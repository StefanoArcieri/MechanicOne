<?php

require_once __DIR__ . '/View.php';

class VServizio extends View {
    public function mostraLista($servizi, $errore = '') {
        $this->renderTemplate('gestisciservizi.tpl', [
            'titolo' => 'Catalogo servizi',
            'servizi' => array_map(function ($s) { return $s->toArray(); }, $servizi),
            'errore' => $errore,
        ]);
    }
}
