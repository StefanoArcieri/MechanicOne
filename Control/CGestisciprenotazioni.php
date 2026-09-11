<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPrenotazione.php';
require_once __DIR__ . '/../Entity/EPreventivo.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../View/VPrenotazione.php';
require_once __DIR__ . '/CGestiscimeccanici.php';

class CGestisciprenotazioni {

    // Una sola pagina, tutte le prenotazioni raggruppate per mese (la View se ne occupa,
    // stessa classe usata anche lato cliente — VPrenotazione::mostraLista() decide il resto
    // in base al ruolo, come già fatto per i preventivi).
    public function lista() {
        $view = new VPrenotazione();
        $errore = '';

        try {
            $prenotazioni = array_map([$this, 'arricchisci'], $this->richiediLista());

            // il meccanico vede solo le proprie prese in carico + quelle 'in attesa' (idM ancora
            // null: pool condiviso da cui chiunque può accettare) — mai quelle degli altri colleghi
            if (Session::get('ruolo') === 'meccanico') {
                $mioId = (int) Session::get('idU');
                $prenotazioni = array_values(array_filter($prenotazioni, function ($p) use ($mioId) {
                    return $p['idM'] === null || (int) $p['idM'] === $mioId;
                }));
            }
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $prenotazioni = [];
        }

        // per il selettore "assegna meccanico" nel form di modifica, solo l'admin lo vede/usa
        $meccanici = Session::get('ruolo') === 'admin'
            ? array_map([new CGestiscimeccanici(), 'arricchisciConNome'], (new CGestiscimeccanici())->richiediLista())
            : [];

        $view->mostraLista($prenotazioni, $errore, $meccanici);
    }


    public function richiediLista() {
        $pm = PersistentManager::getInstance();
        return $pm->getAll('EPrenotazione') ?: [];
    }

    private function arricchisci($pEntity) {
        $p = $pEntity->toArray();
        $pm = PersistentManager::getInstance();

        $veicolo = $pm->load('EVeicolo', 'idV', $p['idV']);
        $p['veicoloLabel'] = $veicolo ? $veicolo->getMarca() . ' ' . $veicolo->getModello() . ' (' . $veicolo->getTarga() . ')' : '—';

        $cliente = $pm->load('EUtente', 'idU', $p['idU']);
        $p['clienteLabel'] = $cliente ? trim($cliente->getNome() . ' ' . $cliente->getCognome()) : '—';

        if ($p['idM']) {
            $meccanico = $pm->load('EUtente', 'idU', $p['idM']);
            $p['meccanicoLabel'] = $meccanico ? trim($meccanico->getNome() . ' ' . $meccanico->getCognome()) : '—';
        } else {
            $p['meccanicoLabel'] = null;
        }

        return $p;
    }

    // se ad accettare è un meccanico, la prenotazione gli viene assegnata direttamente (la "prende in
    // carico"): a quel punto il preventivo collegato, se c'era, si considera svolto in automatico —
    // non serve più che l'admin lo segni a mano. Se è l'admin ad accettare, resta solo da assegnare
    // e il preventivo non viene toccato: il lavoro non è ancora stato preso in carico da nessuno.
    public function accetta($idPren) {
        $pm = PersistentManager::getInstance();
        $prenData = $pm->load('EPrenotazione', 'idPren', $idPren);
        if (!$prenData) throw new Exception("Prenotazione non trovata.");

        $ruolo = Session::get('ruolo');
        $presaInCaricoDaMeccanico = $ruolo === 'meccanico';
        $idM = $presaInCaricoDaMeccanico ? Session::get('idU') : Request::post('idM', '');

        $prenotazioneAccettata = new EPrenotazione(
            $prenData->getIdPrenotazione(), $prenData->getIdPreventivo(), $idM,
            $prenData->getIdUtente(), $prenData->getIdVeicolo(),
            $prenData->getDataPrenotazione(), 'accettata', $prenData->getOra()
        );

        if (!$pm->update($prenotazioneAccettata)) {
            throw new Exception("Impossibile confermare la prenotazione.");
        }

        if ($presaInCaricoDaMeccanico && $prenData->getIdPreventivo()) {
            $this->completaPreventivoCollegato($prenData->getIdPreventivo());
        }

        header('Location: /MechanicOne/gestisciprenotazioni/lista?msg=prenotazione_accettata#prenotazione-'.$idPren);
        exit();
    }

    private function completaPreventivoCollegato($idPrev) {
        $pm = PersistentManager::getInstance();
        $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$prevData || $prevData->getStato() !== 'accettato') return;

        $preventivoSvolto = new EPreventivo(
            $prevData->getIdPreventivo(), $prevData->getIdUtente(), $prevData->getIdVeicolo(), $prevData->getIdServizio(),
            $prevData->getCosto(), 'svolto', $prevData->getDescrizione(), $prevData->getPdf(), $prevData->getDataRichiesta()
        );
        $pm->update($preventivoSvolto);
    }

    public function concludi($idPren) {
        $pm = PersistentManager::getInstance();
        $prenData = $pm->load('EPrenotazione', 'idPren', $idPren);
        if (!$prenData) throw new Exception("Prenotazione non trovata.");
        if ($prenData->getStato() !== 'accettata') {
            throw new Exception("Solo una prenotazione confermata può essere conclusa.");
        }

        $prenotazioneConclusa = new EPrenotazione(
            $prenData->getIdPrenotazione(), $prenData->getIdPreventivo(), $prenData->getIdMeccanico(),
            $prenData->getIdUtente(), $prenData->getIdVeicolo(),
            $prenData->getDataPrenotazione(), 'conclusa', $prenData->getOra()
        );

        if (!$pm->update($prenotazioneConclusa)) {
            throw new Exception("Impossibile concludere la prenotazione.");
        }

        header('Location: /MechanicOne/gestisciprenotazioni/lista?msg=prenotazione_conclusa#prenotazione-'.$idPren);
        exit();
    }

    // L'admin può spostare direttamente data/ora di una prenotazione (niente proposta da
    // approvare come lato cliente: qui la modifica è già autoritativa) e assegnare, cambiare
    // o togliere il meccanico responsabile. Lo stato non cambia.
    public function modifica($idPren) {
        $pm = PersistentManager::getInstance();
        $prenData = $pm->load('EPrenotazione', 'idPren', $idPren);
        if (!$prenData) throw new Exception("Prenotazione non trovata.");

        if (in_array($prenData->getStato(), ['conclusa', 'cancellata'], true)) {
            throw new Exception("Questa prenotazione non è più modificabile.");
        }

        $nuovaData = Request::post('data', '');
        $nuovaOra = Request::post('ora', '');

        // '' nel select = "nessuno": toglie l'assegnazione. Un id valorizzato = assegna/cambia meccanico.
        $idMPost = Request::post('idM', '');
        $nuovoIdM = $idMPost !== '' ? (int) $idMPost : null;
        if ($nuovoIdM !== null && !$pm->load('EMeccanico', 'idM', $nuovoIdM)) {
            throw new Exception("Il meccanico selezionato non esiste.");
        }

        $prenotazioneModificata = new EPrenotazione(
            $prenData->getIdPrenotazione(), $prenData->getIdPreventivo(), $nuovoIdM,
            $prenData->getIdUtente(), $prenData->getIdVeicolo(),
            $nuovaData, $prenData->getStato(), $nuovaOra
        );

        if (!$pm->update($prenotazioneModificata)) {
            throw new Exception("Impossibile modificare la prenotazione.");
        }

        header('Location: /MechanicOne/gestisciprenotazioni/lista?msg=prenotazione_modificata#prenotazione-'.$idPren);
        exit();
    }

    // a differenza di annullaPrenotazione (lato cliente, che cancella la riga), qui teniamo lo storico
    public function cancella($idPren) {
        $pm = PersistentManager::getInstance();
        $prenData = $pm->load('EPrenotazione', 'idPren', $idPren);
        if (!$prenData) throw new Exception("Prenotazione non trovata.");

        $prenotazioneCancellata = new EPrenotazione(
            $prenData->getIdPrenotazione(), $prenData->getIdPreventivo(), $prenData->getIdMeccanico(),
            $prenData->getIdUtente(), $prenData->getIdVeicolo(),
            $prenData->getDataPrenotazione(), 'cancellata', $prenData->getOra()
        );

        if (!$pm->update($prenotazioneCancellata)) {
            throw new Exception("Impossibile cancellare la prenotazione.");
        }

        header('Location: /MechanicOne/gestisciprenotazioni/lista?msg=prenotazione_cancellata#prenotazione-'.$idPren);
        exit();
    }

    public function elimina($idPren){
        $pm = PersistentManager::getInstance();
        $prenData = $pm->load('EPrenotazione', 'idPren', $idPren);
        if (!$prenData) throw new Exception("Prenotazione non trovata.");

        if (!$pm->delete('EPrenotazione', 'idPren', $idPren)) {
            throw new Exception("Impossibile eliminare la prenotazione.");
        }

        header('Location: /MechanicOne/gestisciprenotazioni/lista?msg=prenotazione_eliminata#prenotazione-'.$idPren);
        exit();
    }
}
?>
