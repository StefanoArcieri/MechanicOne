<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EMeccanico.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../Foundation/Upload.php';
require_once __DIR__ . '/../View/VMeccanico.php';
require_once __DIR__ . '/CGestiscimeccanici.php';

class CProfilomeccanico {

    public function getProfilo() {
        $idM = Session::get('idU');

        $pm = PersistentManager::getInstance();
        $profilo = $pm->load('EMeccanico', 'idM', $idM);
        if (!$profilo) throw new Exception("Profilo meccanico non trovato.");

        return $profilo;
    }

    // punto d'ingresso unico che mostra cose diverse a seconda di chi lo apre: il meccanico vede il suo profilo,
    // l'admin la lista da gestire. Non c'è più una vetrina per i clienti: i profili meccanico
    // li crea solo l'admin da CGestiscimeccanici::creaMeccanico().
    public function area($params = []) {
        $view = new VMeccanico();
        $ruolo = strtolower((string) Session::get('ruolo'));
        $errore = '';

        if ($ruolo === 'meccanico') {
            try {
                $profilo = (new CGestiscimeccanici())->arricchisciConNome($this->getProfilo());
            } catch (Exception $e) {
                $errore = $e->getMessage();
                $profilo = null;
            }
            $view->mostraProfilo($profilo, $errore);
            return;
        }

        if ($ruolo === 'admin') {
            try {
                $meccanici = array_map(
                    [new CGestiscimeccanici(), 'arricchisciConNome'],
                    (new CGestiscimeccanici())->richiediLista()
                );
            } catch (Exception $e) {
                $errore = $e->getMessage();
                $meccanici = [];
            }
            $view->mostraLista($meccanici, $errore);
            return;
        }

        header('Location: /MechanicOne/utente/home');
        exit();
    }

    public function profilo($params = []) {
        $view = new VMeccanico();
        $errore = '';
        try {
            $profilo = (new CGestiscimeccanici())->arricchisciConNome($this->getProfilo());
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $profilo = null;
        }
        $view->mostraProfilo($profilo, $errore);
    }

    public function aggiornaProfilo() {
        $idM = Session::get('idU');
        $pm = PersistentManager::getInstance();

        $nuovaSpecializzazione = trim(Request::post('specializzazione', ''));

        try {
            $datiAttuali = $pm->load('EMeccanico', 'idM', $idM);
            if (!$datiAttuali) throw new Exception("Profilo meccanico non trovato.");

            // se non è stato scelto un nuovo file la foto resta quella di prima; se invece
            // ne arriva una nuova, quella vecchia (se c'era) va tolta dal disco: non serve più
            $nomeFoto = $datiAttuali->getFotoProfilo();
            $nuovoFile = Upload::immagine(Request::file('foto'), 'meccanici');
            if ($nuovoFile !== null) {
                Upload::elimina('meccanici', $nomeFoto);
                $nomeFoto = $nuovoFile;
            }

            $meccanicoAggiornato = new EMeccanico(
                null, '', '', '', '', '', null, null,
                $idM, $nuovaSpecializzazione, $nomeFoto, $datiAttuali->getStatus()
            );

            if (!$pm->update($meccanicoAggiornato)) {
                throw new Exception("Impossibile aggiornare il profilo.");
            }
        } catch (Exception $e) {
            $profilo = (new CGestiscimeccanici())->arricchisciConNome($this->getProfilo());
            (new VMeccanico())->mostraProfilo($profilo, $e->getMessage());
            return;
        }

        header('Location: /MechanicOne/profilomeccanico/profilo?msg=profilo_aggiornato');
        exit();
    }

    // Permette al meccanico di sostituire la password provvisoria consegnata dall'admin
    // con una scelta da lui, dopo aver confermato di conoscere quella attuale.
    public function cambiaPassword() {
        $idU = Session::get('idU');
        $passwordAttuale   = Request::post('password_attuale', '');
        $nuovaPassword     = Request::post('nuova_password', '');
        $confermaPassword  = Request::post('conferma_password', '');

        try {
            $pm = PersistentManager::getInstance();
            $utenteAttuale = $pm->load('EUtente', 'idU', $idU);
            if (!$utenteAttuale) throw new Exception("Utente non trovato.");

            if (!password_verify($passwordAttuale, $utenteAttuale->getPassword())) {
                throw new Exception("La password attuale non è corretta.");
            }

            if (strlen($nuovaPassword) < 8) {
                throw new Exception("La nuova password deve avere almeno 8 caratteri.");
            }

            if ($nuovaPassword !== $confermaPassword) {
                throw new Exception("Le due password non coincidono.");
            }

            $utenteAggiornato = new EUtente(
                $utenteAttuale->getId(), $utenteAttuale->getNome(), $utenteAttuale->getCognome(),
                $utenteAttuale->getEmail(), $nuovaPassword, $utenteAttuale->getRuolo(),
                $utenteAttuale->getUltimoAccesso(), $utenteAttuale->getDataRegistrazione()
            );

            if (!$pm->update($utenteAggiornato)) {
                throw new Exception("Impossibile aggiornare la password.");
            }
        } catch (Exception $e) {
            $profilo = (new CGestiscimeccanici())->arricchisciConNome($this->getProfilo());
            (new VMeccanico())->mostraProfilo($profilo, $e->getMessage());
            return;
        }

        header('Location: /MechanicOne/profilomeccanico/profilo?msg=password_aggiornata');
        exit();
    }
}
?>
