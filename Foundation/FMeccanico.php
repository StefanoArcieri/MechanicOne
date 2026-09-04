<?php

require_once __DIR__ . '/../Entity/EMeccanico.php';

class FMeccanico {
    public function __construct() {}

    private function mapRowToEntity($row) {
        if (!$row) return null;
        return new EMeccanico(
            null, null, null, null, null, null, null, null,
            $row['idM'], $row['specializzazione'], $row['foto_profilo'], $row['status']
        );
    }

   public function load($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM meccanici WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':value' => $value
            ]);
            return $this->mapRowToEntity($stmt->fetch());
        } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nel caricamento del meccanico.");
            }

    }

    public function store($meccanico, $pdo) {
        try {
            $query = "INSERT INTO meccanici (idM, specializzazione, foto_profilo, status) VALUES (:idM, :specializzazione, :foto_profilo, :status)";
            $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':idM' => $meccanico->getIdMeccanico(),
                    ':specializzazione' => $meccanico->getSpecializzazione(),
                    ':foto_profilo' => $meccanico->getFotoProfilo(),
                    ':status' => $meccanico->getStatus(),
                ]);
                // qui idM non è auto-increment (è la stessa idU dell'utente, passata da chi chiama):
                // niente lastInsertId(), sarebbe sbagliato. L'id è già noto, lo restituiamo per
                // coerenza con le altre store() (un id vero invece di un semplice booleano).
                return (int) $meccanico->getIdMeccanico();

        } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nello store del meccanico.");
            }
    }

    public function update($meccanico, $pdo) {
            try {
                $query = "UPDATE meccanici SET specializzazione = :specializzazione, status = :status, foto_profilo = :foto_profilo WHERE idM = :idM";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':idM' => $meccanico->getIdMeccanico(),
                    ':specializzazione' => $meccanico->getSpecializzazione(),
                    ':status' => $meccanico->getStatus(),
                    ':foto_profilo' => $meccanico->getFotoProfilo(),
                ]);
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nell'update del meccanico.");
            }
        }
    
    public function delete($field, $value, $pdo) {
            try {
                $query = "DELETE FROM meccanici WHERE $field = :value";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':value' => $value
                ]);
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nella cancellazione del meccanico.");
            }
        }


    public function search($field, $value, $pdo) {
            try {
                $query = "SELECT * FROM meccanici WHERE $field = :value";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':value' => $value
                ]);
                return array_map([$this, 'mapRowToEntity'], $stmt->fetchAll());
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nella ricerca del meccanico.");
            }
        }

    public function getAll($pdo) {
        try {
            $query = "SELECT * FROM meccanici";

            $stmt = $pdo->prepare($query);
            $stmt->execute();

            return array_map([$this, 'mapRowToEntity'], $stmt->fetchAll(PDO::FETCH_ASSOC));

        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore critico DB nel recupero della lista meccanici.");
        }
    }
}