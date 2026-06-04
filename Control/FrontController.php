<?php

require_once __DIR__ . '/CUtente.php';
require_once __DIR__ . '/CVeicolo.php';
require_once __DIR__ . '/CServizio.php';
require_once __DIR__ . '/CPreventivo.php';
require_once __DIR__ . '/CPrenotazione.php';
require_once __DIR__ . '/CMeccanico.php';
require_once __DIR__ . '/CRecensione.php';

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
                header('HTTP/1.1 405 Method Not Allowed');
                echo "<h1>405 Method Not Allowed</h1><p>L'azione '$method' non esiste nel sistema.</p>";
                exit;
            }
            
        } else {
            header('HTTP/1.1 404 Not Found');
            echo "<h1>404 Not Found</h1><p>La risorsa '$controller' non è registrata nell'officina.</p>";
            exit;
        }

        return $real_controller->$method( $params );
    }
}
?>