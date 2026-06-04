<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPreventivo.php';     
require_once __DIR__ . '/../Foundation/Session.php';

class CPreventivo {

    public static function richiedi($idV, $idS, $descrizione) {
        try {
            $idU = Session::get('idU');
            if (!$idU) throw new Exception("Effettua il login per richiedere un preventivo.");

            $pm = PersistentManager::getInstance();
            $nuovoPreventivo = new EPreventivo(
                null, $idU, $idV, $idS, null, 'in attesa', $descrizione, null, date('Y-m-d')
            );

            if (!$pm->store($nuovoPreventivo)) {
                throw new Exception("Problema tecnico durante l'invio della richiesta.");
            }

            header('Location: ../index.php?msg=preventivo_inviato');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function getPreventiviUtente() {
        try {
            $idU = Session::get('idU');
            if (!$idU) throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();
            $preventivi = $pm->search('EPreventivo', 'idU', $idU);
            return $preventivi ?: [];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function richiediLista() {
        try {
            if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();
            $preventivi = $pm->getAll('EPreventivo');
            return $preventivi ?: [];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function updateCosto($idPrev, $nuovoCosto) {
        try {
            if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();
            $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
            if (!$prevData) throw new Exception("Preventivo non trovato.");

            $preventivoAggiornato = new EPreventivo(
                $prevData['idPrev'], $prevData['idU'], $prevData['idV'], $prevData['idS'],
                $nuovoCosto, 'valutato', $prevData['descrizione'], $prevData['pdf'], $prevData['data_richiesta']
            );

            if (!$pm->update($preventivoAggiornato)) {
                throw new Exception("Impossibile salvare il prezzo.");
            }

            header('Location: ../admin_dashboard.php?msg=preventivo_prezzato');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function rifiuta($idPrev) {
        try {
            if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();
            $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
            if (!$prevData) throw new Exception("Preventivo non trovato.");

            $preventivoRifiutato = new EPreventivo(
                $prevData['idPrev'], $prevData['idU'], $prevData['idV'], $prevData['idS'],
                $prevData['costo'], 'rifiutato', $prevData['descrizione'], $prevData['pdf'], $prevData['data_richiesta']
            );

            if (!$pm->update($preventivoRifiutato)) {
                throw new Exception("Impossibile rifiutare il preventivo.");
            }

            header('Location: ../admin_dashboard.php?msg=preventivo_rifiutato');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>