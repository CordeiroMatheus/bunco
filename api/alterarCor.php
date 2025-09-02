<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

try {
    //Verifica se os campos foram passados
    if (isset($_POST["username"])) {
        $username = $_POST["username"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Usuário não está logado!"]);
        exit;
    }
    if (isset($_POST["cor"])) {
        $cor = $_POST["cor"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu a cor nova!"]);
        exit;
    }

    //Atualiza a cor do usuário
    $query = "UPDATE usuarios SET cor = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $cor);
    $stmt->bindParam(2, $username);
    $resultado = $stmt->execute();
    
    //Verifica se a atualização do nome deu certo
    if ($resultado) {
        echo json_encode(["sucesso" => "true", "mensagem" => "Cor alterada com sucesso!"]);
    }
    else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Erro ao alterar a cor do usuário!"]);
    }

} catch (Exception $e) {
    echo json_encode([
        "sucesso" => "false",
        //"mensagem" => "Exceção: " . $e->getMessage()
        "mensagem" => "Erro no servidor"
    ]);
}
?>