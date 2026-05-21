<?php

require_once __DIR__ . '/../foundation/config.php';
require_once __DIR__ . '/../foundation/FPreventivo.php'; 
require_once __DIR__ . '/../entity/EPreventivo.php';     
require_once __DIR__ . '/../foundation/Session.php';

class CPreventivo {

    public static function richiedi($idV, $idS, $descrizione) {
        global $pdo;

        try {
            $idU = Session::get('idU');
            if (!$idU) {
                throw new Exception("Accesso negato: effettua il login per richiedere un preventivo.");
            }

            $fPreventivo = new FPreventivo();

            $nuovoPreventivo = new EPreventivo(
                null, 
                $idU, 
                $idV, 
                $idS, 
                null, 
                'in attesa', 
                $descrizione, 
                null, 
                date('Y-m-d') 
            );

            if (!$fPreventivo->store($nuovoPreventivo, $pdo)) {
                throw new Exception("Problema tecnico durante l'invio della richiesta. Riprova più tardi.");
            }

            header('Location: ../index.php?msg=preventivo_inviato');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function getPreventiviUtente() {
        global $pdo;

        try {
            $idU = Session::get('idU');
            if (!$idU) {
                throw new Exception("Effettua l'accesso per visualizzare i tuoi preventivi.");
            }

            $fPreventivo = new FPreventivo();
            $preventivi = $fPreventivo->search('idU', $idU, $pdo);
            
            return ($preventivi === false) ? [] : $preventivi;

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

            $fPreventivo = new FPreventivo();
            $preventivi = $fPreventivo->getAll($pdo);
            
            return ($preventivi === false) ? [] : $preventivi;

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function updateCosto($idPrev, $nuovoCosto) {
        global $pdo;

        try {
            if (Session::get('ruolo') !== 'admin') {
                throw new Exception("Accesso negato: Solo la direzione può prezzare i preventivi.");
            }

            $fPreventivo = new FPreventivo();
            
            $prevData = $fPreventivo->load('idPrev', $idPrev, $pdo);
            if (!$prevData) {
                throw new Exception("Errore: Preventivo non trovato.");
            }

            $preventivoAggiornato = new EPreventivo(
                $prevData['idPrev'],
                $prevData['idU'],
                $prevData['idV'],
                $prevData['idS'],
                $nuovoCosto,              
                'valutato',               
                $prevData['descrizione'],
                $prevData['pdf'],
                $prevData['data_richiesta']
            );

            if (!$fPreventivo->update($preventivoAggiornato, $pdo)) {
                throw new Exception("Impossibile salvare il prezzo a causa di un errore tecnico.");
            }

            header('Location: ../admin_dashboard.php?msg=preventivo_prezzato');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function rifiuta($idPrev) {
        global $pdo;

        try {
            if (Session::get('ruolo') !== 'admin') {
                throw new Exception("Accesso negato: Solo la direzione può rifiutare i preventivi.");
            }

            $fPreventivo = new FPreventivo();
            
            $prevData = $fPreventivo->load('idPrev', $idPrev, $pdo);
            if (!$prevData) {
                throw new Exception("Errore: Preventivo non trovato.");
            }

            $preventivoRifiutato = new EPreventivo(
                $prevData['idPrev'],
                $prevData['idU'],
                $prevData['idV'],
                $prevData['idS'],
                $prevData['costo'], 
                'rifiutato',                
                $prevData['descrizione'],
                $prevData['pdf'],
                $prevData['data_richiesta']
            );

            if (!$fPreventivo->update($preventivoRifiutato, $pdo)) {
                throw new Exception("Impossibile rifiutare il preventivo a causa di un errore tecnico.");
            }

            header('Location: ../admin_dashboard.php?msg=preventivo_rifiutato');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>