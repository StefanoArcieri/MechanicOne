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
        'utente' => [
            'home' => 'public',
            'login' => 'public',
            'registrazione' => 'public',
            'logout' => 'public',
        ],
        // la classe è CErrori (plurale): la chiave qui deve combaciare, altrimenti la regola
        // non scatta mai e /errori/... finisce sulla regola di default ('auth') invece che 'public'
        'errori' => [
            '*' => 'public',
        ],

        // Lato utente: riservato al ruolo 'cliente'. Un meccanico non deve poter usare anche
        // le funzioni cliente (garage, preventivi, prenotazioni, recensioni): se un meccanico
        // vuole essere anche cliente dell'officina, si registra un secondo account.
        'aggiungiveicolo' => [
            '*' => ['cliente'],
        ],
        'garage' => [
            '*' => ['cliente'],
        ],
        'richiedipreventivo' => [
            '*' => ['cliente'],
        ],
        'visualizzapreventivi' => [
            '*' => ['cliente'],
        ],
        'richiediprenotazione' => [
            '*' => ['cliente'],
        ],
        'visualizzaprenotazioni' => [
            '*' => ['cliente'],
        ],
        'scrivirecensione' => [
            'scrivi' => ['cliente'],
        ],
        'visualizzarecensioni' => [
            'richiediLista' => 'auth',
        ],

        // Lato meccanico/admin
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
        'gestisciservizi' => [
            'lista' => 'auth',
            'aggiungiServizio' => ['admin'],
            'modificaServizio' => ['admin'],
            'richiediLista' => 'auth',
            'eliminaServizio' => ['admin'],
        ],
        // I preventivi (valutare, prezzare, rifiutare) restano solo all'admin: il meccanico
        // non li vede più né li gestisce, si occupa solo delle prenotazioni assegnate.
        'gestiscipreventivi' => [
            '*' => ['admin'],
        ],
        'gestisciprenotazioni' => [
            'lista' => ['admin', 'meccanico'],
            'richiediLista' => ['admin', 'meccanico'],
            'accetta' => ['admin', 'meccanico'],
            // solo il meccanico segna il lavoro come concluso: l'admin vede l'avanzamento ma non lo forza
            'concludi' => ['meccanico'],
            // spostare data/ora resta una decisione dell'admin, non del meccanico
            'modifica' => ['admin'],
            'cancella' => ['admin', 'meccanico'],
        ],
        'dashboard' => [
            'admin' => ['admin'],
            'meccanico' => ['meccanico'],
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

        if ($requisito === 'public') {
            return 'ok';
        }

        if (empty(Session::get('idU'))) {
            return 'login';
        }

        if ($requisito === 'auth') {
            return 'ok';
        }

        $ruolo = strtolower((string) Session::get('ruolo'));
        return in_array($ruolo, $requisito, true) ? 'ok' : 'forbidden';
    }
}
?>
