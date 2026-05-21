<?php

class FVeicolo {
    public function __construct() {}

    public function load($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM veicoli WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':value' => $value
            ]);
            return $stmt->fetch();
        } catch (PDOException $e) {
                error_log("Errore nel caricamento del veicolo: " . $e->getMessage());
                return false;
            }
            
    }

    public function store($veicolo, $pdo) {
        try {
            $query = "INSERT INTO veicoli (targa, idU, marca, modello) VALUES (:targa, :idU, :marca, :modello)";
            $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':targa' => $veicolo->getTarga(),
                    ':modello' => $veicolo->getModello(),
                    ':marca' => $veicolo->getMarca(),
                    ':idU' => $veicolo->getIdUtente(),   
                ]);

        } catch (PDOException $e) {
                error_log("Errore nello store del veicolo: " . $e->getMessage());
                return false;
            }
    }

    public function update($veicolo, $pdo) {
            try {
                $query = "UPDATE veicoli SET  targa = :targa, idU = :idU, marca = :marca, modello = :modello WHERE idV = :idV;";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':idV' => $veicolo->getIdVeicolo(),
                    ':targa' => $veicolo->getTarga(),
                    ':idU' => $veicolo->getIdUtente(),
                    ':marca' => $veicolo->getMarca(),
                    ':modello' => $veicolo->getModello()
                ]);
            } catch (PDOException $e) {
                error_log("Errore nell'update del veicolo: " . $e->getMessage());
                return false;
            }
        }
    
    public function delete($field, $value, $pdo) {
            try {
                $query = "DELETE FROM veicoli WHERE $field = :value";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':value' => $value
                ]);
            } catch (PDOException $e) {
                error_log("Errore nella cancellazione del veicolo: " . $e->getMessage());
                return false;
            }
        }


    public function search($field, $value, $pdo) {
            try {
                $query = "SELECT * FROM veicoli WHERE $field = :value";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':value' => $value
                ]);
                return $stmt->fetchAll();
            } catch (PDOException $e) {
                error_log("Errore nella ricerca del veicolo: " . $e->getMessage());
                return false;
            }
        }





}
