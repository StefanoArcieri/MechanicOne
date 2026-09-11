<?php

require_once __DIR__ . '/View.php';

class VUtente extends View {

    public function mostraFormLogin($errore = '', $emailRicordata = '') {
        $this->renderTemplate('login.tpl', [
            'errore' => $errore,
            'emailRicordata' => $emailRicordata,
        ]);
    }

    public function mostraFormRegistrazione($errore = '') {
        $this->renderTemplate('registrazione.tpl', [
            'errore' => $errore,
        ]);
    }

    //mostra la home pubblica del sito con recensioni e servizi disponibili
    public function mostraHomePubblica($datiRecensioni = [], $servizi = []) {
        $this->renderTemplate('home.tpl', array_merge($datiRecensioni, $servizi));
    }

    public function mostraDashboardUtente($nome, $datiPagina = []) {
        $this->renderTemplate('utente/profilo_utente.tpl', array_merge(
            ['nome' => $nome],
            $datiPagina
        ));
    }

    public function mostraDashboardMeccanico($profilo, $stats, $errore = '') {
        $this->renderTemplate('meccanico/dashboard.tpl', [
            'profilo' => $profilo,
            'stats' => $stats,
            'errore' => $errore,
        ]);
    }

    public function mostraDashboardAdmin($nome) {
        $this->renderTemplate('admin/dashboard.tpl', [
            'nome' => $nome,
        ]);
    }
}
?>