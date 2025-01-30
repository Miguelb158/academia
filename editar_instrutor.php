<?php
include 'conexao.php';
include 'instrutor_academia.php';

$row = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $especialidade =$_POST['especialidade'];

    if ($row > 0) {
        $sql = "UPDATE instrutor SET instrutor_nome='$nome', instrutor_especialidade='$especialidade' WHERE instrutor_cod = $row";

        if (mysqli_query($conn, $sql)) {
            echo "Atualização realizada com sucesso!";
        } else {
            echo "Erro ao atualizar: " . mysqli_error($conn);
        }
    } else {
        echo "Erro: Código do instrutor inválido.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>alterar</h3>
        <form method="POST" action="">
        
        <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="especialidade">especialidade:</label>
            <input type="text" id="especialidade" name="especialidade" required>

            <button type="submit" id="content">editar</button>
        </form>
    
</body>
</html>