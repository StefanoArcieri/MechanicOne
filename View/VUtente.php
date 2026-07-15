<?php

require_once __DIR__ . '/View.php';

class VUtente extends View {

    public function mostraFormLogin($errore = '') {
        $this->smarty->assign('errore', $errore);
        $this->smarty->display('login.tpl');
    }

    public function mostraFormRegistrazione($errore = '') {
        $this->smarty->assign('errore', $errore);
        $this->smarty->display('registrazione.tpl');
    }

    public function mostraHomePubblica($datiRecensioni = []) {
        $this->assignData($datiRecensioni);
        $this->smarty->display('home.tpl');
    }

    public function mostraDashboardMeccanico($nome) {
        $this->smarty->assign('nome', $nome);
        $this->smarty->display('home_meccanico.tpl');
    }

    public function mostraDashboardUtente($nome, $datiRecensioni = []) {
        $this->smarty->assign('nome', $nome);
        $this->assignData($datiRecensioni);
        $this->smarty->display('home_utente.tpl');
    }

    public function mostraDashboardAdmin($nome) {
        $this->smarty->assign('nome', $nome);
        $this->smarty->display('home_admin.tpl');
    }
}
?>