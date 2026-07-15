<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VVeicolo.php';

class CGarage {

    public function lista($params = []) {
        $view = new VVeicolo();
        $errore = '';
        try {
            $veicoli = $this->getVeicoliPersonali();
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $veicoli = [];
        }
        $view->mostraGarage($veicoli, $errore);
    }

    public function getVeicoliPersonali() {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();
        return $pm->search('EVeicolo', 'idU', $idU) ?: [];
    }

    public function eliminaVeicolo($idV) {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();

        $veicolo = $pm->load('EVeicolo', 'idV', $idV);
        if (!$veicolo || $veicolo->getIdUtente() != $idU) {
            throw new Exception("Non puoi eliminare un veicolo che non ti appartiene.");
        }

        if (!$pm->delete('EVeicolo', 'idV', $idV)) {
            throw new Exception("Impossibile eliminare il veicolo.");
        }

        header('Location: /MechanicOne/garage/lista?msg=veicolo_eliminato');
        exit();
    }
}
?>
