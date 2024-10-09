<?php
// Charger les messages
$messages = [];
if (file_exists('messages.json')) {
    $messages = json_decode(file_get_contents('messages.json'), true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auteur = htmlspecialchars($_POST['lastname']);
    $message = htmlspecialchars($_POST['message']);
    
    // Ajouter le nouveau message
    $messages[] = ['lastname' => $auteur, 'message' => $message];
    file_put_contents('messages.json', json_encode($messages));
    header("Location: index.php"); // Rediriger après soumission
    exit();
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
    <h1>Livre d'Or :</h1>
    <form method="post">
        <label for="lastname" hidden>Nom</label>
        <input type="text" name="lastname" placeholder="Votre nom" required maxlength="50">
        <br>
        <textarea name="message" placeholder="Placez votre message ici.." required maxlength="200"></textarea>
        <br>
        <button type="submit">Soumettre</button>
    </form>

    <h2>Messages</h2>
    <div class="messages">
        <?php foreach ($messages as $msg): ?>
            <div class="message">
                <strong><?php echo $msg['lastname']; ?></strong>: <p><?php echo $msg['message']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
