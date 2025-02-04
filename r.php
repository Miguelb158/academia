<?php
// Conexão com o banco de dados via PDO
$pdo = new PDO("mysql:host=localhost;dbname=db_academia", "root", "", [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

/* ============
   PROCESSAMENTO
   ============ */

// --- Atualização de Aluno ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aluno_cod'])) {
  $stmt = $pdo->prepare("UPDATE aluno 
                         SET aluno_nome = :nome, 
                             aluno_cpf = :cpf, 
                             aluno_endereco = :endereco, 
                             aluno_telefone = :telefone 
                         WHERE aluno_cod = :cod");
  $stmt->bindParam(':nome', $_POST['aluno_nome'], PDO::PARAM_STR);
  $stmt->bindParam(':cpf', $_POST['aluno_cpf'], PDO::PARAM_STR);
  $stmt->bindParam(':endereco', $_POST['aluno_endereco'], PDO::PARAM_STR);
  $stmt->bindParam(':telefone', $_POST['aluno_telefone'], PDO::PARAM_STR);
  $stmt->bindParam(':cod', $_POST['aluno_cod'], PDO::PARAM_INT);
  $stmt->execute();
  
  // Redireciona mantendo o parâmetro para exibir o SweetAlert de sucesso
  header("Location: " . $_SERVER['PHP_SELF'] . "?edit_aluno=" . $_POST['aluno_cod'] . "&success=1");
  exit;
}

// --- Atualização de Instrutor ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['instrutor_cod'])) {
  $stmt = $pdo->prepare("UPDATE instrutor 
                         SET instrutor_nome = :nome, 
                             instrutor_especialidade = :especialidade 
                         WHERE instrutor_cod = :cod");
  $stmt->bindParam(':nome', $_POST['instrutor_nome'], PDO::PARAM_STR);
  $stmt->bindParam(':especialidade', $_POST['instrutor_especialidade'], PDO::PARAM_STR);
  $stmt->bindParam(':cod', $_POST['instrutor_cod'], PDO::PARAM_INT);
  $stmt->execute();
  
  header("Location: " . $_SERVER['PHP_SELF'] . "?edit_instrutor=" . $_POST['instrutor_cod'] . "&success=1");
  exit;
}

// --- Exclusão de Instrutor ---
if (isset($_GET['delete_instrutor'])) {
  $deleteId = $_GET['delete_instrutor'];
  $stmt = $pdo->prepare("DELETE FROM instrutor WHERE instrutor_cod = :cod");
  $stmt->bindParam(':cod', $deleteId, PDO::PARAM_INT);
  $stmt->execute();
  
  header("Location: " . $_SERVER['PHP_SELF'] . "?deleted=1");
  exit;
}

// --- Dummy Data para Alunos (se houver menos de 8 registros) ---
$stmt = $pdo->query("SELECT * FROM aluno");
$alunos = $stmt->fetchAll();
if (count($alunos) < 8) {
  $dummyData = [
    ['aluno_nome' => 'João da Silva',   'aluno_cpf' => '11122233344', 'aluno_endereco' => 'Rua A, 123', 'aluno_telefone' => '1234-5678'],
    ['aluno_nome' => 'Maria Oliveira',   'aluno_cpf' => '22233344455', 'aluno_endereco' => 'Rua B, 456', 'aluno_telefone' => '2345-6789'],
    ['aluno_nome' => 'Pedro Santos',     'aluno_cpf' => '33344455566', 'aluno_endereco' => 'Rua C, 789', 'aluno_telefone' => '3456-7890'],
    ['aluno_nome' => 'Ana Costa',        'aluno_cpf' => '44455566677', 'aluno_endereco' => 'Rua D, 101', 'aluno_telefone' => '4567-8901'],
    ['aluno_nome' => 'Carlos Lima',      'aluno_cpf' => '55566677788', 'aluno_endereco' => 'Rua E, 202', 'aluno_telefone' => '5678-9012'],
    ['aluno_nome' => 'Fernanda Rocha',   'aluno_cpf' => '66677788899', 'aluno_endereco' => 'Rua F, 303', 'aluno_telefone' => '6789-0123'],
    ['aluno_nome' => 'Rafael Souza',     'aluno_cpf' => '77788899900', 'aluno_endereco' => 'Rua G, 404', 'aluno_telefone' => '7890-1234'],
    ['aluno_nome' => 'Juliana Martins',  'aluno_cpf' => '88899900011', 'aluno_endereco' => 'Rua H, 505', 'aluno_telefone' => '8901-2345']
  ];
  foreach ($dummyData as $data) {
    $stmt = $pdo->prepare("INSERT INTO aluno (aluno_nome, aluno_cpf, aluno_endereco, aluno_telefone) 
                            VALUES (:nome, :cpf, :endereco, :telefone)");
    $stmt->bindParam(':nome', $data['aluno_nome'], PDO::PARAM_STR);
    $stmt->bindParam(':cpf', $data['aluno_cpf'], PDO::PARAM_STR);
    $stmt->bindParam(':endereco', $data['aluno_endereco'], PDO::PARAM_STR);
    $stmt->bindParam(':telefone', $data['aluno_telefone'], PDO::PARAM_STR);
    $stmt->execute();
  }
  $alunos = $pdo->query("SELECT * FROM aluno")->fetchAll();
}

// --- Dummy Data para Instrutores (se houver menos de 8 registros) ---
$instrutores = $pdo->query("SELECT * FROM instrutor")->fetchAll();
if (count($instrutores) < 8) {
  $dummyInstrutores = [
    ['instrutor_nome' => 'Luís', 'instrutor_especialidade' => 'Musculção'],
    ['instrutor_nome' => 'Wesley', 'instrutor_especialidade' => 'Aeróbico'],
    ['instrutor_nome' => 'Joana', 'instrutor_especialidade' => 'Crossfit'],
    ['instrutor_nome' => 'Kellen', 'instrutor_especialidade' => 'Musculção'],
    ['instrutor_nome' => 'Lucia', 'instrutor_especialidade' => 'yoga'],
    ['instrutor_nome' => 'Gabriel', 'instrutor_especialidade' => 'Crossfit'],
    ['instrutor_nome' => 'Fernanda', 'instrutor_especialidade' => 'Aeróbico'],
    ['instrutor_nome' => 'Jamile', 'instrutor_especialidade' => 'yoga']
  ];
  foreach ($dummyInstrutores as $data) {
    $stmt = $pdo->prepare("INSERT INTO instrutor (instrutor_nome, instrutor_especialidade) 
                            VALUES (:nome, :especialidade)");
    $stmt->bindParam(':nome', $data['instrutor_nome'], PDO::PARAM_STR);
    $stmt->bindParam(':especialidade', $data['instrutor_especialidade'], PDO::PARAM_STR);
    $stmt->execute();
  }
  $instrutores = $pdo->query("SELECT * FROM instrutor")->fetchAll();
}

// --- Verifica se há pedido de edição para aluno ou instrutor ---
$editAluno = null;
if (isset($_GET['edit_aluno'])) {
  $stmt = $pdo->prepare("SELECT * FROM aluno WHERE aluno_cod = :cod");
  $stmt->bindParam(':cod', $_GET['edit_aluno'], PDO::PARAM_INT);
  $stmt->execute();
  $editAluno = $stmt->fetch();
}

$editInstrutor = null;
if (isset($_GET['edit_instrutor'])) {
  $stmt = $pdo->prepare("SELECT * FROM instrutor WHERE instrutor_cod = :cod");
  $stmt->bindParam(':cod', $_GET['edit_instrutor'], PDO::PARAM_INT);
  $stmt->execute();
  $editInstrutor = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciamento de Alunos e Instrutores</title>
  <!-- Ícones, CSS externos e SweetAlert2 -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />

  <!-- <link rel="stylesheet" href="./css/styles.css"> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- CSS interno para os formulários de edição -->
  <style>
    .edit-container {
      max-width: 500px;
      margin: 20px auto;
      padding: 20px;
      background-color: #f9f9f9; 
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .edit-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .edit-container form {
      display: flex;
      flex-direction: column;
    }
    .edit-container form label {
      margin: 10px 0 5px;
    }
    .edit-container form input {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .edit-container form button {
      margin-top: 20px;
      padding: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .edit-container form button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <!-- MENU DE NAVEGAÇÃO -->
  <header>
  <nav class="navbar">
    <div class="nav-left">
      <ul class="nav-links">
        <li><a href="#">Página 1</a></li>
        <li><a href="#">Página 2</a></li>
        <li><a href="#">Página 3</a></li>
      </ul>
      <button class="menu-toggle">
        <i class="ri-menu-line"></i>
      </button>
    </div>
    <div class="nav-right">
      <img src="./img/logo.png" alt="Logo" class="logo">
    </div>
  </nav>
</header>

  <!-- TABELA DE ALUNOS -->
  <h1>Alunos Cadastrados</h1>
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
          <a href="<?= $_SERVER['PHP_SELF'] ?>?edit_aluno=<?= $aluno['aluno_cod'] ?>">Editar</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  <!-- Formulário de edição de aluno (se solicitado) -->
  <?php if ($editAluno): ?>
    <div class="edit-container">
      <h2>Editar Aluno</h2>
      <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
        <input type="hidden" name="aluno_cod" value="<?= $editAluno['aluno_cod'] ?>">
        <label>Nome:</label>
        <input type="text" name="aluno_nome" value="<?= htmlspecialchars($editAluno['aluno_nome']) ?>" required>
        <label>CPF:</label>
        <input type="text" name="aluno_cpf" value="<?= htmlspecialchars($editAluno['aluno_cpf']) ?>" required>
        <label>Endereço:</label>
        <input type="text" name="aluno_endereco" value="<?= htmlspecialchars($editAluno['aluno_endereco']) ?>" required>
        <label>Telefone:</label>
        <input type="text" name="aluno_telefone" value="<?= htmlspecialchars($editAluno['aluno_telefone']) ?>" required>
        <button type="submit">Atualizar</button>
      </form>
    </div>
  <?php endif; ?>

  <!-- TABELA DE INSTRUTORES -->
  <h1>Instrutores Cadastrados</h1>
  <table border="1">
    <tr>
      <th>Nome</th>
      <th>Especialidade</th>
      <th>Ações</th>
    </tr>
    <?php foreach ($instrutores as $instrutor): ?>
      <tr>
        <td><?= htmlspecialchars($instrutor['instrutor_nome']) ?></td>
        <td><?= htmlspecialchars($instrutor['instrutor_especialidade']) ?></td>
        <td>
          <a href="<?= $_SERVER['PHP_SELF'] ?>?edit_instrutor=<?= $instrutor['instrutor_cod'] ?>">Editar</a>
          <a href="<?= $_SERVER['PHP_SELF'] ?>?delete_instrutor=<?= $instrutor['instrutor_cod'] ?>" onclick="return confirm('Tem certeza que deseja excluir este instrutor?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  <!-- Formulário de edição de instrutor (se solicitado) -->
  <?php if ($editInstrutor): ?>
    <div class="edit-container">
      <h2>Editar Instrutor</h2>
      <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
        <input type="hidden" name="instrutor_cod" value="<?= $editInstrutor['instrutor_cod'] ?>">
        <label>Nome:</label>
        <input type="text" name="instrutor_nome" value="<?= htmlspecialchars($editInstrutor['instrutor_nome']) ?>" required>
        <label>Especialidade:</label>
        <input type="text" name="instrutor_especialidade" value="<?= htmlspecialchars($editInstrutor['instrutor_especialidade']) ?>" required>
        <button type="submit">Atualizar</button>
      </form>
    </div>
  <?php endif; ?>

  <!-- SweetAlert para feedback -->
  <?php if (isset($_GET['success'])): ?>
    <script>
      Swal.fire({
        title: "Editado com sucesso!",
        icon: "success",
        draggable: true
      });
    </script>
  <?php endif; ?>

  <?php if (isset($_GET['deleted'])): ?>
    <script>
      Swal.fire({
        title: "Instrutor excluído com sucesso!",
        icon: "success",
        draggable: true
      });
    </script>
  <?php endif; ?>
  <script>
  const menuToggle = document.querySelector(".menu-toggle");
  const navLinks = document.querySelector(".nav-links");

  menuToggle.addEventListener("click", () => {
    navLinks.classList.toggle("active");
  });
</script>

  <script src="./js/script.js"></script>
</body>
</html>
