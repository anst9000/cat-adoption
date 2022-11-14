<?php

$servername = "localhost";
$username = "coltla";
$password = "jSjDyE[t8jLABDel";
$database = "kattadoption";

// connect to the database using PDO
$dsn = "mysql:host=$servername;dbname=$database;charset=UTF8";

try {
  $pdo = new PDO($dsn, $username, $password);

  if ($pdo) {
    // echo "Connected to the $database database successfully!";
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}
