function abrirModalAvisoCadastro(mensagem){
    document.querySelector('#modalOverlay').style.display = "flex"
    document.querySelector('#modalTitle').textContent = "Aviso"
    document.querySelector('#aviso').textContent = mensagem
    document.querySelector('.modal').style.width = "30%"
}

function confirmarAviso(){
    document.querySelector('#modalOverlay').style.display = "none"
}

document.getElementById('btnCadastro').addEventListener('click', function(e) {
            e.preventDefault(); // Impede o envio tradicional do formulário
            
            // Coletar dados do formulário
            const nome = document.getElementById('nomeusuariotxt').value.trim();
            const username = document.getElementById('apelidotxt').value.trim();
            const email = document.getElementById('emailtxt').value.trim().toLowerCase();
            const senha = document.getElementById('senha').value.trim();

            if (!nome || !username || !email || !senha) {
            abrirModalAvisoCadastro("Preencha todos os campos!")
            return;
            }
            if (username.includes(' ')) {
    abrirModalAvisoCadastro("Username não pode conter espaços!")
    return;
}

const regex = /^[\w\.-]+@[\w\.-]+\.\w+$/;
if (!regex.test(email)) {
  abrirModalAvisoCadastro("Digite um email válido!")
    return;
}

const regexUser = /^[a-zA-Z0-9_]{4,}$/
    if (!regexUser.test(username)) {
        abrirModalAvisoCadastro("Insira um username válido! Apenas letras, números e underline (_), e no mínimo 4 caracteres!")
        return;
    }

if (nome.length < 4) {
    abrirModalAvisoCadastro("Nome precisa ter no mínimo 4 caracteres!")
    return;
}

if (senha.length < 4) {
    abrirModalAvisoCadastro("Senha precisa ter no mínimo 4 caracteres!")
    return;
}
            
            // Enviar requisição para o PHP
            fetch('php/cadastrar.php', {
                headers:{
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                credentials: "include",
                method: 'POST',
                body: `username=${encodeURIComponent(username)}&nome=${encodeURIComponent(nome)}&senha=${encodeURIComponent(senha)}&email=${encodeURIComponent(email)}`,
            })
            .then(response => {
                // Verificar se a resposta é JSON
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                }
                throw new TypeError("Resposta não é JSON");
            })
            .then(data => {    
                // Mostrar mensagem de acordo com a resposta
                if(data.sucesso === "true") {
                    abrirModalAvisoCadastro("Cadastro feito com sucesso!")
                    // Limpar formulário
                    document.getElementById('formCadastro').reset();
                } else {
                    abrirModalAvisoCadastro(data.mensagem)
                }
            })
            .catch(error => {
                abrirModalAvisoCadastro("Algo deu errado ao fazer o cadastro!")
            });
        });