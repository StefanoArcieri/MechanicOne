<?php

require_once __DIR__ . '/View.php';

class VServizio extends View {
    public function mostraLista($servizi, $errore = '') {
        // $servizi arriva già come array (conversione fatta dal Control)
        $this->renderTemplate('admin/gestisciservizi.tpl', [
            'servizi' => $servizi,
            'errore' => $errore,
        ]);
    }
}
