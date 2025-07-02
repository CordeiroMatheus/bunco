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
        console.log("Senha:", atual, nova, confirmar)
    }
    else if (titulo === "Alterar links"){
        let github = document.querySelector('#linkGithub').value
        let linkedin = document.querySelector('#linkLinkedin').value
        let outro = document.querySelector('#linkOutro').value
        console.log("Links:", github, linkedin, outro)
    }
    else{
        let valor = document.querySelector('#modalInput').value
        console.log(valor)
    }
    /* código pra alterar no bd fica aí */
}

function fecharModal(){
    document.querySelector('.modal-overlay').style.display = "none"
}

fecharModal()