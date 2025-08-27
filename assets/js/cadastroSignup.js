let statusCadastro = false

function abrirModalAvisoCadastro(mensagem){
    document.querySelector('#modalOverlay').style.display = "flex"
    document.querySelector('#modalTitle').textContent = "Aviso"
    document.querySelector('#aviso').textContent = mensagem
    document.querySelector('.modal').style.width = "30%"
}

function confirmarAviso(){
    document.querySelector('#modalOverlay').style.display = "none"
    if (statusCadastro) {
        statusCadastro = false
        window.location.href = "signin.php"
    }
}

document.getElementById('formCadastro').addEventListener('submit', function(e) {
    e.preventDefault(); // Impede o envio tradicional do formulário
    
    // Coletar dados dos campos
    const nome = document.getElementById('nome').value.trim();
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim().toLowerCase();
    const senha = document.getElementById('senha').value.trim();

    // Validações
    if (!nome || !username || !email || !senha) {
        abrirModalAvisoCadastro("Preencha todos os campos!");
        return;
    }

    if (senha.length < 4) {
        abrirModalAvisoCadastro("Senha precisa ter no mínimo 4 caracteres!")
        return;
    }

    if (username.includes(' ')) {
        abrirModalAvisoCadastro("Username não pode conter espaços!");
        return;
    }

    const regex = /^[\w\.-]+@[\w\.-]+\.\w+$/;
    if (!regex.test(email)) {
        abrirModalAvisoCadastro("Digite um email válido!");
        return;
    }

    if (nome.length < 4) {
        abrirModalAvisoCadastro("Nome precisa ter no mínimo 4 caracteres!");
        return;
    }

    const regexUser = /^[a-zA-Z0-9_]{4,}$/
    if (!regexUser.test(username)) {
        abrirModalAvisoCadastro("Insira um username válido! Apenas letras, números e underline (_), e no mínimo 4 caracteres!")
        return;
    }
    
    // Enviar requisição para o PHP
    fetch('../php/cadastrar.php', {
        headers:{
            "Content-Type": "application/x-www-form-urlencoded"
        },
        credentials: "include",
        method: 'POST',
        body: `nome=${encodeURIComponent(nome)}&username=${encodeURIComponent(username)}&senha=${encodeURIComponent(senha)}&email=${encodeURIComponent(email)}`,
    })
    .then(response => {
        // Verificar se a resposta é JSON
        if (response.ok) {
            return response.json();
        }
        throw new Error(`Erro no servidor: ${response.status}`);
    })
    .then(data => {
        // Mostrar mensagem de acordo com a resposta
        if(data.sucesso === "true") {
            abrirModalAvisoCadastro("Cadastro feito com sucesso!")
            statusCadastro = true
        } else {
            abrirModalAvisoCadastro(data.mensagem || "Erro desconhecido no cadastro");
        }
    })
    .catch(error => {
        abrirModalAvisoCadastro("Algo deu errado ao fazer o cadastro!");
    });
});