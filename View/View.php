<?php
// View/View.php

require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../smarty/src/functions.php';

// autoloader manuale per Smarty: non usiamo composer, quindi le classi Smarty\* le carichiamo a mano dal path
spl_autoload_register(function ($class) {
    if (strpos($class, 'Smarty\\') !== 0) {
        return;
    }

    $relative_class = substr($class, 7); // rimuove "Smarty\"
    $file = __DIR__ . '/../smarty/src/' . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

use Smarty\Smarty;

// Wrapper unico su Smarty: ogni V<Nome> estende questa classe invece di istanziare Smarty
// da sola, così la config (cartelle template/compile/cache) e i dati comuni a ogni pagina
// (isLogged, ruolo, nome) si scrivono una volta sola qui invece che in ogni View.
class View {
    protected $smarty;

    public function __construct() {
        $this->smarty = new Smarty();
        
        $rootPath = dirname(__DIR__);
        $this->smarty->setTemplateDir($rootPath . '/templates/');
        $this->smarty->setCompileDir($rootPath . '/templates_c/');
        $this->smarty->setCacheDir($rootPath . '/cache/');
        $this->smarty->setConfigDir($rootPath . '/configs/');

        $this->initializeCommonData();
    }

    // Codice passato con ?msg=... dopo un redirect -> testo da mostrare in un banner.
    // Prima venivano solo mandati in giro nell'URL, mai letti da nessuna parte: la
    // funzionalità era iniziata (il redirect) ma mai finita (la lettura/visualizzazione).
    private static $messaggi = [
        'veicolo_aggiunto'        => 'Veicolo aggiunto al garage.',
        'veicolo_eliminato'       => 'Veicolo eliminato.',
        'preventivo_inviato'      => 'Richiesta di preventivo inviata.',
        'preventivo_prezzato'     => 'Preventivo aggiornato.',
        'preventivo_rifiutato'    => 'Preventivo rifiutato.',
        'preventivo_svolto'       => 'Preventivo segnato come svolto.',
        'prenotazione_effettuata' => 'Prenotazione richiesta.',
        'prenotazione_accettata'  => 'Prenotazione confermata.',
        'prenotazione_conclusa'   => 'Prenotazione conclusa.',
        'prenotazione_cancellata' => 'Prenotazione cancellata.',
        'prenotazione_annullata'  => 'Prenotazione annullata.',
        'modifica_inviata'        => 'Modifica inviata.',
        'modifica_annullata'      => 'Modifica annullata.',
        'recensione_pubblicata'   => 'Recensione pubblicata, grazie!',
        'servizio_aggiunto'       => 'Servizio aggiunto al catalogo.',
        'servizio_eliminato'      => 'Servizio eliminato dal catalogo.',
        'profilo_aggiornato'      => 'Profilo aggiornato.',
        'meccanico_approvato'     => 'Meccanico approvato.',
        'meccanico_eliminato'     => 'Meccanico eliminato.',
    ];

    protected function initializeCommonData() {
        $codice = Request::get('msg');

        $this->assignData([
            'isLogged' => !empty(Session::get('idU')),
            'userRole' => Session::get('ruolo'),
            'nomeUtente' => Session::get('nome') ?: '',
            'messaggioSuccesso' => $codice ? (self::$messaggi[$codice] ?? null) : null,
        ]);
    }

    protected function assignData(array $data = []) {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        return $this;
    }

    protected function renderTemplate($template, array $data = []) {
        $this->assignData($data);
        $this->smarty->display($template);
    }

    // Raggruppa una lista di prenotazioni/preventivi per il campo "stato" in categorie.
    // Stessa logica riusata da VPrenotazione/VGestisciprenotazioni e VPreventivo/
    // VGestiscipreventivi, che prima la riscrivevano ciascuna per conto proprio.
    // Accetta sia array di Entity (con toArray()) sia array già convertiti in array.
    protected function raggruppaPerStato(array $items, array $statiPossibili) {
        $categorie = array_fill_keys($statiPossibili, []);

        foreach ($items as $item) {
            $dato = (is_object($item) && method_exists($item, 'toArray')) ? $item->toArray() : $item;
            $stato = $dato['stato'] ?? $statiPossibili[0];

            if (!isset($categorie[$stato])) {
                $categorie[$stato] = [];
            }
            $categorie[$stato][] = $dato;
        }

        return $categorie;
    }
}