<?php
/*
SELECT * FROM usuarios;


-- mulher
SELECT id_usuario, genero_usuario FROM usuarios WHERE genero_usuario = 'Feminino';


-- homem
SELECT id_usuario, genero_usuario FROM usuarios WHERE genero_usuario = 'Masculino';

-- genero
SELECT genero_usuario FROM usuarios;

-- menos de 18 anos
SELECT data_nasc_usuario FROM usuarios WHERE YEAR(CURRENT_DATE) - YEAR(data_nasc_usuario) >= 18;

-- mais de 18 anos
SELECT data_nasc_usuario FROM usuarios WHERE YEAR(CURRENT_DATE) - YEAR(data_nasc_usuario) < 18;
-- bairro
SELECT u.nome_usuario, e.bairro_endereco FROM enderecos AS e INNER JOIN usuarios AS u WHERE e.id_endereco = u.fk_endereco;


-- cidade
SELECT u.nome_usuario, e.cidade_usuario FROM enderecos AS e INNER JOIN usuarios AS u WHERE e.id_endereco = u.fk_endereco;

-- serie 
SELECT serie_usuario FROM usuarios;


*/
include '../../sql/db_connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$sql = "select * from usuarios";
$result = $conn -> query($sql);
if ($result -> num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $data = json_encode($data);
}
    echo "<script defer>var graphData = $data;</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração</title>
    <link rel="stylesheet" href="adm.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/fc7cc2b487.js" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
</head>
<body>
<h1> Administração <h2>
<a href="gerenciar_usuarios.php"><button>Gerenciar Usuários</button></a>
<h2> Relatórios </h2>
    <div id="filter">
    <i class="fa-solid fa-minus" id="filter-icon"></i>
        <div id="filter-content">
            <form action="adm.php" method="POST">
                <h4>Periodo:</h4>
                <div class="flex">
                    <span>De </span><input type="date" id="date-start"><span> até </span><input type="date" id="date-end">
                </div>
                <h4>Filtros <small>(escolha até no máximo 2 filtros):</small></h4>
                <div>
                    <input type="checkbox" name="filter-levels" id="filter-levels">
                    <label for="filter-levels">Níves de Ensino</label>
                </div>
                <div>
                    <input type="checkbox" name="filter-gender" id="filter-gender">
                    <label for="filter-gender">Gênero</label>
                </div>
                <div>
                    <input type="checkbox" name="filter-place" id="filter-place">
                    <label for="filter-place">Localidade <small>(estado, cidade, bairro)</small></label>
                </div>
                <div>
                    <input type="checkbox" name="filter-age" id="filter-age">
                    <label for="filter-age">Faixa etária</label>
                </div>
                <div>
                    <input type="checkbox" name="filter-grade" id="filter-grade">
                    <label for="filter-grade">Série</label>
                </div>
                <input type="submit" value="Filtrar">
            </form>
        </div>
    </div>
    <div id="table">

    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
    </div>
    <script src="adm.js"></script>
    <script>
        $(document).ready(function () {
            if (typeof graphData !== 'undefined') {
                makeGraph(graphData);
            }
        });
    </script>
</body>
</html>