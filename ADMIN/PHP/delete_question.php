<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// ID à supprimer
$id_to_delete = 'your_id';

// Exécuter la requête SQL
$sql = "DELETE FROM cards WHERE id=$id_to_delete";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
