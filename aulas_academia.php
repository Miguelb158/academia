<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_academia";

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
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');@import url("https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
* {
  margin: 0;
  padding: 0;
}



:root {
  --primary-color: #8c52ff;
  --primary-color-dark: #482f79;
  --secondary-color: #2d0779;
  --text-dark: #1c1917;
  --text-light: #57534e;
  --extra-light: #d6d3d1;
  --white: #ffffff;
  --max-width: 1200px;
  --header-font:  "DM Sans", serif;
}


a {
  color: #fff;
  text-decoration: none;
  transition: 0.3s;
}

a:hover {
  opacity: 0.7;
}

.logo {
  font-size: 24px;
  text-transform: uppercase;
  letter-spacing: 4px;
}

nav {
  display: flex;
  justify-content: space-around;
  align-items: center;
  font-family: var(--header-font);
   background: #6017a3;
  height: 8vh;
}

main {
  background: url("bg.jpg") no-repeat center center;
  background-size: cover;
  height: 92vh;
}

.nav-list {
  list-style: none;
  display: flex;
}

.nav-list li {
  letter-spacing: 3px;
  margin-left: 32px;
}

.mobile-menu {
  display: none;
  cursor: pointer;
}

.mobile-menu div {
  width: 32px;
  height: 2px;
  background: #fff;
  margin: 8px;
  transition: 0.3s;
}

@media (max-width: 999px) {
  body {
    overflow-x: hidden;
  }
  .nav-list {
    position: absolute;
    top: 8vh;
    right: 0;
    width: 50vw;
    height: 92vh;
    background: #6017a3;
    flex-direction: column;
    align-items: center;
    justify-content: space-around;
    transform: translateX(100%);
    transition: transform 0.3s ease-in;
  }
  .nav-list li {
    margin-left: 0;
    opacity: 0;
  }
  .mobile-menu {
    display: block;
  }
}

.nav-list.active {
  transform: translateX(0);
}

@keyframes navLinkFade {
  from {
    opacity: 0;
    transform: translateX(50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.mobile-menu.active .line1 {
  transform: rotate(-45deg) translate(-8px, 8px);
}

.mobile-menu.active .line2 {
  opacity: 0;
}

.mobile-menu.active .line3 {
  transform: rotate(45deg) translate(-5px, -7px);
}
    
    body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 20px;
    text-align: center;
}

/* Cabeçalhos */
h2 {
    color: #333;
}

/* Estilização da tabela */
table {
    width: 90%;
    max-width: 900px;
    margin: 20px auto;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

th {
    background: #4d23a1;;
    color: white;
    text-transform: uppercase;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}


a {
    text-decoration: none;
    padding: 5px 10px;
    color: white;
    border-radius: 5px;
    margin: 2px;
    display: inline-block;
}


a[href*="delete"] {
    background-color: #dc3545;
}

a[href*="delete"]:hover {
    background-color: #c82333;
}

/* Formulário */
form {
    background: white;
    padding: 20px;
    width: 300px;
    margin: 20px auto;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    text-align: left;
}

input {
    width: 95%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background-color:#4CAF50;;
    color: white;
    border: none;
    padding: 10px;
    width: 100%;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
}

button:hover {
    background-color: #45a049;;


}
#agenda{
    color: #9100cb;
}
</style>
<body>
<header>
<nav>
  <a class="logo" href="/">Fitness Center</a>
  <div class="mobile-menu">
    <div class="line1"></div>
    <div class="line2"></div>
    <div class="line3"></div>
  </div>
  <ul class="nav-list">
    <li><a href="./index.php">Home</a></li>
    <li><a href="./aluno.php">Aluno</a></li>
    <li><a href="./instrutor.php">Instrutor</a></li>
    <li><a href="./aulas_academia.php">Aulas</a></li>
  </ul>
</nav>
</header>
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

    <h2 id ="agenda">Agendar Nova Aula</h2>
    <form method="post">
        <label>Tipo de Aula: <input type="text" name="aula_tipo" required></label><br>
        <label>Data: <input type="date" name="aula_data" required></label><br>
        <label>ID Instrutor: <input type="number" name="fk_instrutor_cod" required></label><br>
        <label>ID Aluno: <input type="number" name="fk_aluno_cod" required></label><br>
        <button type="submit" name="add">Agendar</button>
    </form>
</body>
</html>