<?php
// presentation/login.php
require_once '../control/CUtente.php';

$errore = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    try {
        // Chiamata al metodo statico del Controller
        CUtente::login($_POST['email'], $_POST['password']);
    } catch (Exception $e) {
        // Catturiamo l'allarme lanciato dal Controller
        $errore = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login - MechanicOne</title>
</head>
<body>
    <h2>Accesso Utente</h2>

    <?php if ($errore): ?>
        <p style="color: red;">❌ <?php echo htmlspecialchars($errore); ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit" name="login">Entra in Officina</button>
    </form>

    <p><a href="../index.php">Torna alla Home</a></p>
</body>
</html>