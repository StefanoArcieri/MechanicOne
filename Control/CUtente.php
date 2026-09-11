<?php

require_once __DIR__ . '/../View/VUtente.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../Foundation/Cookie.php';
require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Foundation/FUtente.php';
require_once __DIR__ . '/../Entity/EUtente.php';
require_once __DIR__ . '/CRecensione.php';
require_once __DIR__ . '/CGestiscimeccanici.php';
require_once __DIR__ . '/CProfilomeccanico.php';

class CUtente {

    // dati per la sezione recensioni in home: lista, media stelle e meccanici tra cui scegliere
    private function datiRecensioni() {
        $pm = PersistentManager::getInstance();

        //recupero le recensioni
        $recensioniEntities = (new CRecensione())->richiediLista();

        //creo un array di recensioni (arrary di array)
        $recensioni = [];
        foreach ($recensioniEntities as $rEntity) {
            $r = $rEntity->toArray();

            $autore = $pm->load('EUtente', 'idU', $r['idU']);
            $r['nomeAutore'] = $autore ? trim($autore->getNome() . ' ' . $autore->getCognome()) : 'Cliente';

            $meccanico = $pm->load('EUtente', 'idU', $r['idM']);
            $r['nomeMeccanico'] = $meccanico ? trim($meccanico->getNome() . ' ' . $meccanico->getCognome()) : 'Meccanico';

            $voto = (int) $r['valutazione'];
            $r['stelleVoto'] = str_repeat('★', $voto) . str_repeat('☆', 5 - $voto);

            $recensioni[] = $r;
        }

        // calcolo media stelle e numero recensioni
        $numero = count($recensioni);
        $media = $numero > 0
            ? round(array_sum(array_column($recensioni, 'valutazione')) / $numero, 1)
            : 0;
        $mediaArrotondata = (int) round($media);
        //stringa di stelline
        $stelleMedia = str_repeat('★', $mediaArrotondata) . str_repeat('☆', 5 - $mediaArrotondata);

        //recupero i meccanici (array di array)
        $meccaniciEntities = (new CGestiscimeccanici()) -> richiediLista();
        $meccanici = [];
        foreach ($meccaniciEntities as $mEntity) {
            $m = $mEntity->toArray();
            $u = $pm->load('EUtente', 'idU', $m['idM']); //carica i dati completi del meccanico
            $m['nomeCompleto'] = trim($u->getNome() . ' ' . $u->getCognome());
            $meccanici[] = $m;
        }

        return [
            'recensioni' => $recensioni,
            'mediaStelle' => $media,
            'stelleMedia' => $stelleMedia,
            'numeroRecensioni' => $numero,
            'meccanici' => $meccanici,
        ];
    }

    private function datiServizi() {
        $pm = PersistentManager::getInstance();
        $serviziEntities = (new CGestisciservizi())->richiediLista();

        $servizi = [];
        foreach ($serviziEntities as $sEntity) {
            $s = $sEntity->toArray();
            $servizi[] = $s;
        }

        return ['servizi' => $servizi];
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
                    // prima di scrivere qualunque dato in sessione: nuovo id di sessione, per non
                    // ereditare un id che l'attaccante potrebbe aver fissato prima del login
                    Session::regenerate();

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
        $ruolo = Session::get('ruolo');

        require_once __DIR__ . '/../View/VUtente.php';
        $view = new VUtente();

         // Meccanico e admin niente home
        switch ($ruolo) {
            case 'meccanico':
                $errore = '';
                $profilo = null;
                $stats = ['daAccettare' => 0, 'inCorso' => 0, 'concluse' => 0];
                try {
                    $profilo = (new CGestiscimeccanici())->arricchisciConNome((new CProfilomeccanico())->getProfilo());
                    // niente foto profilo caricata: iniziale del nome per l'avatar segnaposto
                    $profilo['iniziale'] = $profilo['nome'] !== '' ? mb_strtoupper(mb_substr($profilo['nome'], 0, 1)) : '?';
                    $stats = $this->statisticheMeccanico(Session::get('idU'));
                } catch (Exception $e) {
                    $errore = $e->getMessage();
                }
                $view->mostraDashboardMeccanico($profilo, $stats, $errore);
                break;
            case 'admin':
                $view->mostraDashboardAdmin(Session::get('nome'));
                break;
            default:
                $view->mostraHomePubblica($this->datiRecensioni(), $this->datiServizi());
        }
    }

    // "Situazione generale" del meccanico: quante prenotazioni sono ancora libere (chiunque può
    // prenderle in carico), quante ha già in corso lui, quante ne ha concluse in totale.
    private function statisticheMeccanico($idM) {
        $pm = PersistentManager::getInstance();
        $prenotazioni = $pm->getAll('EPrenotazione') ?: [];

        $daAccettare = 0;
        $inCorso = 0;
        $concluse = 0;

        foreach ($prenotazioni as $p) {
            if ($p->getStato() === 'in attesa') {
                $daAccettare++;
            } elseif ($p->getStato() === 'accettata' && (int) $p->getIdMeccanico() === (int) $idM) {
                $inCorso++;
            } elseif ($p->getStato() === 'conclusa' && (int) $p->getIdMeccanico() === (int) $idM) {
                $concluse++;
            }
        }

        return ['daAccettare' => $daAccettare, 'inCorso' => $inCorso, 'concluse' => $concluse];
    }

    // Pagina "personale" del cliente (garage, preventivi, prenotazioni a colpo d'occhio) —
    // prima era ciò che home() mostrava di default al cliente loggato; ora è un punto
    // d'ingresso a sé, raggiungibile dal menu profilo (come già CProfilomeccanico::profilo()).
    public function dashboardUtente() {

        require_once __DIR__ . '/../View/VUtente.php';
        $view = new VUtente();
        $view->mostraDashboardUtente(Session::get('nome'), $this->datiDashboardUtente());
    }

    private function datiDashboardUtente(){
        $pm = PersistentManager::getInstance();
        $preventiviEntities = $pm->search('EPreventivo', 'idU', Session::get('idU')) ?: [];
        $countPreventiviTotali = count($preventiviEntities);
        $conteggiPreventivi = array_count_values(array_map(function ($p) { return $p->getStato(); }, $preventiviEntities));

        $prenotazioniEntities = $pm->search('EPrenotazione', 'idU', Session::get('idU')) ?: [];
        $countPrenotazioniTotali = count($prenotazioniEntities);
        $conteggiPrenotazioni = array_count_values(array_map(function ($pr) { return $pr->getStato(); }, $prenotazioniEntities));

        $veicoliEntities = $pm->search('EVeicolo', 'idU', Session::get('idU')) ?: [];
        $countVeicoliTotali = count($veicoliEntities);
        $p = [];
        foreach ($veicoliEntities as $vEntity) {
            $p[] = [
                'targa' => $vEntity->getTarga(),
                'marca' => $vEntity->getMarca(),
                'modello' => $vEntity->getModello(),
            ];
        }

        return [
            'countPreventiviTotali' => $countPreventiviTotali,
            'countPreventiviSvolti' => $conteggiPreventivi['svolto'] ?? 0,
            'countPreventiviAccettati' => $conteggiPreventivi['accettato'] ?? 0,
            'countPreventiviRifiutati' => $conteggiPreventivi['rifiutato'] ?? 0,
            'countPreventiviInviati' => $conteggiPreventivi['inviato'] ?? 0,
            'countPrenotazioniTotali' => $countPrenotazioniTotali,
            'countPrenotazioniInAttesa' => $conteggiPrenotazioni['in attesa'] ?? 0,
            'countPrenotazioniConcluse' => $conteggiPrenotazioni['conclusa'] ?? 0,
            'countPrenotazioniAccettate' => $conteggiPrenotazioni['accettata'] ?? 0,
            'countPrenotazioniCancellate' => $conteggiPrenotazioni['cancellata'] ?? 0,
            'countVeicoliTotali' => $countVeicoliTotali,
            'veicoli' => $p,
        ];
    }

    // Registrazione pubblica: crea sempre e solo account cliente.
    // I profili meccanico sono creati dall'admin da CGestiscimeccanici::creaMeccanico().
    public function registrazione() {
        $vUtente = new VUtente();
        $errore = '';

        if (Request::isPost() && Request::hasPost('nome', 'cognome', 'email', 'password')) {
            try {
                $nome     = trim(Request::post('nome'));
                $cognome  = trim(Request::post('cognome'));
                $email    = trim(Request::post('email'));
                $password = Request::post('password');

                if (strlen($password) < 8) {
                    throw new Exception("La password deve avere almeno 8 caratteri.");
                }

                $nuovoUtente = new EUtente(null, $nome, $cognome, $email, $password, 'cliente', null, date('Y-m-d H:i:s'));

                $pm = PersistentManager::getInstance();
                $nuovoId = $pm->store($nuovoUtente);

                if (!$nuovoId) {
                    throw new Exception("Impossibile registrarsi. Forse questa email è già nel nostro database?");
                }

                // Auto-login: appena registrato l'utente resta già dentro, non deve rifare il login.
                // Anche qui: nuovo id di sessione prima di scrivere i dati, stesso motivo del login.
                Session::regenerate();
                Session::set('idU', $nuovoId);
                Session::set('nome', $nome);
                Session::set('ruolo', 'cliente');

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
        header('Location: /MechanicOne/utente/home');
        exit;
    }
}
?>