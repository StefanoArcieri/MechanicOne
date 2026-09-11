<?php

require_once __DIR__ . '/Session.php';

/**
 * Mappa dichiarativa dei permessi: per ogni controller/azione stabilisce chi può accedervi.
 * Requisiti possibili:
 *  - 'public'         nessuna autenticazione richiesta
 *  - 'auth'           richiede login, qualsiasi ruolo
 *  - ['ruolo', ...]   richiede login E uno dei ruoli elencati
 *  - '*' come chiave del metodo copre tutte le azioni non elencate esplicitamente per quel controller
 */
class AccessControl {

    private static $rules = [

        // ===== ACCOUNT / UTENTE — ciclo di vita dell'account, non un oggetto del dominio =====
        'utente' => [
            'home' => 'public',
            'login' => 'public',
            'registrazione' => 'public',
            'logout' => 'public',
            'dashboardUtente' => ['cliente'],
        ],

        // ===== VEICOLO — solo lato cliente, nessuna gestione staff per ora =====
        'veicolo' => [
            '*' => ['cliente'],
        ],

        // ===== PREVENTIVO — il cliente crea/vede i propri, l'admin gestisce tutti =====
        'richiedipreventivo' => [
            '*' => ['cliente'],
        ],
        'visualizzapreventivi' => [
            '*' => ['cliente'],
        ],
        // Valutare/prezzare/rifiutare restano solo all'admin: il meccanico non vede né
        // gestisce i preventivi, si occupa solo delle prenotazioni già assegnate.
        'gestiscipreventivi' => [
            '*' => ['admin'],
        ],

        // ===== PRENOTAZIONE — il cliente crea/vede le proprie, admin+meccanico gestiscono tutte =====
        'richiediprenotazione' => [
            '*' => ['cliente'],
        ],
        'visualizzaprenotazioni' => [
            '*' => ['cliente'],
        ],
        'gestisciprenotazioni' => [
            'lista' => ['admin', 'meccanico'],
            'richiediLista' => ['admin', 'meccanico'],
            'accetta' => ['admin', 'meccanico'],
            // solo il meccanico segna il lavoro come concluso: l'admin vede l'avanzamento ma non lo forza
            'concludi' => ['meccanico'],
            // spostare data/ora resta una decisione dell'admin, non del meccanico
            'modifica' => ['admin'],
            'cancella' => ['admin'],
            'elimina' => ['admin'],
        ],

        // ===== RECENSIONE — il cliente scrive, la lista è pubblica =====
        'recensione' => [
            'scrivi' => ['cliente'],
            'richiediLista' => 'public',
        ],

        // ===== MECCANICO — il meccanico gestisce se stesso, l'admin gestisce l'elenco =====
        'profilomeccanico' => [
            'area' => 'auth',
            'profilo' => ['meccanico', 'admin'],
            'getProfilo' => ['meccanico', 'admin'],
            'aggiornaProfilo' => ['meccanico'],
            'cambiaPassword' => ['meccanico'],
        ],
        'gestiscimeccanici' => [
            'lista' => 'auth',
            'richiediLista' => 'auth',
            'creaMeccanico' => ['admin'],
            'eliminaMeccanico' => ['admin'],
        ],

        // ===== SERVIZIO — catalogo gestito solo dall'admin =====
        'gestisciservizi' => [
            'lista' => 'auth',
            'aggiungiServizio' => ['admin'],
            'modificaServizio' => ['admin'],
            'richiediLista' => 'auth',
            'eliminaServizio' => ['admin'],
        ],

        // ===== INFRASTRUTTURA — non è un oggetto del dominio =====
        // la classe è CErrori (plurale): la chiave qui deve combaciare, altrimenti la regola
        // non scatta mai e /errori/... finisce sulla regola di default ('auth') invece che 'public'
        'errori' => [
            '*' => 'public',
        ],
    ];

    // Requisito applicato quando controller/azione non compaiono in mappa
    private static $default = 'auth';

    private static function requisito($controllerInput, $method) {
        $controllerInput = strtolower($controllerInput);

        if (isset(self::$rules[$controllerInput]['*'])) {
            return self::$rules[$controllerInput]['*'];
        }

        return self::$rules[$controllerInput][$method] ?? self::$default;
    }

    /**
     * Verifica se l'utente corrente può eseguire controller/metodo.
     * Ritorna 'ok', 'login' (serve autenticazione) oppure 'forbidden' (ruolo non autorizzato).
     */
    public static function verifica($controllerInput, $method) {
        $requisito = self::requisito($controllerInput, $method);

        //se è pubblico ez
        if ($requisito === 'public') {
            return 'ok';
        }

        //se nn è pubblico vuol dire che devi essere loggato
        //quindi se non hai l'idU in sessione, login
        if (empty(Session::get('idU'))) {
            return 'login';
        }

        //ora che abbiamo visto che abbiamo l'id di sessione
        //vediamo se richiede un auth generale, in caso positivo ok
        if ($requisito === 'auth') {
            return 'ok';
        }

        //se non è auth, vuol dire che richiede un ruolo specifico, 
        //quindi controlliamo il ruolo dell'utente in sessione
        $ruolo = strtolower((string) Session::get('ruolo'));
        return in_array($ruolo, $requisito, true) ? 'ok' : 'forbidden';
    }
}
?>
