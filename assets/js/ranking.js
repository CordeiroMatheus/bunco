document.addEventListener("DOMContentLoaded", () => {
  fetch("../php/ranking.php")
    .then(response => response.json())
    .then(dados => {
      if (dados.sucesso === false) {
        document.getElementById("ranking").innerHTML = `<p>${dados.mensagem}</p>`
        return
      }

      const listaRanking = document.getElementById("lista-ranking")
      const posicaoUsuario = document.getElementById("posicao-usuario")

      // Limpa antes de preencher
      listaRanking.innerHTML = ""
      posicaoUsuario.innerHTML = ""

      // Preenche os 15 primeiros colocados
      dados.primeiros.forEach((usuario, index) => {
        const item = document.createElement("li")
        item.innerHTML = `
          <div class="usuario-ranking" style="display: flex; align-items: center; gap: 10px;">
            <span><strong>#${index + 1}</strong></span>
            <span style="color: #fff">${usuario.username}</span>
            <span>XP: ${usuario.xp}</span>
          </div>
        `
        listaRanking.appendChild(item)
      })

      // Preenche a posição do usuário logado
      if (dados.voce) {
        posicaoUsuario.innerHTML = `
          <p>Sua posição: <br> <strong>#${dados.voce.posicao}</strong> - ${dados.voce.username} (XP: ${dados.voce.xp})</p>
        `
      }

    })
    .catch(erro => {
      console.log("Erro ao carregar o ranking:", erro)
      document.getElementById("ranking").innerHTML = `<p>Erro ao carregar ranking!</p>`
    })
})