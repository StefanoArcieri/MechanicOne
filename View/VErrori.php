<?php

require_once __DIR__ . '/View.php';

class VErrori extends View {

    public function errore($codice, $messaggio) {
        $this->smarty->assign('codice', $codice);
        $this->smarty->assign('messaggio', $messaggio);
        $this->smarty->display('errore.tpl');
    }
}
?>