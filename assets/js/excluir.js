let btnExcluir = document.querySelector('#btnexcluir')
btnExcluir.addEventListener('click', () => {
    const confirmar = window.confirm("Tem certeza que deseja excluir sua conta?")
    if(!confirmar) return
    
    fetch("../api/excluir.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        credentials: "include"
    })
    .then(res => res.json())
    .then(data => {
        if (data.sucesso) {
            alert(data.mensagem);
            window.location.href = "../index.html"; // ou login.html
        } else {
            alert("Erro: " + data.mensagem);
        }
    })
    .catch(err => {
        alert("Erro na requisição: " + err.message);
    });
})