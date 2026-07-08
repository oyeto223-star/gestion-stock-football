<?php
// Configuration de la base de données

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_stock_football";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
