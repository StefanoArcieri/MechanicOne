<?php

require_once __DIR__ . '/View.php';

class VUtente extends View {

    public function mostraHomePubblica() {
        $this->smarty->display('home.tpl');
    }
}
?>