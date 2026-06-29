<?php

class FPrenotazione {
    public function __construct() {}

    public function load($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM prenotazioni WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':value' => $value
            ]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nel caricamento della prenotazione.");
        }
    }

    public function store($prenotazione, $pdo) {
        try {
            $query = "INSERT INTO prenotazioni (idPrev, idM, idV, data, ora, stato) VALUES (:idPrev, :idM, :idV, :data, :ora, :stato)";
            $stmt = $pdo->prepare($query);
            return $stmt->execute([
                ':idPrev' => $prenotazione->getIdPreventivo(),
                ':idM' => $prenotazione->getIdMeccanico(),
                ':idV' => $prenotazione->getIdVeicolo(),
                ':data' => $prenotazione->getDataPrenotazione(),
                ':ora' => $prenotazione->getOra(),
                ':stato' => $prenotazione->getStato(),
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nello store della prenotazione.");
        }
    }

    public function update($prenotazione, $pdo) {
        try {
            $query = "UPDATE prenotazioni SET idPrev = :idPrev, idM = :idM, idV = :idV, data = :data, ora = :ora, stato = :stato WHERE idPren = :idPren";
            $stmt = $pdo->prepare($query);
            return $stmt->execute([
                ':idPrev' => $prenotazione->getIdPreventivo(),
                ':idM' => $prenotazione->getIdMeccanico(),
                ':idV' => $prenotazione->getIdVeicolo(),
                ':data' => $prenotazione->getDataPrenotazione(),
                ':ora' => $prenotazione->getOra(),
                ':stato' => $prenotazione->getStato(),
                ':idPren' => $prenotazione->getIdPrenotazione(),
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nell'update della prenotazione.");
        }
    }

    public function delete($field, $value, $pdo) {
        try {
            $query = "DELETE FROM prenotazioni WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            return $stmt->execute([
                ':value' => $value
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nella cancellazione della prenotazione.");
        }
    }

    public function search($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM prenotazioni WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':value' => $value
            ]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nella ricerca della prenotazione.");
        }
    }

    public function getAll($pdo) {
        try {
            $query = "SELECT * FROM prenotazioni";
            $stmt = $pdo->query($query);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore critico DB nel recupero della lista prenotazioni.");
        }
    }
}
