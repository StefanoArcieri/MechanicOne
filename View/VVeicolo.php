<?php

require_once __DIR__ . '/View.php';

class VVeicolo extends View {

    public function mostraGarage($veicoli, $errore = '') {
        $this->renderTemplate('utente/garage.tpl', [
            'veicoli' => $veicoli,
            'errore' => $errore,
        ]);
    }

    public function mostraFormAggiungi($errore = '') {
        $this->renderTemplate('utente/aggiungiveicolo.tpl', [
            'errore' => $errore]
            );
    }
}
