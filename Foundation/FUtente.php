<?php

    class FUtente {
        public function __construct() {}

        public function load($field, $value, $pdo) {
            try {
                $query = "SELECT * FROM utenti WHERE  $field  =  :value";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':value' => $value
                ]);
                return $stmt->fetch();
            } catch (PDOException $e) {
                die("Errore nel caricamento dell'utente: " . $e->getMessage());
                return false;
            }
            
        }

        public function store($utente, $pdo) {
            try {
                $query = "INSERT INTO utenti (nome, cognome, email, password, ruolo, ultimo_accesso, data_registrazione)
                        VALUES (:nome, :cognome, :email, :password, :ruolo, :ultimo_accesso, :data_registrazione);";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':nome' => $utente->getNome(),
                    ':cognome' => $utente->getCognome(),
                    ':email' => $utente->getEmail(),
                    ':password' => $utente->getPassword(),
                    ':ruolo' => $utente->getRuolo(),
                    ':ultimo_accesso' => $utente->getUltimoAccesso(),
                    ':data_registrazione' => $utente->getDataRegistrazione()
                ]);
            } catch (PDOException $e) {
                error_log("Errore nello store dell'utente: " . $e->getMessage());
                return false;
            }
        }

        public function update($utente, $pdo) {
            try {
                $query = "UPDATE utenti SET nome = :nome, cognome = :cognome, email = :email, password = :password, 
                ruolo = :ruolo, ultimo_accesso = :ultimo_accesso, data_registrazione = :data_registrazione WHERE idU = :idU;";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':idU' => $utente->getId(),
                    ':nome' => $utente->getNome(),
                    ':cognome' => $utente->getCognome(),
                    ':email' => $utente->getEmail(),
                    ':password' => $utente->getPassword(),
                    ':ruolo' => $utente->getRuolo(),
                    ':ultimo_accesso' => $utente->getUltimoAccesso(),
                    ':data_registrazione' => $utente->getDataRegistrazione()
                ]);
            } catch (PDOException $e) {
                error_log("Errore nell'update dell'utente: " . $e->getMessage());
                return false;
            }
        }

        public function delete($field, $value, $pdo) {
            try {
                $query = "DELETE FROM utenti WHERE $field = :value";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':value' => $value
                ]);
            } catch (PDOException $e) {
                error_log("Errore nella cancellazione dell'utente: " . $e->getMessage());
                return false;
            }
        }
        public function search($field, $value, $pdo) {
            try {
                $query = "SELECT * FROM utenti WHERE $field = :value;";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':value' => $value
                ]);
                return $stmt->fetchAll();
            } catch (PDOException $e) {
                error_log("Errore nella ricerca degli utenti: " . $e->getMessage());
                return false;
            }
        }
    }
?>