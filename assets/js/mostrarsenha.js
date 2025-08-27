const opcaosenha = document.querySelector('#opcaosenha')
const olhoaberto = document.querySelector('#openedeye')
const olhofechado = document.querySelector('#closedeye')
document.addEventListener('DOMContentLoaded', ()=>{
    olhofechado.style.display = "none"
})
    opcaosenha.addEventListener('click', ()=>{
        const senhaInput = document.querySelector('#senha')
        if(senhaInput.type === "password"){
            senhaInput.type = "text"
            olhofechado.style.display = "inherit"
            olhoaberto.style.display = "none"
        }
        else{
            senhaInput.type = "password"
            olhofechado.style.display = "none"
            olhoaberto.style.display = "inherit"
        }
})