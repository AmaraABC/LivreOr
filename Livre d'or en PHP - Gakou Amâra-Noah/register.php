<?php
session_start();
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $mot_de_passe = trim($_POST['mot_de_passe']);

    if (!empty($username) && !empty($mot_de_passe)) {
        $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO users (username, mot_de_passe) VALUES (?, ?)");
        if ($stmt->execute([$username, $hashedPassword])) {
            $_SESSION['username'] = $username;
            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Messages délivrés par plusieurs personnes">
    <link rel="stylesheet" href="style.css">
    <title>Livre d'Or avec PHP - Gakou Amâra-Noah</title>
</head>

<body>
    <form method="post" class="log-form">
        <h1>GOLDEN BOOK</h1>
        <br>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <br>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        <br>
        <button type="submit">S'inscrire</button>
    </form>
</body>


