document.querySelector('#alterar-cor').onclick = () => {
    document.querySelector('#modalTitle').textContent = "Alterar cor"
    document.querySelector('#campopadrao').style.display = "none"
    document.querySelector('#campolink').style.display = "none"
    document.querySelector('#camposenha').style.display = "none"
    document.querySelector('#campoimagem').style.display = "none"
    document.querySelector('.modal-overlay').style.display = "flex"
    document.querySelector('#campocor').style.display = "flex"
    document.querySelector('.modal').style.width = "30%"
    const imagemAtual = document.querySelector('#img-profile').src
    document.querySelector('#prealterarcorimg').src = imagemAtual
    const elemento = document.querySelector('#profile-img')
    const corAtual = getComputedStyle(elemento).backgroundColor
    document.querySelector('#prealterar-cor').style.backgroundColor = corAtual
}
let preimg = document.querySelector('#prealterar-cor')
let cores = document.querySelectorAll('.opcaocores')
cores.forEach(cor => 
    cor.addEventListener('click', () => {
        cores.forEach(c => c.style.border = "1px solid white")
        cor.style.border = "1px solid dodgerblue"
        preimg.style.backgroundColor = cor.style.backgroundColor
    }))


function confirmarCor() {
    const novaCor = preimg.style.backgroundColor;

    function rgbParaHex(rgb) {
        const result = rgb.match(/\d+/g).map(x => parseInt(x).toString(16).padStart(2, '0'));
        return result ? result.join('').toUpperCase() : null;
    }

    const corHex = rgbParaHex(novaCor);

    fetch('../php/alterarCor.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        credentials: 'include',
        body: `cor=${corHex}`
    })
    .then(res => res.json()) 
    .then(data => {
        if (data.sucesso === true) {
            document.querySelector('#profile-img').style.backgroundColor = `#${corHex}`;
            alert(data.mensagem);
            window.location.reload()
        } else {
            throw new Error(data.mensagem);
        }
    })
    .catch(err => {
        console.error("Erro completo:", err);
        alert(`Erro ao atualizar a cor:\n${err.message}`);
    });
}