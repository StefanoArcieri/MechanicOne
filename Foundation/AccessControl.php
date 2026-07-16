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
        'errore' => [
            '*' => 'public',
        ],

        // Lato utente
        'aggiungiveicolo' => [
            '*' => 'auth',
        ],
        'garage' => [
            '*' => 'auth',
        ],
        'richiedipreventivo' => [
            '*' => 'auth',
        ],
        'visualizzapreventivi' => [
            '*' => 'auth',
        ],
        'richiediprenotazione' => [
            '*' => 'auth',
        ],
        'visualizzaprenotazioni' => [
            '*' => 'auth',
        ],
        'scrivirecensione' => [
            'scrivi' => 'auth',
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
        ],
        'gestiscimeccanici' => [
            'lista' => 'auth',
            'richiediLista' => 'auth',
            'approvaMeccanico' => ['admin'],
            'eliminaMeccanico' => ['admin'],
        ],
        'gestisciservizi' => [
            'lista' => 'auth',
            'aggiungiServizio' => ['admin'],
            'richiediLista' => 'auth',
            'eliminaServizio' => ['admin'],
        ],
        'gestiscipreventivi' => [
            'lista' => ['admin', 'meccanico'],
            'richiediLista' => ['admin', 'meccanico'],
            'updateCosto' => ['admin'],
            'rifiuta' => ['admin'],
            'segnaSvolto' => ['admin', 'meccanico'],
        ],
        'gestisciprenotazioni' => [
            'lista' => ['admin', 'meccanico'],
            'richiediLista' => ['admin', 'meccanico'],
            'accetta' => ['admin', 'meccanico'],
            'concludi' => ['admin', 'meccanico'],
            'cancella' => ['admin', 'meccanico'],
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
