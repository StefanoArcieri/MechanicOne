<?php

require_once __DIR__ . '/../foundation/config.php';
require_once __DIR__ . '/../foundation/FPrenotazione.php'; 
require_once __DIR__ . '/../entity/EPrenotazione.php';     
require_once __DIR__ . '/../foundation/Session.php';

class CPrenotazione {

    public static function richiedi($data, $ora, $idM, $idRiferimento) {
        global $pdo;

        try {
            $idU = Session::get('idU');
            if (!$idU) {
                throw new Exception("Accesso negato: effettua il login per prenotare un intervento.");
            }

            $fPrenotazione = new FPrenotazione();
            $nuovaPrenotazione = new EPrenotazione(null, $idU, $idM, $idRiferimento, $data, $ora, 'in attesa');

            if (!$fPrenotazione->store($nuovaPrenotazione, $pdo)) {
                throw new Exception("Si è verificato un problema tecnico. Impossibile salvare la prenotazione.");
            }

            header('Location: ../index.php?msg=prenotazione_confermata');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function getPrenotazioniUtente() {
        global $pdo;

        try {
            $idU = Session::get('idU');
            if (!$idU) {
                throw new Exception("Devi effettuare l'accesso per visualizzare il tuo calendario.");
            }

            $fPrenotazione = new FPrenotazione();
            $prenotazioni = $fPrenotazione->search('idU', $idU, $pdo);
            
            return ($prenotazioni === false) ? [] : $prenotazioni;

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function getPrenotazioniMeccanico() {
        global $pdo;

        try {
            $idM = Session::get('idU'); 
            $ruolo = Session::get('ruolo');

            if (!$idM || $ruolo !== 'meccanico') {
                throw new Exception("Accesso negato: Area riservata allo staff tecnico.");
            }

            $fPrenotazione = new FPrenotazione();
            $prenotazioni = $fPrenotazione->search('idM', $idM, $pdo);
            
            return ($prenotazioni === false) ? [] : $prenotazioni;

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function cancellaPrenotazione($idP) {
        global $pdo;

        try {

            $idLoggato = Session::get('idU');
            $ruoloLoggato = Session::get('ruolo');
            
            if (!$idLoggato) {
                throw new Exception("Accesso negato: effettua il login per annullare una prenotazione.");
            }

            $fPrenotazione = new FPrenotazione();
            
            $prenotazioneData = $fPrenotazione->load('idP', $idP, $pdo);
            
            if (!$prenotazioneData) {
                throw new Exception("Attenzione: Prenotazione non trovata nel sistema.");
            }

            if ($ruoloLoggato !== 'admin' && $prenotazioneData['idU'] != $idLoggato) {
                throw new Exception("Operazione non autorizzata: non puoi cancellare questa prenotazione.");
            }

            if (!$fPrenotazione->delete('idP', $idP, $pdo)) {
                throw new Exception("Impossibile cancellare la prenotazione a causa di un errore tecnico.");
            }

            if ($ruoloLoggato === 'admin') {
                header('Location: ../admin_dashboard.php?msg=prenotazione_cancellata');
            } else {
                header('Location: ../index.php?msg=prenotazione_annullata');
            }
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function switchMeccanico($idP, $nuovoIdM) {
        global $pdo;

        try {
            
            if (Session::get('ruolo') !== 'admin') {
                throw new Exception("Operazione non autorizzata: Privilegi di amministrazione richiesti.");
            }

            $fPrenotazione = new FPrenotazione();
            
            $prenotazioneData = $fPrenotazione->load('idP', $idP, $pdo);
            if (!$prenotazioneData) {
                throw new Exception("Errore: Prenotazione non trovata.");
            }

            $prenotazioneAggiornata = new EPrenotazione(
                $prenotazioneData['idP'],
                $prenotazioneData['idU'],
                $nuovoIdM, 
                $prenotazioneData['idRiferimento'] ?? $prenotazioneData['idPreventivo'] ?? $prenotazioneData['idS'],
                $prenotazioneData['data'],
                $prenotazioneData['ora'],
                $prenotazioneData['status'] ?? $prenotazioneData['stato']
            );

            if (!$fPrenotazione->update($prenotazioneAggiornata, $pdo)) {
                throw new Exception("Impossibile completare la riassegnazione del meccanico.");
            }

            header('Location: ../admin_dashboard.php?msg=meccanico_aggiornato');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>