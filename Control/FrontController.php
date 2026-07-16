<?php

require_once __DIR__ . '/CUtente.php';
require_once __DIR__ . '/CErrori.php';

// Lato utente: un controller per macro-funzionalità
require_once __DIR__ . '/CAggiungiveicolo.php';
require_once __DIR__ . '/CGarage.php';
require_once __DIR__ . '/CRichiedipreventivo.php';
require_once __DIR__ . '/CVisualizzapreventivi.php';
require_once __DIR__ . '/CRichiediprenotazione.php';
require_once __DIR__ . '/CVisualizzaprenotazioni.php';
require_once __DIR__ . '/CScrivirecensione.php';
require_once __DIR__ . '/CVisualizzarecensioni.php';

// Lato meccanico/admin: un controller per macro-funzionalità
require_once __DIR__ . '/CProfilomeccanico.php';
require_once __DIR__ . '/CGestiscimeccanici.php';
require_once __DIR__ . '/CGestisciservizi.php';
require_once __DIR__ . '/CGestiscipreventivi.php';
require_once __DIR__ . '/CGestisciprenotazioni.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/AccessControl.php';

class FrontController {

    public function run() {

        // Scorpora l'URL in parti per determinare il controller, il metodo e i parametri
        $url = $_GET['url'] ?? '';

        $url = filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL);
        $urlParts = explode('/', $url);

        $controllerInput = !empty($urlParts[0]) ? $urlParts[0] : 'utente';
        $controller = 'C' . ucfirst($controllerInput);

        $method = !empty($urlParts[1]) ? $urlParts[1] : 'home';

        $params = array_slice($urlParts, 2);
        //

        // controllo prima che la rotta esista davvero, altrimenti un url sbagliato da utente non loggato
        // finiva reindirizzato al login invece che a un 404
        if (!class_exists($controller)) {
            $errorController = new CErrori();
            return $errorController->mostraErrore(404, "La risorsa '$controller' non è registrata nell'officina.");
        }

        if (!method_exists($controller, $method)) {
            $errorController = new CErrori();
            return $errorController->mostraErrore(405, "L'azione '$method' non esiste nel sistema.");
        }

        // Controllo permessi tramite la mappa dichiarativa di AccessControl
        switch (AccessControl::verifica($controllerInput, $method)) {
            case 'login':
                header('Location: /MechanicOne/utente/login');
                exit;
            case 'forbidden':
                $errorController = new CErrori();
                return $errorController->mostraErrore(403, "Non hai i permessi per accedere a questa risorsa.");
        }

        $real_controller = new $controller();

        try {
            return $real_controller->$method(...$params);
        } catch (Throwable $e) {
            $errorController = new CErrori();
            return $errorController->mostraErrore(500, $e->getMessage());
        }
    }
}
?>