<?php 
require_once "headers/headers.php";
include_once("conexao.php");
$conn = conexao();

function validarNome($nome) {
    if (empty($nome)) {
        return false;
    }
    if (strlen($nome) < 4 || strlen($nome) > 30) {
        return false;
    }
    if (strpos($nome, " ")) {
        return false;
    }
    return true;
}

try {
    //Verifica se os campos foram passados
    if (isset($_POST["username"])) {
        $username = $_POST["username"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Usuário não está logado!"]);
        exit;
    }
    if (isset($_POST["nomenovo"])) {
        $nomenovo = trim($_POST["nomenovo"]);
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu o nome novo!"]);
        exit;
    }
    if (!validarNome($nomenovo)) {
        echo json_encode(["sucesso" => "false", "mensagem" => "O nome novo é inválido!"]);
        exit;
    }

    //Atualiza o nome do usuário
    $query = "UPDATE usuarios SET nome = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $nomenovo);
    $stmt->bindParam(2, $username);
    $resultado = $stmt->execute();
    
    //Verifica se a atualização do nome deu certo
    if ($resultado) {
        echo json_encode(["sucesso" => "true", "mensagem" => "Nome alterado com sucesso!"]);
    }
    else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Erro ao alterar o nome do usuário!"]);
    }

} catch (Exception $e) {
    echo json_encode([
        "sucesso" => "false",
        //"mensagem" => "Exceção: " . $e->getMessage()
        "mensagem" => "Erro no servidor"
    ]);
}
?>