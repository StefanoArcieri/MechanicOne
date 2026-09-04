<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPreventivo.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../Foundation/PdfPreventivo.php';
require_once __DIR__ . '/../Foundation/Upload.php';
require_once __DIR__ . '/../View/VGestiscipreventivi.php';

class CGestiscipreventivi {

    public function lista($params = []) {
        $view = new VGestiscipreventivi();
        $errore = '';
        try {
            $preventivi = array_map([$this, 'arricchisci'], $this->richiediLista());
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $preventivi = [];
        }
        $view->mostraLista($preventivi, $errore);
    }

    public function richiediLista() {
        $pm = PersistentManager::getInstance();
        return $pm->getAll('EPreventivo') ?: [];
    }

    // idV/idS/idU sono solo id: qui aggiungiamo le etichette leggibili per la tabella admin
    private function arricchisci($pEntity) {
        $p = $pEntity->toArray();
        $pm = PersistentManager::getInstance();

        $veicolo = $pm->load('EVeicolo', 'idV', $p['idV']);
        $p['veicoloLabel'] = $veicolo ? $veicolo->getMarca() . ' ' . $veicolo->getModello() . ' (' . $veicolo->getTarga() . ')' : '—';

        $servizio = $pm->load('EServizio', 'idS', $p['idS']);
        $p['servizioLabel'] = $servizio ? $servizio->getTitolo() : '—';

        $cliente = $pm->load('EUtente', 'idU', $p['idU']);
        $p['clienteLabel'] = $cliente ? trim($cliente->getNome() . ' ' . $cliente->getCognome()) : '—';

        return $p;
    }

    public function updateCosto($idPrev) {
        $pm = PersistentManager::getInstance();
        $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$prevData) throw new Exception("Preventivo non trovato.");

        $nuovoCosto = Request::post('costo');
        if (!is_numeric($nuovoCosto) || (float) $nuovoCosto < 0) {
            throw new Exception("Il prezzo deve essere un numero maggiore o uguale a zero.");
        }

        // se il preventivo aveva una proposta di modifica in sospeso, accettandolo la proposta diventa definitiva
        $descrizioneFinale = $prevData->getDescrizioneProposta() ?: $prevData->getDescrizione();

        $preventivoAggiornato = new EPreventivo(
            $prevData->getIdPreventivo(), $prevData->getIdUtente(), $prevData->getIdVeicolo(), $prevData->getIdServizio(),
            $nuovoCosto, 'accettato', $descrizioneFinale, $prevData->getPdf(), $prevData->getDataRichiesta(),
            null
        );

        if (!$pm->update($preventivoAggiornato)) {
            throw new Exception("Impossibile salvare il prezzo.");
        }

        // il PDF si genera solo ora, con prezzo e stato 'accettato' già definitivi: prima di questo
        // momento il preventivo non è ancora scaricabile. Un eventuale errore qui non deve però far
        // perdere il prezzo appena salvato, quindi è isolato nel suo try/catch.
        try {
            $nomeFile = PdfPreventivo::genera($preventivoAggiornato);
            $preventivoConPdf = new EPreventivo(
                $preventivoAggiornato->getIdPreventivo(), $preventivoAggiornato->getIdUtente(), $preventivoAggiornato->getIdVeicolo(), $preventivoAggiornato->getIdServizio(),
                $preventivoAggiornato->getCosto(), $preventivoAggiornato->getStato(), $preventivoAggiornato->getDescrizione(), $nomeFile, $preventivoAggiornato->getDataRichiesta(),
                null
            );
            $pm->update($preventivoConPdf);
        } catch (Exception $e) {
            error_log("Generazione PDF preventivo #$idPrev fallita: " . $e->getMessage());
        }

        header('Location: /MechanicOne/gestiscipreventivi/lista?msg=preventivo_prezzato');
        exit();
    }

    public function rifiuta($idPrev) {
        $pm = PersistentManager::getInstance();
        $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$prevData) throw new Exception("Preventivo non trovato.");
        // come in updateCosto(), si decide solo su richieste ancora 'inviato': una volta accettato
        // e prezzato (quindi con PDF già generato) non deve più poter tornare indietro a 'rifiutato'
        // lasciando comunque scaricabile un documento che parla di un preventivo ormai respinto.
        if ($prevData->getStato() !== 'inviato') {
            throw new Exception("Questa richiesta non è più in attesa di valutazione.");
        }

        $preventivoRifiutato = new EPreventivo(
            $prevData->getIdPreventivo(), $prevData->getIdUtente(), $prevData->getIdVeicolo(), $prevData->getIdServizio(),
            $prevData->getCosto(), 'rifiutato', $prevData->getDescrizione(), $prevData->getPdf(), $prevData->getDataRichiesta(),
            null
        );

        if (!$pm->update($preventivoRifiutato)) {
            throw new Exception("Impossibile rifiutare il preventivo.");
        }

        header('Location: /MechanicOne/gestiscipreventivi/lista?msg=preventivo_rifiutato');
        exit();
    }

    // Non c'è più un'azione manuale per segnarlo svolto: ci pensa CGestisciprenotazioni::accetta()
    // in automatico, quando un meccanico prende in carico la prenotazione collegata a questo preventivo.

    // A differenza di rifiuta(), qui non c'è whitelist sullo stato: l'admin può eliminare un
    // preventivo in qualunque fase (anche già accettato o svolto), per ripulire richieste di
    // prova, duplicati o roba molto vecchia. In DB la FK prenotazioni->preventivi è ON DELETE
    // CASCADE: se il preventivo aveva già una prenotazione collegata, viene eliminata insieme
    // a lui, non solo scollegata. L'avviso esplicito è nel confirm() del template.
    public function elimina($idPrev) {
        $pm = PersistentManager::getInstance();
        $preventivo = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$preventivo) throw new Exception("Preventivo non trovato.");

        if (!$pm->delete('EPreventivo', 'idPrev', $idPrev)) {
            throw new Exception("Impossibile eliminare il preventivo.");
        }

        // eliminare la riga non tocca /uploads/preventivi: il file va rimosso a mano
        if ($preventivo->getPdf()) {
            Upload::elimina('preventivi', $preventivo->getPdf());
        }

        header('Location: /MechanicOne/gestiscipreventivi/lista?msg=preventivo_eliminato');
        exit();
    }

    // Uguale alla versione cliente in CVisualizzapreventivi, ma senza controllo di proprietà:
    // l'admin può scaricare il PDF di qualunque preventivo.
    public function scaricaPdf($idPrev) {
        $pm = PersistentManager::getInstance();

        $preventivo = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$preventivo) throw new Exception("Preventivo non trovato.");
        // il campo pdf da solo basterebbe (si valorizza solo in updateCosto), ma controllare anche lo
        // stato è una seconda barriera esplicita: un preventivo solo 'inviato' non deve mai risultare
        // scaricabile, qualunque cosa succeda in futuro alla colonna pdf.
        if ($preventivo->getStato() !== 'accettato' && $preventivo->getStato() !== 'svolto') {
            throw new Exception("Il PDF sarà disponibile solo dopo che l'admin avrà accettato e fissato un prezzo.");
        }
        if (!$preventivo->getPdf()) throw new Exception("Nessun PDF disponibile per questo preventivo.");

        $percorso = __DIR__ . '/../uploads/preventivi/' . basename($preventivo->getPdf());
        if (!is_file($percorso)) throw new Exception("Il file PDF non è più disponibile.");

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="preventivo_' . $preventivo->getIdPreventivo() . '.pdf"');
        header('Content-Length: ' . filesize($percorso));
        readfile($percorso);
        exit();
    }
}
?>
