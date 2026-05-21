<?php

require_once __DIR__ . '/../foundation/config.php';
require_once __DIR__ . '/../foundation/FServizio.php'; 
require_once __DIR__ . '/../entity/EServizio.php';     
require_once __DIR__ . '/../foundation/Session.php';

class CServizio {

    public static function aggiungiServizio($titolo, $descrizione) {
        global $pdo;

        try {
            if (Session::get('ruolo') !== 'admin') {
                throw new Exception("Accesso negato: Solo l'amministrazione può modificare il listino.");
            }

            $fServizio = new FServizio();

            if ($fServizio->load('titolo', $titolo, $pdo)) {
                throw new Exception("Attenzione: Un servizio chiamato '$titolo' esiste già nel catalogo.");
            }

            $nuovoServizio = new EServizio(null, $titolo, $descrizione);

            if (!$fServizio->store($nuovoServizio, $pdo)) {
                throw new Exception("Errore tecnico durante il salvataggio del nuovo servizio.");
            }

            header('Location: ../admin_dashboard.php?msg=servizio_aggiunto');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function modificaServizio($idS, $nuovoTitolo, $nuovaDescrizione) {
        global $pdo;

        try {

            if (Session::get('ruolo') !== 'admin') {
                throw new Exception("Accesso negato: Solo l'amministrazione può modificare i servizi.");
            }

            $fServizio = new FServizio();

            $servizioAttuale = $fServizio->load('idS', $idS, $pdo);
            if (!$servizioAttuale) {
                throw new Exception("Errore: Il servizio che stai cercando di modificare non esiste.");
            }

            $servizioAggiornato = new EServizio($idS, $nuovoTitolo, $nuovaDescrizione);

            if (!$fServizio->update($servizioAggiornato, $pdo)) {
                throw new Exception("Impossibile aggiornare il servizio a causa di un errore di sistema.");
            }

            header('Location: ../admin_dashboard.php?msg=servizio_modificato');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function eliminaServizio($idS) {
        global $pdo;

        try {
            if (Session::get('ruolo') !== 'admin') {
                throw new Exception("Accesso negato: Operazione riservata all'amministratore.");
            }

            $fServizio = new FServizio();

            if (!$fServizio->delete('idS', $idS, $pdo)) {
                throw new Exception("Impossibile eliminare il servizio. Potrebbe essere associato a prenotazioni o preventivi esistenti.");
            }

            header('Location: ../admin_dashboard.php?msg=servizio_eliminato');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function richiediLista() {
        global $pdo;

        try {
            $fServizio = new FServizio();
            
            $servizi = $fServizio->getAll($pdo);
            
            return ($servizi === false) ? [] : $servizi;

        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>