<?php
include '../sql/db_connect.php';
session_start();


if (isset($_POST["alterarSenha"])) {

  $id_usuario = $_SESSION['id_usuario'];
  $nova_senha = password_hash($_POST['senha-usuario'], PASSWORD_DEFAULT); // Hash da senha
  // segurança
  $stmt = $conn->prepare(query: "UPDATE usuarios SET senha_usuario = ? WHERE id_usuario = ?");
  $stmt->bind_param("si", $nova_senha, $id_usuario);
  
  // executar se tudo ta certo
  $stmt->execute() ;
      // fazer login após alterar a senha
  if ($stmt->execute()) {
    echo 'entoru';
    header("Location: login.php");
    exit();
  };
  

  $stmt->close();
};

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Esqueceu a Senha</title>
    <link rel="website icon" type="svg" href="../styles/imagens/question-mark.svg">
    <link rel="stylesheet" href="../styles/loginCadastro.css" />
    <link rel="stylesheet" href="../styles/geral.css" />
    <script defer src="../scripts/esqueciSenha.js"></script>
  </head>
  <body>
    <header>
      <img src="../styles/imagens/logo_eptran.png" alt="Logo da Prefeitura de Joinville" />
    </header>
    <section id="section-etapa-um" class="block">
      <div>
        <!-- é pra colocar o https da tela conta no href de baixo -->
        <a href=""><button class="botao-voltar"><img class="seta-para-esquerda" src="../styles/imagens/seta-voltar-preta.svg" alt="" />Voltar</button></a>
      </div>
      <section class="classe-do-cadastro">
        <div class="Recupere-senha">
          <h2>Recupere a sua Senha:</h2>
        </div>
        <div class="msg-senha">
          <div>
            <h4 class="formato-h4">Você receberá as instruções para a criação</h4>
            <h4 class="formato-h4">de uma nova senha para o usuário que</h4>
            <h4 class="formato-h4">possui este email cadastrado.</h4>
          </div>
        </div>
        <div class="email-senha">
          <form class="forms-do-cadastro" method="POST" action="">
            <div class="divisoes-formulario">
              <label for="email-senha">Digite o seu email de acesso:</label>
              <input type="text" name="email-senha" id="email-senha" required>
            </div>
            <div class="div-passos-esqueceu-senha1">
              <input onclick="validaApareceSectionDois()" type="button" name="esqueceu-senha1" value="Enviar email de recuperação" class="botao-seguinte" required>
            </div>
          </form>
        </div>
      </section>
    </section>

    <section id="section-etapa-dois" class="none">
      <div onclick="voltarEtapaUm()">
        <a><button class="botao-voltar"><img class="seta-para-esquerda" src="../styles/imagens/seta-voltar-preta.svg" alt="" />Voltar</button></a>
      </div>
      <section class="classe-do-cadastro">
        <div class="Recupere-senha">
          <h2>Enviamos as instruções para</h2>
        </div>
        <div class="msg-senha ajuste">
          <div>
            <h4 class="formato-h4">Não achou o email em sua caixa de</h4>
            <h4 class="formato-h4">entrada?</h4>
            <h4 class="formato-h4" id="ajuste-h4">Verifique o email ou <a href="" id="ajuste-h4">envie novamente</a>
          </div>  
        </div>
        <div class="div-passos-esqueceu-senha2 ajuste">
          <input onclick="passaEtapa()" type="button" name="esqueceu-senha1" value="Continuar" class="botao-seguinte" required />
        </div>
      </section>
    </section>
    <section id="section-etapa-tres" class="none">
      <div onclick="voltarEtapaDois()">
        <a><button class="botao-voltar"><img class="seta-para-esquerda" src="../styles/imagens/seta-voltar-preta.svg" alt="" />Voltar</button></a>
      </div>
      <section>
        <div class="faca-seu-cadastro">
          <h2>Crie sua nova senha</h2>
        </div>
        <div class="classe-do-cadastro">
          <form class="forms-do-cadastro" method="POST" action="">
            <div class="divisoes-formulario">
              <label for="senha-usuario">Crie sua senha:</label>
              <input type="password" name="senha-usuario" id="senha-usuario" required>
            </div>
            <div class="divisoes-formulario divisao-5-formulario">
              <label for="confirma-senha-usuario">Confirme sua senha:</label>
              <input type="password" name="confirma-senha-usuario" id="confirma-senha-usuario" required>
            </div>
            <div id="div-requisitos-senha" class="campo-guia-cadastro">
              <div>
                <p>Sua senha deve ter:</p>
              </div>
              <div class="div-alinhamento-senha">
                <div class="errado" id="caracteres"></div> 
                <p>No mínimo 8 caracteres</p>
              </div>
              <div class="div-alinhamento-senha">
                <div class="errado" id="maiuscula"></div> 
                <p>Letras maiúsculas e minúsculas</p>
              </div>
              <div class="div-alinhamento-senha">
                <div class="errado" id="numero"></div> 
                <p>Pelo menos um número</p>
              </div>
              <div class="div-alinhamento-senha">
                <div class="correto" id="acento"></div> 
                <p>Não contém acentos</p>
              </div>
            </div>
            <div class="div-passos-cadastro">
              <input onclick="verificar_senha()" type="submit" name="alterarSenha" value="Alterar senha" class="botao-seguinte" id="seguinte" required>
            </div>
          </form>
        </div>  
      </section>
    </section>
  </body>
</html>