<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPrenotazione.php';
require_once __DIR__ . '/../Entity/EPreventivo.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../View/VGestisciprenotazioni.php';
require_once __DIR__ . '/CGestiscimeccanici.php';

class CGestisciprenotazioni {

    // Navigazione a 3 livelli, tutta su questo stesso metodo:
    //  /gestisciprenotazioni/lista                      -> mesi che hanno almeno una prenotazione
    //  /gestisciprenotazioni/lista/{anno}/{mese}         -> settimane di quel mese
    //  /gestisciprenotazioni/lista/{anno}/{mese}/{lun}    -> prenotazioni di quella settimana (lun = lunedì, Y-m-d)
    public function lista($anno = null, $mese = null, $settimanaInizio = null) {
        $view = new VGestisciprenotazioni();
        $errore = '';
        try {
            $prenotazioni = array_map([$this, 'arricchisci'], $this->richiediLista());
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $prenotazioni = [];
        }

        if ($anno && $mese && $settimanaInizio) {
            // per il selettore "assegna meccanico" nel form di modifica, solo l'admin lo vede/usa
            $meccanici = Session::get('ruolo') === 'admin'
                ? array_map([new CGestiscimeccanici(), 'arricchisciConNome'], (new CGestiscimeccanici())->richiediLista())
                : [];
            $view->mostraSettimana((int) $anno, (int) $mese, $settimanaInizio, $prenotazioni, $errore, $meccanici);
        } elseif ($anno && $mese) {
            $view->mostraSettimaneDelMese((int) $anno, (int) $mese, $prenotazioni, $errore);
        } else {
            $view->mostraMesi($prenotazioni, $errore);
        }
    }

    // Dopo un'azione (accetta/concludi/cancella) si torna alla stessa settimana da cui si è partiti,
    // non alla lista dei mesi: il form nasconde anno/mese/settimanaInizio, li leggiamo da qui.
    private function redirectAllaSettimana($msg) {
        $anno = Request::post('anno');
        $mese = Request::post('mese');
        $settimanaInizio = Request::post('settimanaInizio');

        if ($anno && $mese && $settimanaInizio) {
            return "/MechanicOne/gestisciprenotazioni/lista/$anno/$mese/$settimanaInizio?msg=$msg";
        }
        return "/MechanicOne/gestisciprenotazioni/lista?msg=$msg";
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
        $idM = $presaInCaricoDaMeccanico ? Session::get('idU') : $prenData->getIdMeccanico();

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

        header('Location: ' . $this->redirectAllaSettimana('prenotazione_accettata'));
        exit();
    }

    private function completaPreventivoCollegato($idPrev) {
        $pm = PersistentManager::getInstance();
        $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$prevData || $prevData->getStato() !== 'accettato') return;

        $preventivoSvolto = new EPreventivo(
            $prevData->getIdPreventivo(), $prevData->getIdUtente(), $prevData->getIdVeicolo(), $prevData->getIdServizio(),
            $prevData->getCosto(), 'svolto', $prevData->getDescrizione(), $prevData->getPdf(), $prevData->getDataRichiesta(),
            null
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

        header('Location: ' . $this->redirectAllaSettimana('prenotazione_conclusa'));
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
        if ($nuovaData === '' || $nuovaOra === '') {
            throw new Exception("Data e ora sono obbligatorie.");
        }

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

        // la data è cambiata: la prenotazione potrebbe essere finita in un'altra settimana/mese,
        // seguiamola invece di rimandare l'admin a una vista ormai vuota
        $ts = strtotime($nuovaData);
        $giornoSettimana = (int) date('N', $ts);
        $lunedi = date('Y-m-d', strtotime('-' . ($giornoSettimana - 1) . ' days', $ts));

        header('Location: /MechanicOne/gestisciprenotazioni/lista/' . date('Y', $ts) . '/' . date('n', $ts) . '/' . $lunedi . '?msg=prenotazione_modificata');
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

        header('Location: ' . $this->redirectAllaSettimana('prenotazione_cancellata'));
        exit();
    }
}
?>
