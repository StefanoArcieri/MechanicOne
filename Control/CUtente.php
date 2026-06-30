<?php

require_once __DIR__ . '/../View/VUtente.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/PersistentManager.php';
// Includiamo il layer Foundation per parlare col Database reale!
require_once __DIR__ . '/../Foundation/FUtente.php'; 
require_once __DIR__ . '/../Entity/EUtente.php';

class CUtente {

    /**
     * Gestisce la visualizzazione e l'autenticazione del Login tramite Database
     */
    public function login() {
        $vUtente = new VUtente();
        $errore = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
            try {
                $email = $_POST['email'];
                $password = $_POST['password'];

                // FASE FOUNDATION: Chiamiamo il PersistentManager!
                $pm = PersistentManager::getInstance();
                $utente = $pm->verificaLogin($email, $password);

                if ($utente !== null) {
                    Session::set('idU', $utente->getId());
                    Session::set('nome', $utente->getNome());
                    Session::set('ruolo', $utente->getRuolo());
                    header('Location: /MechanicOne/utente/home');
                    exit;
                } else {
                    throw new Exception("Email o Password errate! L'officina non ti riconosce.");
                }
            } catch (Exception $e) {
                $errore = $e->getMessage();
            }
        }

        $vUtente->mostraFormLogin($errore);
    }

    /**
     * Gestisce la pagina principale dell'utente dopo il login
     */
    public static function home() {
        require_once __DIR__ . '/../View/VUtente.php';
        $view = new VUtente();

        // 1. Recuperiamo le informazioni di controllo dallo strato Sessione
        $idU = Session::get('idU');
        $nome = Session::get('nome');
        $ruolo = Session::get('ruolo');

        // 2. Controllo di flusso: l'utente ha una sessione attiva?
        if (!$idU) {
            // Se l'utente è un ospite anonimo, vede la vetrina pubblica dell'officina
            $view->mostraHomePubblica();
        } else {
            // Se l'utente è autenticato, lo smistiamo sulla sua plancia di comando specifica
            switch ($ruolo) {
                case 'cliente':
                    $view->mostraDashboardUtente($nome);
                    break;
                case 'meccanico':
                    $view->mostraDashboardMeccanico($nome);
                    break;
                case 'admin':
                    $view->mostraDashboardAdmin($nome);
                    break;
                default:
                    // Failsafe: se il ruolo non è riconosciuto, lo trattiamo come ospite
                    $view->mostraHomePubblica();
                    break;
            }
        }
    }

    public function registrazione() {
        require_once __DIR__ . '/../Entity/EMeccanico.php';
        $vUtente = new VUtente();
        $errore = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'], $_POST['cognome'], $_POST['email'], $_POST['password'])) {
            try {
                $nome           = trim($_POST['nome']);
                $cognome        = trim($_POST['cognome']);
                $email          = trim($_POST['email']);
                $password       = $_POST['password'];
                $ruolo          = isset($_POST['ruolo']) && $_POST['ruolo'] === 'meccanico' ? 'meccanico' : 'cliente';
                $specializzazione = $ruolo === 'meccanico' ? trim($_POST['specializzazione'] ?? '') : null;

                $nuovoUtente = new EUtente(null, $nome, $cognome, $email, $password, $ruolo, null, date('Y-m-d H:i:s'));

                $pm = PersistentManager::getInstance();
                $nuovoId = $pm->store($nuovoUtente);

                if (!$nuovoId) {
                    throw new Exception("Impossibile registrarsi. Forse questa email è già nel nostro database?");
                }

                if ($ruolo === 'meccanico') {
                    $nuovoMeccanico = new EMeccanico(
                        null, $nome, $cognome, $email, $password, 'meccanico', null, null,
                        $nuovoId, $specializzazione, null, 'in attesa'
                    );
                    $pm->store($nuovoMeccanico);
                }

                header('Location: /MechanicOne/utente/login');
                exit;

            } catch (Exception $e) {
                $errore = $e->getMessage();
            }
        }

        $vUtente->mostraFormRegistrazione($errore);
    }

    /**
     * Gestisce la disconnessione dell'utente (Logout)
     */
    public function logout() {
        Session::destroy();
        header('Location: /MechanicOne/utente/login');
        exit;
    }
}
?>