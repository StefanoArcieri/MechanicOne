<?php

require_once __DIR__ . '/View.php';

class VUtente extends View {

    // =========================================================
    // METODI PER L'AUTENTICAZIONE (Login e Registrazione)
    // =========================================================

    /**
     * Mostra il form di login inserendo l'eventuale errore
     */
    public function mostraFormLogin($errore = '') {
        $this->smarty->assign('errore', $errore);
        $this->smarty->display('login.tpl');
    }

    /**
     * Mostra il form di registrazione inserendo l'eventuale errore
     */
    public function mostraFormRegistrazione($errore = '') {
        $this->smarty->assign('errore', $errore);
        $this->smarty->display('registrazione.tpl');
    }

    // =========================================================
    // METODI PER LE AREE RISERVATE E PUBBLICHE (Strada A)
    // =========================================================

    /**
     * Mostra la vetrina dell'officina per gli utenti non loggati
     */
    public function mostraHomePubblica() {
        $this->smarty->display('home.tpl');
    }

    /**
     * Renderizza l'area riservata ai clienti dell'officina
     */
    public function mostraDashboardCliente($nome) {
        $this->smarty->assign('nome', $nome);
        $this->smarty->display('home_cliente.tpl');
    }

    /**
     * Renderizza l'area di gestione per i dipendenti/meccanici
     */
    public function mostraDashboardMeccanico($nome) {
        $this->smarty->assign('nome', $nome);
        $this->smarty->display('home_meccanico.tpl');
    }

    /**
     * Renderizza il pannello di controllo dell'amministratore generale
     */
    public function mostraDashboardAdmin($nome) {
        $this->smarty->assign('nome', $nome);
        $this->smarty->display('home_admin.tpl');
    }
}
?>