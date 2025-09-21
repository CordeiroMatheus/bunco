<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/formstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" href="../assets/img/buncosilhueta.svg">
    <title>Login</title>
</head>

<body>
    <?php 
    include_once("../php/perderVida.php");
    include_once("../php/conexao.php");
    session_start();
    if (isset($_SESSION["usuario_id"])) {
        $conn = conexao();
        atualizarOfensiva($_SESSION["usuario_id"], $conn);
        header("Location: perfil.php");
        exit;
    }
    ?>
    <div class="modal-overlay" id="modalOverlay" onclick="fecharModal(event)">
        <div class="modal" onclick="event.stopPropagation()">
          <div id="top-modal">
            <div class="circles">
                <div id="red" class="circle"></div>
                <div id="orange" class="circle"></div>
                <div id="green" class="circle"></div>
            </div>
            <h2 id="modalTitle">Aviso</h2>
          </div>
          <div id="campoaviso" class="campos">
            <p id="aviso"></p>
            <button onclick="confirmarAviso()">Ok</button>
          </div>
        </div>
    </div>
    <div class="container">
        <div class="signin-image">
        </div>
        <div class="form">
            <h1>Entrar</h1>
            <form action="../php/login.php" method="post">
                <div class="input-group">
                    <div class="input-box">
                        <i class="fas fa-user"></i>
                        <input type="text" name="login" id="email" placeholder="E-mail ou username" required>
                    </div>

                    <div class="input-box">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="senha" id="senha" placeholder="Senha" minlength="4" maxlength="16" required>
                        <p id="opcaosenha"><i class="fa-solid fa-eye" id="openedeye"></i><i class="fa-solid fa-eye-slash" id="closedeye"></i></p>
                    </div>

                    <div class="continue-button">
                        <button type="submit">Entrar</button>
                    </div>
                </div>
            </form>
            <div class="redirect">
                <p>Ainda não tem uma conta? <a href="signup.html"><span class="redirect-text">Cadastre-se</span></a></p>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', ()=>{
            document.querySelector('#modalOverlay').style.display = "none"
        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', ()=>{
            const params = new URLSearchParams(window.location.search)
            const erro = params.get("erro")

            if (erro) {
                let mensagem = ""
                switch (erro) {
                    case "1":
                        mensagem = "Usuário ou senha inválidos."
                        break
                    case "2":
                        mensagem = "Campo de login não enviado."
                        break
                    case "3":
                        mensagem = "Campo de senha não enviado."
                        break;
                    case "4":
                        mensagem = "Erro interno. Tente novamente mais tarde."
                        break
                    default:
                        mensagem = "Erro desconhecido."
                }
                abrirModal(mensagem)
            }
        });

        function abrirModal(mensagem) {
            const modal = document.getElementById("modalOverlay")
            const aviso = document.getElementById("aviso")

            aviso.innerText = mensagem;
            modal.style.display = "flex"
        }

        function fecharModal(event) {
            if (event.target.id === "modalOverlay") {
                document.getElementById("modalOverlay").style.display = "none"
            }
        }

        function confirmarAviso() {
            document.getElementById("modalOverlay").style.display = "none"
            window.location.href = "signin.php"
        }
    </script>
    <script src="../assets/js/mostrarsenha.js"></script>
</body>
</html>