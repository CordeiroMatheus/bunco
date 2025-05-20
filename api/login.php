<?php

// Configurações padrão do código
header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

try {
    // Verifica se os campos foram enviados
    if (isset($_POST["login"])) {
        $login = $_POST["login"]; // pode ser username ou email
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Login não enviado"]);
        exit;
    }

    if (isset($_POST["senha"])) {
        $senha = md5($_POST["senha"]);
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Senha não enviada"]);
        exit;
    }

    // Consulta que verifica se o login é username ou email
    $sql = "SELECT id, username, nome, email, link_github, link_instagram, link_linkedin 
            FROM usuarios 
            WHERE (username = :login OR email = :login) AND senha = :senha";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":login", $login);
    $stmt->bindParam(":senha", $senha);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultado) {
    $resultado["sucesso"] = "true";
    echo json_encode($resultado);
} else {
    echo json_encode([
        "sucesso" => "false",
        "mensagem" => "Usuário ou senha inválidos"
    ]);
}
} 
catch (Exception $e) {
    echo json_encode([
        "sucesso" => "false",
        "mensagem" => "Erro no servidor"
    ]);
}

