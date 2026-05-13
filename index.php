<?php
// index.php
require_once 'foundation/config.php';
require_once 'foundation/Session.php';

Session::start();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>MechanicOne - Home</title>
</head>
<body>
    <h1>MechanicOne</h1>

    <?php if (Session::get('idU')): ?>
        <p>Benvenuto in officina, <strong><?php echo htmlspecialchars(Session::get('nome')); ?></strong>!</p>
        <p>Il tuo ruolo registrato è: <?php echo htmlspecialchars(Session::get('ruolo')); ?></p>
        
    <?php else: ?>
        <p>Benvenuto! Accedi o registrati per gestire i tuoi veicoli.</p>
        <ul>
            <li><a href="presentation/login.php">Accedi</a></li>
            <li><a href="presentation/registrazione.php">Registrati</a></li>
        </ul>
    <?php endif; ?>

    <hr>
</body>
</html>