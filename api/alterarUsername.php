<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

try {
    //Verifica se os campos foram passados
    if (isset($_POST["usernamenovo"])) {
        $usernamenovo = $_POST["usernamenovo"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Usuário não está logado!"]);
        exit;
    }
    if (isset($_POST["username"])) {
        $username = $_POST["username"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu o username novo!"]);
        exit;
    }

    //Atualiza o username do usuário
    $query = "UPDATE usuarios SET username = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $usernamenovo);
    $stmt->bindParam(2, $username);
    $resultado = $stmt->execute();
    $linhasAfetadas = $stmt->rowCount();
    
    //Verifica se a atualização do username deu certo
    if ($resultado) {
        echo json_encode(["sucesso" => "true", "mensagem" => "Username alterado com sucesso!"]);
    }
    else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Erro ao alterar o username do usuário!"]);
    }

} catch (Exception $e) {
    echo json_encode([
        "sucesso" => "false",
        //"mensagem" => "Exceção: " . $e->getMessage()
        "mensagem" => "Erro no servidor"
    ]);
}
?>