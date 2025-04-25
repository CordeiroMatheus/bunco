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

    if (isset($_POST["senha"])) {
        $senha = $_POST["senha"];
        $senha = md5($senha);
    } else {
        echo json_encode(["sucesso" => "false"]);
        exit;
    }

    //Busca se existe algum usuário com o username e senha passados
    $sql = "SELECT id, username, nome, email, link_github, link_instagram, link_linkedin FROM usuarios WHERE username = :username AND senha = :senha";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":senha", $senha);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($resultado);
} 
catch (Exception $e) {
    $erro = [];
    $erro["erro"] = "true";
    echo json_encode($erro);
}
