<?php 
include_once("../conexao/conexao.php");
$conn = conexao();
try {
    $conn->beginTransaction();
    $sql = "UPDATE status
            SET vidas = LEAST(vidas + 1, 5)
            WHERE vidas < 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $updated = $stmt->rowCount();

    $conn->commit();

    // Saída para logs / debug
    echo date('Y-m-d H:i:s') . " - refresh_lives: OK.";
    exit(0);

} catch (Exception $e) {
    echo date('Y-m-d H:i:s') . " - refresh_lives: ERRO. " . $e->getMessage() . "\n";
}
?>