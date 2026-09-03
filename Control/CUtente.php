<?php

require_once __DIR__ . '/../View/VUtente.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../Foundation/Cookie.php';
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

        if (Request::isPost() && Request::hasPost('email', 'password')) {
            try {
                $email = Request::post('email');
                $password = Request::post('password');

                $pm = PersistentManager::getInstance();
                $utente = $pm->verificaLogin($email, $password);

                if ($utente !== null) {
                    Session::set('idU', $utente->getId());
                    Session::set('nome', $utente->getNome());
                    Session::set('ruolo', $utente->getRuolo());

                    // "Ricordami": salva (o dimentica) l'email in un cookie, mai la password
                    if (Request::post('ricordami')) {
                        Cookie::set('email_ricordata', $email, 30);
                    } else {
                        Cookie::delete('email_ricordata');
                    }

                    header('Location: /MechanicOne/utente/home');
                    exit;
                } else {
                    throw new Exception("Email o Password errate! L'officina non ti riconosce.");
                }
            } catch (Exception $e) {
                $errore = $e->getMessage();
            }
        }

        $vUtente->mostraFormLogin($errore, Cookie::get('email_ricordata', ''));
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

        if (Request::isPost() && Request::hasPost('nome', 'cognome', 'email', 'password')) {
            try {
                $nome           = trim(Request::post('nome'));
                $cognome        = trim(Request::post('cognome'));
                $email          = trim(Request::post('email'));
                $password       = Request::post('password');
                $ruolo          = Request::post('ruolo') === 'meccanico' ? 'meccanico' : 'cliente';
                $specializzazione = $ruolo === 'meccanico' ? trim(Request::post('specializzazione', '')) : null;

                $nuovoUtente = new EUtente(null, $nome, $cognome, $email, $password, $ruolo, null, date('Y-m-d H:i:s'));

                $pm = PersistentManager::getInstance();

                // Transazione: chi si registra come meccanico scrive su DUE tabelle (utenti + meccanici).
                // Senza transazione, se la seconda store() fallisse resteremmo con un utente ruolo='meccanico'
                // ma senza riga in meccanici -> l'app si romperebbe al primo accesso a profilomeccanico/area.
                $pm->beginTransaction();

                $nuovoId = $pm->store($nuovoUtente);

                if (!$nuovoId) {
                    $pm->rollback();
                    throw new Exception("Impossibile registrarsi. Forse questa email è già nel nostro database?");
                }

                if ($ruolo === 'meccanico') {
                    $nuovoMeccanico = new EMeccanico(
                        null, $nome, $cognome, $email, $password, 'meccanico', null, null,
                        $nuovoId, $specializzazione, null, 'in attesa'
                    );
                    if (!$pm->store($nuovoMeccanico)) {
                        $pm->rollback();
                        throw new Exception("Registrazione non riuscita: impossibile creare il profilo meccanico.");
                    }
                }

                $pm->commit();

                // Auto-login: appena registrato l'utente resta già dentro, non deve rifare il login
                Session::set('idU', $nuovoId);
                Session::set('nome', $nome);
                Session::set('ruolo', $ruolo);

                header('Location: /MechanicOne/utente/home');
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