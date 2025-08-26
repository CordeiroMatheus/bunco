document.querySelector("#alterar-img").onclick = () => {
  const corAtual = getComputedStyle(
    document.querySelector("#profile-img")
  ).backgroundColor;

  document.querySelector("#modalTitle").textContent = "Alterar imagem";
  document.querySelector("#campopadrao").style.display = "none";
  document.querySelector("#campolink").style.display = "none";
  document.querySelector("#camposenha").style.display = "none";
  document.querySelector("#campocor").style.display = "none";
  document.querySelector("#campoaviso").style.display = "none";
  document.querySelector("#camposair").style.display = "none";
  document.querySelector("#campoexcluir").style.display = "none";
  document.querySelector(".modal-overlay").style.display = "flex";
  document.querySelector("#campoimagem").style.display = "flex";
  document.querySelector("#prealterar-img").style.backgroundColor = corAtual;
  document.querySelector(".modal").style.width = "50%";
  const imagemAtual = document.querySelector("#img-profile").src;
  document.querySelector("#prealterarimg").src = imagemAtual;
};

let prealtimg = document.querySelector("#prealterarimg");
let opcoesimg = document.querySelectorAll(".opcaoimagens");
opcoesimg.forEach((opcao) => {
  opcao.addEventListener("click", () => {
    prealtimg.src = opcao.src;
  });
});

function confirmarImagem() {
  const novaImagem = prealtimg.src.split("/").pop().split(".")[0];

  fetch("../php/alterarFoto.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    credentials: "include",
    body: `foto=${encodeURIComponent(novaImagem)}`,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.sucesso === true) {
        document.querySelector("#img-profile").src = prealtimg.src;
        abrirModalAviso(data.mensagem);
      } else {
        abrirModalAviso(data.mensagem);
      }
    })
    .catch((err) => {
      abrirModalAviso("Erro ao trocar a imagem de perfil!");
    });
}
