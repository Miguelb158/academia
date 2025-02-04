<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_academia";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


if (isset($_GET['delete'])) {
    $aula_cod = intval($_GET['delete']);
    
    $stmt = $conn->prepare("DELETE FROM aula WHERE aula_cod = ?");
    $stmt->bind_param("i", $aula_cod);
    $stmt->execute();
    $stmt->close();
    

}


if (isset($_POST['update'])) {
    $aula_cod = intval($_POST['aula_cod']);
    $aula_tipo = $_POST['aula_tipo'];
    $aula_data = $_POST['aula_data'];
    $fk_instrutor_cod = intval($_POST['fk_instrutor_cod']);
    $fk_aluno_cod = intval($_POST['fk_aluno_cod']);

    $stmt = $conn->prepare("UPDATE aula SET aula_tipo=?, aula_data=?, fk_instrutor_cod=?, fk_aluno_cod=? WHERE aula_cod=?");
    $stmt->bind_param("ssiii", $aula_tipo, $aula_data, $fk_instrutor_cod, $fk_aluno_cod, $aula_cod);
    $stmt->execute();
    $stmt->close();

   
}

if (isset($_POST['add'])) {
    $aula_tipo = $_POST['aula_tipo'];
    $aula_data = $_POST['aula_data'];
    $fk_instrutor_cod = intval($_POST['fk_instrutor_cod']);
    $fk_aluno_cod = intval($_POST['fk_aluno_cod']);

    $stmt = $conn->prepare("INSERT INTO aula (aula_tipo, aula_data, fk_instrutor_cod, fk_aluno_cod) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $aula_tipo, $aula_data, $fk_instrutor_cod, $fk_aluno_cod);
    $stmt->execute();
    $stmt->close();


}

// 🔎 SELECIONAR todas as aulas
$stmt = $conn->prepare("SELECT a.aula_cod, a.aula_tipo, a.aula_data, i.instrutor_nome, al.aluno_nome FROM aula a JOIN instrutor i ON a.fk_instrutor_cod = i.instrutor_cod JOIN aluno al ON a.fk_aluno_cod = al.aluno_cod");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Aulas</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="tab2.css">
    <link rel="stylesheet" href="tabela1.css">
</head>
<body>
    <h2>Aulas Agendadas</h2>
    <table border="1">
        <tr>
            <th>Tipo</th>
            <th>Data</th>
            <th>Instrutor</th>
            <th>Aluno</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['aula_tipo']) ?></td>
            <td><?= htmlspecialchars($row['aula_data']) ?></td>
            <td><?= htmlspecialchars($row['instrutor_nome']) ?></td>
            <td><?= htmlspecialchars($row['aluno_nome']) ?></td>
            <td>
                <a href="editar_alulas.php?id=<?= $row['aula_cod'] ?>">Editar</a> 
                <a href="aulas_academia.php?delete=<?= $row['aula_cod'] ?>" onclick="return confirm('Tem certeza?');">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Agendar Nova Aula</h2>
    <form method="post">
        <label>Tipo de Aula: <input type="text" name="aula_tipo" required></label><br>
        <label>Data: <input type="date" name="aula_data" required></label><br>
        <label>ID Instrutor: <input type="number" name="fk_instrutor_cod" required></label><br>
        <label>ID Aluno: <input type="number" name="fk_aluno_cod" required></label><br>
        <button type="submit" name="add">Agendar</button>
    </form>
</body>
</html>