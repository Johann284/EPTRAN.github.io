<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/geral.css">
    <link rel="stylesheet" href="../styles/loginCadastro.css">
    <link rel="stylesheet" href="../styles/adicionarEditarNoticias.css">
    <title>Adicionar Notícia</title>
</head>
<body>
    <header>
        <img src="../styles/imagens/logo_eptran.png" alt="Logo da Prefeitura de Joinville" />
      </header>
      <div>
        <a href="./telaNoticias.html"><button class="botao-voltar"><img class="seta-para-esquerda" src="../styles/imagens/seta-voltar-preta.svg" alt="" />Voltar</button></a>
      </div>
      <div id="div-adicionar-noticia">
        <h1>Adicionar notícia</h1>
        <p class="p-noticias">
            Insira os dados da matéria nos campos abaixo.
        </p>
     </div>

      <form action="" class="forms-do-cadastro" method="POST">
        <div>
            <label for="titulo-materia">Titulo da matéria</label>
            <input type="text" name="titulo-materia">
        </div>
        <div>
            <label for="link-acesso">Link para acesso</label>
            <input type="text" name="link-acesso">
        </div>
        <div>
            <label for="nome-site">Nome do site</label>
            <input type="text" name="nome-site">
        </div>
        <div>
            <label for="imagem-capa">Imagem da capa <p class="p-noticias">(opcional)</p></label>
            <input type="file" name="imagem-capa" value="Faça upload de uma imagem"></input>
        </div>
        <button class="botao-seguinte">Concluir</button>
      </form>
</body>
</html>