<?php

//Configurações padrão do código
header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

try {
    $arr = [];
    //Verifica se algum valor não foi passado pelo método post
    $campos = ["username", "nome", "email", "senha"];
foreach ($campos as $campo) {
    if (empty($_POST[$campo])) {
        $arr["sucesso"] = "false";
        $arr["mensagem"] = "o campo '$campo' está vazio.";
        echo json_encode($arr);
        exit;
    }
    $$campo = $_POST[$campo];
}
$senha = md5($senha);

// Verifica se username já existe
$query = "SELECT COUNT(*) FROM usuarios WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bindParam(1, $username);
$stmt->execute();
if ($stmt->fetchColumn() > 0) {
    $arr["sucesso"] = "false";
    $arr["mensagem"] = "username existe.";
    echo json_encode($arr);
    exit;
}

// Verifica se email já existe
$query = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bindParam(1, $email);
$stmt->execute();
if ($stmt->fetchColumn() > 0) {
    $arr["sucesso"] = "false";
    $arr["mensagem"] = "email existe.";
    echo json_encode($arr);
    exit;
}

    //Cria a query da tabela usuários, passa os parâmetros necessários e executa ela (true ou false)
    $query = "INSERT INTO usuarios(username, nome, email, senha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $nome);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $senha);
    $resultado = $stmt->execute();


    if ((!$resultado)) {
        $arr["sucesso"] = "false";
        $arr["mensagem"] = "erro ao cadastrar usuário";
        echo json_encode($arr);
        exit;
    }

    //Pega o id do usuário que acabou de ser cadastrado
    $query = "SELECT id FROM usuarios WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $resultado = $stmt->fetchALL(PDO::FETCH_OBJ);

    //Cria a query da tabela status
    foreach ($resultado as $r) {
        $query = "INSERT INTO status(usuario) VALUES (?)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $r->id, PDO::PARAM_INT);
        $resultado = $stmt->execute();
    }

    //Retorna se esse processo deu certo
    if ($resultado) {
        $arr["sucesso"] = "true";
        $arr["mensagem"] = "Usuário cadastrado com sucesso."
    } else {
        $arr["sucesso"] = "false";
        $arr["mensagem"] = "erro do servidor";
    }
    echo json_encode($arr);
} catch (Exception $e) {
    $arr = [];
    $arr["sucesso"] = "false";
    echo json_encode($arr);
}