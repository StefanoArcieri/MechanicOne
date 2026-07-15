<?php

require_once __DIR__ . '/../View/VErrori.php';

class CErrori {

    public function mostraErrore($codice, $messaggio) {
        if ($codice === 404) {
            header('HTTP/1.1 404 Not Found');
        } elseif ($codice === 405) {
            header('HTTP/1.1 405 Method Not Allowed');
        } elseif ($codice === 403) {
            header('HTTP/1.1 403 Forbidden');
        } else {
            header('HTTP/1.1 500 Internal Server Error');
        }

        $vErrori = new VErrori();
        $vErrori->errore($codice, $messaggio);
    }
}
?>