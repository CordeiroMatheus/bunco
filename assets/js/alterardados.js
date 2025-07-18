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
    document.querySelector('#campoaviso').style.display = "none"
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
    document.querySelector('#campoaviso').style.display = "none"
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
    document.querySelector('#campoaviso').style.display = "none"
    document.querySelector('.modal').style.width = "30%"
    
}

function abrirModalAviso(mensagem){
    document.querySelector('#modalTitle').textContent = "Aviso"
    document.querySelector('.modal-overlay').style.display = "flex"
    document.querySelector('#campopadrao').style.display = "none"
    document.querySelector('#camposenha').style.display = "none"
    document.querySelector('#campolink').style.display = "none"
    document.querySelector('#campocor').style.display = "none"
    document.querySelector('#campoimagem').style.display = "none"
    document.querySelector('#campoaviso').style.display = "flex"

    document.querySelector('#aviso').textContent = mensagem
    document.querySelector('.modal').style.width = "30%"
}


function confirmarAlteracao(){
    let titulo = document.querySelector('#modalTitle').textContent
    if(titulo === "Alterar senha"){
        let atual = document.querySelector('#senhaAtual').value
        let nova = document.querySelector('#novaSenha').value
        let confirmar = document.querySelector('#confirmarSenha').value
        if (nova !== confirmar) {
            alert("A nova senha e a confirmação não coincidem!")
            return
        }
        fetch("../php/alterarSenha.php",{
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
            abrirModalAviso(data.mensagem)
        } else {
            abrirModalAviso(data.mensagem)
        }
        })
        .catch(err => {
            abrirModalAviso(err.message)
        })

    }
    if (titulo === "Alterar links"){ 
        let github = document.querySelector('#linkGithub').value
        let linkedin = document.querySelector('#linkLinkedin').value
        let instagram = document.querySelector('#linkInstagram').value
        fetch("../php/alterarLinks.php",{
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
            abrirModalAviso(data.mensagem)
        } else {
            abrirModalAviso(data.mensagem)
        }
        })
        .catch(err => {
            abrirModalAviso(err.message)
        })
    }
    if(titulo === "Alterar username"){ 
        let valor = document.querySelector('#modalInput').value
        fetch("../php/alterarUsername.php",{
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
            abrirModalAviso(data.mensagem)
        } else {
            abrirModalAviso(data.mensagem)
        }
        })
        .catch(err => {
            abrirModalAviso(err.message)
        })
    }
    if(titulo === "Alterar nome"){
        let valor = document.querySelector('#modalInput').value
        fetch("../php/alterarNome.php",{
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
            abrirModalAviso(data.mensagem)
        } else {
            abrirModalAviso(data.mensagem)
        }
        })
        .catch(err => {
            abrirModalAviso(err.message)
        })
    }
    if(titulo === "Alterar email"){
        let valor = document.querySelector('#modalInput').value
        fetch("../php/alterarEmail.php",{
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
            abrirModalAviso(data.mensagem)
        } else {
            abrirModalAviso(data.mensagem)
        }
        })
        .catch(err => {
            abrirModalAviso(err.message)
        })
    }
}

function fecharModal(){
    document.querySelectorAll('input').forEach(input => {
        if(input.type === "text" || input.type === "password" || input.type === "email"){
        input.value = ""
    }})
    document.querySelector('.modal-overlay').style.display = "none"
}

function confirmarAviso(){
    window.location.reload()
}