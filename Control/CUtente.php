<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EUtente.php';
require_once __DIR__ . '/../Foundation/Session.php';

class CUtente {

    public static function login($email, $password_chiara) {
        try {
            $pm = PersistentManager::getInstance();
            $userData = $pm->load('EUtente', 'email', $email);

            if (!$userData) {
                throw new Exception("Credenziali non valide. Riprova.");
            }

            $utenteObj = new EUtente(
                $userData['idU'] ?? $userData['id'],
                $userData['nome'],
                $userData['cognome'],
                $userData['email'],
                $userData['password'],
                $userData['ruolo'],
                $userData['ultimo_accesso'] ?? null,
                $userData['data_registrazione'] ?? null
            );

            if (!password_verify($password_chiara, $utenteObj->getPassword())) {
                throw new Exception("Credenziali non valide. Riprova.");
            }

            Session::set('idU', $utenteObj->getId());
            Session::set('nome', $utenteObj->getNome());
            Session::set('ruolo', $utenteObj->getRuolo());
            
            header('Location: ../index.php');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function registrazione($nome, $cognome, $email, $password_chiara) {
        try {
            $pm = PersistentManager::getInstance();
            
            if ($pm->load('EUtente', 'email', $email)) {
                throw new Exception("Questa email è già registrata nel sistema.");
            }

            $password_sicura = password_hash($password_chiara, PASSWORD_BCRYPT);
            $nuovoUtente = new EUtente(
                null, $nome, $cognome, $email, $password_sicura, 'cliente', null, date('Y-m-d')
            );

            if (!$pm->store($nuovoUtente)) {
                throw new Exception("Impossibile completare la registrazione al momento. Riprova.");
            }
            
            self::login($email, $password_chiara);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function logout() {
        Session::destroy();
        header('Location: index.php');
        exit();
    }

    public static function home() {
        require_once __DIR__ . '/../View/VUtente.php';

        $view = new VUtente();
        $view->mostraHomePubblica();
    }
}
?>