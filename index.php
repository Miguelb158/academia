<?php

$pdo = new PDO("mysql:host=localhost;dbname=db_academia", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aluno_cod'])) {
    $stmt = $pdo->prepare("UPDATE aluno SET aluno_nome = ?, aluno_endereco = ?, aluno_telefone = ? WHERE aluno_cod = ?");
    $stmt->execute([$_POST['aluno_nome'], $_POST['aluno_endereco'], $_POST['aluno_telefone'], $_POST['aluno_cod']]);
}

$alunos = $pdo->query("SELECT * FROM aluno")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Alunos</title>
    <link rel="stylesheet" href="./css/nav.css">
</head>
<body>
<header class="header">
      <nav>
        <div class="nav__bar">
          <div class="logo">
            <a href="#">    <img src="./img/trans.png" alt=""></a>
          </div>
          <div class="nav__menu__btn" id="menu-btn">
            <i class="ri-menu-line"></i>
          </div>
        </div>
        <ul class="nav__links" id="nav-links">
          <li><a href="#home">Home</a></li>
          <li><a href="#about">Aluno</a></li>
          <li><a href="#service">Instrutor</a></li>
          <li><a href="#explore">Aulas</a></li>
        
        </ul>
       
      </nav>
      <script src="./js/script.js"></script>
    </header>
    <h2>Lista de Alunos</h2>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Endereço</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($alunos as $aluno): ?>
            <tr>
                <td><?= htmlspecialchars($aluno['aluno_nome']) ?></td>
                <td><?= htmlspecialchars($aluno['aluno_cpf']) ?></td>
                <td><?= htmlspecialchars($aluno['aluno_endereco']) ?></td>
                <td><?= htmlspecialchars($aluno['aluno_telefone']) ?></td>
                <td>
                    <a href="aluno.php?edit=<?= $aluno['aluno_cod'] ?>">Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if (isset($_GET['edit'])): 
        $stmt = $pdo->prepare("SELECT * FROM aluno WHERE aluno_cod = ?");
        $stmt->execute([$_GET['edit']]);
        $aluno = $stmt->fetch();
    ?>
    <h2>Editar Aluno</h2>
    <form method="POST" action="aluno.php">
        <input type="hidden" name="aluno_cod" value="<?= $aluno['aluno_cod'] ?>">
        <label>Nome:</label>
        <input type="text" name="aluno_nome" value="<?= htmlspecialchars($aluno['aluno_nome']) ?>" required>
        <label>Endereço:</label>
        <input type="text" name="aluno_endereco" value="<?= htmlspecialchars($aluno['aluno_endereco']) ?>" required>
        <label>Telefone:</label>
        <input type="text" name="aluno_telefone" value="<?= htmlspecialchars($aluno['aluno_telefone']) ?>" required>
        <button type="submit">Atualizar</button>
    </form>
    <?php endif; ?>
</body>
</html>
