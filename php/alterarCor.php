<?php
session_start(); // Necessário para acessar a sessão

header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

try {
    // Verifica se o usuário está logado
    if (!isset($_SESSION["usuario_id"])) {
        echo json_encode([
            "sucesso" => false,
            "mensagem" => "Usuário não está logado!"
        ]);
        exit;
    }

    // Verifica se a nova cor foi enviada
    if (!isset($_POST["cor"])) {
        echo json_encode([
            "sucesso" => false,
            "mensagem" => "A cor não foi enviada!"
        ]);
        exit;
    }

    // Pega dados
    $id = $_SESSION["usuario_id"];
    $cor = $_POST["cor"];

    // Atualiza a cor no banco
    $query = "UPDATE usuarios SET cor = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $cor);
    $stmt->bindParam(2, $id);

    $stmt->execute();

    // Verifica se alguma linha foi realmente alterada
    if ($stmt->rowCount() > 0) {
        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Cor alterada com sucesso!",
        ]);
        exit;
    } else {
        echo json_encode([
            "sucesso" => false,
            "mensagem" => "A cor já estava atualizada ou nenhum usuário foi encontrado."
        ]);
        exit;
    }
} catch (Exception $e) {
    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Erro no servidor: " . $e->getMessage()
    ]);
    exit;
}
