<?php

require_once __DIR__ . '/View.php';

class VPrenotazione extends View {

    public function mostraForm($veicoli, $preventiviAccettati, $errore = '') {
        $this->renderTemplate('utente/richiediprenotazione.tpl', [
            'titolo' => 'Richiedi una prenotazione',
            'veicoli' => array_map(function ($v) { return $v->toArray(); }, $veicoli),
            'preventiviAccettati' => array_map(function ($p) { return $p->toArray(); }, $preventiviAccettati),
            'oggi' => date('Y-m-d'),
            'errore' => $errore,
        ]);
    }

    public function mostraLista($prenotazioni, $errore = '') {
        $categorie = $this->raggruppaPerStato($prenotazioni, ['in attesa', 'accettata', 'conclusa', 'cancellata']);

        $sezioni = [
            [
                'label' => 'In attesa', 'classe' => 'in-attesa', 'items' => $categorie['in attesa'],
                'modificabile' => true, 'cancellabile' => true, 'vuoto' => 'Nessuna prenotazione in attesa di conferma.',
            ],
            [
                'label' => 'Confermate', 'classe' => 'accettata', 'items' => $categorie['accettata'],
                // una volta confermata (dall'admin o dal meccanico che la prende in carico), il cliente
                // non può più proporre di spostarla: può ancora farlo solo mentre è 'in attesa'.
                // Può comunque ancora annullarla: quello resta un permesso separato.
                'modificabile' => false, 'cancellabile' => true, 'vuoto' => 'Nessuna prenotazione confermata al momento.',
            ],
            [
                'label' => 'Concluse', 'classe' => 'conclusa', 'items' => $categorie['conclusa'],
                'modificabile' => false, 'cancellabile' => false, 'vuoto' => 'Nessun intervento concluso.',
            ],
            [
                'label' => 'Cancellate', 'classe' => 'cancellata', 'items' => $categorie['cancellata'],
                'modificabile' => false, 'cancellabile' => false, 'vuoto' => 'Nessuna prenotazione cancellata.',
            ],
        ];

        $this->renderTemplate('utente/visualizzaprenotazioni.tpl', [
            'titolo' => 'Le tue prenotazioni',
            'sezioni' => $sezioni,
            'oggi' => date('Y-m-d'),
            'errore' => $errore,
        ]);
    }
}
