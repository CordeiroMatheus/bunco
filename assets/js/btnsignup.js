let btn = document.querySelector('#signup-button')
btn.addEventListener('click', function(){
btn.disabled = true
btn.style.cursor = "none"
setTimeout(function(){
document.location.href = "pages/signup.html"
}, 1000)
})