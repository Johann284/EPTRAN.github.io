function validaApareceSectionDois() {
    event.preventDefault();
    let input = document.getElementById("email-senha");
    let sectionUm = document.getElementById("section-etapa-um");
    let sectionDois = document.getElementById("section-etapa-dois");

    if (input.value.trim() === "") {
        alert("É necessário inserir um email para prosseguir e recuperar sua senha!");
    } else {
        sectionUm.style.display = "none";
        sectionDois.style.display = "block";
    }
}

function passaEtapa() {
    event.preventDefault();
    let sectionDois = document.getElementById("section-etapa-dois");
    let sectionTres = document.getElementById("section-etapa-tres");

    sectionDois.style.display = "none";
    sectionTres.style.display = "block";
}

document.getElementById("senha-usuario").addEventListener("input", verificar_senha);
document.getElementById("confirma-senha-usuario").addEventListener("input", verificar_senha);

function verificar_senha() {
    let senha = document.getElementById("senha-usuario").value; // Pegando o valor do input
    let chars = Array.from(senha);
    let confirma_senha = document.getElementById("confirma-senha-usuario").value;

    // Identifica os elementos para os requisitos de senha
    let caracteres = document.getElementById("caracteres");
    let maiuscula = document.getElementById("maiuscula");
    let numero = document.getElementById("numero");
    let acento = document.getElementById("acento");

    let totalCaracteres = chars.length;
    let temMaiuscula = chars.some(char => /[A-Z]/.test(char));
    let temNumeros = chars.some(char => !isNaN(char) && char !== ' ');
    let temAcento = chars.some(char => /[!@#$%^&*(),.?":{}|<>^~´`ªº°]/.test(char));

    // Verifica se a senha tem no mínimo 8 caracteres
    if (totalCaracteres >= 8) {
        caracteres.classList.remove("errado");
        caracteres.classList.add("correto");
    } else {
        caracteres.classList.remove("correto");
        caracteres.classList.add("errado");
    }

    // Verifica se a senha tem letra maiúscula
    if (temMaiuscula) {
        maiuscula.classList.remove("errado");
        maiuscula.classList.add("correto");
    } else {
        maiuscula.classList.remove("correto");
        maiuscula.classList.add("errado");
    }

    // Verifica se a senha tem número
    if (temNumeros) {
        numero.classList.remove("errado");
        numero.classList.add("correto");
    } else {
        numero.classList.remove("correto");
        numero.classList.add("errado");
    }

    // Verifica se a senha tem caractere especial
    if (temAcento) {
        acento.classList.remove("correto");
        acento.classList.add("errado");
    } else {
        acento.classList.remove("errado");
        acento.classList.add("correto");
    };


    if (totalCaracteres >= 8 && temMaiuscula === true && temNumeros === true && temAcento === false){
        if (senha == confirma_senha) {
            document.getElementById("seguinte").disabled = false;
        } else{
            document.getElementById("seguinte").disabled = true;
        };
    } else {
        document.getElementById("seguinte").disabled = true;
    };
}

function voltarEtapaUm() {
    let sectionUm = document.getElementById("section-etapa-um");
    let sectionDois = document.getElementById("section-etapa-dois");

    sectionUm.style.display = "block";
    sectionDois.style.display = "none";
}

function voltarEtapaDois() {
    let sectionTres = document.getElementById("section-etapa-tres");
    let sectionDois = document.getElementById("section-etapa-dois");

    sectionTres.style.display = "none";
    sectionDois.style.display = "block";
}