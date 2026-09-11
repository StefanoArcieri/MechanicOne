<?php

require_once __DIR__ . '/View.php';

class VPreventivo extends View {

    public function mostraForm($veicoli, $servizi, $idVPreselezionato = null, $errore = '') {
        // $veicoli/$servizi arrivano già come array (conversione fatta dal Control, non più qui)
        $this->renderTemplate('utente/richiedipreventivo.tpl', [
            'veicoli' =>  $veicoli,
            'servizi' => $servizi,
            'idVPreselezionato' => $idVPreselezionato,
            'errore' => $errore,
        ]);
    }

    public function mostraLista($preventivi, $errore = '') {
        $categorie = $this->raggruppaPerStato($preventivi, ['inviato', 'accettato', 'rifiutato', 'svolto']);

        // un array di sezioni invece di 4 variabili: il tpl fa un solo {foreach} invece di 4 blocchi copiati

        if (Session::get('ruolo') === 'cliente'){
            $sezioni = [
                [
                    'label' => 'Inviati', 'classe' => 'inviato', 'items' => $categorie['inviato'],
                    'modificabile' => true, 'mostraCosto' => false, 'mostraPrenotaLink' => false,
                    'vuoto' => 'Nessun preventivo in attesa di risposta.',
                ],
                [
                    'label' => 'Accettati', 'classe' => 'accettato', 'items' => $categorie['accettato'],
                    'modificabile' => false, 'mostraCosto' => true, 'mostraPrenotaLink' => true,
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
            $template = 'utente/visualizzapreventivi.tpl';
        }else{
            $sezioni = [
                ['label' => 'Da accettare', 'classe' => 'inviato', 'items' => $categorie['inviato'], 'vuoto' => 'Nessuna richiesta da valutare.'],
                ['label' => 'Accettati', 'classe' => 'accettato', 'items' => $categorie['accettato'], 'vuoto' => 'Nessun preventivo accettato in corso.'],
                ['label' => 'Svolti', 'classe' => 'svolto', 'items' => $categorie['svolto'], 'vuoto' => 'Nessun intervento concluso.'],
                ['label' => 'Annullati', 'classe' => 'rifiutato', 'items' => $categorie['rifiutato'], 'vuoto' => 'Nessun preventivo annullato.'],
            ];
            $template = 'admin/gestiscipreventivi.tpl';
        }
        

        $this->renderTemplate($template, [
            'sezioni' => $sezioni,
            'errore' => $errore,
        ]);
    }
}
