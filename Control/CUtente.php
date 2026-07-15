<?php

require_once __DIR__ . '/../View/VUtente.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Foundation/FUtente.php';
require_once __DIR__ . '/../Entity/EUtente.php';
require_once __DIR__ . '/CVisualizzarecensioni.php';
require_once __DIR__ . '/CGestiscimeccanici.php';

class CUtente {

    // dati per la sezione recensioni in home: lista, media stelle e meccanici tra cui scegliere
    private function datiRecensioni() {
        $pm = PersistentManager::getInstance();

        $recensioniEntities = (new CVisualizzarecensioni())->richiediLista();

        $recensioni = [];
        foreach ($recensioniEntities as $rEntity) {
            $r = $rEntity->toArray();

            $autore = $pm->load('EUtente', 'idU', $r['idU']);
            $r['nomeAutore'] = $autore ? $autore->getNome() : 'Cliente';

            $meccanico = $pm->load('EUtente', 'idU', $r['idM']);
            $r['nomeMeccanico'] = $meccanico ? trim($meccanico->getNome() . ' ' . $meccanico->getCognome()) : 'Meccanico';

            $voto = (int) $r['valutazione'];
            $r['stelleVoto'] = str_repeat('★', $voto) . str_repeat('☆', 5 - $voto);

            $recensioni[] = $r;
        }

        $numero = count($recensioni);
        $media = $numero > 0
            ? round(array_sum(array_column($recensioni, 'valutazione')) / $numero, 1)
            : 0;
        $mediaArrotondata = (int) round($media);
        $stelleMedia = str_repeat('★', $mediaArrotondata) . str_repeat('☆', 5 - $mediaArrotondata);

        $meccaniciEntities = array_values(array_filter(
            (new CGestiscimeccanici())->richiediLista(),
            function ($m) { return $m->getStatus() === 'approvato'; }
        ));

        $meccaniciApprovati = [];
        foreach ($meccaniciEntities as $mEntity) {
            $m = $mEntity->toArray();
            $u = $pm->load('EUtente', 'idU', $m['idM']);
            $m['nomeCompleto'] = $u ? trim($u->getNome() . ' ' . $u->getCognome()) : ('Meccanico #' . $m['idM']);
            $meccaniciApprovati[] = $m;
        }

        return [
            'recensioni' => $recensioni,
            'mediaStelle' => $media,
            'stelleMedia' => $stelleMedia,
            'numeroRecensioni' => $numero,
            'meccaniciApprovati' => $meccaniciApprovati,
        ];
    }

    public function login() {
        $vUtente = new VUtente();
        $errore = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
            try {
                $email = $_POST['email'];
                $password = $_POST['password'];

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

    public function home() {
        require_once __DIR__ . '/../View/VUtente.php';
        $view = new VUtente();

        $idU = Session::get('idU');
        $nome = Session::get('nome');
        $ruolo = Session::get('ruolo');

        $datiRecensioni = $this->datiRecensioni();

        if (!$idU) {
            $view->mostraHomePubblica($datiRecensioni);
        } else {
            switch ($ruolo) {
                case 'cliente':
                    $view->mostraDashboardUtente($nome, $datiRecensioni);
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

    public function logout() {
        Session::destroy();
        header('Location: /MechanicOne/utente/login');
        exit;
    }
}
?>