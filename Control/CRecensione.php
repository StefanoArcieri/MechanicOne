<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/ERecensione.php';     
require_once __DIR__ . '/../Foundation/Session.php';

class CRecensione {

    public static function scrivi($idP, $voto, $testo) {
        try {
            $idU = Session::get('idU');
            if (!$idU) throw new Exception("Effettua il login per recensire.");

            $pm = PersistentManager::getInstance();
            $nuovaRecensione = new ERecensione(null, $idU, $idP, (int)$voto, trim($testo), date('Y-m-d'));

            if (!$pm->store($nuovaRecensione)) {
                throw new Exception("Impossibile pubblicare la recensione.");
            }

            header('Location: ../index.php?msg=recensione_pubblicata');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function richiediLista() {
        try {
            $pm = PersistentManager::getInstance();
            $recensioni = $pm->getAll('ERecensione');
            return $recensioni ?: [];
        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>