<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPrenotazione.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VGestisciprenotazioni.php';

class CGestisciprenotazioni {

    public function lista($params = []) {
        $view = new VGestisciprenotazioni();
        $errore = '';
        try {
            $prenotazioni = array_map([$this, 'arricchisci'], $this->richiediLista());
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $prenotazioni = [];
        }
        $view->mostraLista($prenotazioni, $errore);
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

    // se ad accettare è un meccanico, la prenotazione gli viene assegnata direttamente; se è l'admin resta da assegnare
    public function accetta($idPren) {
        $pm = PersistentManager::getInstance();
        $prenData = $pm->load('EPrenotazione', 'idPren', $idPren);
        if (!$prenData) throw new Exception("Prenotazione non trovata.");

        $ruolo = Session::get('ruolo');
        $idM = $ruolo === 'meccanico' ? Session::get('idU') : $prenData->getIdMeccanico();

        $prenotazioneAccettata = new EPrenotazione(
            $prenData->getIdPrenotazione(), $prenData->getIdPreventivo(), $idM,
            $prenData->getIdUtente(), $prenData->getIdVeicolo(),
            $prenData->getDataPrenotazione(), 'accettata', $prenData->getOra()
        );

        if (!$pm->update($prenotazioneAccettata)) {
            throw new Exception("Impossibile confermare la prenotazione.");
        }

        header('Location: /MechanicOne/gestisciprenotazioni/lista?msg=prenotazione_accettata');
        exit();
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

        header('Location: /MechanicOne/gestisciprenotazioni/lista?msg=prenotazione_conclusa');
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

        header('Location: /MechanicOne/gestisciprenotazioni/lista?msg=prenotazione_cancellata');
        exit();
    }
}
?>
