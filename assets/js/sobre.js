let integrantes = [
    {
        id: 1,
        nome: "Gabriel Linhares",
        trabalho: "Designer",
        imagem: '/assets/img/',
        texto: 'Trabalhou na parte de design do TCC'
    },
    {
        id: 2,
        nome: "João Pedro",
        trabalho: "Programador Back-end",
        imagem: '/assets/img/',
        texto: 'Trabalhou na parte back-end do TCC'
    },
    {
        id: 3,
        nome: "Matheus Cordeiro",
        trabalho: "Programador Front-end",
        imagem: '/assets/img/logo.png',
        texto: 'Trabalhou na parte front-end do TCC'
    }
]

let itemAtual = 0

const img = document.querySelector('#pessoa-img')
const nome = document.querySelector('#nome')
const trabalho = document.querySelector('#funcao')
const texto = document.querySelector('#info')


document.addEventListener('DOMContentLoaded', function(e){
    mostrarPessoa(itemAtual)
})

function mostrarPessoa(pessoa){
    let item = integrantes[pessoa]
    img.src = item.imagem
    nome.textContent = item.nome
    trabalho.textContent = item.trabalho
    texto.textContent = item.texto
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