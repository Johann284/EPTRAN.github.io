var click = true;

(function(){ 
 
    const cep = document.querySelector("input[name=cep]");
 
    cep.addEventListener('blur', e=> {
         const value = cep.value.replace(/[^0-9]+/, '');
         const url = `https://viacep.com.br/ws/${value}/json/`;
 
       fetch(url)
      .then( response => response.json())
      .then( json => {
              console.log(json)   
          if( json.logradouro ) {
                // document.querySelector('input[name=rua]').value = json.logradouro;
                document.querySelector('input[name=bairro]').value = json.bairro;
                // document.querySelector('input[name=cidade]').value = json.localidade;
                document.querySelector('input[name=estado]').value = json.estado;
          }
         
       
      });
   });
 })();

document.addEventListener('DOMContentLoaded', function() {
    const criarArrayBtn = document.getElementById("criar-array");

    criarArrayBtn.addEventListener('click', apareceSectionDois);

    function apareceSectionDois() {
        let section1 = document.getElementById("section-principal-tela-1");
        let section2 = document.getElementById("section-principal-tela-2");
        let inputNome = document.getElementById("nome-completo");
        let dataNasc = document.getElementById("data-nasc-usuario");
        const selectElement = document.getElementById("genero-usuario");

        // Validação dos campos
        if (inputNome.value.trim() === "") {
            alert("É necessário inserir o nome completo para continuar!");
            return;
        } else if (dataNasc.value.trim() === "") {
            alert("É necessário inserir a data de nascimento para continuar!");
            return;
        } else if (selectElement.value === "nulo") {
            alert("É necessário selecionar um gênero para continuar!");
            return;
        }

        // Se todas as validações passarem, avança para a próxima seção
        section1.style.display = "none";
        section2.style.display = "block";
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const criarArrayEST = document.getElementById("criar-novo-array");

    criarArrayEST.addEventListener('click', apareceSectionTres);

    function apareceSectionTres() {
        let section2 = document.getElementById("section-principal-tela-2");
        let section3 = document.getElementById("section-principal-tela-3");
        let section4 = document.getElementById("section-principal-tela-4");

        let userNickName = document.getElementById("nome-de-usuario");
        let userEmail = document.getElementById("email-usuario");
        const selectEstudante = document.getElementById("estudante-ensino-medio-fundamental");

        if (userNickName.value.trim() === "") { 
            alert("É necessário escrever um nome de usuário para continuar!");
            return;
        } else if (userEmail.value.trim() === "") {
            alert("É necessário escrever um email para continuar!");
            return;
        } else if (selectEstudante.value === "default") {
            alert("É necessário selecionar uma opção de estudo para continuar!");
            return;
        } else if (selectEstudante.value === "0") {
            section2.style.display = "none";
            section3.style.display = "none";
            section4.style.display = "block";
        } else {
            section2.style.display = "none";
            section3.style.display = "block";
            section4.style.display = "none";
        }  
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const criarArraySerie = document.getElementById("criar-array-serie");

    criarArraySerie.addEventListener('click', apareceSectionQuatro);

    function apareceSectionQuatro() {
        let section3 = document.getElementById("section-principal-tela-3");
        let section4 = document.getElementById("section-principal-tela-4");

        const selectSerie = document.getElementById("categoria-de-ensino");
        let instituicaoEnsino = document.getElementById("nome-escola");

        if (selectSerie.value === "default") {
            alert("É necessário selecionar uma série para continuar!");
            return;
        } else if (instituicaoEnsino.value.trim() === "") {
            alert("É necessário escrever uma instituição de ensino para continuar!");
            return;
        } else {
            section3.style.display = "none";
            section4.style.display = "block";
        }

        
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const criarArrayEstado = document.getElementById("criar-array-geral");
    criarArrayEstado.addEventListener('click', apareceSectionCinco);

    const criarArrayCidade = document.getElementById("criar-array-geral");
    criarArrayCidade.addEventListener('click', apareceSectionCinco);

    function apareceSectionCinco() {
        let section4 = document.getElementById("section-principal-tela-4");
        let section5 = document.getElementById("section-principal-tela-5");

        let cep = document.getElementById("cep");
        let bairro = document.getElementById("bairro");
        const selectEstado = document.getElementById("estado");
        const selectCidade = document.getElementById("cidade-usuario");

        if (cep.value.length !== 8 || cep.value.trim() === "") {
            alert("Insira um CEP válido!(8 caracteres numéricos)");
            return;
        } else if (selectEstado.value === "default") {
            alert("É necessário selecionar um estado para continuar!");
            return;
        } else if (bairro.value.trim() === "") {
            alert("É necessário escrever um bairro para continuar!");
            return;
        } else if (selectCidade.value === "default") {
            alert("É necessário selecionar uma cidade para continuar!");
            return;
        } else {
            section4.style.display = "none";
            section5.style.display = "block";
        }
    }
});

function voltarSectionUm() {
   let section1 = document.getElementById("section-principal-tela-1");
   let section2 = document.getElementById("section-principal-tela-2");
   if (click === true){
        section1.style.display = "block";
        section2.style.display = "none";
   }
}

function voltarSectionDois() {
    let section2 = document.getElementById("section-principal-tela-2");
    let section3 = document.getElementById("section-principal-tela-3");
    if (click === true){
         section3.style.display = "none";
         section2.style.display = "block";
         
    }
}

function voltarSectionTres() {
    let section2 = document.getElementById("section-principal-tela-2");
    let section3 = document.getElementById("section-principal-tela-3");
    let section4 = document.getElementById("section-principal-tela-4");
    let pessoaNaoEstudante = document.getElementById("estudante-ensino-medio-fundamental").value;

    if (click === true) {
        if (pessoaNaoEstudante === "0") {
            section3.style.display = "none";
            section4.style.display = "none";
            section2.style.display = "block";
        } else {
            section3.style.display = "block";
            section4.style.display = "none";            
        }
    }
}

function voltarSectionQuatro() {
    let section4 = document.getElementById("section-principal-tela-4");
    let section5 = document.getElementById("section-principal-tela-5");
    if (click === true){
        section5.style.display = "none";
        section4.style.display = "block";
    }
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