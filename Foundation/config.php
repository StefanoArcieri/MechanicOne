<?php

$host    = 'localhost';
$db      = 'mechanicone';
$user    = 'root';
$pass    = ''; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";


$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false, // prepared statement veri, non simulati da PHP: query parametrizzate reali
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    error_log($e->getMessage());
    throw new Exception("Sito momentaneamente non disponibile. Riprova più tardi.");
}

?>