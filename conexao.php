<?php
$servername = "localhost"; 
$username = "root";  
$password = ""; 
$dbname = "db_academia";  

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
