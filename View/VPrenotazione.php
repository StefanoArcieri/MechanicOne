<?php

require_once __DIR__ . '/View.php';

class VPrenotazione extends View {

    public function mostraForm($veicoli, $preventiviAccettati, $errore = '') {
        $this->renderTemplate('richiediprenotazione.tpl', [
            'titolo' => 'Richiedi una prenotazione',
            'veicoli' => array_map(function ($v) { return $v->toArray(); }, $veicoli),
            'preventiviAccettati' => array_map(function ($p) { return $p->toArray(); }, $preventiviAccettati),
            'errore' => $errore,
        ]);
    }

    public function mostraLista($prenotazioni, $errore = '') {
        $categorie = ['in attesa' => [], 'accettata' => [], 'conclusa' => [], 'cancellata' => []];
        foreach ($prenotazioni as $pEntity) {
            $p = $pEntity->toArray();
            $stato = $p['stato'] ?? 'in attesa';
            if (!isset($categorie[$stato])) {
                $categorie[$stato] = [];
            }
            $categorie[$stato][] = $p;
        }

        $sezioni = [
            [
                'label' => 'In attesa', 'classe' => 'in-attesa', 'items' => $categorie['in attesa'],
                'modificabile' => true, 'vuoto' => 'Nessuna prenotazione in attesa di conferma.',
            ],
            [
                'label' => 'Confermate', 'classe' => 'accettata', 'items' => $categorie['accettata'],
                'modificabile' => true, 'vuoto' => 'Nessuna prenotazione confermata al momento.',
            ],
            [
                'label' => 'Concluse', 'classe' => 'conclusa', 'items' => $categorie['conclusa'],
                'modificabile' => false, 'vuoto' => 'Nessun intervento concluso.',
            ],
            [
                'label' => 'Cancellate', 'classe' => 'cancellata', 'items' => $categorie['cancellata'],
                'modificabile' => false, 'vuoto' => 'Nessuna prenotazione cancellata.',
            ],
        ];

        $this->renderTemplate('visualizzaprenotazioni.tpl', [
            'titolo' => 'Le tue prenotazioni',
            'sezioni' => $sezioni,
            'errore' => $errore,
        ]);
    }
}
