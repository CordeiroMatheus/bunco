<?php 
require_once "headers/headers.php";
include_once("conexao/conexao.php");

$conn = conexao();

try {
    // Verifica se os campos necessários foram passados
    if (!isset($_POST["usuario_id"])) {
        echo json_encode(["sucesso" => false, "mensagem" => "ID do usuário não informado!"]);
        exit;
    }

    $usuarioId = intval($_POST["usuario_id"]);

    // Busca a quantidade atual de vidas do usuário
    $queryVidas = "SELECT vidas FROM status WHERE usuario = ?";
    $stmtVidas = $conn->prepare($queryVidas);
    $stmtVidas->bindParam(1, $usuarioId);
    $stmtVidas->execute();
    $resultadoVidas = $stmtVidas->fetch(PDO::FETCH_ASSOC);

    if (!$resultadoVidas) {
        echo json_encode(["sucesso" => false, "mensagem" => "Usuário não encontrado!"]);
        exit;
    }

    $vidasAtuais = $resultadoVidas['vidas'];

    // Verifica se o usuário ainda tem vidas
    if ($vidasAtuais <= 0) {
        echo json_encode([
            "sucesso" => true, 
            "mensagem" => "Você não tem mais vidas!",
            "vidas_restantes" => 0
        ]);
        exit;
    }

    // Decrementa uma vida
    $novasVidas = $vidasAtuais - 1;
    
    $queryUpdate = "UPDATE status SET vidas = ? WHERE usuario = ?";
    $stmtUpdate = $conn->prepare($queryUpdate);
    $stmtUpdate->bindParam(1, $novasVidas);
    $stmtUpdate->bindParam(2, $usuarioId);
    $stmtUpdate->execute();

    // Busca a quantidade atual de vidas do usuário
    $queryVidas = "SELECT vidas FROM status WHERE usuario = ?";
    $stmtVidas = $conn->prepare($queryVidas);
    $stmtVidas->bindParam(1, $usuarioId);
    $stmtVidas->execute();
    $resultadoVidas = $stmtVidas->fetch(PDO::FETCH_ASSOC);

    $vidasAtuais = $resultadoVidas['vidas'];

    // Verifica se o usuário ainda tem vidas
    if ($vidasAtuais <= 0) {
        echo json_encode([
            "sucesso" => true, 
            "mensagem" => "Você não tem mais vidas!",
            "vidas_restantes" => 0
        ]);
        exit;
    }

    echo json_encode([
        "sucesso" => true,
        "mensagem" => "Você perdeu uma vida!",
        "vidas_restantes" => $novasVidas
    ]);

} catch (Exception $e) {
    echo json_encode([
        "sucesso" => false,
        //"mensagem" => "Erro no servidor: " . $e->getMessage()
        "mensagem" => "Erro no serivdor."
    ]);
}
?>