<?php

require_once __DIR__ . '/View.php';

class VVeicolo extends View {

    public function mostraGarage($veicoli, $errore = '') {
        $this->renderTemplate('utente/garage.tpl', [
            'titolo' => 'Il tuo garage',
            'veicoli' => array_map(function ($v) { return $v->toArray(); }, $veicoli),
            'errore' => $errore,
        ]);
    }

    public function mostraFormAggiungi($errore = '') {
        $this->renderTemplate('utente/aggiungiveicolo.tpl', [
            'titolo' => 'Aggiungi un veicolo',
            'errore' => $errore,
        ]);
    }
}
