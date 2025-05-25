<?php 
header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

try {
    //Verifica se o username foi passado
    if (isset($_POST["username"])) {
        $username = $_POST["username"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "username ausente"]);
        exit;
    }
    //Deleta o usuário e consequentemente os dados das tabelas com chave estrangeira desse usuário
    $query = "DELETE FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $username);
    $resultado = $stmt->execute();
    //Verifica se a deleção deu certo
    if ($resultado) {
        echo json_encode(["sucesso" => "true", "mensagem" => "Usuário excluído com sucesso!"]);
    }
    else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Erro ao excluir o usuário!"]);
    }
} catch (Exception $e) {
    echo json_encode([
        "sucesso" => "false",
        "mensagem" => "Exceção: " . $e->getMessage()
    ]);
}
?>