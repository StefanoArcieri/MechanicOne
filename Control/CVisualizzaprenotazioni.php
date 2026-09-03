<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPrenotazione.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../View/VPrenotazione.php';

class CVisualizzaprenotazioni {

    public function lista($params = []) {
        $view = new VPrenotazione();
        $errore = '';
        try {
            $prenotazioni = $this->getPrenotazioniUtente();
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $prenotazioni = [];
        }
        $view->mostraLista($prenotazioni, $errore);
    }

    public function getPrenotazioniUtente() {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();
        return $pm->search('EPrenotazione', 'idU', $idU) ?: [];
    }

    // stesso discorso dei preventivi: data/ora vecchia resta valida finché non viene accettata la proposta nuova
    public function modifica($idPren) {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();

        $prenData = $pm->load('EPrenotazione', 'idPren', $idPren);
        if (!$prenData) throw new Exception("Prenotazione non trovata.");
        if ($prenData->getIdUtente() != $idU) throw new Exception("Non puoi modificare una prenotazione che non ti appartiene.");
        if (in_array($prenData->getStato(), ['conclusa', 'cancellata'], true)) {
            throw new Exception("Questa prenotazione non è più modificabile.");
        }

        $nuovaData = Request::post('nuovaData', '');
        $nuovaOra = Request::post('nuovaOra', '');
        if ($nuovaData === '' || $nuovaOra === '') {
            throw new Exception("Indica la nuova data e ora.");
        }

        $prenotazioneAggiornata = new EPrenotazione(
            $prenData->getIdPrenotazione(), $prenData->getIdPreventivo(), $prenData->getIdMeccanico(),
            $prenData->getIdUtente(), $prenData->getIdVeicolo(),
            $prenData->getDataPrenotazione(), $prenData->getStato(), $prenData->getOra(),
            $nuovaData, $nuovaOra
        );

        if (!$pm->update($prenotazioneAggiornata)) {
            throw new Exception("Impossibile inviare la modifica.");
        }

        header('Location: /MechanicOne/visualizzaprenotazioni/lista?msg=modifica_inviata');
        exit();
    }

    // ritira la proposta: la prenotazione resta quella già confermata
    public function annullaModifica($idPren) {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();

        $prenData = $pm->load('EPrenotazione', 'idPren', $idPren);
        if (!$prenData) throw new Exception("Prenotazione non trovata.");
        if ($prenData->getIdUtente() != $idU) throw new Exception("Non puoi modificare una prenotazione che non ti appartiene.");

        $prenotazioneRipristinata = new EPrenotazione(
            $prenData->getIdPrenotazione(), $prenData->getIdPreventivo(), $prenData->getIdMeccanico(),
            $prenData->getIdUtente(), $prenData->getIdVeicolo(),
            $prenData->getDataPrenotazione(), $prenData->getStato(), $prenData->getOra(),
            null, null
        );

        if (!$pm->update($prenotazioneRipristinata)) {
            throw new Exception("Impossibile annullare la modifica.");
        }

        header('Location: /MechanicOne/visualizzaprenotazioni/lista?msg=modifica_annullata');
        exit();
    }

    public function annullaPrenotazione($idPren) {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();

        $prenotazione = $pm->load('EPrenotazione', 'idPren', $idPren);
        if (!$prenotazione) throw new Exception("Prenotazione non trovata.");

        if ($prenotazione->getIdUtente() != $idU) {
            throw new Exception("Non puoi annullare una prenotazione che non ti appartiene.");
        }

        if (!$pm->delete('EPrenotazione', 'idPren', $idPren)) {
            throw new Exception("Impossibile annullare la prenotazione.");
        }

        header('Location: /MechanicOne/visualizzaprenotazioni/lista?msg=prenotazione_annullata');
        exit();
    }
}
?>
