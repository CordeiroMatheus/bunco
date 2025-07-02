document.querySelector('#alterar-cor').onclick = () => {
    document.querySelector('#modalTitle').textContent = "Alterar cor"
    document.querySelector('#campopadrao').style.display = "none"
    document.querySelector('#campolink').style.display = "none"
    document.querySelector('#camposenha').style.display = "none"
    document.querySelector('#campoimagem').style.display = "none"
    document.querySelector('.modal-overlay').style.display = "flex"
    document.querySelector('#campocor').style.display = "flex"
    document.querySelector('.modal').style.width = "30%"
    const imagemAtual = document.querySelector('#img-profile').src
    document.querySelector('#prealterarcorimg').src = imagemAtual
}
let preimg = document.querySelector('#prealterar-cor')
let cores = document.querySelectorAll('.opcaocores')
cores.forEach(cor => 
    cor.addEventListener('click', () => {
        cores.forEach(c => c.style.border = "1px solid white")
        cor.style.border = "1px solid dodgerblue"
        preimg.style.backgroundColor = cor.style.backgroundColor
    }))


function confirmarCor(){
    document.querySelector('#profile-img').style.backgroundColor = preimg.style.backgroundColor 
    /*código pra alterar no bd*/
}