let btnup = document.querySelector('#signup-button')
btnup.addEventListener('click', function(){
btnup.disabled = true
btnup.style.cursor = "default"
setTimeout(function(){
document.location.href = "pages/signup.html"
}, 200)
})