<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EServizio.php';
require_once __DIR__ . '/../Foundation/Session.php';

class CServizio {

    public static function aggiungiServizio($titolo, $descrizione, $prezzo) {
        try {
            if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();

            if ($pm->load('EServizio', 'titolo', $titolo)) {
                throw new Exception("Un servizio chiamato '$titolo' esiste già nel catalogo.");
            }

            $nuovoServizio = new EServizio(null, $titolo, $descrizione, $prezzo);

            if (!$pm->store($nuovoServizio)) {
                throw new Exception("Impossibile salvare il servizio.");
            }

            header('Location: ../catalogo.php?msg=servizio_aggiunto');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function richiediLista() {
        try {
            $pm = PersistentManager::getInstance();
            $servizi = $pm->getAll('EServizio');
            return $servizi ?: [];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function eliminaServizio($idS) {
        try {
            if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();
            if (!$pm->delete('EServizio', 'idS', $idS)) {
                throw new Exception("Impossibile eliminare il servizio.");
            }

            header('Location: ../catalogo.php?msg=servizio_eliminato');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>