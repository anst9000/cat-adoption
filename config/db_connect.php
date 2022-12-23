<?php

$servername = "localhost";
$username = "coltla";
$password = "g!sV3sil9PReCDB1";
$database = "kattadoption";

// connect to the database using PDO
$conn = "mysql:host=$servername;dbname=$database;charset=UTF8";

try {
  $pdo = new PDO($conn, $username, $password);

  if ($pdo) {
    // echo "Connected to the $database database successfully!";
  }
} catch (PDOException $ex) {
  echo $ex->getMessage();
}
