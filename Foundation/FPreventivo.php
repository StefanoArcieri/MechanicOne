<?php

class FPreventivo {
    public function __construct() {}

    public function load($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM preventivi WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':value' => $value]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nel caricamento del preventivo.");
        }
    }

    public function store($preventivo, $pdo) {
        try {
            $query = "INSERT INTO preventivi (idU, idV, idS, descrizione, costo, stato, pdf, data_richiesta)
                      VALUES (:idU, :idV, :idS, :descrizione, :costo, :stato, :pdf, :data_richiesta)";
            $stmt = $pdo->prepare($query);
            return $stmt->execute([
                ':idU'            => $preventivo->getIdUtente(),
                ':idV'            => $preventivo->getIdVeicolo(),
                ':idS'            => $preventivo->getIdServizio(),
                ':descrizione'    => $preventivo->getDescrizione(),
                ':costo'          => $preventivo->getCosto(),
                ':stato'          => $preventivo->getStato(),
                ':pdf'            => $preventivo->getPdf(),
                ':data_richiesta' => $preventivo->getDataRichiesta(),
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nello store del preventivo.");
        }
    }

    public function update($preventivo, $pdo) {
        try {
            $query = "UPDATE preventivi SET idU = :idU, idV = :idV, idS = :idS,
                      descrizione = :descrizione, costo = :costo, stato = :stato,
                      pdf = :pdf, data_richiesta = :data_richiesta WHERE idPrev = :idPrev";
            $stmt = $pdo->prepare($query);
            return $stmt->execute([
                ':idPrev'         => $preventivo->getIdPreventivo(),
                ':idU'            => $preventivo->getIdUtente(),
                ':idV'            => $preventivo->getIdVeicolo(),
                ':idS'            => $preventivo->getIdServizio(),
                ':descrizione'    => $preventivo->getDescrizione(),
                ':costo'          => $preventivo->getCosto(),
                ':stato'          => $preventivo->getStato(),
                ':pdf'            => $preventivo->getPdf(),
                ':data_richiesta' => $preventivo->getDataRichiesta(),
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nell'update del preventivo.");
        }
    }

    public function delete($field, $value, $pdo) {
        try {
            $query = "DELETE FROM preventivi WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            return $stmt->execute([':value' => $value]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nella cancellazione del preventivo.");
        }
    }

    public function search($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM preventivi WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':value' => $value]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nella ricerca del preventivo.");
        }
    }

    public function getAll($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM preventivi");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nel recupero di tutti i preventivi.");
        }
    }
}
