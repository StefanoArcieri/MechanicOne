<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';

class CVisualizzarecensioni {

    public function richiediLista() {
        $pm = PersistentManager::getInstance();
        return $pm->getAll('ERecensione') ?: [];
    }
}
?>
