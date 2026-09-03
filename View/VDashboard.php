<?php

require_once __DIR__ . '/View.php';

class VDashboard extends View {

    public function mostraAdmin($nome) {
        $this->renderTemplate('admin/dashboard.tpl', [
            'nome' => $nome,
        ]);
    }
}
