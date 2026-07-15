<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';

class CGestisciprenotazioni {

    public function richiediLista() {
        $pm = PersistentManager::getInstance();
        return $pm->getAll('EPrenotazione') ?: [];
    }
}
?>
