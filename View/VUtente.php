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

    public function mostraHomePubblica($datiRecensioni = []) {
        $this->renderTemplate('home.tpl', $datiRecensioni);
    }

    public function mostraDashboardUtente($nome, $datiRecensioni = []) {
        $this->renderTemplate('utente/home_utente.tpl', array_merge(
            ['nome' => $nome],
            $datiRecensioni
        ));
    }
}
?>