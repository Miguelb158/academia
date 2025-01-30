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
