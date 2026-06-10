<?php

require_once __DIR__ . '/View.php';

class VErrori extends View {

    /**
     * Associa le variabili a Smarty e mostra il template dell'errore
     */
    public function errore($codice, $messaggio) {
        // Iniettiamo i dati all'interno del motore Smarty
        $this->smarty->assign('codice', $codice);
        $this->smarty->assign('messaggio', $messaggio);

        // Chiediamo a Smarty di renderizzare il file .tpl dedicato
        $this->smarty->display('errore.tpl');
    }
}
?>