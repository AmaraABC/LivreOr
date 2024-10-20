<?php
include 'Model/database.php';
include 'Controller/functions.php';

if (!isset($_SESSION['id_usermsg'])) {
    redirection('View/login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = trim($_POST['message']);
    if (!empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (id_usermsg, contenu) VALUES (?, ?)");
        $stmt->execute([$_SESSION['id_usermsg'], $message]);
    }
}

$messages = $pdo->query("SELECT messages.*, users.username FROM messages JOIN users ON messages.id_usermsg = users.id_user ORDER BY creation DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr-FR" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'Or avec PHP - Gakou Amâra-Noah</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="View/style.css">
</head>

<body>
    <h1>Bienvenue,
        <?= htmlspecialchars($_SESSION['username']) ?>
    </h1>

    <form method="POST">
        <textarea name="message" placeholder="Écrivez votre message.." required></textarea>
        <br>
        <button type="submit">Envoyer</button>
    </form>

    <h2>Messages :</h2>
    <?php foreach ($messages as $msg): ?>
    <p><strong>
            <?= htmlspecialchars($msg['username']) ?> :
        </strong>
        <?= htmlspecialchars($msg['contenu']) ?> <em>(
            <?= $msg['creation'] ?>)
        </em>
    </p>
    <?php endforeach; ?>

    <a href="View/logout.php">Se déconnecter</a>
</body>

</html>
