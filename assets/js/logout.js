let btnSair = document.querySelector('#btnsair')
btnSair.addEventListener('click', ()=>{
    const confirmar = window.confirm("Tem certeza que deseja sair da sua conta?")
    if(!confirmar) return

    window.location.href = "../index.html"
})