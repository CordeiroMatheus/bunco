document.addEventListener('DOMContentLoaded', function() {
const formTextElement = document.getElementById('form-text');
            
const words = ["começar", "criar", "aprender", "descobrir", "desenvolver", "programar"];
let currentWordIndex = 0;
let isDeleting = false;
let currentText = '';
let typingSpeed = 200;
let pauseBetweenWords = 1000;
            
function typeWriter() {
const fullWord = words[currentWordIndex];
                
if (isDeleting) {
    currentText = fullWord.substring(0, currentText.length - 1);
} else {
    currentText = fullWord.substring(0, currentText.length + 1);
}

    formTextElement.innerHTML = '&nbsp;' + currentText + '<span class="cursor"></span>';

if (!isDeleting && currentText === fullWord) {
    isDeleting = true;
    setTimeout(typeWriter, pauseBetweenWords);
} else if (isDeleting && currentText === '') {
    isDeleting = false;
    currentWordIndex = (currentWordIndex + 1) % words.length;
    setTimeout(typeWriter, typingSpeed);
} else {
    setTimeout(typeWriter, isDeleting ? typingSpeed / 2 : typingSpeed);
}
}
typeWriter();
});