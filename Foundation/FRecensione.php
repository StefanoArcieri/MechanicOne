<?php

require_once __DIR__ . '/../Entity/ERecensione.php';

class FRecensione {
    public function __construct() {}

    private function mapRowToEntity($row) {
        if (!$row) return null;
        return new ERecensione($row['idR'], $row['idM'], $row['idU'], $row['valutazione'], $row['commento'], $row['data_recensione']);
    }

    public function load($field, $value, $pdo) {
        try {
            $query = "SELECT * FROM recensioni WHERE $field = :value";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':value' => $value
            ]);
            return $this->mapRowToEntity($stmt->fetch());
        } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nel caricamento della recensione.");
            }

    }

    public function store($recensione, $pdo) {
        try {
            $query = "INSERT INTO recensioni (idM, idU, valutazione, commento, data_recensione) VALUES (:idM, :idU, :valutazione, :commento, :data_recensione)";
            $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':idM' => $recensione->getIdMeccanico(),
                    ':idU' => $recensione->getIdUtente(),
                    ':valutazione' => $recensione->getValutazione(),
                    ':commento' => $recensione->getCommento(),
                    ':data_recensione' => $recensione->getDataRecensione(),
                ]);

        } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nello store della recensione.");
            }
    }

    public function update($recensione, $pdo) {
            try {
                $query = "UPDATE recensioni SET idM = :idM, idU = :idU, valutazione = :valutazione, commento = :commento, data_recensione = :data_recensione WHERE idR = :idR;";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':idR' => $recensione->getIdRecensione(),
                    ':idM' => $recensione->getIdMeccanico(),
                    ':idU' => $recensione->getIdUtente(),
                    ':valutazione' => $recensione->getValutazione(),
                    ':commento' => $recensione->getCommento(),
                    ':data_recensione' => $recensione->getDataRecensione(),
                ]);
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nell'update della recensione.");
            }
        }

    public function delete($field, $value, $pdo) {
            try {
                $query = "DELETE FROM recensioni WHERE $field = :value";
                $stmt = $pdo->prepare($query);
                return $stmt->execute([
                    ':value' => $value
                ]);
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nella cancellazione della recensione.");
            }
        }


    public function search($field, $value, $pdo) {
            try {
                $query = "SELECT * FROM recensioni WHERE $field = :value";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':value' => $value
                ]);
                return array_map([$this, 'mapRowToEntity'], $stmt->fetchAll());
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new Exception("Errore nella ricerca della recensione.");
            }
        }

    public function getAll($pdo) {
        try {

            $query = "SELECT * FROM recensioni";

            $stmt = $pdo->prepare($query);
            $stmt->execute();

            return array_map([$this, 'mapRowToEntity'], $stmt->fetchAll(PDO::FETCH_ASSOC));

        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Errore critico DB nel recupero delle recensioni.");
        }
    }
}
