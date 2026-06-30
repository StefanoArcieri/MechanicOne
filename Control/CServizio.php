<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EServizio.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VServizio.php';

class CServizio {

    public static function aggiungiServizio($titolo, $descrizione) {
        if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

        $pm = PersistentManager::getInstance();

        if ($pm->load('EServizio', 'titolo', $titolo)) {
            throw new Exception("Un servizio chiamato '$titolo' esiste già nel catalogo.");
        }

        $nuovoServizio = new EServizio(null, $titolo, $descrizione);

        if (!$pm->store($nuovoServizio)) {
            throw new Exception("Impossibile salvare il servizio.");
        }

        header('Location: /MechanicOne/servizio/lista?msg=servizio_aggiunto');
        exit();
    }

    public static function richiediLista() {
        $pm = PersistentManager::getInstance();
        return $pm->getAll('EServizio') ?: [];
    }

    public static function eliminaServizio($idS) {
        if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

        $pm = PersistentManager::getInstance();
        if (!$pm->delete('EServizio', 'idS', $idS)) {
            throw new Exception("Impossibile eliminare il servizio.");
        }

        header('Location: /MechanicOne/servizio/lista?msg=servizio_eliminato');
        exit();
    }
}
?>
