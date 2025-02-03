<?php
// Conexão com o banco de dados via PDO
$pdo = new PDO("mysql:host=localhost;dbname=db_academia", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// Se o formulário de edição for submetido, atualiza o registro do aluno
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aluno_cod'])) {
    $stmt = $pdo->prepare("
        UPDATE aluno 
        SET aluno_nome = :nome, 
            aluno_cpf = :cpf, 
            aluno_endereco = :endereco, 
            aluno_telefone = :telefone 
        WHERE aluno_cod = :cod
    ");
    $stmt->bindParam(':nome', $_POST['aluno_nome'], PDO::PARAM_STR);
    $stmt->bindParam(':cpf', $_POST['aluno_cpf'], PDO::PARAM_STR);
    $stmt->bindParam(':endereco', $_POST['aluno_endereco'], PDO::PARAM_STR);
    $stmt->bindParam(':telefone', $_POST['aluno_telefone'], PDO::PARAM_STR);
    $stmt->bindParam(':cod', $_POST['aluno_cod'], PDO::PARAM_INT);
    $stmt->execute();

    // Redireciona para a mesma página com os parâmetros 'edit' e 'success'
    header("Location: " . $_SERVER['PHP_SELF'] . "?edit=" . $_POST['aluno_cod'] . "&success=1");
    exit;
}

// Busca todos os registros da tabela aluno
$alunos = $pdo->query("SELECT * FROM aluno")->fetchAll();

// Se houver menos de 8 registros, insere os registros dummy
if (count($alunos) < 8) {
    $dummyData = [
        ['aluno_nome' => 'João da Silva',    'aluno_cpf' => '11122233344', 'aluno_endereco' => 'Rua A, 123', 'aluno_telefone' => '1234-5678'],
        ['aluno_nome' => 'Maria Oliveira',    'aluno_cpf' => '22233344455', 'aluno_endereco' => 'Rua B, 456', 'aluno_telefone' => '2345-6789'],
        ['aluno_nome' => 'Pedro Santos',      'aluno_cpf' => '33344455566', 'aluno_endereco' => 'Rua C, 789', 'aluno_telefone' => '3456-7890'],
        ['aluno_nome' => 'Ana Costa',         'aluno_cpf' => '44455566677', 'aluno_endereco' => 'Rua D, 101', 'aluno_telefone' => '4567-8901'],
        ['aluno_nome' => 'Carlos Lima',       'aluno_cpf' => '55566677788', 'aluno_endereco' => 'Rua E, 202', 'aluno_telefone' => '5678-9012'],
        ['aluno_nome' => 'Fernanda Rocha',    'aluno_cpf' => '66677788899', 'aluno_endereco' => 'Rua F, 303', 'aluno_telefone' => '6789-0123'],
        ['aluno_nome' => 'Rafael Souza',      'aluno_cpf' => '77788899900', 'aluno_endereco' => 'Rua G, 404', 'aluno_telefone' => '7890-1234'],
        ['aluno_nome' => 'Juliana Martins',   'aluno_cpf' => '88899900011', 'aluno_endereco' => 'Rua H, 505', 'aluno_telefone' => '8901-2345']
    ];

    foreach ($dummyData as $data) {
        $stmt = $pdo->prepare("
            INSERT INTO aluno (aluno_nome, aluno_cpf, aluno_endereco, aluno_telefone) 
            VALUES (:nome, :cpf, :endereco, :telefone)
        ");
        $stmt->bindParam(':nome', $data['aluno_nome'], PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $data['aluno_cpf'], PDO::PARAM_STR);
        $stmt->bindParam(':endereco', $data['aluno_endereco'], PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $data['aluno_telefone'], PDO::PARAM_STR);
        $stmt->execute();
    }
    // Atualiza a listagem após inserir os registros dummy
    $alunos = $pdo->query("SELECT * FROM aluno")->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciamento de Alunos</title>
  <!-- CSS dos ícones e estilos -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="./css/tabela1.css">
  <link rel="stylesheet" href="./css/styles.css">
  <!-- Biblioteca SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <nav>
      <div class="nav__header">
          <div class="nav__logo">
              <a href="#">
                  <img src="assets/logo.png" alt="logo">
              </a>
          </div>
          <div class="nav__menu__btn" id="menu-btn">
              <i class="ri-menu-3-line"></i>
          </div>
      </div>
      <ul class="nav__links" id="nav-links">
          <li><a href="#home">Home</a></li>
          <li><a href="#menu">Aluno</a></li>
          <li><a href="#about">Instrutor</a></li>
          <li><a href="">Aulas</a></li>
      </ul>
  </nav>

  
  <h2>Lista de Alunos</h2>
  <div class="table-container">
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
                  <!-- Link para edição usando o nome do arquivo atual -->
                  <a href="<?= $_SERVER['PHP_SELF'] ?>?edit=<?= $aluno['aluno_cod'] ?>">
                      <i class="bi bi-pencil"></i>
                  </a>
              </td>
          </tr>
          <?php endforeach; ?>
      </table>
  </div>

  <?php
  // Se o parâmetro GET 'edit' existir, exibe o formulário de edição logo abaixo da tabela
  if (isset($_GET['edit'])):
      $stmt = $pdo->prepare("SELECT * FROM aluno WHERE aluno_cod = :cod");
      $stmt->bindParam(':cod', $_GET['edit'], PDO::PARAM_INT);
      $stmt->execute();
      $aluno_edit = $stmt->fetch();
      if ($aluno_edit):
  ?>
  <h2>Editar Aluno</h2>
  <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
      <input type="hidden" name="aluno_cod" value="<?= $aluno_edit['aluno_cod'] ?>">
      <label>Nome:</label>
      <input type="text" name="aluno_nome" value="<?= htmlspecialchars($aluno_edit['aluno_nome']) ?>" required>
      <label>CPF:</label>
      <input type="text" name="aluno_cpf" value="<?= htmlspecialchars($aluno_edit['aluno_cpf']) ?>" required>
      <label>Endereço:</label>
      <input type="text" name="aluno_endereco" value="<?= htmlspecialchars($aluno_edit['aluno_endereco']) ?>" required>
      <label>Telefone:</label>
      <input type="text" name="aluno_telefone" value="<?= htmlspecialchars($aluno_edit['aluno_telefone']) ?>" required>
      <button type="submit">Atualizar</button>
  </form>
  <?php
      endif;
  endif;
  ?>

  <!-- SweetAlert: exibe a mensagem de sucesso se o parâmetro 'success' estiver definido -->
  <?php if (isset($_GET['success'])): ?>
  <script>
    Swal.fire({
      title: "Editado com sucesso!",
      icon: "success",
      draggable: true
    });
  </script>
  <?php endif; ?>
</body>
</html>
