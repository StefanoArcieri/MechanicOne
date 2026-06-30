<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/ERecensione.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VRecensione.php';

class CRecensione {

    public static function scrivi($idM, $voto, $testo) {
        $idU = Session::get('idU');
        if (!$idU) throw new Exception("Effettua il login per recensire.");

        $voto = (int) $voto;
        if ($voto < 1 || $voto > 5) throw new Exception("Il voto deve essere compreso tra 1 e 5.");

        $pm = PersistentManager::getInstance();

        if (!$pm->load('EMeccanico', 'idM', $idM)) {
            throw new Exception("Il meccanico che vuoi recensire non esiste.");
        }

        $nuovaRecensione = new ERecensione(null, $idM, $idU, $voto, trim($testo), date('Y-m-d'));

        if (!$pm->store($nuovaRecensione)) {
            throw new Exception("Impossibile pubblicare la recensione.");
        }

        header('Location: /MechanicOne/recensione/lista?msg=recensione_pubblicata');
        exit();
    }

    public static function richiediLista() {
        $pm = PersistentManager::getInstance();
        return $pm->getAll('ERecensione') ?: [];
    }
}
?>
