<?php
include "../sql/db_connect.php";

session_start();
// Verifica se existe os dados da sessão de login
if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"])) { // Usuário não logado! Redireciona para a página de login
  session_unset();
  session_destroy();  
  header("Location: telaInicial.php");
  exit();
}; // se está tudo certinho ele só continua

?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tela Inicial</title>
    <link rel="stylesheet" href="../styles/inicialEJogos.css" />
    <link rel="stylesheet" href="../styles/geral.css" />
  </head>
  <body id="body-tela-inicial">
    <header>
      <img
        id="tela-inicial-eptran-logo"
        src="../styles/imagens/logo_eptran.png"
        alt="Logo da EPTRAN"
      />
    </header>
    <section id="inicio-parte-amarela">
      <div id="frase-educa-transito">
        <p>EDUCAÇÃO NO TRÂNSITO</p>
      </div>
      <div id="frase-efeito-inicial">
        <p>Venha fazer parte deste mundo de aprendizagem!</p>
      </div>
      <div id="container-imagens-tela-inicial">
        <div id="div-imagens-tela-inicial">

          
          <img
            src="../styles/imagens/fotoInicial1.PNG"
            alt="Rua com carros em circulação"
            id="carros-circulacao"
          />
          <img
            src="../styles/imagens/fotoInicial2.PNG"
            alt="Placas de trânsito"
            id="placas-transito"
          />
          
          <img
            src="../styles/imagens/fotoInicial3.PNG"
            alt="Vaga de cadeirante"
            id="vaga-cadeirante"
          />
          
        </div>
      </div>
      
      <img id="foca-tela-inicial" src="../styles/imagens/personagens/focaInteira.png" alt="foca">
    </section>
    <section id="section-videos-tela-inicial">
      <br>
      <p>Confira os nossos conteúdos </p>
      <br>
      <div id="video-tela-inicial">
        <video
          src="../styles/imagens/videoTransito.mp4"
          type="video/mp4"
          controls
        ></video>
      </div>
      <p>Vídeo sobre conscientização no Trânsito | EPTRAN</p>

      <div id="video-tela-inicial2">
        <video
          src="../styles/imagens/videoTransito.mp4"
          type="video/mp4"
          controls
        ></video>
      </div>
      <p>Vídeo sobre conscientização no Trânsito | EPTRAN</p>

      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      


      
    </section>
    <footer>
      <div class="botoes-navegacao-secoes">
        <a href="./telaInicial.php" class="tamanho-icones-navegacao"
          ><img
            class="botao-clicado-barra-de-nav"
            src="../styles/imagens/casa_azul.svg"
            alt="Ícone do botão início"
          />Início</a
        >
      </div>
      <div class="botoes-navegacao-secoes">
        <a
          href="javascript:void(0)"
          class="botao-niveis-de-ensino tamanho-icones-navegacao"
          ><img
            src="../styles/imagens/chapeu-branco.svg"
            alt="Ícone do botão níveis de ensino"
          />Níveis de Ensino</a
        >
      </div>
      <div class="botoes-navegacao-secoes">
        <a href="./conta.html" class="tamanho-icones-navegacao"
          ><img
            src="../styles/imagens/conta-branca.svg"
            alt="Ícone do botão conta"
          />Conta</a
        >
      </div>
    </footer>
    <div class="niveis-de-ensino" style="display: none"></div>

    <script src="../scripts/niveisDeEnsino.js"></script>
  </body>
</html>