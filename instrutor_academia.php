<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$pdo = new PDO("mysql:host=localhost;dbname=db_academia", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aluno_cod'])) {
    $stmt = $pdo->prepare("UPDATE aluno SET aluno_nome = ?, aluno_endereco = ?, aluno_telefone = ? WHERE aluno_cod = ?");
    $stmt->execute([$_POST['aluno_nome'], $_POST['aluno_endereco'], $_POST['aluno_telefone'], $_POST['aluno_cod']]);
}
=======
<?php
include 'conexao.php';  
$conn = new mysqli("localhost", "root", "", "db_academia");
$sql = "SELECT * FROM instrutor";
$_instrutor = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Alunos</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>

<h1>Alunos Cadastrados</h1>

<table border="1">
    <tr>
        <th>Nome</th>
        <th>CPF</th>
        <th>Telefone</th>
        <th>Ações</th>
    </tr>

    <?php
   
    if ($_result->num_rows > 0) {
        while ($row = $_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['aluno_nome'] . "</td>";
            echo "<td>" . $row['aluno_cpf'] . "</td>";
            echo "<td>" . $row['aluno_telefone'] . "</td>";
            echo "<td>
                    <a href='editar_aluno.php?id=" . $row['aluno_cod'] . "'>Editar</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhum aluno cadastrado.</td></tr>";
    }
    ?>
</table>



<h1>instrutores</h1>

<table border="1">
    <tr>
        <th>nome</th>
        <th>Cespecialidade</th>

    </tr>

    <?php
   
    if ($_instrutor ->num_rows > 0) {
        while ($row = $_instrutor ->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['aluno_nome'] . "</td>";
            echo "<td>" . $row['aluno_cpf'] . "</td>";
            echo "<td>" . $row['aluno_telefone'] . "</td>";
            echo "<td>
                    <a href='editar_aluno.php?id=" . $row['aluno_cod'] . "'>Editar</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhum aluno cadastrado.</td></tr>";
    }
    ?>
</table>


>>>>>>> 981c54ac93321f14f0246f4a1b77d856f68d382b
</body>
</html>