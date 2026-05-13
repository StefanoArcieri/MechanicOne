<?php
// presentation/registrazione.php
require_once '../control/CUtente.php';

$errore = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registra'])) {
    try {
        // Passiamo i dati al Controller per la registrazione e l'auto-login
        CUtente::registrazione(
            $_POST['nome'], 
            $_POST['cognome'], 
            $_POST['email'], 
            $_POST['password']
        );
    } catch (Exception $e) {
        $errore = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione - MechanicOne</title>
</head>
<body>
    <h2>Registrati su MechanicOne</h2>

    <?php if ($errore): ?>
        <p style="color: red;">❌ <?php echo htmlspecialchars($errore); ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Cognome:</label><br>
        <input type="text" name="cognome" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit" name="registra">Crea il mio Account</button>
    </form>

    <p><a href="../index.php">Torna alla Home</a></p>
</body>
</html>