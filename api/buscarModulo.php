<?php

// Parâmetros GET esperados: modulo (int), login (int)
// Retorna JSON com todas as lições do módulo com informações de status

require_once "headers/headers.php";
include_once("conexao.php");
$conn = conexao();

try {
    if (isset($_GET["modulo"])) {
        $modulo = $_GET["modulo"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Módulo não foi definido!"]);
        exit;
    }
    if (isset($_GET["login"])) {
        $login = $_GET["login"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Usuário não foi definido"]);
        exit;
    }
    
    // Buscar todas as lições do módulo
    $sql = "SELECT id, modulo, titulo, tipo, ordem
                   FROM licoes
                   WHERE modulo = ?
                   ORDER BY ordem";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $modulo);
    $stmt->execute();
    $licoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$licoes) {
        echo json_encode(["sucesso" => "false", "mensagem" => "Não tem lições!"]);
        exit;
    }

    // Buscar lições concluídas pelo usuário
    $sql = "SELECT DISTINCT p.licao
                FROM progresso p
                JOIN licoes l ON p.licao = l.id
                WHERE p.usuario = ?
                AND l.modulo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $login);
    $stmt->bindParam(2, $modulo);
    $stmt->execute();
    $licoesFeitas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Criar conjunto de lições concluídas
    $doneSet = [];
    foreach ($licoesFeitas as $r) {
        $doneSet[intval($r['licao'])] = true;
    }

    // Determinar qual é a próxima lição disponível
    $proximaLicaoDisponivel = null;
    $todasConcluidas = true;
    
    foreach ($licoes as $l) {
        $id = intval($l['id']);
        if (!isset($doneSet[$id])) {
            $todasConcluidas = false;
            if ($proximaLicaoDisponivel === null) {
                $proximaLicaoDisponivel = $id;
            }
        }
    }

    // Se todas as lições estiverem concluídas, a próxima disponível é null
    if ($todasConcluidas) {
        $proximaLicaoDisponivel = null;
    }

    // Construir resposta com todas as lições
    $responseLicoes = [];
    $total = count($licoes);
    
    for ($i = 0; $i < $total; $i++) {
        $l = $licoes[$i];
        $id = intval($l['id']);
        
        // Verificar se a lição foi concluída
        $isDone = isset($doneSet[$id]);
        
        // Verificar se a lição está disponível
        // Regras:
        // 1. Se é a primeira lição, sempre está disponível
        // 2. Se a lição anterior foi concluída, esta está disponível
        // 3. Se é a próxima lição após a última concluída, está disponível
        $isAvailable = false;
        if ($i === 0) {
            $isAvailable = true; // Primeira lição sempre disponível
        } else {
            $liacaoAnteriorId = intval($licoes[$i-1]['id']);
            $isAvailable = isset($doneSet[$liacaoAnteriorId]) || $id === $proximaLicaoDisponivel;
        }

        // Conector para a próxima lição (linha vertical)
        $connector_colored = false;
        if ($i + 1 < $total) {
            $nextId = intval($licoes[$i + 1]['id']);
            $nextIsDone = isset($doneSet[$nextId]);
            $nextIsAvailable = $nextIsDone || $nextId === $proximaLicaoDisponivel;
            $connector_colored = $isDone && $nextIsAvailable;
        }

        // Definir ícone baseado no tipo de lição
        $typeLower = mb_strtolower($l['tipo']);
        if ($typeLower === 'teoria' || $typeLower === 'teórica' || $typeLower === 'teorica') {
            $icon = 'book';
            $subtitle = 'Aula teórica';
        } else {
            $icon = 'pencil';
            $subtitle = 'Exercício prático';
        }

        // Adicionar lição à resposta
        $responseLicoes[] = [
            'id' => $id,
            'module_id' => intval($l['modulo']),
            'title' => $l['titulo'],
            'type' => $l['tipo'],
            'order' => intval($l['ordem']),
            'is_done' => $isDone,
            'is_available' => $isAvailable,
            'row_gray' => !$isAvailable, // Linha cinza se não disponível
            'connector_colored' => $connector_colored,
            'icon' => $icon,
            'subtitle' => $subtitle
        ];
    }

    echo json_encode([
        'sucesso' => 'true',
        'modulo' => $modulo,
        'login' => $login,
        'licoes' => $responseLicoes,
        'meta' => [
            'total_licoes_in_module' => $total,
            'proximaLicaoDisponivel' => $proximaLicaoDisponivel,
            'todasConcluidas' => $todasConcluidas
        ]
    ], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['sucesso' => 'false', 'mensagem' => "Erro ao buscar lições: " . $e->getMessage()]);
    exit;
}