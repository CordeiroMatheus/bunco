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
    if (isset($_POST["senhaatual"])) {
        $senhaatual = $_POST["senhaatual"];
        $senhaatual = md5($senhaatual);
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu a senha atual!"]);
        exit;
    }
    if (isset($_POST["senhanova"])) {
        $senhanova = $_POST["senhanova"];
        $senhanova = md5($senhanova);
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu a senha nova!"]);
        exit;
    }

    //Verificando se a senha atual é a mesma
    $sql = "SELECT * FROM usuarios WHERE username = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $senhaatual);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        echo json_encode(["sucesso" => "false", "mensagem" => "A senha atual está errada! Tente novamente!"]);
        exit;
    }
    
    //Atualizando com a senha nova
    $sql = "UPDATE usuarios SET senha = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $senhanova);
    $stmt->bindParam(2, $username);
    $resultado = $stmt->execute();

    if ($resultado) {
        echo json_encode(["sucesso" => "true", "mensagem" => "Senha alterada com sucesso!"]);
    }
    else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Erro ao alterar a senha do usuário!"]);
    }
    
} catch (Exception $e) {
    echo json_encode([
        "sucesso" => "false",
        //"mensagem" => "Exceção: " . $e->getMessage()
        "mensagem" => "Erro no servidor"
    ]);
}
?>