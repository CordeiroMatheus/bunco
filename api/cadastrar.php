<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

function validarCadastro($nome, $username, $email, $senha) {

    if (empty($nome) || empty($username) || empty($email) || empty($senha)) {
        return false;
    }

    // Username não pode ter espaço
    if (strpos($username, ' ') !== false || strpos($nome, ' ') !== false) {
        return false;
    }

    // Email válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    // Nome e username: mínimo 4 caracteres
    if (strlen($nome) < 4 || strlen($username) < 4) {
        return false;
    }

    // Senha: mínimo 4 caracteres
    if (strlen($senha) < 4) {
        return false;
    }

    // Nome e username: máximo 30 caracteres
    if (strlen($nome) > 30 || strlen($username) > 30) {
        return false;
    }

    // Email: máximo 254 caracteres
    if (strlen($email) > 254) {
        return false;
    }
    return true;
}

try {
    //Verifica se os campos foram passados
    if (isset($_POST["username"])) {
        $username = trim($_POST["username"]);
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Username ausente"]);
        exit;
    }

    if (isset($_POST["nome"])) {
        $nome = trim($_POST["nome"]);
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Nome ausente"]);
        exit;
    }

    if (isset($_POST["email"])) {
        $email = trim($_POST["email"]);
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Email ausente"]);
        exit;
    }

    if (isset($_POST["senha"])) {
        $senha = trim($_POST["senha"]);
        $senha = md5($senha);
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Senha ausente"]);
        exit;
    }
    if (!validarCadastro($nome, $username, $email, $senha)) {
        echo json_encode(["sucesso" => "false", "mensagem" => "Cadastro inválido!"]);
        exit;
    }

    // Verificar se o username já existe
    $query = "SELECT id FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        echo json_encode([
            "sucesso" => "false",
            "mensagem" => "Username já cadastrado"
        ]);
        exit;
    }

    // Verificar se o email já existe
    $query = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $email);
    $stmt->execute();
    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        echo json_encode([
            "sucesso" => "false",
            "mensagem" => "Email já cadastrado"
        ]);
        exit;
    }

    // INSERÇÃO DE NOVO USUÁRIO
    $query = "INSERT INTO usuarios(username, nome, email, senha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $nome);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $senha);
    $resultado = $stmt->execute();

    if (!$resultado) {
        echo json_encode(["sucesso" => "false", "mensagem" => "Erro ao inserir usuário"]);
        exit;
    }

    // Buscar ID do novo usuário
    $query = "SELECT id FROM usuarios WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $username);
    $stmt->execute();

    $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

    //Insere os dados na tabela status
    foreach ($resultado as $r) {
        $query = "INSERT INTO status(usuario) VALUES (?)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $r->id, PDO::PARAM_INT);
        $resultado = $stmt->execute();
    }

    $arr = [];
    if ($resultado) {
        $arr["sucesso"] = "true";
    } else {
        $arr["sucesso"] = "false";
        $arr["mensagem"] = "Erro ao cadastrar o status do usuário";
    }
    echo json_encode($arr);

} catch (Exception $e) {
    echo json_encode([
        "sucesso" => "false",
        //"mensagem" => "Exceção: " . $e->getMessage()
        "mensagem" => "Erro do servidor! Tente novamente mais tarde!"
    ]);
}
