<?php

//Configurações padrão do código
header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

try {
    //Verifica se algum valor não foi passado pelo método post
    if (isset($_POST["username"])) {
        $username = $_POST["username"];
    } else {
        echo json_encode(["sucesso" => "false"]);
        exit;
    }

    if (isset($_POST["nome"])) {
        $nome = $_POST["nome"];
    } else {
        echo json_encode(["sucesso" => "false"]);
        exit;
    }

    if (isset($_POST["email"])) {
        $email = $_POST["email"];
    } else {
        echo json_encode(["sucesso" => "false"]);
        exit;
    }

    if (isset($_POST["senha"])) {
        $senha = $_POST["senha"];
        $senha = md5($senha);
    } else {
        echo json_encode(["sucesso" => "false"]);
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
        echo json_encode(["sucesso" => "false"]);
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
    $arr = [];
    if ($resultado) {
        $arr["sucesso"] = "true";
    } else {
        $arr["sucesso"] = "false";
    }
    echo json_encode($arr);
} catch (Exception $e) {
    $arr = [];
    $arr["sucesso"] = "false";
    echo json_encode($arr);
}