<?php
include 'conexao.php';  
$conn = new mysqli("localhost", "root", "", "db_academia");
$sql = "SELECT * FROM aluno";
$result = $conn->query($sql);
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
   
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
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

</body>
</html>
