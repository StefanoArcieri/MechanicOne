<?php

class FPreventivo {
    public function __construct() {}

    public function load($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM preventivi WHERE :field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
                error_log("Errore nel caricamento del preventivo: " . $e->getMessage());
                return false;
            }
            
    }

    public function store($preventivo, $pdo) {
        try {
            $query = "INSERT INTO preventivi (idP, idU, targa,servizio, descrizione, costo, stato, pdf, data_richiesta) VALUES (:idP, :idU, :targa,:servizio, :descrizione, :costo, :stato, :pdf, :data_richiesta )";
            $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':idP' => $preventivo->getIdPreventivo(),   
                    ':targa' => $preventivo->getTarga(),
                    ':idU' => $preventivo->getIdUtente(),  
                    ':servizio' => $preventivo->getServizio(),   
                    ':descrizione' => $preventivo->getDescrizione(),
                    ':costo' => $preventivo->getCosto(),
                    ':stato' => $preventivo->getStato(),   
                    ':pdf' => $preventivo->getPdf(),
                    ':data_richiesta' => $preventivo->getDataRichiesta(),  
                ]);

        } catch (PDOException $e) {
                error_log("Errore nello store del preventivo: " . $e->getMessage());
                return false;
            }
    }

    public function update($preventivo, $pdo) {
            try {
                $query = "UPDATE veicoli SET  targa = :targa, idU = :idU, idP = :idP, servizio = :servizio, costo = :costo, stato = :stato, descrizione = :descrizione, pdf = :pdf, data_richiesta = :data_richiesta WHERE idU = :idU;";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':idP' => $preventivo->getIdPreventivo(),   
                    ':targa' => $preventivo->getTarga(),
                    ':idU' => $preventivo->getIdUtente(),  
                    ':servizio' => $preventivo->getServizio(),   
                    ':descrizione' => $preventivo->getDescrizione(),
                    ':costo' => $preventivo->getCosto(),
                    ':stato' => $preventivo->getStato(),   
                    ':pdf' => $preventivo->getPdf(),
                    ':data_richiesta' => $preventivo->getDataRichiesta(),
                ]);
            } catch (PDOException $e) {
                error_log("Errore nell'update del preventivo: " . $e->getMessage());
                return false;
            }
        }

        public function delete($field, $value, $pdo) {
            try {
                $query = "DELETE FROM preventivi WHERE :field = :value";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':field' => $field,
                    ':value' => $value
                ]);
            } catch (PDOException $e) {
                error_log("Errore nella cancellazione del preventivo: " . $e->getMessage());
                return false;
            }
        }


    public function search($field, $value, $pdo) {
            try {
                $query = "SELECT * FROM preventivi WHERE :field = :value";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':field' => $field,
                    ':value' => $value
                ]);
                return $stmt->fetchAll();
            } catch (PDOException $e) {
                error_log("Errore nella ricerca del preventivo: " . $e->getMessage());
                return false;
            }
        }
}