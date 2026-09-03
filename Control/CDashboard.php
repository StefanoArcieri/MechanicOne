<?php

require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VDashboard.php';

// Punto d'atterraggio dell'admin dopo il login: una pagina propria, mai la
// 'home' generica di CUtente (quella resta riservata a cliente/ospite).
class CDashboard {

    public function admin($params = []) {
        $view = new VDashboard();
        $view->mostraAdmin(Session::get('nome'));
    }
}
?>
