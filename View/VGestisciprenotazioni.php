<?php

require_once __DIR__ . '/View.php';

class VGestisciprenotazioni extends View {

    private static $mesi = [
        1 => 'Gennaio', 2 => 'Febbraio', 3 => 'Marzo', 4 => 'Aprile',
        5 => 'Maggio', 6 => 'Giugno', 7 => 'Luglio', 8 => 'Agosto',
        9 => 'Settembre', 10 => 'Ottobre', 11 => 'Novembre', 12 => 'Dicembre',
    ];

    // Lunedì (Y-m-d) della settimana a cui appartiene una data
    private function lunediDellaSettimana($data) {
        $ts = strtotime($data);
        $giornoSettimana = (int) date('N', $ts); // 1 (lun) .. 7 (dom)
        return date('Y-m-d', strtotime('-' . ($giornoSettimana - 1) . ' days', $ts));
    }

    // Livello 1: i mesi che hanno almeno una prenotazione, in ordine cronologico
    public function mostraMesi($prenotazioni, $errore = '') {
        $mesi = [];
        foreach ($prenotazioni as $p) {
            if (empty($p['data'])) continue;
            $ts = strtotime($p['data']);
            $chiave = date('Y-m', $ts);

            if (!isset($mesi[$chiave])) {
                $mesi[$chiave] = [
                    'anno' => (int) date('Y', $ts),
                    'mese' => (int) date('n', $ts),
                    'label' => self::$mesi[(int) date('n', $ts)] . ' ' . date('Y', $ts),
                    'count' => 0,
                ];
            }
            $mesi[$chiave]['count']++;
        }
        ksort($mesi);

        $this->renderTemplate('gestione/gestisciprenotazioni_mesi.tpl', [
            'titolo' => 'Prenotazioni da gestire',
            'mesi' => array_values($mesi),
            'errore' => $errore,
        ]);
    }

    // Livello 2: le settimane di un mese che hanno almeno una prenotazione
    public function mostraSettimaneDelMese($anno, $mese, $prenotazioni, $errore = '') {
        $settimane = [];
        foreach ($prenotazioni as $p) {
            if (empty($p['data'])) continue;
            $ts = strtotime($p['data']);
            if ((int) date('Y', $ts) !== $anno || (int) date('n', $ts) !== $mese) continue;

            $inizio = $this->lunediDellaSettimana($p['data']);
            if (!isset($settimane[$inizio])) {
                $fine = date('Y-m-d', strtotime('+6 days', strtotime($inizio)));
                $settimane[$inizio] = [
                    'inizio' => $inizio,
                    'label' => date('d/m', strtotime($inizio)) . ' – ' . date('d/m', strtotime($fine)),
                    'count' => 0,
                ];
            }
            $settimane[$inizio]['count']++;
        }
        ksort($settimane);

        $this->renderTemplate('gestione/gestisciprenotazioni_settimane.tpl', [
            'titolo' => self::$mesi[$mese] . ' ' . $anno,
            'anno' => $anno,
            'mese' => $mese,
            'settimane' => array_values($settimane),
            'errore' => $errore,
        ]);
    }

    // Livello 3: le prenotazioni di una settimana, raggruppate per stato come prima (stesso template)
    public function mostraSettimana($anno, $mese, $settimanaInizio, $prenotazioni, $errore = '', $meccanici = []) {
        $fine = date('Y-m-d', strtotime('+6 days', strtotime($settimanaInizio)));

        $filtrate = array_values(array_filter($prenotazioni, function ($p) use ($settimanaInizio, $fine) {
            return !empty($p['data']) && $p['data'] >= $settimanaInizio && $p['data'] <= $fine;
        }));

        $categorie = $this->raggruppaPerStato($filtrate, ['in attesa', 'accettata', 'conclusa', 'cancellata']);

        $sezioni = [
            ['label' => 'In attesa', 'classe' => 'in-attesa', 'items' => $categorie['in attesa'], 'vuoto' => 'Nessuna richiesta da confermare in questa settimana.'],
            ['label' => 'Confermate', 'classe' => 'accettata', 'items' => $categorie['accettata'], 'vuoto' => 'Nessuna prenotazione confermata in questa settimana.'],
            ['label' => 'Concluse', 'classe' => 'conclusa', 'items' => $categorie['conclusa'], 'vuoto' => 'Nessun intervento concluso in questa settimana.'],
            ['label' => 'Cancellate', 'classe' => 'cancellata', 'items' => $categorie['cancellata'], 'vuoto' => 'Nessuna prenotazione cancellata in questa settimana.'],
        ];

        $this->renderTemplate('gestione/gestisciprenotazioni.tpl', [
            'titolo' => 'Settimana dal ' . date('d/m', strtotime($settimanaInizio)) . ' al ' . date('d/m/Y', strtotime($fine)),
            'sezioni' => $sezioni,
            'errore' => $errore,
            'anno' => $anno,
            'mese' => $mese,
            'settimanaInizio' => $settimanaInizio,
            'meccanici' => $meccanici,
        ]);
    }
}
