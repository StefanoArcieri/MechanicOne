<?php

class FVeicolo {
    public function __construct() {}

    public function load($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM veicoli WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':value' => $value]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nel caricamento del veicolo.");
        }
    }

    public function store($veicolo, $pdo) {
        try {
            $query = "INSERT INTO veicoli (targa, marca, modello, idU) VALUES (:targa, :marca, :modello, :idU)";
            $stmt = $pdo->prepare($query);
            return $stmt->execute([
                ':targa'   => $veicolo->getTarga(),
                ':marca'   => $veicolo->getMarca(),
                ':modello' => $veicolo->getModello(),
                ':idU'     => $veicolo->getIdUtente(),
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nello store del veicolo.");
        }
    }

    public function update($veicolo, $pdo) {
        try {
            $query = "UPDATE veicoli SET targa = :targa, marca = :marca, modello = :modello, idU = :idU WHERE idV = :idV";
            $stmt = $pdo->prepare($query);
            return $stmt->execute([
                ':idV'     => $veicolo->getIdVeicolo(),
                ':targa'   => $veicolo->getTarga(),
                ':marca'   => $veicolo->getMarca(),
                ':modello' => $veicolo->getModello(),
                ':idU'     => $veicolo->getIdUtente(),
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nell'update del veicolo.");
        }
    }

    public function delete($field, $value, $pdo) {
        try {
            $query = "DELETE FROM veicoli WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            return $stmt->execute([':value' => $value]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nella cancellazione del veicolo.");
        }
    }

    public function search($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM veicoli WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':value' => $value]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nella ricerca del veicolo.");
        }
    }

    public function getAll($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM veicoli");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nel recupero dei veicoli.");
        }
    }
}
