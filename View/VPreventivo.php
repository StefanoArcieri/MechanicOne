<?php

require_once __DIR__ . '/View.php';

class VPreventivo extends View {

    public function mostraForm($veicoli, $servizi, $errore = '') {
        // riconvertiamo in array qui perché i tpl usano ancora {$v.campo}, non {$v->getCampo()}
        $this->renderTemplate('utente/richiedipreventivo.tpl', [
            'titolo' => 'Richiedi un preventivo',
            'veicoli' => array_map(function ($v) { return $v->toArray(); }, $veicoli),
            'servizi' => array_map(function ($s) { return $s->toArray(); }, $servizi),
            'errore' => $errore,
        ]);
    }

    public function mostraLista($preventivi, $errore = '') {
        $categorie = $this->raggruppaPerStato($preventivi, ['inviato', 'accettato', 'rifiutato', 'svolto']);

        // un array di sezioni invece di 4 variabili: il tpl fa un solo {foreach} invece di 4 blocchi copiati
        $sezioni = [
            [
                'label' => 'Inviati', 'classe' => 'inviato', 'items' => $categorie['inviato'],
                'modificabile' => true, 'mostraCosto' => false, 'mostraPrenotaLink' => false,
                'vuoto' => 'Nessun preventivo in attesa di risposta.',
            ],
            [
                'label' => 'Accettati', 'classe' => 'accettato', 'items' => $categorie['accettato'],
                'modificabile' => true, 'mostraCosto' => true, 'mostraPrenotaLink' => true,
                'vuoto' => 'Nessun preventivo accettato al momento.',
            ],
            [
                'label' => 'Svolti', 'classe' => 'svolto', 'items' => $categorie['svolto'],
                'modificabile' => false, 'mostraCosto' => true, 'mostraPrenotaLink' => false,
                'vuoto' => 'Nessun intervento concluso.',
            ],
            [
                'label' => 'Rifiutati', 'classe' => 'rifiutato', 'items' => $categorie['rifiutato'],
                'modificabile' => false, 'mostraCosto' => false, 'mostraPrenotaLink' => false,
                'vuoto' => 'Nessun preventivo rifiutato.',
            ],
        ];

        $this->renderTemplate('utente/visualizzapreventivi.tpl', [
            'titolo' => 'I tuoi preventivi',
            'sezioni' => $sezioni,
            'errore' => $errore,
        ]);
    }
}
