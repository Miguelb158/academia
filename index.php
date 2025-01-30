<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="cadastroForm">
        <label for="tipo_usuario">Você é:</label>
        <select id="tipo_usuario" name="tipo_usuario" required>
            <option value="">Selecione...</option>
            <option value="aluno">Aluno</option>
            <option value="instrutor">Instrutor</option>
        </select>
    
        <div id="dadosComuns">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
    
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" required>
        </div>
    
        <div id="dadosAluno" style="display:none;">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf">
    
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco">
        </div>
    
        <div id="dadosInstrutor" style="display:none;">
            <label for="especialidade">Especialidade:</label>
            <input type="text" id="especialidade" name="especialidade">
        </div>
    
        <button type="submit">Cadastrar</button>
    </form>

    <script>
    document.getElementById("tipo_usuario").addEventListener("change", function() {
    let tipo = this.value;
    document.getElementById("dadosAluno").style.display = (tipo === "aluno") ? "block" : "none";
    document.getElementById("dadosInstrutor").style.display = (tipo === "instrutor") ? "block" : "none";
});
</script>

</body>
</html>

<?php
include 'conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_usuario = $_POST['tipo_usuario'];
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);

    if (empty($tipo_usuario) || empty($nome) || empty($telefone)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
        exit;
    }

    if ($tipo_usuario == "aluno") {
        $cpf = trim($_POST['cpf']);
        $endereco = trim($_POST['endereco']);

        if (empty($cpf) || empty($endereco)) {
            echo "Por favor, preencha todos os campos de aluno.";
            exit;
        }

        $sql = "INSERT INTO aluno (aluno_nome, aluno_cpf, aluno_endereco, aluno_telefone) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nome, $cpf, $endereco, $telefone);

    } elseif ($tipo_usuario == "instrutor") {
        $especialidade = trim($_POST['especialidade']);

        if (empty($especialidade)) {
            echo "Por favor, preencha o campo de especialidade.";
            exit;
        }

        $sql = "INSERT INTO instrutor (instrutor_nome, instrutor_especialidade) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nome, $especialidade);
    }

    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
