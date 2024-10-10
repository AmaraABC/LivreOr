<?php
session_start();
require 'connect.php';

$error = ''; // Variable pour stocker les messages d'erreur

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $mot_de_passe = trim($_POST['mot_de_passe']);

    // Validation basique des entrées
    if (!empty($username) && !empty($mot_de_passe)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
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

<!-- Formulaire de connexion -->
<form method="post" class="log-form">
    <h1>GOLDEN BOOK</h1>
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <br>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
    <br>
    <button type="submit">Se connecter</button>
</form>

<!-- Affichage des messages d'erreur -->
<?php if (!empty($error)): ?>
    <div style="color: red;"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
