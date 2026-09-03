<?php

require_once __DIR__ . '/View.php';

class VGestiscipreventivi extends View {

    public function mostraLista($preventivi, $errore = '') {
        $categorie = $this->raggruppaPerStato($preventivi, ['inviato', 'accettato', 'svolto', 'rifiutato']);

        $sezioni = [
            ['label' => 'Da accettare', 'classe' => 'inviato', 'items' => $categorie['inviato'], 'vuoto' => 'Nessuna richiesta da valutare.'],
            ['label' => 'Accettati', 'classe' => 'accettato', 'items' => $categorie['accettato'], 'vuoto' => 'Nessun preventivo accettato in corso.'],
            ['label' => 'Svolti', 'classe' => 'svolto', 'items' => $categorie['svolto'], 'vuoto' => 'Nessun intervento concluso.'],
            ['label' => 'Annullati', 'classe' => 'rifiutato', 'items' => $categorie['rifiutato'], 'vuoto' => 'Nessun preventivo annullato.'],
        ];

        $this->renderTemplate('admin/gestiscipreventivi.tpl', [
            'titolo' => 'Preventivi da gestire',
            'sezioni' => $sezioni,
            'errore' => $errore,
        ]);
    }
}
