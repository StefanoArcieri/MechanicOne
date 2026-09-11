<?php

require_once __DIR__ . '/View.php';

class VPrenotazione extends View {

    private static $mesi = [
        1 => 'Gennaio', 2 => 'Febbraio', 3 => 'Marzo', 4 => 'Aprile',
        5 => 'Maggio', 6 => 'Giugno', 7 => 'Luglio', 8 => 'Agosto',
        9 => 'Settembre', 10 => 'Ottobre', 11 => 'Novembre', 12 => 'Dicembre',
    ];

    public function mostraForm($veicoli, $preventiviAccettati, $errore = '') {
        // $veicoli/$preventiviAccettati arrivano già come array (conversione fatta dal Control)
        $this->renderTemplate('utente/richiediprenotazione.tpl', [
            'veicoli' => $veicoli,
            'preventiviAccettati' => $preventiviAccettati,
            'oggi' => date('Y-m-d'),
            'errore' => $errore,
        ]);
    }

    // Il cliente vede solo le proprie, raggruppate per stato; admin/meccanico vedono tutte,
    // raggruppate per mese — stessa fusione già fatta per i preventivi (VGestiscipreventivi
    // non esiste più, era la stessa idea applicata lì).
    public function mostraLista($prenotazioni, $errore = '', $meccanici = []) {
        if (Session::get('ruolo') === 'cliente') {
            $this->mostraListaCliente($prenotazioni, $errore);
            return;
        }
        $this->mostraListaStaff($prenotazioni, $errore, $meccanici);
    }

    private function mostraListaCliente($prenotazioni, $errore) {
        $categorie = $this->raggruppaPerStato($prenotazioni, ['in attesa', 'accettata', 'conclusa', 'cancellata']);

        $sezioni = [
            [
                'label' => 'In attesa', 'classe' => 'in-attesa', 'items' => $categorie['in attesa'],
                'modificabile' => true, 'cancellabile' => true, 'vuoto' => 'Nessuna prenotazione in attesa di conferma.',
            ],
            [
                'label' => 'Confermate', 'classe' => 'accettata', 'items' => $categorie['accettata'],
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
            'sezioni' => $sezioni,
            'oggi' => date('Y-m-d'),
            'errore' => $errore,
        ]);
    }

    // Raggruppa per mese (più recente prima); dentro ogni mese, le prenotazioni ancora "vive"
    // (in attesa/accettata) sono sempre visibili, quelle concluse/cancellate dello stesso mese
    // stanno dietro una tendina in fondo.
    private function mostraListaStaff($prenotazioni, $errore, $meccanici) {
        $mesi = [];

        foreach ($prenotazioni as $p) {
            if (empty($p['data'])) continue;
            $ts = strtotime($p['data']);
            $chiave = date('Y-m', $ts);

            if (!isset($mesi[$chiave])) {
                $mesi[$chiave] = [
                    'label' => self::$mesi[(int) date('n', $ts)] . ' ' . date('Y', $ts),
                    'attive' => [],
                    'archiviate' => [],
                ];
            }

            if (in_array($p['stato'], ['in attesa', 'accettata'], true)) {
                $mesi[$chiave]['attive'][] = $p;
            } else {
                $mesi[$chiave]['archiviate'][] = $p;
            }
        }

        krsort($mesi); // chiave "Y-m": ordine decrescente = dal mese più recente al più vecchio

        foreach ($mesi as &$mese) {
            // attive: la più urgente (data più vicina) per prima
            usort($mese['attive'], function ($a, $b) { return strcmp($a['data'] . $a['ora'], $b['data'] . $b['ora']); });
            // archiviate: la più recente per prima, coerente col resto della pagina
            usort($mese['archiviate'], function ($a, $b) { return strcmp($b['data'] . $b['ora'], $a['data'] . $a['ora']); });
        }
        unset($mese);

        $ruolo = Session::get('ruolo');
        $this->renderTemplate($ruolo . '/gestisciprenotazioni.tpl', [
            'mesi' => array_values($mesi),
            'meccanici' => $meccanici,
            'errore' => $errore,
        ]);
    }
}
