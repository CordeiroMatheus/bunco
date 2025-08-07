<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" href="../assets/img/buncosilhueta.svg">
    <link rel="stylesheet" href="../assets/css/perfil.css">
    <title>Perfil</title>
  </head>
  <body>
    <?php session_start(); ?>
    <?php

      header("Cache-Control: no-cache, no-store, must-revalidate");
      header("Pragma: no-cache");
      header("Expires: 0");

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
        </div>
      </div>
      <div id="profile-container">
        <div id="profile">
          <div id="profile-info">
            <div id="profile-user">
              <div id="profile-img" style="background-color: #<?php echo htmlspecialchars($usuario['cor']); ?>;">
                <img src="../assets/img/<?php echo htmlspecialchars($usuario['foto'].'.svg'); ?>" alt="profile-img" id="img-profile">
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
            <div id="status-container">
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
          <div id="medal-container">
            <div id="title-container"><h1>Suas Medalhas</h1></div>
            <div id="medals-container">
              <div id="medal-01-name" class="medals"></div>
              <div id="medal-02-name" class="medals"></div>
              <div id="medal-03-name" class="medals"></div>
              <div id="medal-04-name" class="medals"></div>
              <div id="medal-05-name" class="medals"></div>
              <div id="medal-06-name" class="medals"></div>
              <div id="medal-07-name" class="medals"></div>
              <div id="medal-08-name" class="medals"></div>
              <div id="medal-09-name" class="medals"></div>
              <div id="medal-10-name" class="medals"></div>
            </div>
          </div>
          <div id="ranking-container">
            <div id="ranking">
              <h1><img src="../assets/img/icones/Troféu.svg" alt="">Ranking</h1>
              <ol id="lista-ranking"></ol>
            </div>
            <div id="posicao-usuario"></div>
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
            <p><button onclick="confirmarAlteracao()" id= "botaoConfirmar" >Confirmar</button></p>
          </div>

          <div id="camposenha" class="campos">
            <p><img src="../assets/img/icones/lock.svg" alt="senhaAtual"><input type="password" id="senhaAtual" class="inputssenha" placeholder="Senha atual"><span class="opcaosenha"><i class="fa-solid fa-eye"></i><i class="fa-solid fa-eye-slash" class="closedeye"></i></span></p>
            <p><img src="../assets/img/icones/key.svg" alt="novaSenha"><input type="password" id="novaSenha" class="inputssenha" placeholder="Nova senha"><span class="opcaosenha"><i class="fa-solid fa-eye"></i><i class="fa-solid fa-eye-slash" class="closedeye"></i></span></p>
            <p><img src="../assets/img/icones/key.svg" alt="confirmarSenha"><input type="password" id="confirmarSenha" class="inputssenha" placeholder="Confirmar nova senha"><span class="opcaosenha"><i class="fa-solid fa-eye"></i><i class="fa-solid fa-eye-slash" class="closedeye"></i></span></p>
            <p><button onclick="confirmarAlteracao()" id="botaoConfirmarSenha">Confirmar</button></p>
          </div>

          <div id="campolink" class="campos">
            <p><img src="../assets/img/icones/github.svg" alt="github" style="width: 18px; color: #fff;"><input type="text" id="linkGithub" placeholder="Digite seu link do Github"></p>
            <p><img src="../assets/img/icones/linkedin.svg" alt="linkedin" style="width: 18px; color: #fff;"><input type="text" id="linkLinkedin" placeholder="Digite seu link do LinkedIn"></p>
            <p><img src="../assets/img/icones/instagram.svg" alt="instagram" style="width: 18px; color: #fff;"><input type="text" id="linkInstagram" placeholder="Digite seu link do Instagram"></p>
            <button onclick="confirmarAlteracao()" id="botaoConfirmarLinks">Confirmar</button>
          </div>

          <div id="campocor" class="campos">
                <div id="prealterar-cor">
                    <img src="../assets/img/" alt="profile-img" id="prealterarcorimg">
                </div>
            <div id="cores">
                <div id="azulescuro" class="opcaocores" style="background-color: #586892;"></div>
                <div id="verdeagua" class="opcaocores" style="background-color: #0E898B;"></div>
                <div id="azulclaro" class="opcaocores" style="background-color: #7AF0F2;"></div>
                <div id="laranja" class="opcaocores" style="background-color: #FF9600;"></div>
                <div id="amarelo" class="opcaocores" style="background-color: #FFC800;"></div>
                <div id="marrom" class="opcaocores" style="background-color: #E5A259;"></div>
                <div id="vermelho" class="opcaocores" style="background-color: #EA2B2B;"></div>
                <div id="roxo" class="opcaocores" style="background-color: #9069CD;"></div>
                <div id="rosa" class="opcaocores" style="background-color: #FFAADE;"></div>
                <div id="verdeescuro" class="opcaocores" style="background-color: #5EB200;"></div>
                <div id="verdeclaro" class="opcaocores" style="background-color: #A5ED6E;"></div>
                <div id="cinza" class="opcaocores" style="background-color: #8E8E93;"></div>
                <div id="preto" class="opcaocores" style="background-color: #000;"></div>
                <div id="branco" class="opcaocores" style="background-color: #fff;"></div>
            </div>
            <button onclick="confirmarCor()">Confirmar</button>
          </div>

            <div id="campoimagem" class="campos">
                    <div id="prealterar-img">
                        <img src="../assets/img/" alt="profile-img" id="prealterarimg"> 
                    </div>

                    <div id="imagens">
                        <div id="buncodefault" class="opcaoimg"><img src="../assets/img/buncodefault.svg" alt="buncodefault" class="opcaoimagens"></div>
                        <div id="buncocavalheiro" class="opcaoimg"><img src="../assets/img/buncocavalheiro.svg" class="opcaoimagens" alt="buncocavalheiro"></div>
                        <div id="buncolegal" class="opcaoimg"><img src="../assets/img/buncolegal.svg" alt="buncolegal" class="opcaoimagens"></div>
                        <div id="buncoandroid" class="opcaoimg"><img src="../assets/img/buncoandroid.svg" alt="buncoandroid" class="opcaoimagens"></div>
                        <div id="buncoapple" class="opcaoimg"><img src="../assets/img/buncoapple.svg" alt="buncoapple" class="opcaoimagens"></div>
                        <div id="buncoduolingo" class="opcaoimg"><img src="../assets/img/buncoduolingo.svg" alt="buncoduolingo" class="opcaoimagens"></div>
                        <div id="buncoformando" class="opcaoimg"><img src="../assets/img/buncoformando.svg" alt="buncoformando" class="opcaoimagens"></div>
                        <div id="buncomimo" class="opcaoimg"><img src="../assets/img/buncomimo.svg" alt="buncomimo" class="opcaoimagens"></div>
                        <div id="buncodetetive" class="opcaoimg"><img src="../assets/img/buncodetetive.svg" alt="buncodetetive" class="opcaoimagens"></div>
                        <div id="buncofazendeiro" class="opcaoimg"><img src="../assets/img/buncofazendeiro.svg" alt="buncofazendeiro" class="opcaoimagens"></div>
                        <div id="buncoromantico" class="opcaoimg"><img src="../assets/img/buncoromantico.svg" alt="buncoromantico" class="opcaoimagens"></div>
                    </div>
                    <button onclick="confirmarImagem()">Confirmar</button>
            </div>

            <div id="campoaviso" class="campos">
                <p id="aviso"></p>
                <button onclick="confirmarAviso()">Ok</button>
            </div>
            
        </div>
      </div>

    </div>
    <script>
        const dadosUsuario = {
          username: <?= json_encode($usuario["username"]) ?>,
          nome: <?= json_encode($usuario["nome"]) ?>,
          email: <?= json_encode($usuario["email"]) ?>,
          github: <?= json_encode($usuario["link_github"]) ?>,
          linkedin: <?= json_encode($usuario["link_linkedin"]) ?>,
          instagram: <?= json_encode($usuario["link_instagram"]) ?>
      }
    </script>
    <script src="../assets/js/alterardados.js"></script>
    <script src="../assets/js/trocacor.js"></script>
    <script src="../assets/js/trocaimagem.js"></script>
    <script src="../assets/js/excluir.js"></script>
    <script src="../assets/js/logout.js"></script>
    <script src="../assets/js/mostrarsenhaperfil.js"></script>
    <script src="../assets/js/ranking.js"></script>
  </body>
</html>