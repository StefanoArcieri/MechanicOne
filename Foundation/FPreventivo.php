<?php

require_once __DIR__ . '/../Entity/EPreventivo.php';

class FPreventivo {
    public function __construct() {}

    // idem come per gli altri Foundation: niente array, si esce sempre con un'Entity
    private function mapRowToEntity($row) {
        if (!$row) return null;
        return new EPreventivo(
            $row['idPrev'], $row['idU'], $row['idV'], $row['idS'], $row['costo'], $row['stato'],
            $row['descrizione'], $row['pdf'], $row['data_richiesta'], $row['descrizione_proposta']
        );
    }

    public function load($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM preventivi WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':value' => $value]);
            return $this->mapRowToEntity($stmt->fetch());
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nel caricamento del preventivo.");
        }
    }

    public function store($preventivo, $pdo) {
        try {
            $query = "INSERT INTO preventivi (idU, idV, idS, descrizione, descrizione_proposta, costo, stato, pdf, data_richiesta)
                      VALUES (:idU, :idV, :idS, :descrizione, :descrizione_proposta, :costo, :stato, :pdf, :data_richiesta)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':idU'                  => $preventivo->getIdUtente(),
                ':idV'                  => $preventivo->getIdVeicolo(),
                ':idS'                  => $preventivo->getIdServizio(),
                ':descrizione'          => $preventivo->getDescrizione(),
                ':descrizione_proposta' => $preventivo->getDescrizioneProposta(),
                ':costo'                => $preventivo->getCosto(),
                ':stato'                => $preventivo->getStato(),
                ':pdf'                  => $preventivo->getPdf(),
                ':data_richiesta'       => $preventivo->getDataRichiesta(),
            ]);
            // l'id serve subito dopo per generare il PDF della richiesta (che riporta "Preventivo #<id>")
            return (int) $pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nello store del preventivo.");
        }
    }

    public function update($preventivo, $pdo) {
        try {
            $query = "UPDATE preventivi SET idU = :idU, idV = :idV, idS = :idS,
                      descrizione = :descrizione, descrizione_proposta = :descrizione_proposta,
                      costo = :costo, stato = :stato,
                      pdf = :pdf, data_richiesta = :data_richiesta WHERE idPrev = :idPrev";
            $stmt = $pdo->prepare($query);
            return $stmt->execute([
                ':idPrev'               => $preventivo->getIdPreventivo(),
                ':idU'                  => $preventivo->getIdUtente(),
                ':idV'                  => $preventivo->getIdVeicolo(),
                ':idS'                  => $preventivo->getIdServizio(),
                ':descrizione'          => $preventivo->getDescrizione(),
                ':descrizione_proposta' => $preventivo->getDescrizioneProposta(),
                ':costo'                => $preventivo->getCosto(),
                ':stato'                => $preventivo->getStato(),
                ':pdf'                  => $preventivo->getPdf(),
                ':data_richiesta'       => $preventivo->getDataRichiesta(),
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
            return array_map([$this, 'mapRowToEntity'], $stmt->fetchAll());
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nella ricerca del preventivo.");
        }
    }

    public function getAll($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM preventivi");
            return array_map([$this, 'mapRowToEntity'], $stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore nel recupero di tutti i preventivi.");
        }
    }
}
