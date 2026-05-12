<?php

class FMeccanico {
    public function __construct() {}

   public function load($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM meccanici WHERE :field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
                error_log("Errore nel caricamento del meccanico: " . $e->getMessage());
                return false;
            }
            
    }

    public function store($meccanico, $pdo) {
        try {
            $query = "INSERT INTO meccanici (idM, specializzazione, status) VALUES (:idM, :specializzazione, :status)";
            $stmt = $pdo->prepare($query);
                return $stmt->execute([

                    ':idM' => $meccanico->getIdMeccanico(),
                    ':specializzazione' => $meccanico->getSpecializzazione(),
                    ':status' => $meccanico->getStatus(),
                    ':fotoprofilo' => $meccanico->getFotoProfilo()  
                ]);

        } catch (PDOException $e) {
                error_log("Errore nello store del meccanico: " . $e->getMessage());
                return false;
            }
    } 

    public function update($meccanico, $pdo) {
            try {
                $query = "UPDATE meccanici SET  idM = :idM, specializzazione = :specializzazione, status = :status, fotoprofilo = :fotoprofilo WHERE idM = :idM;";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':idM' => $meccanico->getIdMeccanico(),
                    ':specializzazione' => $meccanico->getSpecializzazione(),
                    ':status' => $meccanico->getStatus(),
                    ':fotoprofilo' => $meccanico->getFotoProfilo()
                    
                ]);
            } catch (PDOException $e) {
                error_log("Errore nell'update del veicolo: " . $e->getMessage());
                return false;
            }
        }
    
    public function delete($field, $value, $pdo) {
            try {
                $query = "DELETE FROM meccanici WHERE :field = :value";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':field' => $field,
                    ':value' => $value
                ]);
            } catch (PDOException $e) {
                error_log("Errore nella cancellazione del meccanico: " . $e->getMessage());
                return false;
            }
        }


    public function search($field, $value, $pdo) {
            try {
                $query = "SELECT * FROM meccanici WHERE :field = :value";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':field' => $field,
                    ':value' => $value
                ]);
                return $stmt->fetchAll();
            } catch (PDOException $e) {
                error_log("Errore nella ricerca del meccanico: " . $e->getMessage());
                return false;
            }
        }
}