<?php 
require_once "headers/headers.php";
include_once("conexao/conexao.php");
$conn = conexao();

try {
    // Verifica se os campos necessários foram passados
    if (!isset($_POST["aula_id"])) {
        echo json_encode(["sucesso" => false, "mensagem" => "ID da aula não informado!"]);
        exit;
    }
    
    if (!isset($_POST["usuario_id"])) {
        echo json_encode(["sucesso" => false, "mensagem" => "ID do usuário não informado!"]);
        exit;
    }

    $aulaId = intval($_POST["aula_id"]);
    $usuarioId = intval($_POST["usuario_id"]);

    // Busca os dados da aula específica
    $queryAula = "
        SELECT l.*, m.titulo as modulo_titulo,
               (SELECT COUNT(*) FROM progresso p WHERE p.licao = l.id AND p.usuario = ?) as concluida
        FROM licoes l 
        JOIN modulos m ON l.modulo = m.id
        WHERE l.id = ?
    ";
    
    $stmtAula = $conn->prepare($queryAula);
    $stmtAula->bindParam(1, $usuarioId);
    $stmtAula->bindParam(2, $aulaId);
    $stmtAula->execute();
    $aula = $stmtAula->fetch(PDO::FETCH_ASSOC);

    if (!$aula) {
        echo json_encode(["sucesso" => false, "mensagem" => "Aula não encontrada!"]);
        exit;
    }
    $conteudo = json_decode($aula['conteudo'], true);

    // Formata a resposta
    $aulaFormatada = [
        'id' => intval($aula['id']),
        'titulo' => $aula['titulo'],
        'tipo' => $aula['tipo'],
        'progresso' => $aula['concluida'] ? 100 : 0,
        'modulo_id' => intval($aula['modulo']),
        'conteudo' => $conteudo
    ];

    $response = [
        'sucesso' => true,
        'mensagem' => 'Aula carregada com sucesso',
        'dados' => $aulaFormatada
    ];

    echo json_encode($response);

} catch (Exception $e) {
    echo json_encode([
        "sucesso" => false,
        //"mensagem" => "Erro no servidor: " . $e->getMessage()
        "mensagem" => "Erro no servidor!"
    ]);
}
?>