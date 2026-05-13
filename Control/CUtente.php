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
                throw new Exception("Credenziali non valide1. Riprova.");
            }

            $utenteObj = new EUtente(
                $userData['idU'], 
                $userData['nome'], 
                $userData['cognome'], 
                $userData['email'], 
                $userData['password'], 
                $userData['ruolo'], 
                $userData['ultimo_accesso'], 
                $userData['data_registrazione']
            );

            if (!password_verify($password_chiara, $utenteObj->getPassword())) {
                throw new Exception("Credenziali non valide. Riprova.");
            }

            Session::set('idU', $utenteObj->getId());
            Session::set('ruolo', $utenteObj->getRuolo());
            Session::set('nome', $utenteObj->getNome());
            
            header('Location: ../index.php');
            exit();

        } catch (PDOException $e) {
            error_log("ERRORE CRITICO DATABASE: " . $e->getMessage());
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
            $nuovoUtente = new EUtente(null, $nome, $cognome, $email, $password_sicura, 'cliente', null, null);

            if (!$fUtente->store($nuovoUtente, $pdo)) {
                throw new Exception("Impossibile completare la registrazione. Riprova.");
            }
            
            $userData = $fUtente->load('email', $email, $pdo);
            if ($userData) {
                Session::set('idU', $userData['idU'] ?? $userData['id']); 
                Session::set('ruolo', $userData['ruolo']);
                Session::set('nome', $userData['nome']);
                
                header('Location: ../index.php');
                exit();
            }

        } catch (PDOException $e) {
            error_log("ERRORE CRITICO DATABASE REGISTRAZIONE: " . $e->getMessage());
            throw new Exception("Errore di connessione al server. Riprova tra poco.");
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function logout() {
        Session::destroy();
        header('Location: ../index.php');
        exit();
    }
}
?>