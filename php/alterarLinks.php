<?php 
session_start();
header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

try {
    //Verifica se os campos foram passados
    if (isset($_SESSION["usuario_id"])) {
        $id = $_SESSION["usuario_id"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Usuário não está logado!"]);
        exit;
    }
    if (isset($_POST["github"])) {
        $github = $_POST["github"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu o link do github!"]);
        exit;
    }
    if (isset($_POST["instagram"])) {
        $instagram = $_POST["instagram"];

    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu o link do instagram!"]);
        exit;
    }

    if (isset($_POST["linkedin"])) {
        $linkedin = $_POST["linkedin"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu o link do linkedin!"]);
        exit;
    }
    
    //Atualizando com os links novos
    $sql = "UPDATE usuarios SET link_github = ?, link_instagram = ?, link_linkedin = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $github);
    $stmt->bindParam(2, $instagram);
    $stmt->bindParam(3, $linkedin);
    $stmt->bindParam(4, $id);
    $resultado = $stmt->execute();

    if ($resultado) {
        echo json_encode(["sucesso" => true, "mensagem" => "Links alterados com sucesso!", "logout" => true]);
    }
    else {
        echo json_encode(["sucesso" => false, "mensagem" => "Erro ao alterar os links do usuário!"]);
    }
    
} catch (Exception $e) {
    echo json_encode([
        "sucesso" => false,
        //"mensagem" => "Exceção: " . $e->getMessage()
        "mensagem" => "Erro no servidor"
    ]);
}
?>