const profileconfig = document.querySelector('#profile-config')
const settingscontainer = document.querySelector('#settings-container')
profileconfig.addEventListener('click', (e)=>{
    e.stopPropagation()
    settingscontainer.style.display = "flex"
    settingscontainer.style.position = "fixed"
})

const profile = document.querySelector('#profile')
profile.addEventListener('click', fecharConfig)

function fecharConfig(e){
    if (window.innerWidth <= 767 || window.innerWidth >= 768 && window.innerWidth <= 915 && window.innerHeight <= 500){
        settingscontainer.style.display = "none"
    }
}

window.addEventListener('resize', ajustarConfig)

function ajustarConfig() {
    // Celulares
    if (window.innerWidth <= 767) {
        settingscontainer.style.display = "none";

    // Celulares maiores
    } else if (window.innerWidth >= 768 && window.innerWidth <= 915 && window.innerHeight <= 500) {
        settingscontainer.style.display = "none";

    // Tablets médios
    } else if (window.innerWidth >= 768 && window.innerWidth <= 1024 && window.innerHeight <= 600) {
        settingscontainer.style.position = "static";
        settingscontainer.style.display = "flex";

    // Desktop comum
    } else if (window.innerWidth >= 1025 && window.innerHeight <= 1440) {
        settingscontainer.style.position = "static";
        settingscontainer.style.display = "flex";

    // Desktop Full HD
    } else if (window.innerWidth >= 1441 && window.innerWidth <= 1920) {
        settingscontainer.style.position = "static";
        settingscontainer.style.display = "flex";

    // Monitores grandes
    } else if (window.innerWidth >= 1921) {
        settingscontainer.style.position = "static";
        settingscontainer.style.display = "flex";
    }
}