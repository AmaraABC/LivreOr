<?php
require 'connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = trim($_POST['msg']);
    if (!empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (id_user, msg_txt) VALUES (?, ?)");
        $stmt->execute([$_SESSION['id_user'], $message]);
    }
}

$stmt = $pdo->query("SELECT messages.id_user, messages.msg_txt, messages.creation, users.username FROM messages JOIN users ON messages.id_user = users.id_user ORDER BY messages.creation DESC");
$messages = $stmt->fetchAll();
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
    <h1>Salut !, <?php echo $_SESSION['username']; ?></h1>
    <form method="post" class="og-form">
        <textarea name="msg" placeholder="Laissez un message..." required></textarea>
        <br>
        <button type="submit">Soumettre</button>
    </form>

    <h2>Messages</h2>
    <div class="messages">
        <?php foreach ($messages as $msgs): ?>
            <div class="message-div">
                <strong><?php echo htmlspecialchars($msgs['username']); ?></strong>: 
                <?php echo htmlspecialchars($msgs['msg']); ?> 
                <em><?php echo $msgs['creation']; ?></em>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="logout.php">Se déconnecter</a>
</body>
</html>
