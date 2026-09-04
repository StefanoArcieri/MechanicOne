<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VDashboard.php';
require_once __DIR__ . '/CProfilomeccanico.php';
require_once __DIR__ . '/CGestiscimeccanici.php';

// Punto d'atterraggio dell'admin/meccanico dopo il login: una pagina propria, mai la
// 'home' generica di CUtente (quella resta riservata a cliente/ospite).
class CDashboard {

    public function admin($params = []) {
        $view = new VDashboard();
        $view->mostraAdmin(Session::get('nome'));
    }

    public function meccanico($params = []) {
        $view = new VDashboard();
        $errore = '';
        $profilo = null;
        $stats = ['daAccettare' => 0, 'inCorso' => 0, 'concluse' => 0];

        try {
            $profilo = (new CGestiscimeccanici())->arricchisciConNome((new CProfilomeccanico())->getProfilo());
            // niente foto profilo caricata: iniziale del nome per l'avatar segnaposto (calcolata qui,
            // non nel template, dove il modifier |truncate non è tra quelli vendorizzati di Smarty)
            $profilo['iniziale'] = $profilo['nome'] !== '' ? mb_strtoupper(mb_substr($profilo['nome'], 0, 1)) : '?';
            $stats = $this->statisticheMeccanico(Session::get('idU'));
        } catch (Exception $e) {
            $errore = $e->getMessage();
        }

        $view->mostraMeccanico($profilo, $stats, $errore);
    }

    // "Situazione generale" del meccanico: quante prenotazioni sono ancora libere (chiunque può
    // prenderle in carico), quante ha già in corso lui, quante ne ha concluse in totale.
    private function statisticheMeccanico($idM) {
        $pm = PersistentManager::getInstance();
        $prenotazioni = $pm->getAll('EPrenotazione') ?: [];

        $daAccettare = 0;
        $inCorso = 0;
        $concluse = 0;

        foreach ($prenotazioni as $p) {
            if ($p->getStato() === 'in attesa') {
                $daAccettare++;
            } elseif ($p->getStato() === 'accettata' && (int) $p->getIdMeccanico() === (int) $idM) {
                $inCorso++;
            } elseif ($p->getStato() === 'conclusa' && (int) $p->getIdMeccanico() === (int) $idM) {
                $concluse++;
            }
        }

        return ['daAccettare' => $daAccettare, 'inCorso' => $inCorso, 'concluse' => $concluse];
    }
}
?>
