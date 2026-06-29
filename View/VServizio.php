<?php

require_once __DIR__ . '/View.php';

class VServizio extends View {
    public function mostraLista($servizi) {
        $this->renderTemplate('servizio.tpl', [
            'titolo' => 'Catalogo servizi',
            'servizi' => $servizi,
            'tipo' => 'lista'
        ]);
    }
}
