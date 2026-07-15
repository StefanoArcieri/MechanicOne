<?php

require_once __DIR__ . '/View.php';

class VPreventivo extends View {

    public function mostraForm($veicoli, $servizi, $errore = '') {
        // riconvertiamo in array qui perché i tpl usano ancora {$v.campo}, non {$v->getCampo()}
        $this->renderTemplate('richiedipreventivo.tpl', [
            'titolo' => 'Richiedi un preventivo',
            'veicoli' => array_map(function ($v) { return $v->toArray(); }, $veicoli),
            'servizi' => array_map(function ($s) { return $s->toArray(); }, $servizi),
            'errore' => $errore,
        ]);
    }

    public function mostraLista($preventivi, $errore = '') {
        $categorie = ['inviato' => [], 'accettato' => [], 'rifiutato' => [], 'svolto' => []];
        foreach ($preventivi as $pEntity) {
            $p = $pEntity->toArray();
            $stato = $p['stato'] ?? 'inviato';
            if (!isset($categorie[$stato])) {
                $categorie[$stato] = [];
            }
            $categorie[$stato][] = $p;
        }

        $this->renderTemplate('visualizzapreventivi.tpl', [
            'titolo' => 'I tuoi preventivi',
            'preventiviInviati' => $categorie['inviato'],
            'preventiviAccettati' => $categorie['accettato'],
            'preventiviRifiutati' => $categorie['rifiutato'],
            'preventiviSvolti' => $categorie['svolto'],
            'errore' => $errore,
        ]);
    }
}
