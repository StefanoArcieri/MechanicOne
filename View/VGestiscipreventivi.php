<?php

require_once __DIR__ . '/View.php';

class VGestiscipreventivi extends View {

    public function mostraLista($preventivi, $errore = '') {
        $categorie = ['inviato' => [], 'accettato' => [], 'svolto' => [], 'rifiutato' => []];
        foreach ($preventivi as $p) {
            $stato = $p['stato'] ?? 'inviato';
            if (!isset($categorie[$stato])) {
                $categorie[$stato] = [];
            }
            $categorie[$stato][] = $p;
        }

        $sezioni = [
            ['label' => 'Da valutare', 'classe' => 'inviato', 'items' => $categorie['inviato'], 'vuoto' => 'Nessuna richiesta da valutare.'],
            ['label' => 'Accettati', 'classe' => 'accettato', 'items' => $categorie['accettato'], 'vuoto' => 'Nessun preventivo accettato in corso.'],
            ['label' => 'Svolti', 'classe' => 'svolto', 'items' => $categorie['svolto'], 'vuoto' => 'Nessun intervento concluso.'],
            ['label' => 'Rifiutati', 'classe' => 'rifiutato', 'items' => $categorie['rifiutato'], 'vuoto' => 'Nessun preventivo rifiutato.'],
        ];

        $this->renderTemplate('gestiscipreventivi.tpl', [
            'titolo' => 'Preventivi da gestire',
            'sezioni' => $sezioni,
            'errore' => $errore,
        ]);
    }
}
