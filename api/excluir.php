<?php 
session_start(); // SEMPRE que usar $_SESSION

header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

try {
    if (!isset($_SESSION["usuario_id"])) {
        echo json_encode(["sucesso" => false, "mensagem" => "Usuário não está logado!"]);
        exit;
    }

    $id = $_SESSION["usuario_id"];

    // Deleta o usuário usando o ID corretamente
    $query = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $id);
    $resultado = $stmt->execute();

    if ($resultado) {
        // Destrói a sessão, pois o usuário foi excluído
        session_unset();
        session_destroy();

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Usuário excluído com sucesso!"
        ]);
    } else {
        echo json_encode([
            "sucesso" => false,
            "mensagem" => "Erro ao excluir o usuário!"
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Erro do servidor! Tente novamente mais tarde!"
    ]);
}
?>