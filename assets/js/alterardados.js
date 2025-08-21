// Seleciona todos os botões de alteração e o ícone do modal
let opcoesAlterar = document.querySelectorAll('.alterar')
let icones = document.querySelector('#icon')

// Aqui fica as funções de validação 

function validarNome(nomeAtual, novoNome) {
    return novoNome.trim().length >= 4 && novoNome !== nomeAtual
}

function validarEmail(emailAtual, novoEmail) {
    const regex = /^[\w\.-]+@[\w\.-]+\.\w+$/
    return regex.test(novoEmail) && novoEmail.length >= 4 && novoEmail !== emailAtual
}

function validarUsername(usernameAtual, novoUsername) {
    const regex = /^[a-zA-Z0-9_]{4,}$/
    return regex.test(novoUsername) && novoUsername !== usernameAtual
}

function validarSenha() {
    const atual = document.querySelector('#senhaAtual').value.trim()
    const nova = document.querySelector('#novaSenha').value.trim()
    const confirmar = document.querySelector('#confirmarSenha').value.trim()
    return nova.length >= 4 && nova === confirmar && atual != ""
}

function validarLink(linkAtual, novoLink, tipo) {
    const regexes = {
        github: /^https:\/\/(www\.)?github\.com\/[a-zA-Z0-9_-]+\/?$/,
        instagram: /^https:\/\/(www\.)?instagram\.com\/[a-zA-Z0-9._]+\/?$/,
        linkedin: /^https:\/\/(www\.)?linkedin\.com\/in\/[a-zA-Z0-9À-ÿ\-_%]+\/?$/
    }
    const regex = regexes[tipo]
    return regex.test(novoLink) && novoLink !== linkAtual || (novoLink == "" && novoLink !== linkAtual)
}


opcoesAlterar.forEach(
    opcao => {
        opcao.addEventListener('click', ()=>{
            const texto = opcao.textContent
            if(texto === "Alterar nome"){
                abrirModal(texto)
                document.querySelector('#modalInput').setAttribute('maxlength', '30')
                icones.src = "../assets/img/icones/user.svg"
                const input = document.querySelector('#modalInput')
                input.value = dadosUsuario.nome

                const botao = document.querySelector('#botaoConfirmar')
                function atualizarEstadoBotao() {
                    const nomeNovo = input.value.trim()
                    const valido = validarNome(dadosUsuario.nome, nomeNovo)
                    botao.disabled = !valido
                    botao.style.backgroundColor = valido ? "#1CB0F6" : '#3a3a3aff'
                    botao.style.boxShadow = valido ? "2px 2px 0px 1.5px #1453A3" : 'none'
                    botao.style.cursor = valido ? 'pointer' : 'not-allowed'
                }
                    input.addEventListener('input', atualizarEstadoBotao)
                    atualizarEstadoBotao()
            }

            
    if (texto === "Alterar username"){
        abrirModal(texto)
        document.querySelector('#modalInput').setAttribute('maxlength', '30')
        icones.src = "../assets/img/icones/user.svg"
        const input = document.querySelector('#modalInput')
        input.value = dadosUsuario.username

        const botao = document.querySelector('#botaoConfirmar')
        function atualizarEstadoBotao() {
            const novoUsername = input.value.trim()
            const valido = validarUsername(dadosUsuario.username, novoUsername)
            botao.disabled = !valido
            botao.style.backgroundColor = valido ? "#1CB0F6" : '#3a3a3aff'
            botao.style.boxShadow = valido ? "2px 2px 0px 1.5px #1453A3" : 'none'
            botao.style.cursor = valido ? 'pointer' : 'not-allowed'
    }
            input.addEventListener('input', atualizarEstadoBotao)
            atualizarEstadoBotao()

    }


    if (texto === "Alterar email"){
        abrirModal(texto)
        document.querySelector('#modalInput').setAttribute('maxlength', '254')
        icones.src = "../assets/img/icones/email.svg"
        const input = document.querySelector('#modalInput')
        input.value = dadosUsuario.email

        const botao = document.querySelector('#botaoConfirmar')
        function atualizarEstadoBotao() {
            const novoEmail = input.value.trim()
            const valido = validarEmail(dadosUsuario.email, novoEmail)
            botao.disabled = !valido
            botao.style.backgroundColor = valido ? "#1CB0F6" : '#3a3a3aff'
            botao.style.boxShadow = valido ? "2px 2px 0px 1.5px #1453A3" : 'none'
            botao.style.cursor = valido ? 'pointer' : 'not-allowed'
    }
            input.addEventListener('input', atualizarEstadoBotao)
            atualizarEstadoBotao()
    }


    if (texto === "Alterar senha"){
        abrirModalSenha()

        const inputNova = document.querySelector('#novaSenha')
        const inputConfirmar = document.querySelector('#confirmarSenha')
        const botao = document.querySelector('#botaoConfirmarSenha')

        function atualizarEstadoBotaoSenha() {
            const valido = validarSenha()
            botao.disabled = !valido
            botao.style.backgroundColor = valido ? "#1CB0F6" : '#3a3a3aff'
            botao.style.boxShadow = valido ? "2px 2px 0px 1.5px #1453A3" : 'none'
            botao.style.cursor = valido ? 'pointer' : 'not-allowed'
    }

            inputNova.addEventListener('input', atualizarEstadoBotaoSenha)
            inputConfirmar.addEventListener('input', atualizarEstadoBotaoSenha)
            atualizarEstadoBotaoSenha()
    }



    if (texto === "Alterar links"){
        abrirModalLinks()

        const github = document.querySelector('#linkGithub')
        const linkedin = document.querySelector('#linkLinkedin')
        const instagram = document.querySelector('#linkInstagram')
        const botao = document.querySelector('#botaoConfirmarLinks')

        github.value = dadosUsuario.github
        linkedin.value = dadosUsuario.linkedin
        instagram.value = dadosUsuario.instagram

        function atualizarEstadoBotaoLinks() {
            const g = validarLink(dadosUsuario.github, github.value.trim(), "github")
            const l = validarLink(dadosUsuario.linkedin, linkedin.value.trim(), "linkedin")
            const i = validarLink(dadosUsuario.instagram, instagram.value.trim(), "instagram")

            const algumValido = g || l || i
            botao.disabled = !algumValido
            botao.style.backgroundColor = algumValido ? "#1CB0F6" : '#3a3a3aff'
            botao.style.boxShadow = algumValido ? "2px 2px 0px 1.5px #1453A3" : 'none'
            botao.style.cursor = algumValido ? 'pointer' : 'not-allowed'
    }

            github.addEventListener('input', atualizarEstadoBotaoLinks)
            linkedin.addEventListener('input', atualizarEstadoBotaoLinks)
            instagram.addEventListener('input', atualizarEstadoBotaoLinks)
            atualizarEstadoBotaoLinks()
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
        atual = atual.trim()
        nova = nova.trim()
        confirmar = confirmar.trim()
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
            abrirModalAviso("Algo deu errado ao alterar a senha!")
        })

    }
    if (titulo === "Alterar links"){ 
        let github = document.querySelector('#linkGithub').value
        let linkedin = document.querySelector('#linkLinkedin').value
        let instagram = document.querySelector('#linkInstagram').value
        github = github.trim()
        instagram = instagram.trim()
        linkedin = linkedin.trim()
        const regexes = {
        github: /^https:\/\/(www\.)?github\.com\/[a-zA-Z0-9_-]+\/?$/,
        instagram: /^https:\/\/(www\.)?instagram\.com\/[a-zA-Z0-9._]+\/?$/,
        linkedin: /^https:\/\/(www\.)?linkedin\.com\/in\/[a-zA-Z0-9À-ÿ\-_%]+\/?$/
    }
        if (!regexes.github.test(github) && github != "") {
            abrirModalAviso("O link do GitHub é inválido!")
            return
        }
        if (!regexes.instagram.test(instagram) && instagram != "") {
            abrirModalAviso("O link do Instagram é inválido!")
            return
        }
        if (!regexes.linkedin.test(linkedin) && linkedin != "") {
            abrirModalAviso("O link do LinkedIn é inválido!")
            return
        }
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
            abrirModalAviso("Algo deu errado ao alterar os links!")
        })
    }
    if(titulo === "Alterar username"){ 
        let valor = document.querySelector('#modalInput').value
        valor = valor.trim()
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
            abrirModalAviso("Algo deu errado ao alterar o username!")
        })
    }
    if(titulo === "Alterar nome"){
        let valor = document.querySelector('#modalInput').value
        valor = valor.trim()
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
            abrirModalAviso("Algo deu errado ao alterar o nome!")
        })
    }
    if(titulo === "Alterar email"){
        document.querySelector('#modalInput').setAttribute('maxlength', '254')
        let valor = document.querySelector('#modalInput').value
        valor = valor.trim().toLowerCase()
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
            abrirModalAviso("Algo deu errado ao alterar o email!")
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