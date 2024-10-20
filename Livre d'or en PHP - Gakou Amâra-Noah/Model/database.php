<?php
    $database = 'pgsql:host=localhost;port=5432;dbname=GoldenBook;';
    $user = 'postgres';
    $password = 'epiphany212RA_';

    try {
        $pdo = new PDO($database, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    
    catch (PDOException $e) {
        echo 'Échec de la connexion : ' . $e->getMessage();
    }
?>