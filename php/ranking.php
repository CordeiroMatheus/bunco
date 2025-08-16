<?php 
session_start();
header("Content-Type: application/json");
include_once("conexao.php");
$conn = conexao();

try {
    if (isset($_SESSION["usuario_id"])) {
    $id = $_SESSION["usuario_id"];
    } else {
        echo json_encode(["sucesso" => false, "mensagem" => "Usuário não está logado!"]);
        exit;
    }

    //Seleciona os primeiros
    $sql = "SELECT u.id, u.username, u.nome, u.email, u.foto, u.cor, u.link_github, u.link_instagram, u.link_linkedin,
    st.vidas, st.ofensiva, st.xp FROM usuarios u INNER JOIN status st ON st.usuario = u.id ORDER BY st.xp DESC LIMIT 10";
    $stmt = $conn->query($sql);
    $primeiros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Pega o XP do usuário atual
    $sql = "SELECT u.username, st.xp FROM usuarios u INNER JOIN status st ON st.usuario = u.id WHERE u.id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$dadosUsuario) {
        echo json_encode(["sucesso" => false, "mensagem" => "Usuário não encontrado no ranking!"]);
        exit;
    }

    $username = $dadosUsuario['username'];
    $xpUsuario = (int)$dadosUsuario['xp'];

    // Conta quantos usuários têm mais XP que o usuário atual
    $sql = "SELECT COUNT(*) AS acima FROM status WHERE xp > :xp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":xp", $xpUsuario);
    $stmt->execute();
    $posicao = $stmt->fetchColumn() + 1;

    echo json_encode([
        "primeiros" => $primeiros,
        "voce" => [
            "posicao" => $posicao,
            "username" => $username,
            "xp" => $xpUsuario
        ]
    ]);

} catch (Exception $e) {
    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Exceção: " . $e->getMessage()
        //"mensagem" => "Erro do servidor! Tente novamente mais tarde!"
    ]);
}
?>