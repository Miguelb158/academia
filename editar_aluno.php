<?php
include 'conexao.php';
include 'instrutor_academia.php';

$row = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome= $_POST ['nome'];
    $cpf= $_POST ['cpf'];
    $endereco= $_POST ['endereco'];
    $telefone= $_POST ['telefone'];

    if ($row > 0) {
        $sql = "UPDATE aluno SET instrutor_nome='$nome', aluno_cpf = $cpf , aluno_endereco = '$endereco', aluno_telefone = $telefone WHERE instrutor_cod = $row";

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

            <label for="especialidade">cpf:</label>
            <input type="int" id="cpf" name="cpf" required>

            <label for="endereco">endereco:</label>
            <input type="text" id="endereco" name="endereco" required>

            <label for="telefone">telefone:</label>
            <input type="text" id="telefone" name="telefone" required>

            <button type="submit" id="content">editar</button>
        </form>
    
</body>
</html>

aluno_nome
aluno_cpf
aluno_endereco
aluno_telefone