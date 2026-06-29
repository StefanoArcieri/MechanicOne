<?php

class FServizio {
    public function __construct() {}
    public function load($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM servizi WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':value' => $value
            ]);
            return $stmt->fetch();
        } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nel caricamento del servizio.");
            }
            
    }

    public function store($servizio, $pdo) {
        try {
            $query = "INSERT INTO servizi (titolo, descrizione) VALUES (:titolo, :descrizione)";
            $stmt = $pdo->prepare($query);
                return $stmt->execute([

                    ':titolo' => $servizio->getTitolo(),
                    ':descrizione' => $servizio->getDescrizione(),  
                ]);

        } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nello store del servizio.");
            }
    }

    public function update($servizio, $pdo) {
            try {
                $query = "UPDATE servizi SET  titolo = :titolo, descrizione = :descrizione WHERE idS = :idS;";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':idS' => $servizio->getIdServizio(),
                    ':titolo' => $servizio->getTitolo(),
                    ':descrizione' => $servizio->getDescrizione(),
                ]);
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nell'update del servizio.");
            }
        }
    
    public function delete($field, $value, $pdo) {
            try {
                $query = "DELETE FROM servizi WHERE $field = :value";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':value' => $value
                ]);
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nella cancellazione del servizio.");
            }
        }

   public function search($field, $value, $pdo) {
            try {
                $query = "SELECT * FROM servizi WHERE $field = :value";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':value' => $value
                ]);
                return $stmt->fetchAll();
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nella ricerca del servizio.");
            }
        } 

    public function getAll($pdo) {
        try {

            $query = "SELECT * FROM servizi"; 
            
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
            
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nel caricamento del listino servizi.");
        }
    }
}