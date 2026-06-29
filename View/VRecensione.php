<?php

require_once __DIR__ . '/View.php';

class VRecensione extends View {
    public function mostraLista($recensioni) {
        $this->renderTemplate('recensione.tpl', [
            'titolo' => 'Recensioni',
            'recensioni' => $recensioni,
            'tipo' => 'lista'
        ]);
    }
}
