<?php
include 'conexao.php';
include 'aulas_academia.php';

$row = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data= $_POST ['data'];


    if ($row > 0) {
        $sql = "UPDATE aula SET aula_data='$data' WHERE aula_cod = $row";

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

            <label for="data"> Nova data:</label>
            <input  type="date" id="data" name="data" required>

            <button type="submit" id="content">editar</button>
        </form>
    
</body>
</html>