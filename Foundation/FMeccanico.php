<?php

class FMeccanico {
    public function __construct() {}

   public function load($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM meccanici WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':value' => $value
            ]);
            return $stmt->fetch();
        } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nel caricamento del meccanico.");
            }
            
    }

    public function store($meccanico, $pdo) {
        try {
            $query = "INSERT INTO meccanici (specializzazione, status) VALUES (:specializzazione, :status)";
            $stmt = $pdo->prepare($query);
                return $stmt->execute([

                    ':specializzazione' => $meccanico->getSpecializzazione(),
                    ':status' => $meccanico->getStatus(),
                    ':fotoprofilo' => $meccanico->getFotoProfilo()  
                ]);

        } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nello store del meccanico.");
            }
    } 

    public function update($meccanico, $pdo) {
            try {
                $query = "UPDATE meccanici SET specializzazione = :specializzazione, status = :status, fotoprofilo = :fotoprofilo WHERE idM = :idM;";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':idM' => $meccanico->getIdMeccanico(),
                    ':specializzazione' => $meccanico->getSpecializzazione(),
                    ':status' => $meccanico->getStatus(),
                    ':fotoprofilo' => $meccanico->getFotoProfilo()
                    
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
                return $stmt->fetchAll();
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
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
            
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore critico DB nel recupero della lista meccanici.");
        }
    }
}