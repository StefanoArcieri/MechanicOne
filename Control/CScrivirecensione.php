<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/ERecensione.php';
require_once __DIR__ . '/../Foundation/Session.php';

class CScrivirecensione {

    public function scrivi() {
        $idU = Session::get('idU');
        $idM = $_POST['idM'] ?? '';
        $testo = trim($_POST['testo'] ?? '');
        $voto = (int) ($_POST['voto'] ?? 0);

        if ($voto < 1 || $voto > 5) throw new Exception("Il voto deve essere compreso tra 1 e 5.");
        if ($testo === '') throw new Exception("Scrivi un commento per la recensione.");

        $pm = PersistentManager::getInstance();

        $meccanico = $pm->load('EMeccanico', 'idM', $idM);
        if (!$meccanico || $meccanico->getStatus() !== 'approvato') {
            throw new Exception("Il meccanico che vuoi recensire non è disponibile.");
        }

        $nuovaRecensione = new ERecensione(null, $idM, $idU, $voto, $testo, date('Y-m-d'));

        if (!$pm->store($nuovaRecensione)) {
            throw new Exception("Impossibile pubblicare la recensione.");
        }

        header('Location: /MechanicOne/utente/home?msg=recensione_pubblicata#recensioni');
        exit();
    }
}
?>
