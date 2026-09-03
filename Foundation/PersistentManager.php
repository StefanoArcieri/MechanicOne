<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/FUtente.php';
require_once __DIR__ . '/FMeccanico.php';
require_once __DIR__ . '/FVeicolo.php';
require_once __DIR__ . '/FServizio.php';
require_once __DIR__ . '/FPreventivo.php';
require_once __DIR__ . '/FPrenotazione.php';
require_once __DIR__ . '/FRecensione.php';

// Il nostro mini-ORM: niente Doctrine, lo facciamo a mano apposta per capire cosa fa
// davvero un ORM sotto al cofano. PersistentManager è la facciata unica (singleton) che
// i controller usano; smista poi la richiesta alla classe F<Entità> giusta, che è quella
// che parla davvero con PDO. Se un domani si volesse cambiare DB/driver, si tocca solo qui dentro.
class PersistentManager {

    private static $instance = null;
    
    private $pdo;

    private function __construct() {
        global $pdo; 
        $this->pdo = $pdo;
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new PersistentManager();
        }
        return self::$instance;
    }

    private function getFoundationClass($entityName) {
        switch ($entityName) {
            case 'EUtente':       return new FUtente();
            case 'EMeccanico':    return new FMeccanico();
            case 'EVeicolo':      return new FVeicolo();
            case 'EServizio':     return new FServizio();
            case 'EPreventivo':   return new FPreventivo();
            case 'EPrenotazione': return new FPrenotazione();
            case 'ERecensione':   return new FRecensione();
            default: 
                throw new Exception("Errore Architetturale: Entità '$entityName' non riconosciuta dal Persistent Manager.");
        }
    }

    public function store($obj) {
        $entityName = get_class($obj);
        $fClass = $this->getFoundationClass($entityName);
        return $fClass->store($obj, $this->pdo);
    }

    public function update($obj) {
        $entityName = get_class($obj);
        $fClass = $this->getFoundationClass($entityName);
        return $fClass->update($obj, $this->pdo);
    }

    public function load($entityName, $field, $value) {
        $fClass = $this->getFoundationClass($entityName);
        return $fClass->load($field, $value, $this->pdo);
    }

    public function search($entityName, $field, $value) {
        $fClass = $this->getFoundationClass($entityName);
        return $fClass->search($field, $value, $this->pdo);
    }

    public function getAll($entityName) {
        $fClass = $this->getFoundationClass($entityName);
        return $fClass->getAll($this->pdo);
    }

    public function delete($entityName, $field, $value) {
        $fClass = $this->getFoundationClass($entityName);
        return $fClass->delete($field, $value, $this->pdo);
    }

    public function verificaLogin($email, $password) {
        $fUtente = new FUtente();
        return $fUtente->verificaLogin($email, $password, $this->pdo);
    }

    // Transazioni: servono solo dove un controller fa più store()/update() che DEVONO andare
    // a buon fine insieme (es. registrazione di un meccanico: riga in utenti + riga in meccanici).
    // Per una singola store/update non serve: una query PDO è già atomica di suo.
    public function beginTransaction() {
        $this->pdo->beginTransaction();
    }

    public function commit() {
        $this->pdo->commit();
    }

    public function rollback() {
        if ($this->pdo->inTransaction()) {
            $this->pdo->rollBack();
        }
    }
}
?>