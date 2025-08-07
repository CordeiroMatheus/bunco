function abrirModalAvisoCadastro(mensagem){
    document.querySelector('#modalOverlay').style.display = "flex"
    document.querySelector('#modalTitle').textContent = "Aviso"
    document.querySelector('#aviso').textContent = mensagem
    document.querySelector('.modal').style.width = "30%"
}

function confirmarAviso(){
    window.location.reload()
}

document.getElementById('formCadastro').addEventListener('submit', function(e) {
    e.preventDefault(); // Impede o envio tradicional do formulário
    
    // Coletar dados dos campos
    const nome = document.getElementById('nome').value.trim();
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const senha = document.getElementById('senha').value.trim();

    // Validações
    if (!nome || !username || !email || !senha) {
        abrirModalAvisoCadastro("Preencha todos os campos!");
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

    if (nome.length < 4 || username.length < 4) {
        abrirModalAvisoCadastro("Nome e username precisam ter no mínimo 4 caracteres");
        return;
    }
    
    // Criar objeto FormData
    const formData = new FormData(this);
    
    // Enviar requisição para o PHP
    fetch('../php/cadastrar.php', {
        method: 'POST',
        body: formData
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
            abrirModalAvisoCadastro("Cadastro feito com sucesso!");
            
            // Limpar formulário
            this.reset();
        } else {
            abrirModalAvisoCadastro(data.mensagem || "Erro desconhecido no cadastro");
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        abrirModalAvisoCadastro(`Erro na comunicação com o servidor: ${error.message}`);
    });
});