let btnin = document.querySelector('#signin-button')
btnin.addEventListener('click', () => {
    btnin.disabled = true
    btnin.style.cursor = "default"
    setTimeout(function(){
        document.location.href = "pages/signin.html"
    }, 600)
})