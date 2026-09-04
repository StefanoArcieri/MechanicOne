<?php

require_once __DIR__ . '/View.php';

class VDashboard extends View {

    public function mostraAdmin($nome) {
        $this->renderTemplate('admin/dashboard.tpl', [
            'nome' => $nome,
        ]);
    }

    public function mostraMeccanico($profilo, $stats, $errore = '') {
        $this->renderTemplate('meccanico/dashboard.tpl', [
            'profilo' => $profilo,
            'stats' => $stats,
            'errore' => $errore,
        ]);
    }
}
