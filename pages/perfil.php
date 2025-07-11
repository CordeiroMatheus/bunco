<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/img/buncosilhueta.svg">
    <link rel="stylesheet" href="../assets/css/perfil.css">
    <title>Perfil</title>
  </head>
  <body>
    <?php session_start(); ?>
    <?php

      if (!isset($_SESSION["usuario_id"])) {

          header("Location: signin.html");
          exit;
      }

      include_once("../php/conexao.php");
      $conn = conexao();

      $usuario_id = $_SESSION["usuario_id"];

      $sql = "SELECT u.username, u.nome, u.email, u.foto, u.cor, u.link_github, u.link_instagram, u.link_linkedin,
              st.vidas, st.ofensiva, st.xp
              FROM usuarios u 
              INNER JOIN status st ON st.usuario = u.id
              WHERE u.id = :id";

      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":id", $usuario_id);
      $stmt->execute();

      $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$usuario) {
    die("Usuário não encontrado");
}
?>
    <div id="container">
      <div id="settings-container">
        <div id="settings">
          <div id="config-icon">
            <img src="../assets/img/icones/config.svg" alt="Configurações">
          </div>
          <h2 id="titulo">Configurações</h2>
          <div id="settings-options">
            <div id="opcoes-alterar">
              <div id="alterar-nome" class="alterar">Alterar nome</div>
              <div id="alterar-username" class="alterar">Alterar username</div>
              <div id="alterar-email" class="alterar">Alterar email</div>
              <div id="alterar-senha" class="alterar">Alterar senha</div>
              <div id="alterar-links" class="alterar">Alterar links</div>
            </div>
            <div id="opcoes-conta">
              <div id="sair">
                <input type="button" class="opcoes-btn" id="btnsair" value="sair da conta">
              </div>
              <div id="excluir">
                <input type="button" class="opcoes-btn" id="btnexcluir" value="excluir a conta">
              </div>
            </div>
          </div>
          <div id="ranking">
            <h1><img src="../assets/img/icones/Troféu.svg" alt="">Ranking</h1>
          </div>
        </div>
      </div>
      <div id="profile-container">
        <div id="profile">
          <div id="profile-info">
            <div id="profile-user">
              <div id="profile-img" style="background-color: #<?php echo htmlspecialchars($usuario['cor']); ?>;">
                <img src="../assets/img/<?php echo htmlspecialchars($usuario['foto']); ?>" alt="profile-img" id="img-profile">
              </div>
              <div id="names">
                <div id="name">
                  <h1 id=""><?php echo htmlspecialchars($usuario['nome']); ?></h1>
                </div>
                <div id="username">
                  <h5 id="">@<?php echo htmlspecialchars($usuario['username']); ?></h5>
                </div>
              </div>
            </div>
            <div id="profile-options">
              <div id="alterar-img">
                <img src="../assets/img/icones/editarfoto.svg" alt="alterar-imagem">
              </div>
              <div id="alterar-cor">
                <img src="../assets/img/icones/editar.svg" alt="alterar-cor">
              </div>
            </div>
          </div>
          <div id="profile-status">
            <div id="xp" class="status">
              <img src="../assets/img/icones/xp.svg" alt="user_xp">
              <div id="numero-xp"><?php echo $usuario['xp']; ?>  <span>xp</span></div>
              <div>Quantidade de xp</div>
            </div>
            <div id="coracao" class="status">
              <img src="../assets/img/icones/vidas.svg" alt="user_life">
              <div id="numero-vidas"><?php echo $usuario['vidas']; ?>  <span>corações</span></div>
              <div>Quantidade de vidas</div>
            </div>
            <div id="ofensiva" class="status">
              <img src="../assets/img/icones/ofensiva.svg" alt="user_ofensive">
              <div id="numero-ofensiva"><?php echo $usuario['ofensiva']; ?> <span>dias</span></div>
              <div>Dias de ofensiva</div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-overlay" id="modalOverlay" onclick="fecharModal(event)">
        <div class="modal" onclick="event.stopPropagation()">
          <div id="top-modal">
            <div class="circles">
                <div id="red" class="circle"></div>
                <div id="orange" class="circle"></div>
                <div id="green" class="circle"></div>
            </div>
            <h2 id="modalTitle">Título</h2>
          </div>
          <div id="campopadrao" class="campos">
            <p><img src="../assets/img/icones/user.svg" alt="formicon" id="icon"><input type="text" id="modalInput" placeholder="alterar"></p>
            <p><button onclick="confirmarAlteracao()">Confirmar</button></p>
          </div>

          <div id="camposenha" class="campos">
            <p><img src="../assets/img/icones/lock.svg" alt="senhaAtual"><input type="password" id="senhaAtual" class="inputssenha" placeholder="Senha atual"></p>
            <p><img src="../assets/img/icones/key.svg" alt="novaSenha"><input type="password" id="novaSenha" class="inputssenha" placeholder="Nova senha"></p>
            <p><img src="../assets/img/icones/key.svg" alt="confirmarSenha"><input type="password" id="confirmarSenha" class="inputssenha" placeholder="Confirmar nova senha"></p>
            <p><button onclick="confirmarAlteracao()">Confirmar</button></p>
          </div>

          <div id="campolink" class="campos">
            <p><img src="../assets/img/icones/github.svg" alt="github" style="width: 18px; color: #fff;"><input type="text" id="linkGithub" placeholder="Digite seu link do Github"></p>
            <p><img src="../assets/img/icones/linkedin.svg" alt="linkedin" style="width: 18px; color: #fff;"><input type="text" id="linkLinkedin" placeholder="Digite seu link do LinkedIn"></p>
            <p><img src="../assets/img/icones/instagram.svg" alt="instagram" style="width: 18px; color: #fff;"><input type="text" id="linkInstagram" placeholder="Digite seu link do Instagram"></p>
            <button onclick="confirmarAlteracao()">Confirmar</button>
          </div>

          <div id="campocor" class="campos">
                <div id="prealterar-cor">
                    <img src="../assets/img/" alt="profile-img" id="prealterarcorimg">
                </div>
            <div id="cores">
                <div id="cinzaclaro" class="opcaocores" style="background-color: #f8f9fa;"></div>
                <div id="cinzaclaro" class="opcaocores" style="background-color: #f8f9fa;"></div>
                <div id="cinzamédio" class="opcaocores" style="background-color: #e0e0e0;"></div>
                <div id="cinzaazulado" class="opcaocores" style="background-color: #b0bec5;"></div>
                <div id="cinzaescuro" class="opcaocores" style="background-color: #607d8b;"></div>
                <div id="branco" class="opcaocores" style="background-color: #ffffff;"></div>
                <div id="preto" class="opcaocores" style="background-color: #000000;"></div>
                <div id="vermelho" class="opcaocores" style="background-color: #ff5252;"></div>
                <div id="laranja" class="opcaocores" style="background-color: #ff9800;"></div>
                <div id="amarelo" class="opcaocores" style="background-color: #ffeb3b;"></div>
                <div id="verde" class="opcaocores" style="background-color: #4caf50;"></div>
                <div id="azul" class="opcaocores" style="background-color: #2196f3;"></div>
                <div id="azulescuro" class="opcaocores" style="background-color: #3f51b5;"></div>
                <div id="roxo" class="opcaocores" style="background-color: #9c27b0;"></div>
                <div id="rosa" class="opcaocores" style="background-color: #e91e63;"></div>
                <div id="marrom" class="opcaocores" style="background-color: #795548;"></div>
            </div>
            <button onclick="confirmarCor()">Confirmar</button>
          </div>

            <div id="campoimagem" class="campos">
                    <div id="prealterar-img">
                        <img src="../assets/img/" alt="profile-img" id="prealterarimg"> 
                    </div>

                    <div id="imagens">
                        <div id="buncocavalheiro" class="opcaoimg"><img src="../assets/img/buncocavalheiro.svg" class="opcaoimagens" alt="buncocavalheiro"></div>
                        <div id="buncolegal" class="opcaoimg"><img src="../assets/img/buncolegal.svg" alt="buncolegal" class="opcaoimagens"></div>
                        <div id="buncoandroid" class="opcaoimg"><img src="../assets/img/buncoandroid.svg" alt="buncoandroid" class="opcaoimagens"></div>
                        <div id="buncoapple" class="opcaoimg"><img src="../assets/img/buncoapple.svg" alt="buncoapple" class="opcaoimagens"></div>
                        <div id="buncoduolingo" class="opcaoimg"><img src="../assets/img/buncoduolingo.svg" alt="buncoduolingo" class="opcaoimagens"></div>
                        <div id="buncoformando" class="opcaoimg"><img src="../assets/img/buncoformando.svg" alt="buncoformando" class="opcaoimagens"></div>
                        <div id="buncomimo" class="opcaoimg"><img src="../assets/img/buncomimo.svg" alt="buncomimo" class="opcaoimagens"></div>
                    </div>
                    <button onclick="confirmarImagem()">Confirmar</button>
            </div>
        </div>
      </div>

    </div>
    <script src="../assets/js/alterardados.js"></script>
    <script src="../assets/js/trocacor.js"></script>
    <script src="../assets/js/trocaimagem.js"></script>
    <script src="../assets/js/excluir.js"></script>
    <script src="../assets/js/logout.js"></script>
  </body>
</html>