<?php

require_once __DIR__ . '/View.php';

class VGestisciprenotazioni extends View {

    public function mostraLista($prenotazioni, $errore = '') {
        $categorie = ['in attesa' => [], 'accettata' => [], 'conclusa' => [], 'cancellata' => []];
        foreach ($prenotazioni as $p) {
            $stato = $p['stato'] ?? 'in attesa';
            if (!isset($categorie[$stato])) {
                $categorie[$stato] = [];
            }
            $categorie[$stato][] = $p;
        }

        $sezioni = [
            ['label' => 'In attesa', 'classe' => 'in-attesa', 'items' => $categorie['in attesa'], 'vuoto' => 'Nessuna richiesta da confermare.'],
            ['label' => 'Confermate', 'classe' => 'accettata', 'items' => $categorie['accettata'], 'vuoto' => 'Nessuna prenotazione confermata.'],
            ['label' => 'Concluse', 'classe' => 'conclusa', 'items' => $categorie['conclusa'], 'vuoto' => 'Nessun intervento concluso.'],
            ['label' => 'Cancellate', 'classe' => 'cancellata', 'items' => $categorie['cancellata'], 'vuoto' => 'Nessuna prenotazione cancellata.'],
        ];

        $this->renderTemplate('gestisciprenotazioni.tpl', [
            'titolo' => 'Prenotazioni da gestire',
            'sezioni' => $sezioni,
            'errore' => $errore,
        ]);
    }
}
