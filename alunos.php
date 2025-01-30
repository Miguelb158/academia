<?php
include 'conexao.php';  
$conn = new mysqli("localhost", "root", "", "db_academia");
$sql = "SELECT * FROM aluno";
$_result = $conn->query($sql);
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

<nav>
        <div class="nav__header">
          <div class="nav__logo">
            <a href="#">
              <img src="assets/logo-white.png" alt="logo" class="logo-white" />
              <img src="assets/logo-dark.png" alt="logo" class="logo-dark" />
            </a>
          </div>
          <div class="nav__menu__btn" id="menu-btn">
            <i class="ri-menu-line"></i>
          </div>
        </div>
        <ul class="nav__links" id="nav-links">
          <li><a href="#home">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#service">Services</a></li>
          <li><a href="#class">Classes</a></li>
          <li><a href="#contact">Blog</a></li>
          <li><a href="#">Join Now</a></li>
        </ul>
        <div class="nav__btns">
          <button class="btn">Join Now</button>
        </div>
      </nav>
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
                    <a href='editar.php?id=" . $row['aluno_cod'] . "'>Editar</a>
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
