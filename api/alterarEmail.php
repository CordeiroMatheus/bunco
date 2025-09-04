<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

function validarEmail($email) {
    $email = trim($email);
    $regex = "/^[\w\.-]+@[\w\.-]+\.\w+$/";

    // Regras
    if (empty($email)) {
        return false;
    }

    if (strlen($email) < 4 || strlen($email) > 254) {
        return false;
    }

    if (!preg_match($regex, $email)) {
        return false;
    }
    return true;
}
try {
    if (isset($_POST["username"])) {
        $username = $_POST["username"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Usuário não está logado!"]);
        exit;
    }
    if (isset($_POST["email"])) {
        $email = trim($_POST["email"]);
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu o email novo!"]);
        exit;
    }
    if (!validarEmail($email)) {
        echo json_encode(["sucesso" => "false", "mensagem" => "O email é inválido!"]);
        exit;
    }

    //Atualiza o email do usuário
    $query = "UPDATE usuarios SET email = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $email);
    $stmt->bindParam(2, $username);
    $resultado = $stmt->execute();
    
    //Verifica se a atualização do nome deu certo
    if ($resultado) {
        echo json_encode(["sucesso" => "true", "mensagem" => "Email alterado com sucesso!"]);
    }
    else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Erro ao alterar o email do usuário!"]);
    }

} catch (Exception $e) {
    echo json_encode([
        "sucesso" => "false",
        //"mensagem" => "Exceção: " . $e->getMessage()
        "mensagem" => "Erro no servidor"
    ]);
}
?>