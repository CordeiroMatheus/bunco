<?php
require_once "headers/headers.php";
include_once("conexao/conexao.php");
$conn = conexao();

try {
    if (!isset($_POST["login"]) || $_POST["login"] === "") {
        echo json_encode(["sucesso" => "false", "mensagem" => "Login não enviado"]);
        exit;
    }

    $usuario = $_POST["login"];

    // Query que traz todos os módulos e o progresso do usuário em cada um
    $sql = "
        SELECT
            m.id,
            m.titulo,
            m.descricao,
            COALESCE((
                SELECT COUNT(*) FROM licoes l WHERE l.modulo = m.id
            ), 0) AS total_licoes,
            COALESCE((
                SELECT COUNT(DISTINCT p.licao)
                FROM progresso p 
                JOIN licoes l ON p.licao = l.id
                WHERE l.modulo = m.id AND p.usuario = :userId
            ), 0) AS licoes_feitas
        FROM modulos m
        ORDER BY m.id
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":userId", $usuario, PDO::PARAM_INT);
    $stmt->execute();

    $todosModulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $modulos = [];
    // Consideramos que "módulo anterior concluído" é true antes do primeiro módulo
    $moduloAnteriorConcluido = true;

    foreach ($todosModulos as $m) {
        $total = (int)$m["total_licoes"];
        $feitas = (int)$m["licoes_feitas"];

        if ($total > 0 && $feitas >= $total) {
            $status = "completo";
        } 
        else if ($feitas > 0 || $moduloAnteriorConcluido) {
            $status = "progresso";
        } 
        else {
            $status = "bloqueado";
        }

        $moduloAnteriorConcluido = ($status === "completo");

        $modulos[] = [
            "id" => (int)$m["id"],
            "titulo" => $m["titulo"],
            "descricao" => $m["descricao"],
            "total_licoes" => $total,
            "licoes_feitas" => $feitas,
            "status" => $status
        ];
    }

    echo json_encode([
        "sucesso" => "true",
        "modulos" => $modulos
    ]);
    exit;

} catch (Exception $e) {
    echo json_encode([
        "sucesso" => "false",
        //"mensagem" => "Erro: " . $e->getMessage()
        "mensagem" => "Erro no servidor"
    ]);
    exit;
}
