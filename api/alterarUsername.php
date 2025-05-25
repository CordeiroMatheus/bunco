<?php 
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
    if (isset($_POST["id"])) {
        $id = $_POST["id"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu o username novo!"]);
        exit;
    }

    //Atualiza o nome do usuário
    $query = "UPDATE usuarios SET username = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $usernamenovo);
    $stmt->bindParam(2, $id);
    $resultado = $stmt->execute();
    
    //Verifica se a atualização do nome deu certo
    if ($resultado) {
        echo json_encode(["sucesso" => "true", "mensagem" => "Username alterado com sucesso! Você será deslogado para os dados serem atualizados!"]);
    }
    else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Erro ao alterar o username do usuário!"]);
    }

} catch (Exception $e) {
    echo json_encode([
        "sucesso" => "false",
        "mensagem" => "Exceção: " . $e->getMessage()
    ]);
}
?>