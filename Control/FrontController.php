<?php

require_once __DIR__ . '/CUtente.php';
require_once __DIR__ . '/CVeicolo.php';
require_once __DIR__ . '/CServizio.php';
require_once __DIR__ . '/CPreventivo.php';
require_once __DIR__ . '/CPrenotazione.php';
require_once __DIR__ . '/CMeccanico.php';
require_once __DIR__ . '/CRecensione.php';
require_once __DIR__ . '/CErrori.php';
require_once __DIR__ . '/../Foundation/Session.php';

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

        // Controllo se l'utente è autenticato per le azioni che richiedono autenticazione
        if ($this->requiresAuth($controllerInput, $method) && empty(Session::get('idU'))) {
            header('Location: /MechanicOne/utente/login');
            exit;
        }

        //controllo se la classe del controller esiste e se il metodo richiesto è definito
        if ( class_exists( $controller ) ) {
            
            // Controllo se il metodo esiste nella classe del controller
            if ( method_exists($controller, $method ) ) {
                $real_controller = new $controller();
            } else {

                $errorController = new CErrori();
                return $errorController->mostraErrore(405, "L'azione '$method' non esiste nel sistema.");
            }
            
        } else {
            $errorController = new CErrori();
            return $errorController->mostraErrore(404, "La risorsa '$controller' non è registrata nell'officina.");
        }

        return $real_controller->$method(...$params);
    }

    private function requiresAuth($controllerInput, $method) {
        
        //white list dei controller e metodi pubblici che non richiedono autenticazione
        $publicControllers = ['utente', 'errore'];
        $publicActions = ['home', 'login', 'registrazione', 'logout'];

        //se il controller è nella lista dei controller pubblici, allora controlla se il metodo è nella lista dei metodi pubblici
        if (in_array($controllerInput, $publicControllers, true)) {
            return !in_array($method, $publicActions, true);
        }

        return True; // Tutti gli altri controller richiedono autenticazione
    }
}
?>