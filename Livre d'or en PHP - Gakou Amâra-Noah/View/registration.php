<?php
include '../Model/database.php';
include '../Controller/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['secret-password']);
    
    if (!empty($username) && !empty($password)) {
        $hashedPassword = chiffrerMdp($password);
        $stmt = $pdo->prepare("INSERT INTO users(username, mot_de_passe) VALUES (?, ?)");
        if ($stmt->execute([$username, $hashedPassword])) {
            redirection('login.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr-FR" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'Or avec PHP - Gakou Amâra-Noah</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST" class="log-form">
        <input type="text" name="username" placeholder="Nom d'utilisateur.." maxlength="50" required>
        <br>
        <input type="password" name="secret-password" placeholder="Mot de passe.." required>
        <br>
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
