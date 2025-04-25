const inputs = document.querySelectorAll('.input') // troca aqui, já explico!
const audio = new Audio('/assets/audio/tecla.ogg')

inputs.forEach(input => {
  input.addEventListener('keydown', () => {
    audio.currentTime = 0
    audio.play()
  })
})
