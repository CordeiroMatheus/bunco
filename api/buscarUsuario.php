<?php 
require_once "headers/headers.php";
include_once("conexao/conexao.php");
include_once("ofensiva.php");

$conn = conexao();

try {
    
    if (isset($_POST["login"])) {
        $login = $_POST["login"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Login não enviado"]);
        exit;
    }
    
    $sql = "SELECT u.id, u.username, u.nome, u.email, u.foto, u.cor, 
                   u.link_github, u.link_instagram, u.link_linkedin,
                   st.vidas, st.ofensiva, st.xp, st.modulos
            FROM usuarios u 
            INNER JOIN status st ON st.usuario = u.id
            WHERE u.id = :login";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":login", $login, PDO::PARAM_INT);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        if (!atualizarOfensiva($resultado['id'], $conn)) {
    echo json_encode([
        "sucesso" => "false",
        "mensagem" => "Erro ao atualizar a ofensiva do usuário!"
    ]);
    exit;
    }
        // Adiciona sucesso=true aos dados
        $resultado['sucesso'] = "true";
        echo json_encode($resultado);
    } else {
        echo json_encode([
            "sucesso" => "false",
            "mensagem" => "Usuário não encontrado"
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        "sucesso" => "false",
        //"mensagem" => "Erro: " . $e->getMessage()
        "mensagem" => "Erro no servidor"
    ]);
}
?>