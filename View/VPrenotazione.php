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

        $this->renderTemplate('visualizzaprenotazioni.tpl', [
            'titolo' => 'Le tue prenotazioni',
            'prenotazioniInAttesa' => $categorie['in attesa'],
            'prenotazioniConfermate' => $categorie['accettata'],
            'prenotazioniConcluse' => $categorie['conclusa'],
            'prenotazioniCancellate' => $categorie['cancellata'],
            'errore' => $errore,
        ]);
    }
}
