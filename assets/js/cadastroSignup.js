document.getElementById('formCadastro').addEventListener('submit', function(e) {
    e.preventDefault(); // Impede o envio tradicional do formulário
    
    // Coletar dados dos campos
    const nome = document.getElementById('nome').value.trim();
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const senha = document.getElementById('senha').value.trim();

    // Validações
    if (!nome || !username || !email || !senha) {
        alert("Preencha todos os campos!");
        return;
    }

    if (username.includes(' ')) {
        alert("Username não pode conter espaços!");
        return;
    }

    const regex = /^[\w\.-]+@[\w\.-]+\.\w+$/;
    if (!regex.test(email)) {
        alert("Digite um email válido!");
        return;
    }

    if (nome.length < 4 || username.length < 4) {
        alert("Nome e username precisam ter no mínimo 4 caracteres");
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
            alert("Cadastro feito com sucesso!");
            
            // Limpar formulário
            this.reset();
        } else {
            alert(data.mensagem || "Erro desconhecido no cadastro");
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert(`Erro na comunicação com o servidor: ${error.message}`);
    });
});