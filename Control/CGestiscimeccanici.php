<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EMeccanico.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../View/VMeccanico.php';

class CGestiscimeccanici {

    public function lista($params = []) {
        $view = new VMeccanico();
        $errore = '';
        try {
            $meccanici = array_map([$this, 'arricchisciConNome'], $this->richiediLista());
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $meccanici = [];
        }
        $view->mostraLista($meccanici, $errore);
    }

    public function richiediLista() {
        $pm = PersistentManager::getInstance();
        return $pm->getAll('EMeccanico') ?: [];
    }

    // meccanici table non ha nome/cognome (stanno su utenti), quindi li recuperiamo qui per i template
    public function arricchisciConNome($meccanicoEntity) {
        $m = $meccanicoEntity->toArray();
        $pm = PersistentManager::getInstance();
        $u = $pm->load('EUtente', 'idU', $m['idM']);
        $m['nome'] = $u ? $u->getNome() : '';
        $m['cognome'] = $u ? $u->getCognome() : '';
        $m['email'] = $u ? $u->getEmail() : '';
        return $m;
    }

    // Genera una password provvisoria leggibile (evita caratteri ambigui tipo 0/O, 1/l/I)
    private function generaPassword($lunghezza = 10) {
        $alfabeto = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789';
        $password = '';
        for ($i = 0; $i < $lunghezza; $i++) {
            $password .= $alfabeto[random_int(0, strlen($alfabeto) - 1)];
        }
        return $password;
    }

    // L'admin crea direttamente un profilo meccanico: le credenziali (email + password
    // provvisoria generata al volo) vanno consegnate a mano al collaboratore, l'account
    // nasce già attivo e non richiede più nessuna approvazione.
    public function creaMeccanico() {
        $nome              = trim(Request::post('nome', ''));
        $cognome           = trim(Request::post('cognome', ''));
        $email             = trim(Request::post('email', ''));
        $specializzazione  = trim(Request::post('specializzazione', ''));

        try {
            if ($nome === '' || $cognome === '' || $email === '') {
                throw new Exception("Nome, cognome ed email sono obbligatori.");
            }

            $pm = PersistentManager::getInstance();

            if ($pm->load('EUtente', 'email', $email)) {
                throw new Exception("Esiste già un account con questa email.");
            }

            $password = $this->generaPassword();

            $pm->beginTransaction();

            $nuovoUtente = new EUtente(null, $nome, $cognome, $email, $password, 'meccanico', null, date('Y-m-d H:i:s'));
            $nuovoId = $pm->store($nuovoUtente);

            if (!$nuovoId) {
                $pm->rollback();
                throw new Exception("Impossibile creare l'account del meccanico.");
            }

            $nuovoMeccanico = new EMeccanico(
                null, $nome, $cognome, $email, $password, 'meccanico', null, null,
                $nuovoId, $specializzazione !== '' ? $specializzazione : null, null, 'approvato'
            );

            if (!$pm->store($nuovoMeccanico)) {
                $pm->rollback();
                throw new Exception("Account creato ma impossibile salvare il profilo meccanico.");
            }

            $pm->commit();
        } catch (Exception $e) {
            $meccanici = array_map([$this, 'arricchisciConNome'], $this->richiediLista());
            (new VMeccanico())->mostraLista($meccanici, $e->getMessage());
            return;
        }

        // Le credenziali generate si vedono solo in questa risposta: niente redirect,
        // altrimenti andrebbero perse (in DB la password resta solo come hash).
        $meccanici = array_map([$this, 'arricchisciConNome'], $this->richiediLista());
        (new VMeccanico())->mostraLista($meccanici, '', ['email' => $email, 'password' => $password]);
    }

    public function eliminaMeccanico($idM) {
        $pm = PersistentManager::getInstance();
        if (!$pm->delete('EMeccanico', 'idM', $idM)) {
            throw new Exception("Impossibile eliminare il meccanico.");
        }

        header('Location: /MechanicOne/gestiscimeccanici/lista?msg=meccanico_eliminato');
        exit();
    }
}
?>
