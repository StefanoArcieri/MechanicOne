<?php

require_once __DIR__ . '/CUtente.php';
require_once __DIR__ . '/CVeicolo.php';
require_once __DIR__ . '/CServizio.php';
require_once __DIR__ . '/CPreventivo.php';
require_once __DIR__ . '/CPrenotazione.php';
require_once __DIR__ . '/CMeccanico.php';
require_once __DIR__ . '/CRecensione.php';
require_once __DIR__ . '/CErrori.php'; // Includiamo il nuovo controller degli errori

class FrontController {

    public function run() {

        $url = $_GET['url'] ?? '';
        
        $url = filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL);
        $urlParts = explode('/', $url);

        $controllerInput = !empty($urlParts[0]) ? $urlParts[0] : 'utente';
        $controller = 'C' . ucfirst($controllerInput);

        $method = !empty($urlParts[1]) ? $urlParts[1] : 'home';

        $params = array_slice($urlParts, 2);

        if ( class_exists( $controller ) ) {
            
            if ( method_exists($controller, $method ) ) {
                $real_controller = new $controller();
            } else {
                // Sostituito l'echo con la chiamata al controllore degli errori (Metodo non esistente)
                $errorController = new CErrori();
                return $errorController->mostraErrore(405, "L'azione '$method' non esiste nel sistema.");
            }
            
        } else {
            // Sostituito l'echo con la chiamata al controllore degli errori (Classe non esistente)
            $errorController = new CErrori();
            return $errorController->mostraErrore(404, "La risorsa '$controller' non è registrata nell'officina.");
        }

        return $real_controller->$method( $params );
    }
}
?>