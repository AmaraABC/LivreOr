<?php
include '../Model/database.php';
include '../Controller/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['secret-password']);
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && verifierMdp($password, $user['mot_de_passe'])) {
        $_SESSION['id_usermsg'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        redirection('../index.php');
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
        <input type="text" name="username" placeholder="Nom d'utilisateur" maxlength="50" required>
        <br>
        <input type="password" name="secret-password" placeholder="Mot de passe" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>
</body>

</html>
