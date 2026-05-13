<?php

class FPrenotazione {
    public function __construct() {}

    public function load($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM prenotaioni WHERE :field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
                error_log("Errore nel caricamento della prenotazione: " . $e->getMessage());
                return false;
            }
            
    }

    public function store($prenotazione, $pdo) {
        try {
            $query = "INSERT INTO prenotazioni (idU, idP, idM, targa, data, ora, stato) VALUES (:idU, :idP, :idM, :targa, :data, :ora, :stato)";
            $stmt = $pdo->prepare($query);
                return $stmt->execute([

                    ':targa' => $prenotazione->getTarga(),
                    ':idP' => $prenotazione->getIdPreventivo(),
                    ':idM' => $prenotazione->getIdMeccanico(),
                    ':idU' => $prenotazione->getIdUtente(), 
                    ':data' => $prenotazione->getDataPrenotazione(),
                    ':ora' => $prenotazione->getOra(),
                    ':stato' => $prenotazione->getStato(),  
                ]);

        } catch (PDOException $e) {
                error_log("Errore nello store della prenotazione: " . $e->getMessage());
                return false;
            }
    }

    public function update($prenotazione, $pdo) {
            try {
                $query = "UPDATE prenotazioni SET  idU = :idU, idP = :idP, idM = :idM, targa = :targa, data = :data, ora = :ora, stato = :stato WHERE idU = :idU;";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':targa' => $prenotazione->getTarga(),
                    ':idP' => $prenotazione->getIdPreventivo(),
                    ':idM' => $prenotazione->getIdMeccanico(),
                    ':idU' => $prenotazione->getIdUtente(), 
                    ':data' => $prenotazione->getDataPrenotazione(),
                    ':ora' => $prenotazione->getOra(),
                    ':stato' => $prenotazione->getStato(),
                ]);
            } catch (PDOException $e) {
                error_log("Errore nell'update della prenotazione: " . $e->getMessage());
                return false;
            }
        }

        public function delete($field, $value, $pdo) {
            try {
                $query = "DELETE FROM prenotazioni WHERE :field = :value";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':field' => $field,
                    ':value' => $value
                ]);
            } catch (PDOException $e) {
                error_log("Errore nella cancellazione della prenotazione: " . $e->getMessage());
                return false;
            }
        }


    public function search($field, $value, $pdo) {
            try {
                $query = "SELECT * FROM prenotazioni WHERE :field = :value";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':field' => $field,
                    ':value' => $value
                ]);
                return $stmt->fetchAll();
            } catch (PDOException $e) {
                error_log("Errore nella ricerca della prenotazione: " . $e->getMessage());
                return false;
            }
        }


}