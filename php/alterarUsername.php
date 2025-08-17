<?php 
session_start();
header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

try {
    if (isset($_SESSION["username"]) && isset($_SESSION["usuario_id"])) {
        $username = $_SESSION["username"];
        $id = $_SESSION["usuario_id"];
    } else {
        echo json_encode(["sucesso" => false, "mensagem" => "Usuário não está logado!"]);
        exit;
    }

    if (isset($_POST["usernamenovo"])) {
        $usernamenovo = $_POST["usernamenovo"];
    } else {
        echo json_encode(["sucesso" => false, "mensagem" => "O servidor não recebeu o username novo!"]);
        exit;
    }

    $query = "UPDATE usuarios SET username = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $usernamenovo);
    $stmt->bindParam(2, $id);
    $resultado = $stmt->execute();

    if ($resultado) {
        echo json_encode(["sucesso" => true, "mensagem" => "Username alterado com sucesso!", "logout" => true]);
    } else {
        echo json_encode(["sucesso" => false, "mensagem" => "Erro ao alterar o username do usuário!"]);
    }
} catch (Exception $e) {
    echo json_encode([
        "sucesso" => false, 
        //"mensagem" => "Erro no servidor: " . $e->getMessage()
        "mensagem" => "Erro no servidor"
    ]);
}
?>