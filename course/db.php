<?php
$servername = "localhost";
$username = "root"; 
$password = "root";
$dbname = "dandyou"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем подключение на наличие ошибок
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
?>
