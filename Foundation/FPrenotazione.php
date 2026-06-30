<?php

class FPrenotazione {
    public function __construct() {}

    public function load($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM prenotazioni WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':value' => $value]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nel caricamento della prenotazione.");
        }
    }

    public function store($prenotazione, $pdo) {
        try {
            $query = "INSERT INTO prenotazioni (idPrev, idM, idU, idV, data, ora, stato)
                      VALUES (:idPrev, :idM, :idU, :idV, :data, :ora, :stato)";
            $stmt = $pdo->prepare($query);
            return $stmt->execute([
                ':idPrev' => $prenotazione->getIdPreventivo(),
                ':idM'    => $prenotazione->getIdMeccanico(),
                ':idU'    => $prenotazione->getIdUtente(),
                ':idV'    => $prenotazione->getIdVeicolo(),
                ':data'   => $prenotazione->getDataPrenotazione(),
                ':ora'    => $prenotazione->getOra(),
                ':stato'  => $prenotazione->getStato(),
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nello store della prenotazione.");
        }
    }

    public function update($prenotazione, $pdo) {
        try {
            $query = "UPDATE prenotazioni SET idPrev = :idPrev, idM = :idM, idU = :idU,
                      idV = :idV, data = :data, ora = :ora, stato = :stato WHERE idPren = :idPren";
            $stmt = $pdo->prepare($query);
            return $stmt->execute([
                ':idPren' => $prenotazione->getIdPrenotazione(),
                ':idPrev' => $prenotazione->getIdPreventivo(),
                ':idM'    => $prenotazione->getIdMeccanico(),
                ':idU'    => $prenotazione->getIdUtente(),
                ':idV'    => $prenotazione->getIdVeicolo(),
                ':data'   => $prenotazione->getDataPrenotazione(),
                ':ora'    => $prenotazione->getOra(),
                ':stato'  => $prenotazione->getStato(),
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
            return $stmt->execute([':value' => $value]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nella cancellazione della prenotazione.");
        }
    }

    public function search($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM prenotazioni WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':value' => $value]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nella ricerca della prenotazione.");
        }
    }

    public function getAll($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM prenotazioni");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore critico DB nel recupero della lista prenotazioni.");
        }
    }
}
