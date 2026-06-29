<?php

require_once __DIR__ . '/View.php';

class VVeicolo extends View {
    private function formatVeicoli(array $veicoli): array {
        return array_map(function ($veicolo) {
            if (is_array($veicolo)) {
                $targa = $veicolo['targa'] ?? '';
                $marca = $veicolo['marca'] ?? '';
                $modello = $veicolo['modello'] ?? '';
            } elseif (is_object($veicolo)) {
                $targa = method_exists($veicolo, 'getTarga') ? $veicolo->getTarga() : '';
                $marca = method_exists($veicolo, 'getMarca') ? $veicolo->getMarca() : '';
                $modello = method_exists($veicolo, 'getModello') ? $veicolo->getModello() : '';
            } else {
                return (string) $veicolo;
            }

            return trim(sprintf('%s %s (%s)', $marca, $modello, $targa));
        }, $veicoli);
    }

    public function mostraLista($veicoli) {
        $this->renderTemplate('veicolo.tpl', [
            'titolo' => 'Garage utente',
            'veicoli' => $this->formatVeicoli($veicoli),
            'tipo' => 'lista'
        ]);
    }
}
