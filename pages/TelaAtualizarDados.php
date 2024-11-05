<?php
include '../sql/db_connect.php';
session_start();

if (isset($_POST['atualizar']) && isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $serie = $_POST['categoria-de-ensino'];
    $escola = $_POST['instituicao-do-aluno']; 

    // Get `id_escola` from `escolas` table based on selected school name
    $stmt_escola = $conn->prepare("SELECT id_escola FROM escolas WHERE nome_escola = ?");
    $stmt_escola->bind_param("s", $escola);
    $stmt_escola->execute();
    $result_escola = $stmt_escola->get_result();
    $fk_escola = $result_escola->fetch_assoc()['id_escola'];
    $stmt_escola->close();

    // Update `serie_usuario` and `fk_escola` in `usuarios` table for the given `id_usuario`
    $stmt = $conn->prepare("UPDATE usuarios SET serie_usuario = ?, fk_escola = ? WHERE id_usuario = ?");
    $stmt->bind_param("sii", $serie, $fk_escola, $id_usuario);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Erro ao atualizar os dados.";
    }

    $stmt->close();
}

// pegar as escolas
$pesquisas_escolas = "SELECT nome_escola, id_escola FROM escolas";
$result = $conn->query($pesquisas_escolas);
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Atualização de dados</title>
    <link rel="stylesheet" href="../styles/loginCadastro.css" />
    <link rel="stylesheet" href="../styles/geral.css" />
    <link rel="stylesheet" href="../styles/AtualizarDados.css" />
  </head>
  <body>
    <header>
      <img
        src="../styles/imagens/logo_eptran.png"
        alt="Logo da Prefeitura de Joinville"
      />
    </header>
      <div>
        <div id="div-atualizar-dados">
            <h1 id="titulo-atualizar-dados">Atualização de dados</h1>
            <a id="subtitulo-atualizar-dados">Precisamos atualizar os dados dos nossos usuários</a>
        </div>
        <div id="mensagem-atualizar-dados">
            <a>Você ainda continua nesta série ou escola?<br>Por favor, altere os campos abaixo como for necessário</a>
        </div>
      </div>
      <div id="div-forms-atualizar">
        <form action="POST">
          <label for="categoria-de-ensino">Série:</label>
          <select required name="categoria-de-ensino" id="categoria-de-ensino">
            <option selected disabled value="default">Selecione uma opção</option>
            <option value="1º série">1º ano do Ensino Fundamental</option>
            <option value="2º série">2º ano do Ensino Fundamental</option>
            <option value="3º série">3º ano do Ensino Fundamental</option>
            <option value="4º série">4º ano do Ensino Fundamental</option>
            <option value="5º série">5º ano do Ensino Fundamental</option>
            <option value="6º série">6º ano do Ensino Fundamental</option>
            <option value="7º série">7º ano do Ensino Fundamental</option>
            <option value="8º série">8º ano do Ensino Fundamental</option>
            <option value="9º série">9º ano do Ensino Fundamental</option>
            <option value="1º série ensino médio">1º ano do Ensino Médio</option>
            <option value="2º série ensino médio">2º ano do Ensino Médio</option>
            <option value="3º série ensino médio">3º ano do Ensino Médio</option>
            <option value="4º série ensino médio">4º ano do Ensino Médio</option>
          </select>
        </form>
        <label for="instituicao-do-aluno">Instituição de Ensino:</label>
        <select name="instituicao-do-aluno" required>
            <option selected disabled >Selecione uma instituição</option>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?= $row['nome_escola']; ?>">
                    <?= $row['nome_escola']; ?>
                </option>
            <?php endwhile; ?>
        </select>
      </div>
      <div id="div-botao-comfimar-dados">
        <button type="submit">Confirmar dados</button>
      </div>
  </body>        
</html>
