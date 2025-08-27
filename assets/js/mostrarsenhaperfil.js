const opcaosenha = document.querySelectorAll('.opcaosenha')
const olhoaberto = document.querySelectorAll('.fa-solid.fa-eye')
const olhofechado = document.querySelectorAll('.fa-solid.fa-eye-slash')

document.addEventListener('DOMContentLoaded', ()=>{
    olhofechado.forEach(closeeye => {
        closeeye.style.display = "none"
    });
})

opcaosenha.forEach(opcao => {
    const olhoaberto = opcao.querySelector('.fa-eye')
    const olhofechado = opcao.querySelector('.fa-eye-slash')
    const senhaInput = opcao.parentElement.querySelector('input')

    opcao.addEventListener('click', () => {
        if (senhaInput.type === "password") {
            senhaInput.type = "text"
            olhoaberto.style.display = "none"
            olhofechado.style.display = "inline"
        } else {
            senhaInput.type = "password"
            olhoaberto.style.display = "inline"
            olhofechado.style.display = "none"
        }
    })
})
