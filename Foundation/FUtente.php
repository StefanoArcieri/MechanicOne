<?php

require_once __DIR__ . '/../Entity/EUtente.php';

class FUtente {
    public function __construct() {}

    public function load($field, $value, $pdo) {
        // ... (lascialo invariato, come lo avevi scritto tu) ...
    }

    /**
     * Equivalente del vecchio "registraUtente"
     */
    public function store($utente, $pdo) {
        try {
            $query = "INSERT INTO utenti (nome, cognome, email, password, ruolo, ultimo_accesso, data_registrazione)
                    VALUES (:nome, :cognome, :email, :password, :ruolo, :ultimo_accesso, :data_registrazione);";
            $stmt = $pdo->prepare($query);
            return $stmt->execute([
                ':nome' => $utente->getNome(),
                ':cognome' => $utente->getCognome(),
                ':email' => $utente->getEmail(),
                // GAS! Criptiamo la password prima di salvarla nel Database
                ':password' => password_hash($utente->getPassword(), PASSWORD_DEFAULT),
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

        public function verificaLogin($email, $password, $pdo) {
        try {
            // Cerchiamo l'utente tramite l'email
            $query = "SELECT * FROM utenti WHERE email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':email' => $email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Se l'email esiste e la password inserita corrisponde all'hash salvato nel DB
            if ($row && password_verify($password, $row['password'])) {
                // Restituiamo l'Entity EUtente popolata coi dati del DB
                return new EUtente(
                    $row['idU'],
                    $row['nome'],
                    $row['cognome'],
                    $row['email'],
                    $row['password'],
                    $row['ruolo'],
                    $row['ultimo_accesso'],
                    $row['data_registrazione']
                );
            }
            return null; // Credenziali errate
        } catch (PDOException $e) {
            error_log("Errore nel verificaLogin: " . $e->getMessage());
            return null;
        }
    }
}
?>