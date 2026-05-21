<?php
// control/CRecensione.php

require_once __DIR__ . '/../foundation/config.php';
require_once __DIR__ . '/../foundation/FRecensione.php'; // La tua Foundation
require_once __DIR__ . '/../entity/ERecensione.php';     // La tua Entity
require_once __DIR__ . '/../foundation/Session.php';

class CRecensione {

    /**
     * UTENTE: Scrive una recensione per un intervento (Prenotazione) concluso.
     */
    public static function scrivi($idP, $voto, $testo) {
        global $pdo;

        try {
            // 1. RBAC: L'utente deve essere loggato per lasciare una recensione
            $idU = Session::get('idU');
            if (!$idU) {
                throw new Exception("Accesso negato: effettua il login per scrivere una recensione.");
            }

            $fRecensione = new \FRecensione();

            // (Opzionale ma super consigliato per il 30 e lode): 
            // Potresti usare un $fRecensione->load per controllare se l'utente ha GIÀ recensito questo $idP,
            // in modo da evitare che un utente arrabbiato scriva 100 recensioni negative per lo stesso lavoro!

            // 2. CREAZIONE ENTITY: 
            // Ordine ipotizzato: idRec(null), idU, idP, voto, testo, data
            $nuovaRecensione = new ERecensione(
                null, 
                $idU, 
                $idP, 
                (int)$voto, // Forziamo il voto a essere un intero (es. da 1 a 5)
                trim($testo), 
                date('Y-m-d') // Inserisce in automatico la data di oggi
            );

            // 3. SALVATAGGIO
            if (!$fRecensione->store($nuovaRecensione, $pdo)) {
                throw new Exception("Si è verificato un errore tecnico. Impossibile pubblicare la recensione.");
            }

            // 4. REDIREZIONE
            header('Location: ../index.php?msg=recensione_pubblicata');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * TUTTI: Visualizza la lista di tutte le recensioni dell'officina.
     * Metodo ideale da chiamare nella homepage per mostrare i feedback dei clienti.
     */
    public static function richiediLista() {
        global $pdo;

        try {
            $fRecensione = new \FRecensione();
            
            // Usiamo il metodo getAll per scaricare tutti i feedback dal DB
            // Ricordati di creare la funzione getAll() nel tuo FRecensione.php!
            $recensioni = $fRecensione->getAll($pdo);
            
            // Se non ci sono recensioni o c'è un errore tecnico, restituiamo un array vuoto
            return ($recensioni === false) ? [] : $recensioni;

        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>