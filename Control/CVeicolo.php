<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EVeicolo.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VVeicolo.php';

class CVeicolo {

    public static function aggiungiVeicolo($targa, $marca, $modello) {
        $idU = Session::get('idU');
        if (!$idU) throw new Exception("Accesso negato.");

        $pm = PersistentManager::getInstance();

        if ($pm->load('EVeicolo', 'targa', strtoupper(trim($targa)))) {
            throw new Exception("Questo veicolo è già registrato nel sistema.");
        }

        $nuovoVeicolo = new EVeicolo(null, strtoupper(trim($targa)), $marca, $modello, $idU);

        if (!$pm->store($nuovoVeicolo)) {
            throw new Exception("Errore tecnico durante il salvataggio del veicolo.");
        }

        header('Location: /MechanicOne/veicolo/lista?msg=veicolo_aggiunto');
        exit();
    }

    public static function getVeicoliPersonali() {
        $idU = Session::get('idU');
        if (!$idU) throw new Exception("Accesso negato.");

        $pm = PersistentManager::getInstance();
        return $pm->search('EVeicolo', 'idU', $idU) ?: [];
    }

    public static function eliminaVeicolo($idV) {
        $idU = Session::get('idU');
        if (!$idU) throw new Exception("Accesso negato.");

        $pm = PersistentManager::getInstance();
        if (!$pm->delete('EVeicolo', 'idV', $idV)) {
            throw new Exception("Impossibile eliminare il veicolo.");
        }

        header('Location: /MechanicOne/veicolo/lista?msg=veicolo_eliminato');
        exit();
    }

    public function nuovo($params = []) {
        return $this->lista($params);
    }

    public function lista($params = []) {
        $view = new VVeicolo();
        $errore = '';
        try {
            $veicoli = self::getVeicoliPersonali();
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $veicoli = [];
        }
        $view->mostraLista($veicoli, $errore);
    }
}
?>
