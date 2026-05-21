<?php

require_once __DIR__ . '/../foundation/config.php';
require_once __DIR__ . '/../foundation/FUtente.php';
require_once __DIR__ . '/../entity/EUtente.php';
require_once __DIR__ . '/../foundation/Session.php';

class CUtente {

    public static function login($email, $password_chiara) {
        global $pdo;

        try {
            $fUtente = new FUtente();
            
            $userData = $fUtente->load('email', $email, $pdo);

            if (!$userData) {
                throw new Exception("Credenziali non valide. Riprova.");
            }
            
            $idCorretto = $userData['idU'] ?? $userData['id'];

            $utenteObj = new EUtente(
                $idCorretto,
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

        } catch (PDOException $e) {
            error_log("ERRORE CRITICO DB NEL LOGIN: " . $e->getMessage());
            throw new Exception("Servizio momentaneamente non disponibile. Riprova più tardi.");
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public static function registrazione($nome, $cognome, $email, $password_chiara) {
        global $pdo;

        try {
            $fUtente = new FUtente();
            
            if ($fUtente->load('email', $email, $pdo)) {
                throw new Exception("Questa email è già registrata nel sistema.");
            }

            $password_sicura = password_hash($password_chiara, PASSWORD_BCRYPT);
            
            // 🛠️ RE-PACK CORRETTO: Aggiunti i 2 parametri mancanti alla fine!
            $nuovoUtente = new EUtente(
                null, 
                $nome, 
                $cognome, 
                $email, 
                $password_sicura, 
                'cliente',
                null,           // <--- ultimo_accesso (null perché non è ancora entrato)
                date('Y-m-d')   // <--- data_registrazione (la data di oggi)
            );

            if (!$fUtente->store($nuovoUtente, $pdo)) {
                throw new Exception("Impossibile completare la registrazione al momento. Riprova.");
            }
            
            self::login($email, $password_chiara);

        } catch (PDOException $e) {
            error_log("ERRORE CRITICO DB NELLA REGISTRAZIONE: " . $e->getMessage());
            throw new Exception("Errore di connessione al server durante la registrazione. Riprova.");
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function logout() {
        Session::destroy();
        header('Location: index.php');
        exit();
    }
}
?>