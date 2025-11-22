<?php

require_once("configsession.php");
include_once("conexao.php");

$conn = conexao();

try {

    // Campos obrigatórios
    if (!isset($_POST["login"]) || empty($_POST["login"])) {
        header("Location: ../pages/signin.php?erro=2"); // login não enviado
        exit;
    }

    if (!isset($_POST["senha"]) || empty($_POST["senha"])) {
        header("Location: ../pages/signin.php?erro=3"); // senha não enviada
        exit;
    }

    $login = $_POST["login"];
    $senha = md5($_POST["senha"]);

    // Validação
    $sql = "SELECT u.id, u.username, u.nome
            FROM usuarios u 
            INNER JOIN status st ON st.usuario = u.id
            WHERE (u.username = :login OR u.email = :login)
            AND u.senha = :senha";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":login", $login);
    $stmt->bindParam(":senha", $senha);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {

        // sessão já é iniciada no config_session.php
        $_SESSION["usuario_id"] = $resultado["id"];
        $_SESSION["nome"] = $resultado["nome"];
        $_SESSION["username"] = $resultado["username"];

        header("Location: ../pages/perfil.php");
        exit;
    } 
    else {
        header("Location: ../pages/signin.php?erro=1"); // usuário/senha inválidos
        exit;
    }

} catch (Exception $e) {

    header("Location: ../pages/signin.php?erro=4");
    exit;
}

