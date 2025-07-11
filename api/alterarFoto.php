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
    if (isset($_POST["foto"])) {
        $foto = $_POST["foto"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu a foto nova!"]);
        exit;
    }

    //Atualiza a foto do usuário
    $query = "UPDATE usuarios SET foto = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $foto);
    $stmt->bindParam(2, $username);
    $resultado = $stmt->execute();
    
    //Verifica se a atualização do nome deu certo
    if ($resultado) {
        echo json_encode(["sucesso" => "true", "mensagem" => "Foto alterada com sucesso!"]);
    }
    else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Erro ao alterar a foto do usuário!"]);
    }

} catch (Exception $e) {
    echo json_encode([
        "sucesso" => "false",
        //"mensagem" => "Exceção: " . $e->getMessage()
        "mensagem" => "Erro no servidor"
    ]);
}
?>