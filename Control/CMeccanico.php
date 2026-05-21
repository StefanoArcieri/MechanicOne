<?php

require_once __DIR__ . '/../foundation/config.php';
require_once __DIR__ . '/../foundation/FMeccanico.php';
require_once __DIR__ . '/../entity/EMeccanico.php';
require_once __DIR__ . '/../foundation/Session.php';

class CMeccanico {

    public static function getProfilo() {
        global $pdo;

        try {
            $idM = Session::get('idU');
            $ruolo = Session::get('ruolo');

            if (!$idM || $ruolo !== 'meccanico') {
                throw new Exception("Accesso negato: Area riservata allo staff tecnico.");
            }

            $fMeccanico = new FMeccanico();
            $profilo = $fMeccanico->load('idM', $idM, $pdo);

            if (!$profilo) {
                throw new Exception("Profilo meccanico non trovato.");
            }

            return $profilo;

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function aggiornaProfilo($nuovaSpecializzazione, $nuovaFoto) {
        global $pdo;

        try {
            $idM = Session::get('idU');
            if (Session::get('ruolo') !== 'meccanico') {
                throw new Exception("Accesso negato.");
            }

            $fMeccanico = new FMeccanico();
            
            $datiAttuali = $fMeccanico->load('idM', $idM, $pdo);
            if (!$datiAttuali) {
                throw new Exception("Errore nel caricamento del profilo.");
            }

            $meccanicoAggiornato = new EMeccanico(
                null, '', '', '', '', '', null, null, 
                $idM,                                 
                $nuovaSpecializzazione,               
                $nuovaFoto,                           
                $datiAttuali['status']                
            );

            if (!$fMeccanico->update($meccanicoAggiornato, $pdo)) {
                throw new Exception("Impossibile aggiornare il profilo.");
            }

            header('Location: ../profilo_meccanico.php?msg=profilo_aggiornato');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function richiediLista() {
        global $pdo;

        try {
            if (Session::get('ruolo') !== 'admin') {
                throw new Exception("Accesso negato: Area riservata alla direzione.");
            }

            $fMeccanico = new FMeccanico();!
            $lista = $fMeccanico->getAll($pdo);

            return ($lista === false) ? [] : $lista;

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function approvaMeccanico($idM) {
        global $pdo;

        try {
            if (Session::get('ruolo') !== 'admin') {
                throw new Exception("Accesso negato.");
            }

            $fMeccanico = new FMeccanico();
            
            $datiAttuali = $fMeccanico->load('idM', $idM, $pdo);
            if (!$datiAttuali) {
                throw new Exception("Meccanico non trovato nel sistema.");
            }

            $meccanicoApprovato = new EMeccanico(
                null, '', '', '', '', '', null, null, 
                $idM,
                $datiAttuali['specializzazione'],
                $datiAttuali['foto_profilo'] ?? $datiAttuali['fotoprofilo'],
                'approvato'
            );

            if (!$fMeccanico->update($meccanicoApprovato, $pdo)) {
                throw new Exception("Impossibile approvare il meccanico per un errore tecnico.");
            }

            header('Location: ../admin_dashboard.php?msg=meccanico_approvato');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function eliminaMeccanico($idM) {
        global $pdo;

        try {
            if (Session::get('ruolo') !== 'admin') {
                throw new Exception("Accesso negato.");
            }

            $fMeccanico = new FMeccanico();

            if (!$fMeccanico->delete('idM', $idM, $pdo)) {
                throw new Exception("Impossibile eliminare il meccanico (potrebbe avere prenotazioni assegnate).");
            }

            header('Location: ../admin_dashboard.php?msg=meccanico_eliminato');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>