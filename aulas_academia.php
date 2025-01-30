<?php

$pdo = new PDO("mysql:host=localhost;dbname=db_academia", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM aula WHERE aula_cod = ?");
    $stmt->execute([$_GET['delete']]);
}

// Atualizar aula
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aula_cod'])) {
    $stmt = $pdo->prepare("UPDATE aula SET aula_tipo = ?, aula_data = ?, fk_instrutor_cod = ?, fk_aluno_cod = ? WHERE aula_cod = ?");
    $stmt->execute([$_POST['aula_tipo'], $_POST['aula_data'], $_POST['fk_instrutor_cod'], $_POST['fk_aluno_cod'], $_POST['aula_cod']]);
}


$aulas = $pdo->query("SELECT aula.aula_cod, aula.aula_tipo, aula.aula_data, instrutor.instrutor_nome, aluno.aluno_nome 
                      FROM aula 
                      JOIN instrutor ON aula.fk_instrutor_cod = instrutor.instrutor_cod 
                      JOIN aluno ON aula.fk_aluno_cod = aluno.aluno_cod")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Aulas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Lista de Aulas</h2>
    <table border="1">
        <tr>
            <th>Tipo de Aula</th>
            <th>Data</th>
            <th>Instrutor</th>
            <th>Aluno</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($aulas as $aula): ?>
            <tr>
                <td><?= htmlspecialchars($aula['aula_tipo']) ?></td>
                <td><?= htmlspecialchars($aula['aula_data']) ?></td>
                <td><?= htmlspecialchars($aula['instrutor_nome']) ?></td>
                <td><?= htmlspecialchars($aula['aluno_nome']) ?></td>
                <td>
                    <a href="aula.php?edit=<?= $aula['aula_cod'] ?>">Editar</a>
                    <a href="aula.php?delete=<?= $aula['aula_cod'] ?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if (isset($_GET['edit'])): 
        $stmt = $pdo->prepare("SELECT * FROM aula WHERE aula_cod = ?");
        $stmt->execute([$_GET['edit']]);
        $aula = $stmt->fetch();
    ?>
    <h2>Editar Aula</h2>
    <form method="POST" action="aula.php">
        <input type="hidden" name="aula_cod" value="<?= $aula['aula_cod'] ?>">
        <label>Tipo de Aula:</label>
        <input type="text" name="aula_tipo" value="<?= htmlspecialchars($aula['aula_tipo']) ?>" required>
        <label>Data:</label>
        <input type="date" name="aula_data" value="<?= htmlspecialchars($aula['aula_data']) ?>" required>
        <label>ID Instrutor:</label>
        <input type="number" name="fk_instrutor_cod" value="<?= htmlspecialchars($aula['fk_instrutor_cod']) ?>" required>
        <label>ID Aluno:</label>
        <input type="number" name="fk_aluno_cod" value="<?= htmlspecialchars($aula['fk_aluno_cod']) ?>" required>
        <button type="submit">Atualizar</button>
    </form>
    <?php endif; ?>
</body>
</html>
