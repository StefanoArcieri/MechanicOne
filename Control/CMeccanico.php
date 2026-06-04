<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EMeccanico.php';
require_once __DIR__ . '/../Foundation/Session.php';

class CMeccanico {

    public static function getProfilo() {
        try {
            $idM = Session::get('idU');
            if (!$idM || Session::get('ruolo') !== 'meccanico') {
                throw new Exception("Accesso negato.");
            }

            $pm = PersistentManager::getInstance();
            $profilo = $pm->load('EMeccanico', 'idM', $idM);
            if (!$profilo) throw new Exception("Profilo meccanico non trovato.");

            return $profilo;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function aggiornaProfilo($nuovaSpecializzazione, $nuovaFoto) {
        try {
            $idM = Session::get('idU');
            if (Session::get('ruolo') !== 'meccanico') throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();
            $datiAttuali = $pm->load('EMeccanico', 'idM', $idM);
            if (!$datiAttuali) throw new Exception("Errore caricamento profilo.");

            $meccanicoAggiornato = new EMeccanico(
                null, '', '', '', '', '', null, null, 
                $idM, $nuovaSpecializzazione, $nuovaFoto, $datiAttuali['status']
            );

            if (!$pm->update($meccanicoAggiornato)) {
                throw new Exception("Impossibile aggiornare il profilo.");
            }

            header('Location: ../profilo_meccanico.php?msg=profilo_aggiornato');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function richiediLista() {
        try {
            if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();
            $lista = $pm->getAll('EMeccanico');
            return $lista ?: [];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function approvaMeccanico($idM) {
        try {
            if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();
            $datiAttuali = $pm->load('EMeccanico', 'idM', $idM);
            if (!$datiAttuali) throw new Exception("Meccanico non trovato.");

            $meccanicoApprovato = new EMeccanico(
                null, '', '', '', '', '', null, null, 
                $idM, $datiAttuali['specializzazione'], $datiAttuali['foto_profilo'] ?? $datiAttuali['fotoprofilo'], 'approvato'
            );

            if (!$pm->update($meccanicoApprovato)) {
                throw new Exception("Impossibile approvare il meccanico.");
            }

            header('Location: ../admin_dashboard.php?msg=meccanico_approvato');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function eliminaMeccanico($idM) {
        try {
            if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();
            if (!$pm->delete('EMeccanico', 'idM', $idM)) {
                throw new Exception("Impossibile eliminare il meccanico.");
            }

            header('Location: ../admin_dashboard.php?msg=meccanico_eliminato');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>