<?php 

$host = 'localhost';
$db   = 'GoldenBook';
$user = 'postgres';
$pass = 'epiphany212RA_';

try {
    $pdo = new PDO("pgsql:host=$host;port=5432;dbname=$db", $user, $pass);
}
catch(PDOException $e){
	die($e->getMessage());
}
