<?php
/**
 * Função para atualizar a ofensiva (dias seguidos) do usuário
 * Baseada nos registros de progresso da tabela progresso
 */

include_once("conexao.php");

/**
 * Atualiza a ofensiva do usuário baseada nos dias consecutivos com atividades
 * @param int $usuarioId ID do usuário
 * @param PDO $conn Conexão com o banco de dados
 * @return bool Resultado da operação
 */
function atualizarOfensiva($usuarioId, $conn) {
    try {
        // Verifica se o usuário existe na tabela status
        $queryCheckStatus = "SELECT * FROM status WHERE usuario = ?";
        $stmtCheckStatus = $conn->prepare($queryCheckStatus);
        $stmtCheckStatus->bindParam(1, $usuarioId);
        $stmtCheckStatus->execute();
        
        if ($stmtCheckStatus->rowCount() == 0) {
            // Se não existir, cria um registro para o usuário
            $queryInsertStatus = "INSERT INTO status (usuario, vidas, ofensiva, xp, modulos) VALUES (?, 5, 0, 0, 0)";
            $stmtInsertStatus = $conn->prepare($queryInsertStatus);
            $stmtInsertStatus->bindParam(1, $usuarioId);
            $stmtInsertStatus->execute();
        }
        
        // Busca todas as datas distintas em que o usuário teve progresso
        $queryDatasProgresso = "
            SELECT DISTINCT DATE(data) as data_progresso 
            FROM progresso 
            WHERE usuario = ? 
            ORDER BY data_progresso DESC
        ";
        $stmtDatasProgresso = $conn->prepare($queryDatasProgresso);
        $stmtDatasProgresso->bindParam(1, $usuarioId);
        $stmtDatasProgresso->execute();
        $datasProgresso = $stmtDatasProgresso->fetchAll(PDO::FETCH_ASSOC);
        
        // Se não houver progresso, retorna ofensiva 0
        if (count($datasProgresso) == 0) {
            $queryUpdateOfensiva = "UPDATE status SET ofensiva = 0 WHERE usuario = ?";
            $stmtUpdateOfensiva = $conn->prepare($queryUpdateOfensiva);
            $stmtUpdateOfensiva->bindParam(1, $usuarioId);
            $stmtUpdateOfensiva->execute();
            
            return true;
        }
        
        // Converte as datas para objetos DateTime
        $datas = [];
        foreach ($datasProgresso as $data) {
            $datas[] = new DateTime($data['data_progresso']);
        }
        
        // Calcula a sequência de dias consecutivos
        $ofensiva = 1;
        $dataAtual = new DateTime(); // Data de hoje
        $dataReferencia = $datas[0]; // Data mais recente de progresso
        
        // Se a data mais recente for hoje, começamos a contar de hoje
        // Se não for, começamos do dia mais recente de progresso
        if ($dataReferencia->format('Y-m-d') === $dataAtual->format('Y-m-d')) {
            $dataAtual = $dataReferencia;
        } else {
            $dataAtual = $dataReferencia;
            $ofensiva = 0; // Começamos a contar do zero se o progresso não for de hoje
        }
        
        // Percorre todas as datas para encontrar a sequência consecutiva
        for ($i = 0; $i < count($datas); $i++) {
            $dataProgresso = $datas[$i];
            
            // Se a data de progresso for igual à data de referência, incrementa a ofensiva
            if ($dataProgresso->format('Y-m-d') === $dataAtual->format('Y-m-d')) {
                // Move para o dia anterior
                $dataAtual->modify('-1 day');
            } else {
                // Se não for consecutivo, para de contar
                break;
            }
            
            // Para evitar loop infinito em caso de muitos dados
            if ($i > 365) break; // Limite de 1 ano
        }
        
        // Atualiza a ofensiva do usuário
        $queryUpdateOfensiva = "UPDATE status SET ofensiva = ? WHERE usuario = ?";
        $stmtUpdateOfensiva = $conn->prepare($queryUpdateOfensiva);
        $stmtUpdateOfensiva->bindParam(1, $ofensiva);
        $stmtUpdateOfensiva->bindParam(2, $usuarioId);
        $stmtUpdateOfensiva->execute();
        
        return true;
        
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Atualiza a ofensiva do usuário baseada nos dias consecutivos com atividades
 * @param int $usuarioId ID do usuário
 * @param PDO $conn Conexão com o banco de dados
 * @return int Resultado da operação
 */
function retornarOfensiva($usuarioId, $conn) {
    try {
        $query = "SELECT ofensiva FROM status WHERE usuario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $usuarioId);
        $stmt->execute();
        $ofensiva = $stmt->fetch(PDO::FETCH_ASSOC)['ofensiva'];
        return $ofensiva;
    } catch (Exception $e) {
        return 366;
    }
}
?>