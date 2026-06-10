<?php

require_once __DIR__ . '/View.php';

class VUtente extends View {

    /**
     * Mostra il form di login inserendo l'eventuale errore
     */
    public function mostraFormLogin($errore = '') {
        $this->smarty->assign('errore', $errore);
        $this->smarty->display('login.tpl');
    }

    /**
     * Renderizza la Dashboard/Home dell'utente loggato usando il template Smarty
     * @param int $idUtente L'ID dell'utente recuperato dalla sessione
     */
    public function mostraHome($idUtente) {
        // Prepariamo i dati per il motore grafico
        $this->smarty->assign('idUtente', $idUtente);
        
        // Lanciamo il rendering del file template dedicato
        $this->smarty->display('home.tpl');
    }

    public function mostraFormRegistrazione($errore = '') {
        $this->smarty->assign('errore', $errore);
        $this->smarty->display('registrazione.tpl');
    }
}
?>