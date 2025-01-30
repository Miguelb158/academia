<?php
require 'conexao.php';

// Listar aulas
$query = "SELECT aula_cod, aula_tipo, aula_data FROM aula";
$result = mysqli_query($conn, $query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['agendar'])) {
        $tipo = $_POST['tipo'];
        $data = $_POST['data'];
        $sql = "INSERT INTO aula (aula_tipo, aula_data) VALUES ('$tipo', '$data')";
        mysqli_query($conn, $sql);
    }
    if (isset($_POST['editar'])) {
        $id = $_POST['id'];
        $tipo = $_POST['tipo'];
        $data = $_POST['data'];
        $sql = "UPDATE aula SET aula_tipo='$tipo', aula_data='$data' WHERE aula_cod=$id";
        mysqli_query($conn, $sql);
    }
    if (isset($_POST['excluir'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM aula WHERE aula_cod=$id";
        mysqli_query($conn, $sql);
    }
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gerenciamento de Aulas</title>
</head>
<body>
    <h2>Aulas Agendadas</h2>
    <table border='1'>
        <tr>
            <th>Tipo de Aula</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
<<<<<<< HEAD
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['aula_tipo']) ?></td>
            <td><?= htmlspecialchars($row['aula_data']) ?></td>
            <td><?= htmlspecialchars($row['instrutor_nome']) ?></td>
            <td><?= htmlspecialchars($row['aluno_nome']) ?></td>
            <td>
                <a href="editar_aluno.php?aula_cod=<?= $row['aula_cod'] ?>">Editar</a> |
                <a href="index.php?delete=<?= $row['aula_cod'] ?>" onclick="return confirm('Tem certeza?');">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
=======
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['aula_tipo']; ?></td>
                <td><?php echo $row['aula_data']; ?></td>
                <td>
                    <form method='post' style='display:inline;'>
                        <input type='hidden' name='id' value='<?php echo $row['aula_cod']; ?>'>
                        <input type='text' name='tipo' value='<?php echo $row['aula_tipo']; ?>' required>
                        <input type='date' name='data' value='<?php echo $row['aula_data']; ?>' required>
                        <button type='submit' name='editar'>Editar</button>
                    </form>
                    <form method='post' style='display:inline;'>
                        <input type='hidden' name='id' value='<?php echo $row['aula_cod']; ?>'>
                        <button type='submit' name='excluir'>Excluir</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
>>>>>>> 48da21feb2834fcaec1e2de9eedbf47433be0fd6
    </table>

    <h2>Agendar Nova Aula</h2>
    <form method='post'>
        <input type='text' name='tipo' placeholder='Tipo de Aula' required>
        <input type='date' name='data' required>
        <button type='submit' name='agendar'>Agendar</button>
    </form>
</body>
</html>
