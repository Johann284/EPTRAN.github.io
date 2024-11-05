<?php
include "../../sql/db_connect.php";

$data_nascimento = isset($_POST['dataNascimento']) && !empty($_POST['dataNascimento']) ? $_POST['dataNascimento'] : null;
$genero_usuario = isset($_POST['genero_usuario']) && !empty($_POST['genero_usuario']) ? $_POST['genero_usuario'] : null;

$sql_usuarios = "SELECT id_usuario, nome_usuario, nickname_usuario, data_nasc_usuario, genero_usuario FROM usuarios WHERE 1=1";

if ($genero_usuario) {
    $sql_usuarios .= " AND genero_usuario = '$genero_usuario'";
}
if ($data_nascimento) {
    $sql_usuarios .= " AND data_nasc_usuario = '$data_nascimento'";
}
/*------------------------------------------------------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------------------------------------------------------*/
$result_usuarios = $conn->query($sql_usuarios);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
</head>
<body>
    <a href="adm.php"><button>Voltar</button></a>
    <h1>Gerenciar Usuários</h1>
    <section id="Pessoais">
        <h2>Pessoais</h2>
        <h4>Filtros</h4>
        <form action="gerenciar_usuarios.php" method="POST">
            <input id="checkboxData" type="checkbox">Data de Nascimento</input>
            <br>
            <input id="dataNascimento" type="date" name="dataNascimento" disabled value="<?php echo $data_nascimento; ?>">
            <br>

            <br>
            <input id="checkboxGenero" type="checkbox">Gênero</input>
            <select name="genero_usuario" id="generosFiltro" disabled>
                <option selected disabled>Selecione uma opção</option>
                <option value="Masculino" <?php if ($genero_usuario == 'Masculino') echo 'selected';?>>Masculino</option>
                <option value="Feminino"<?php if ($genero_usuario == 'Feminino') echo 'selected';?>>Feminino</option>
                <option value="Outro"<?php if ($genero_usuario == 'Outro') echo 'selected';?>>Outro</option>
                <option value="Prefiro não informar"<?php if ($genero_usuario == 'Prefiro não informar') echo 'selected';?>>Prefiro não informar</option>
            </select>
            <br>
            <input type="submit" value="Filtrar">
        </form>
    </section>

    <section id="Institucionais">
        <h2>Institucionais</h2>
        <h4>Filtros</h4>
        <form action="gerenciar_usuarios.php" method="POST">
        <input id="checkboxInstituicao" type="checkbox">Instituição de Ensino</input>
            <select name="instituicao_ensino" id="instituicaoEnsino">
                <option selected disabled>Selecione o nome de uma instituição de ensino</option>
            </select>
            <br>
         <input id="checkboxSerie" type="checkbox">Série</input>
            <select name="instituicao_ensino" id="instituicaoEnsino">
                <option selected disabled>Selecione uma série</option>
            </select>
        </form>
    </section>
    <section id="Redisenciais">
    </section>

    <a href="../cadastro/cadastro.php"><button>Adicionar Usuário</button></a>

    <section id="Read Principal">
            <?php 
            if ($result_usuarios -> num_rows > 0) {
                echo "
                <table border='1'>
                <tr>
                    <th> ID do Usuário </th>
                    <th> Nome do Usuário </th>
                    <th> Apelido do Usuário </th>
                    <th> Data de Nascimento </th>
                    <th> Gênero do Usuário </th>
                " ;
                while($row = $result_usuarios -> fetch_assoc()){
                    echo "<tr>
                            <td> {$row['id_usuario']} </td>
                            <td> {$row['nome_usuario']} </td>
                            <td> {$row['nickname_usuario']} </td>
                            <td> {$row['data_nasc_usuario']} </td>
                            <td> {$row['genero_usuario']} </td>
                            <td>
                                <a href='edicao_usuario_adm.php?editar_id_usuario={$row['id_usuario']}'><button>Editar</button></a>
                            </td>";
                }
            } else {
                echo "Nenhum usuário encontrado para os critérios selecionados.";
            }
            
            ?>
    </section>
</body>

<script>
    var dataNascimento = document.getElementById("dataNascimento");
    var checkboxData = document.getElementById("checkboxData");
    var generosFiltro = document.getElementById("generosFiltro");
    var checkboxGenero = document.getElementById("checkboxGenero");

    checkboxData.addEventListener('click', ()=> {
        dataNascimento.disabled = !checkboxData.checked; 
    });

    checkboxGenero.addEventListener('click', ()=> {
        generosFiltro.disabled = !checkboxGenero.checked; 
    });
</script>
</html>