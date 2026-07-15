<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPreventivo.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VPreventivo.php';

class CVisualizzapreventivi {

    // questo controller è solo lato cliente, la vista "tutti i preventivi" per meccanico/admin sta in CGestiscipreventivi
    public function lista($params = []) {
        $view = new VPreventivo();
        $errore = '';
        try {
            $preventivi = $this->getPreventiviUtente();
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $preventivi = [];
        }
        $view->mostraLista($preventivi, $errore);
    }

    public function getPreventiviUtente() {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();
        return $pm->search('EPreventivo', 'idU', $idU) ?: [];
    }

    // non sovrascriviamo la descrizione originale: resta lì finché il meccanico non accetta la proposta,
    // così se l'utente annulla la modifica il preventivo torna com'era
    public function modifica($idPrev) {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();

        $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$prevData) throw new Exception("Preventivo non trovato.");
        if ($prevData->getIdUtente() != $idU) throw new Exception("Non puoi modificare un preventivo che non ti appartiene.");
        if (in_array($prevData->getStato(), ['rifiutato', 'svolto'], true)) {
            throw new Exception("Questo preventivo non è più modificabile.");
        }

        $nuovaDescrizione = trim($_POST['nuovaDescrizione'] ?? '');
        if ($nuovaDescrizione === '') {
            throw new Exception("La descrizione non può essere vuota.");
        }

        $preventivoAggiornato = new EPreventivo(
            $prevData->getIdPreventivo(), $prevData->getIdUtente(), $prevData->getIdVeicolo(), $prevData->getIdServizio(),
            $prevData->getCosto(), $prevData->getStato(), $prevData->getDescrizione(), $prevData->getPdf(), $prevData->getDataRichiesta(),
            $nuovaDescrizione
        );

        if (!$pm->update($preventivoAggiornato)) {
            throw new Exception("Impossibile inviare la modifica.");
        }

        header('Location: /MechanicOne/visualizzapreventivi/lista?msg=modifica_inviata');
        exit();
    }

    // ritira la proposta: il preventivo resta quello già in vigore
    public function annullaModifica($idPrev) {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();

        $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$prevData) throw new Exception("Preventivo non trovato.");
        if ($prevData->getIdUtente() != $idU) throw new Exception("Non puoi modificare un preventivo che non ti appartiene.");

        $preventivoRipristinato = new EPreventivo(
            $prevData->getIdPreventivo(), $prevData->getIdUtente(), $prevData->getIdVeicolo(), $prevData->getIdServizio(),
            $prevData->getCosto(), $prevData->getStato(), $prevData->getDescrizione(), $prevData->getPdf(), $prevData->getDataRichiesta(),
            null
        );

        if (!$pm->update($preventivoRipristinato)) {
            throw new Exception("Impossibile annullare la modifica.");
        }

        header('Location: /MechanicOne/visualizzapreventivi/lista?msg=modifica_annullata');
        exit();
    }
}
?>
