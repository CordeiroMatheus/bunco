<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

function validarLinks($github, $instagram, $linkedin) {
    // Regex igual ao do Dart
    $regexGithub   = "/^https:\/\/(www\.)?github\.com\/[a-zA-Z0-9_-]+\/?$/";
    $regexInstagram = "/^https:\/\/(www\.)?instagram\.com\/[a-zA-Z0-9._]+\/?$/";
    $regexLinkedin  = "/^https:\/\/(www\.)?linkedin\.com\/in\/[a-zA-Z0-9À-ÿ\-_%]+\/?$/i";

    // Github
    if (!empty($github) && !preg_match($regexGithub, $github)) {
        return false;
    }

    // Instagram
    if (!empty($instagram) && !preg_match($regexInstagram, $instagram)) {
        return false;
    }

    // Linkedin
    if (!empty($linkedin) && !preg_match($regexLinkedin, $linkedin)) {
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
    if (isset($_POST["github"])) {
        $github = $_POST["github"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu o link do github!"]);
        exit;
    }
    if (isset($_POST["instagram"])) {
        $instagram = $_POST["instagram"];

    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu o link do instagram!"]);
        exit;
    }

    if (isset($_POST["linkedin"])) {
        $linkedin = $_POST["linkedin"];
    } else {
        echo json_encode(["sucesso" => "false", "mensagem" => "O servidor não recebeu o link do linkedin!"]);
        exit;
    }
    if (!validarLinks($github, $instagram, $linkedin)) {
        echo json_encode(["sucesso" => "false", "mensagem" => "Alguns dos links mandados é inválido!"]);
        exit; 
    }
    
    //Atualizando com os links novos
    $sql = "UPDATE usuarios SET link_github = ?, link_instagram = ?, link_linkedin = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $github);
    $stmt->bindParam(2, $instagram);
    $stmt->bindParam(3, $linkedin);
    $stmt->bindParam(4, $username);
    $resultado = $stmt->execute();

    if ($resultado) {
        echo json_encode(["sucesso" => "true", "mensagem" => "Links alterados com sucesso!"]);
    }
    else {
        echo json_encode(["sucesso" => "false", "mensagem" => "Erro ao alterar os links do usuário!"]);
    }
    
} catch (Exception $e) {
    echo json_encode([
        "sucesso" => "false",
        //"mensagem" => "Exceção: " . $e->getMessage()
        "mensagem" => "Erro no servidor"
    ]);
}
?>