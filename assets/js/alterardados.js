let icones = document.querySelector('#icon')
let opcoesAlterar = document.querySelectorAll('.alterar')
opcoesAlterar.forEach(
    opcao => {
        opcao.addEventListener('click', ()=>{
            const texto = opcao.textContent
            if(texto === "Alterar nome"){
                abrirModal(texto)
                icones.src = "../assets/img/icones/user.svg"
            }
            if (texto === "Alterar username"){
                abrirModal(texto)
                icones.src = "../assets/img/icones/user.svg"
            }
            if (texto === "Alterar email"){
                abrirModal(texto)
                icones.src = "../assets/img/icones/email.svg"
            }
            if (texto === "Alterar senha"){
                abrirModalSenha()
            }
            if (texto === "Alterar links"){
                abrirModalLinks()
            }
        })
    }
)

let alterarNome = document.querySelector('#alterar-nome')
let btn = alterarNome.addEventListener('click', abrirModal())

function abrirModal(titulo){
    document.querySelector('#modalTitle').textContent = titulo
    let input = document.querySelector('#modalInput')
    input.placeholder = titulo
    document.querySelector('#campopadrao').style.display = "flex"
    document.querySelector('.modal-overlay').style.display = "flex"
    document.querySelector('#camposenha').style.display = "none"
    document.querySelector('#campolink').style.display = "none"
    document.querySelector('#campocor').style.display = "none"
    document.querySelector('#campoimagem').style.display = "none"
    document.querySelector('.modal').style.width = "30%"
}

function abrirModalSenha(){
    document.querySelector('#modalTitle').textContent = "Alterar senha"
    document.querySelector('.modal-overlay').style.display = "flex"
    document.querySelector('#camposenha').style.display = "flex"
    document.querySelector('#campopadrao').style.display = "none"
    document.querySelector('#campolink').style.display = "none"
    document.querySelector('#campocor').style.display = "none"
    document.querySelector('#campoimagem').style.display = "none"
    document.querySelector('.modal').style.width = "30%"
    
}

function abrirModalLinks(){
    document.querySelector('#modalTitle').textContent = "Alterar links"
    document.querySelector('.modal-overlay').style.display = "flex"
    document.querySelector('#campolink').style.display= "flex"
    document.querySelector('#campopadrao').style.display = "none"
    document.querySelector('#camposenha').style.display = "none"
    document.querySelector('#campocor').style.display = "none"
    document.querySelector('#campoimagem').style.display = "none"
    document.querySelector('.modal').style.width = "30%"
    
}

function confirmarAlteracao(){
    let titulo = document.querySelector('#modalTitle').textContent
    if(titulo === "Alterar senha"){
        let atual = document.querySelector('#senhaAtual').value
        let nova = document.querySelector('#novaSenha').value
        let confirmar = document.querySelector('#confirmarSenha').value
        if (nova !== confirmar) {
            alert("A nova senha e a confirmação não coincidem!");
            return;
        }
        fetch("../api/alterarSenha.php",{
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            credentials: "include",
            body: `senhaatual=${encodeURIComponent(atual)}&senhanova=${encodeURIComponent(nova)}`
            
        })
        .then(res => res.json())
        .then(data => {
        if (data.sucesso === true) {
            alert(data.mensagem);
            window.location.reload()
        } else {
            alert("Erro: " + data.mensagem);
        }
        })
        .catch(err => {
            alert("Erro na requisição: " + err.message);
        });

    }
    if (titulo === "Alterar links"){ 
        let github = document.querySelector('#linkGithub').value
        let linkedin = document.querySelector('#linkLinkedin').value
        let instagram = document.querySelector('#linkInstagram').value
        fetch("../api/alterarLinks.php",{
            method: "POST",
            headers:{
                "Content-Type": "application/x-www-form-urlencoded"
            },
            credentials: "include",
            body: `github=${encodeURIComponent(github)}&linkedin=${encodeURIComponent(linkedin)}&instagram=${encodeURIComponent(instagram)}`
        })
        .then(res => res.json())
        .then(data => {
        if (data.sucesso === true) {
            alert(data.mensagem);
            window.location.reload()
        } else {
            alert("Erro: " + data.mensagem);
        }
        })
        .catch(err => {
            alert("Erro na requisição: " + err.message);
        });
    }
    if(titulo === "Alterar username"){ 
        let valor = document.querySelector('#modalInput').value
        fetch("../api/alterarUsername.php",{
            method: "POST",
            headers:{
                "Content-Type": "application/x-www-form-urlencoded"
            },
            credentials: "include",
            body: `usernamenovo=${encodeURIComponent(valor)}`
        })
        .then(res => res.json())
        .then(data => {
        if (data.sucesso === true) {
            alert(data.mensagem);
            window.location.reload()
        } else {
            alert("Erro: " + data.mensagem);
        }
        })
        .catch(err => {
            alert("Erro na requisição: " + err.message);
        });
    }
    if(titulo === "Alterar nome"){
        let valor = document.querySelector('#modalInput').value
        fetch("../api/alterarNome.php",{
            method: "POST",
            headers:{
                "Content-Type": "application/x-www-form-urlencoded"
            },
            credentials: "include",
            body: `nomenovo=${encodeURIComponent(valor)}`
        })
        .then(res => res.json())
        .then(data => {
        if (data.sucesso === true) {
            alert(data.mensagem);
            window.location.reload()
        } else {
            alert("Erro: " + data.mensagem);
        }
        })
        .catch(err => {
            alert("Erro na requisição: " + err.message);
        });
    }
    if(titulo === "Alterar email"){
        let valor = document.querySelector('#modalInput').value
        fetch("../api/alterarEmail.php",{
            method: "POST",
            headers:{
                "Content-Type": "application/x-www-form-urlencoded"
            },
            credentials: "include",
            body: `email=${encodeURIComponent(valor)}`
        })
        .then(res => res.json())
        .then(data => {
        if (data.sucesso === true) {
            alert(data.mensagem);
            window.location.reload()
        } else {
            alert("Erro: " + data.mensagem);
        }
        })
        .catch(err => {
            alert("Erro na requisição: " + err.message);
        });
    }
}

function fecharModal(){
    document.querySelector('.modal-overlay').style.display = "none"
}

fecharModal()