<?php

require_once __DIR__ . '/View.php';

class VMeccanico extends View {

    public function mostraProfilo($profilo, $errore = '') {
        $this->renderTemplate('meccanico/profilomeccanico.tpl', [
            'profilo' => $profilo,
            'errore' => $errore,
        ]);
    }

    public function mostraLista($meccanici, $errore = '', $credenzialiGenerate = null) {
        $this->renderTemplate('admin/gestiscimeccanici.tpl', [
            'meccanici' => $meccanici,
            'errore' => $errore,
            'credenzialiGenerate' => $credenzialiGenerate,
        ]);
    }
}
