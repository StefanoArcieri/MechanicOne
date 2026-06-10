<?php

require_once __DIR__ . '/../View/VErrori.php';

class CErrori {

    /**
     * Gestisce e smista la visualizzazione degli errori di sistema
     * @param int $codice Il codice d'errore HTTP (es. 404, 405)
     * @param string $messaggio Il messaggio di dettaglio da mostrare
     */
    public function mostraErrore($codice, $messaggio) {
        // Inviamo l'header HTTP corretto al browser in base al codice d'errore
        if ($codice === 404) {
            header('HTTP/1.1 404 Not Found');
        } elseif ($codice === 405) {
            header('HTTP/1.1 405 Method Not Allowed');
        } else {
            header('HTTP/1.1 500 Internal Server Error');
        }

        // Deleghiamo alla View specifica il rendering della pagina d'errore
        $vErrori = new VErrori();
        $vErrori->errore($codice, $messaggio);
    }
}
?>