<?php 
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
    if (isset($_POST["email"])) {
        $email = $_POST["email"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu o nome novo!"]);
        exit;
    }

    //Atualiza o nome do usuário
    $query = "UPDATE usuarios SET email = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $email);
    $stmt->bindParam(2, $username);
    $resultado = $stmt->execute();
    
    //Verifica se a atualização do nome deu certo
    if ($resultado) {
        echo json_encode(["sucesso" => "true", "mensagem" => "Email alterado com sucesso! Você será deslogado para os dados serem atualizados!"]);
    }
    else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Erro ao alterar o email do usuário!"]);
    }

} catch (Exception $e) {
    echo json_encode([
        "sucesso" => "false",
        "mensagem" => "Exceção: " . $e->getMessage()
    ]);
}
?>