<?php 
session_start();
header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

try {
    
    if (isset($_SESSION["usuario_id"])) {
    $id = $_SESSION["usuario_id"];
    } else {
        echo json_encode(["sucesso" => false, "mensagem" => "Usuário não está logado!"]);
        exit;
    }
    if (isset($_POST["foto"])) {
        $foto = $_POST["foto"];
    } else {
        echo json_encode(["sucesso" => false, "mensagem" => "O servidor não recebeu a foto nova!"]);
        exit;
    }

    $query = "UPDATE usuarios SET foto = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $foto);
    $stmt->bindParam(2, $id);
    $resultado = $stmt->execute();
    
    if ($resultado) {
        echo json_encode(["sucesso" => true, "mensagem" => "Foto alterada com sucesso!", "logout" => true]);
    }
    else {
        echo json_encode(["sucesso" => false, "mensagem" => "Erro ao alterar a foto do usuário!"]);
    }

} catch (Exception $e) {
    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Erro no servidor"
    ]);
}
?>