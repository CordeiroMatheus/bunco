<?php 
require_once "headers/headers.php";
include_once("conexao.php");
$conn = conexao();

function validarUsername($usernameNovo, $usernameAtual) {

    if (empty($usernameNovo) || empty($usernameAtual)) {
        return false;
    }

    if ($usernameNovo === $usernameAtual) {
        return false;
    }

    // Deve ter entre 4 e 30 caracteres
    if (strlen($usernameNovo) < 4 || strlen($usernameNovo) > 30) {
        return false;
    }

    // Não pode conter espaços
    if (strpos($usernameNovo, ' ') !== false) {
        return false;
    }

    return true;
}
try {
    //Verifica se os campos foram passados
    if (isset($_POST["usernamenovo"])) {
        $usernameNovo = trim($_POST["usernamenovo"]);
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu o username novo!"]);
        exit;
    }
    if (isset($_POST["username"])) {
        $username = trim($_POST["username"]);
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Usuário não está logado!"]);
        exit;
    }
    if (!validarUsername($usernameNovo, $username)) {
        echo json_encode(["sucesso" => "false", "mensagem" => "O username novo é inválido"]);
        exit;
    }

    //Atualiza o username do usuário
    $query = "UPDATE usuarios SET username = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $usernameNovo);
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