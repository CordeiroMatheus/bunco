let integrantes = [
    {
        id: 1,
        nome: "Gabriel Linhares",
        trabalho: "Designer",
        imagem: 'assets/img/integrantes/gabriel.svg',
        texto: 'Trabalhou na parte de design do TCC'
    },
    {
        id: 2,
        nome: "João D'Allessio",
        trabalho: "Programador Back-end",
        imagem: 'assets/img/integrantes/joão.svg',
        texto: 'Trabalhou no back-end e mobile do TCC'
    },
    {
        id: 3,
        nome: "Matheus Cordeiro",
        trabalho: "Programador Front-end",
        imagem: 'assets/img/integrantes/matheus.svg',
        texto: 'Trabalhou na parte front-end do TCC'
    }
]

let itemAtual = 0

const img = document.querySelector('#pessoa-img')
const nome = document.querySelector('#nome')
const trabalho = document.querySelector('#funcao')
const texto = document.querySelector('#info')
const info = document.querySelector('#about-info')


document.addEventListener('DOMContentLoaded', function(e){
    mostrarPessoa(itemAtual)
})

function mostrarPessoa(pessoa){
    let item = integrantes[pessoa]
    img.src = item.imagem
    nome.textContent = item.nome
    trabalho.textContent = item.trabalho
    texto.textContent = item.texto
    if(pessoa === 0){
        info.style.setProperty('--cor-before', '#D11515')
        info.style.setProperty('--cor-texto', '#D11515')
        document.body.style.setProperty('--cor-texto', '#D11515')
    }
    if(pessoa === 1){
        info.style.setProperty('--cor-before', '#3E7500')
        info.style.setProperty('--cor-texto', '#3E7500')
        document.body.style.setProperty('--cor-texto', '#3E7500')
    }
    if(pessoa === 2){
        info.style.setProperty('--cor-before', '#066693')
        info.style.setProperty('--cor-texto', '#066693')
        document.body.style.setProperty('--cor-texto', '#066693')
    }
}

document.querySelector('.next-btn').addEventListener('click', function(){
    itemAtual++
    if(itemAtual > 2){
        itemAtual = 0
    }
    mostrarPessoa(itemAtual)
})

document.querySelector('.prev-btn').addEventListener('click', function(){
    itemAtual--
    if(itemAtual < 0){
        itemAtual = 2
    }
    mostrarPessoa(itemAtual)
})