<?php

$host    = 'localhost';
$db      = 'mechanicone';
$user    = 'root';
$pass    = ''; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";


$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //trasforma l'errore in eccezione
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //array associativo, field=>value
    PDO::ATTR_EMULATE_PREPARES   => false //prepared statement
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options); //connessione al database
} catch (PDOException $e) {
    error_log("Errore con la connessione al database: " . $e->getMessage());
}

require_once __DIR__ . '/PersistentManager.php';
require_once __DIR__ . '/Session.php';

$persistentManager = new PersistentManager($pdo);