<?php
$host = "localhost";
$dbname = "qna";
$port = 3306;
$username = "root";
$password = "";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
);
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;port=$port;charset=utf8", $username, $password, $options);
} catch (PDOException $e) {
    die("Chyba pripojenia: " . $e->getMessage());
}
?>