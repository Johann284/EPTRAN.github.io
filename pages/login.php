<?php 
include "../sql/db_connect.php";

session_start();

if (session_status() !== PHP_SESSION_ACTIVE) {//Verificar se a sessão não já está aberta.
};

if (isset($_POST["entrar"])) {
    $login_usuario = $_POST['usuario-email'];
    $senha_usuario = $_POST['senha'];

    // Usando prepared statements
    $stmt = $conn->prepare("SELECT id_usuario, senha_usuario, nickname_usuario, nome_usuario, genero_usuario, data_nasc_usuario, data_cadastro_usuario, avatar_usuario, data_nasc_usuario, id_usuario, email_usuario, serie_usuario, fk_escola, fk_endereco FROM usuarios WHERE (nickname_usuario = ? OR email_usuario = ?)");
    $stmt->bind_param("ss", $login_usuario, $login_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        // Verifica a senha digitada com a senha armazenada
        if (password_verify($senha_usuario, $row['senha_usuario'])) {
            // Redireciona para a página de dashboard
            $_SESSION['genero'] = $row['genero_usuario'];
            $_SESSION['senha'] = $row['senha_usuario']; // teste
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['data_nasc_usuario'] = $row['data_nasc_usuario'];
            $_SESSION['cadastro_usuario'] = $row['data_cadastro_usuario'];
            $_SESSION['avatar'] = $row['avatar_usuario'];
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['email'] = $row['email_usuario'];
            $_SESSION['fk_escola'] = $row['fk_escola'];
            $_SESSION['fk_endereco'] = $row['fk_endereco'] ;
            $_SESSION['serie'] = $row['serie_usuario'];
            $_SESSION['nickname'] = $row['nickname_usuario'];
            $_SESSION['nome_usuario'] = $row['nome_usuario'];
            header("Location: telaInicial.php");
            exit();
        } else {
            echo "A senha digitada está incorreta.";
        }
    } else {
        echo "A conta digitada não existe.";
    }

    $stmt->close();
};
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Entrar</title>
    <link rel="stylesheet" href="../styles/loginCadastro.css" />
    <link rel="stylesheet" href="../styles/geral.css" />
  </head>
  <body>
    <header>
      <img
        src="../styles/imagens/logo_eptran.png"
        alt="Logo da Prefeitura de Joinville"
      />
    </header>
    <div id="container">
      <h1 id="h1-login">ENTRE</h1>
      <form method="post" id="form-login">
        <div class="campo-login">
          <label for="usuario-email">Usuário ou email:</label>
          <input
            type="text"
            id="usuario-email"
            class="input-login"
            name="usuario-email"
            required
          />
        </div>
        <div class="campo-login">
          <label for="senha">Senha:</label>
          <input
            type="password"
            id="senha"
            class="input-login"
            name="senha"
            required
          />
        </div>
        <input id="botao-login" 
                type="submit"
                name="entrar"
                value="Seguinte"
                class="botao-seguinte"
            />
      </form>
      <div>
        <a id="ir-para-cadastro" href="esqueciSenha.php">Esqueceu a senha?</a>  
      </div>
      <div id="ou">
      <h1>OU</h1> 
      </div>
      <div id="ir-para-cadastro">
        <p>Não possui cadastro?</p>
        <a href="cadastro.php">Cadastre-se:</a>
      </div>
    </div>
  </body>
</html>