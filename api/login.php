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
    
    //Verifica se o login e a senha estão corretos e passa os dados
    $sql = "SELECT u.id, u.username, u.nome, u.email, u.link_github, u.link_instagram, u.link_linkedin,
    st.vidas, st.ofensiva, st.xp FROM usuarios u INNER JOIN status st ON st.usuario = u.id
    WHERE (u.username = :login OR u.email = :login) AND u.senha = :senha";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":login", $login);
    $stmt->bindParam(":senha", $senha);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    //Se o login e senha estão corretos
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

