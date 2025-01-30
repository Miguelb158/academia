<?php

session_start();

$nome = $_SESSION['nome'];
$tel = $_SESSION['tel'];
$email = $_SESSION['email'];

include 'conexao.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>bem vindo aluno    ,</h1>

    

</body>
</html>