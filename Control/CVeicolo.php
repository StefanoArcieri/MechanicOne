<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EVeicolo.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VVeicolo.php';

class CVeicolo {

    public static function aggiungiVeicolo($targa, $marca, $modello) {
        try {
            $idU = Session::get('idU');
            if (!$idU) throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();

            // Verifica duplicato targa tramite PM
            if ($pm->load('EVeicolo', 'targa', strtoupper(trim($targa)))) {
                throw new Exception("Attenzione: Questo veicolo risulta già registrato.");
            }

            $nuovoVeicolo = new EVeicolo(null, $idU, strtoupper(trim($targa)), $marca, $modello);

            if (!$pm->store($nuovoVeicolo)) {
                throw new Exception("Errore tecnico durante il salvataggio del veicolo.");
            }

            header('Location: /MechanicOne/veicolo/lista?msg=veicolo_aggiunto');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function getVeicoliPersonali() {
        try {
            $idU = Session::get('idU');
            if (!$idU) return [];

            $pm = PersistentManager::getInstance();
            $veicoli = $pm->search('EVeicolo', 'idU', $idU);
            return $veicoli ?: [];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function eliminaVeicolo($idV) {
        try {
            $idU = Session::get('idU');
            if (!$idU) throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();
            if (!$pm->delete('EVeicolo', 'idV', $idV)) {
                throw new Exception("Impossibile eliminare il veicolo.");
            }

            header('Location: /MechanicOne/veicolo/lista?msg=veicolo_eliminato');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function nuovo($params = []) {
        return $this->lista($params);
    }

    public function lista($params = []) {
        $view = new VVeicolo();
        $veicoli = self::getVeicoliPersonali();
        $view->mostraLista($veicoli);
    }
}
?>