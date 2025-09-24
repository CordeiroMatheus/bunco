<?php 
require_once "headers/headers.php";
include_once("conexao/conexao.php");
include_once("ofensiva.php"); 

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

    // Verifica se a aula já foi concluída anteriormente
    $queryVerificaConclusao = "SELECT COUNT(*) as total FROM progresso WHERE licao = ? AND usuario = ?";
    $stmtVerificaConclusao = $conn->prepare($queryVerificaConclusao);
    $stmtVerificaConclusao->bindParam(1, $aulaId);
    $stmtVerificaConclusao->bindParam(2, $usuarioId);
    $stmtVerificaConclusao->execute();
    $resultadoConclusao = $stmtVerificaConclusao->fetch(PDO::FETCH_ASSOC);
    
    $jaConcluida = $resultadoConclusao['total'] > 0;
    $xpGanho = $jaConcluida ? 10 : 25;

    // Se não estava concluída, insere o registro de progresso
    if (!$jaConcluida) {
        $queryInsereProgresso = "INSERT INTO progresso (usuario, licao, data) VALUES (?, ?, NOW())";
        $stmtInsereProgresso = $conn->prepare($queryInsereProgresso);
        $stmtInsereProgresso->bindParam(1, $usuarioId);
        $stmtInsereProgresso->bindParam(2, $aulaId);
        $stmtInsereProgresso->execute();
    } else {
        // Se já estava concluída, atualiza a data do progresso
        $queryAtualizaProgresso = "UPDATE progresso SET data = NOW() WHERE licao = ? AND usuario = ?";
        $stmtAtualizaProgresso = $conn->prepare($queryAtualizaProgresso);
        $stmtAtualizaProgresso->bindParam(1, $aulaId);
        $stmtAtualizaProgresso->bindParam(2, $usuarioId);
        $stmtAtualizaProgresso->execute();
    }

    // Atualiza o XP do usuário
    $queryAtualizaXP = "UPDATE status SET xp = xp + ? WHERE usuario = ?";
    $stmtAtualizaXP = $conn->prepare($queryAtualizaXP);
    $stmtAtualizaXP->bindParam(1, $xpGanho);
    $stmtAtualizaXP->bindParam(2, $usuarioId);
    $stmtAtualizaXP->execute();

    $moduloGanho = false;
    
    // Se a aula não estava concluída anteriormente, verifica se o módulo foi completado
    if (!$jaConcluida) {
        // Obtém o ID do módulo da aula
        $queryModuloAula = "SELECT modulo FROM licoes WHERE id = ?";
        $stmtModuloAula = $conn->prepare($queryModuloAula);
        $stmtModuloAula->bindParam(1, $aulaId);
        $stmtModuloAula->execute();
        $moduloAula = $stmtModuloAula->fetch(PDO::FETCH_ASSOC);
        $moduloId = $moduloAula['modulo'];
        
        // Conta o total de aulas no módulo
        $queryTotalAulas = "SELECT COUNT(*) as total FROM licoes WHERE modulo = ?";
        $stmtTotalAulas = $conn->prepare($queryTotalAulas);
        $stmtTotalAulas->bindParam(1, $moduloId);
        $stmtTotalAulas->execute();
        $totalAulas = $stmtTotalAulas->fetch(PDO::FETCH_ASSOC)['total'];
        
        // Conta quantas aulas do módulo o usuário concluiu
        $queryAulasConcluidas = "
            SELECT COUNT(DISTINCT p.licao) as concluidas 
            FROM progresso p 
            JOIN licoes l ON p.licao = l.id 
            WHERE p.usuario = ? AND l.modulo = ?
        ";
        $stmtAulasConcluidas = $conn->prepare($queryAulasConcluidas);
        $stmtAulasConcluidas->bindParam(1, $usuarioId);
        $stmtAulasConcluidas->bindParam(2, $moduloId);
        $stmtAulasConcluidas->execute();
        $aulasConcluidas = $stmtAulasConcluidas->fetch(PDO::FETCH_ASSOC)['concluidas'];
        
        // Se todas as aulas do módulo foram concluídas, adiciona um módulo
        if ($aulasConcluidas >= $totalAulas) {
            $queryAdicionaModulo = "UPDATE status SET modulos = modulos + 1 WHERE usuario = ?";
            $stmtAdicionaModulo = $conn->prepare($queryAdicionaModulo);
            $stmtAdicionaModulo->bindParam(1, $usuarioId);
            $stmtAdicionaModulo->execute();
            $moduloGanho = true;
        }
    }
    
    // Atualiza a ofensiva do usuário
    atualizarOfensiva($usuarioId, $conn);
    $ofensiva = retornarOfensiva($usuarioId, $conn);
    // Prepara a mensagem de resposta
    $mensagem = $jaConcluida 
        ? "Aula revisitada! Você ganhou $xpGanho de XP." 
        : "Aula concluída! Você ganhou $xpGanho de XP.";
    
    if ($moduloGanho) {
        $mensagem .= " Além disso, você completou o módulo e ganhou 1 módulo extra!";
    }
    
    echo json_encode([
        "sucesso" => true,
        "mensagem" => $mensagem,
        "xp_ganho" => $xpGanho,
        "modulo_ganho" => $moduloGanho,
        "ofensiva" => $ofensiva
    ]);

} catch (Exception $e) {
    echo json_encode([
        "sucesso" => false,
        //"mensagem" => "Erro no servidor: " . $e->getMessage()
        "mensagem" => "Erro no servidor."
    ]);
}
?>