<?php
include '../sql/db_connect.php'; // Inclui o arquivo de conexão
// session_start(); // Inicia a sessão para armazenar dados temporariamente

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Captura os dados do formulário e armazena na sessão
  $_SESSION['form_data'] = $_POST;
    
    
    /*
      $sql = "INSERT INTO enderecos (cep_endereco, estado_endereco, bairro_endereco, cidade_endereco) VALUES ('$cep', '$estado', '$bairro', '$cidade_usuario')";

      if ($conn->query($sql) === TRUE) {
        echo "<div style='color: green;'>Endereço salvo com sucesso!</div>";
      } else {
        echo "<div style='color: red;'>Erro: " . $conn->error . "</div>";
      }
    */
      
  
  if (isset($_POST['tela-cadastro-cinco'])) {

    if ($_POST['estudante-ensino-medio-fundamental'] == '0') {
      $nivel_ensino = 'Não sou estudante';
    } else {
      $nivel_ensino = $_SESSION['form_data']['categoria-de-ensino'];
    };
    // Se o botão "Finalizar" foi clicado, insere os dados no banco
    $nome = $_SESSION['form_data']['nome-completo'];
    $nickname = $_SESSION['form_data']['nome-de-usuario'];
    $email = $_SESSION['form_data']['email-usuario'];
    $senha = password_hash($_SESSION['form_data']['senha-usuario'], PASSWORD_DEFAULT); // Hash da senha
    $genero = $_SESSION['form_data']['genero-usuario'];
    $data_nasc = $_SESSION['form_data']['data-nasc-usuario'];
    $fk_escola = 1;
    $avatar_usuario = 1;
    // ENDERECOS
    
    $cep = $_SESSION['form_data']['cep'];
    $estado = $_SESSION['form_data']['estado'];
    $bairro = $_SESSION['form_data']['bairro'];
    $cidade_usuario = $_SESSION['form_data']['cidade-usuario'];
    
    // Pega o id do endereco onde o cep é o digitado
    $stmt = $conn->prepare("SELECT e.id_endereco FROM enderecos As e WHERE e.cep_endereco = '$cep';");
    $stmt->execute();
    $resultado = $stmt->get_result();


    if ($resultado->num_rows > 0) {
      $row = $resultado->fetch_assoc();
      $fk_endereco = $row['id_endereco']; // pega o fk para ser o mesmo valor do id retornado no select para ver o cep 
    } else{
      $stmt = $conn->prepare("INSERT INTO enderecos (cep_endereco, estado_endereco, bairro_endereco, cidade_endereco) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssss", $cep, $estado, $bairro, $cidade_usuario);
      $stmt->execute();
      $fk_endereco = $conn->insert_id; // page o id do dado inserido
    };
    // FIM - ENDERECOS

    
    
      // Prepara a query de inserção
    $sql = "INSERT INTO usuarios (nome_usuario, nickname_usuario, email_usuario, senha_usuario, serie_usuario, genero_usuario, data_nasc_usuario, fk_escola, fk_endereco, avatar_usuario) VALUES ('$nome', '$nickname', '$email', '$senha', '$nivel_ensino', '$genero', '$data_nasc', '$fk_escola', '$fk_endereco', '$avatar_usuario')";

    if ($conn->query($sql) === TRUE) {
      echo "<div style='color: green;'>Cadastro realizado com sucesso!</div>";
      header("Location: login.php");
      exit();
    } else {
      echo "<div style='color: red;'>Erro: " . $conn->error . "</div>";
    }


  };
}
// pegar as escolas 
$pesquisas_escolas = "SELECT nome_escola, id_escola FROM escolas";
$result = $conn->query($pesquisas_escolas);
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro EPTRAN</title>
    <link rel="stylesheet" href="../styles/loginCadastro.css"/>
    <link rel="stylesheet" href="../styles/geral.css"/>
    
    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script defer src="../scripts/cadastro_fullstack.js"></script>

      <!--Estou aqui?-->

  </head>
  <body>
    <header>
      <img src="../styles/imagens/logo_eptran.png" />
    </header>
    <form method="POST" action="" id="form-tudo">
    <!--Inicio da tela-cadrastro-1-->
    <section id="section-principal-tela-1" class="block">
      <div>
        <a href="./telaLogin.html"><button class="botao-voltar"><img class="seta-para-esquerda" src="../styles/imagens/seta-voltar-preta.svg" alt="" />Voltar</button></a>
      </div>

      <div class="faca-seu-cadastro">
        <h2>Faça o seu cadastro</h2>
        <p class="paragrafo-informacoes-cadastro">Informações Pessoais</p>
      </div>
    

      <div class="classe-do-cadastro">
        
          <div class="divisoes-formulario">
            <label for="nome-completo">Nome completo:</label>
            <input type="text" name="nome-completo" id="nome-completo" required/>
          </div>

          <div class="divisoes-formulario">
            <label for="data-nasc-usuario" class="campo-guia-cadastro">Data Nascimento:</label>
            <input type="date" name="data-nasc-usuario" id="data-nasc-usuario" required/>
          </div>

          <div class="divisoes-formulario divisao-1-formulario">
            <label for="genero-usuario" class="campo-guia-cadastro">Gênero:</label>
            <select required name="genero-usuario" id="genero-usuario">
              <option selected disabled value="nulo">Selecione uma opção</option>
              <option value="feminino">Feminino</option>
              <option value="masculino">Masculino</option>
              <option value="outro">Outro</option>
              <option value="prefiro-nao-informar">Prefiro não informar</option>
            </select>
          </div>

          <div class="div-passos-cadastro">
            <input id="criar-array" type="button" value="Seguinte" class="botao-seguinte" name="tela-cadastro-um">
            <div id="div-bolas">
              <span class="bola-aberta"></span>
              <span class="bola-fechado"></span>
              <span class="bola-fechado"></span>
              <span class="bola-fechado"></span>
              <span class="bola-fechado"></span>
            </div>
          </div>
      </div>
    </section>
    <!--Fim da tela-cadrastro-1-->

    <!--Inicio da tela cadastro 2-->
    <section id="section-principal-tela-2" class="none">
      <div>
        <button onclick="voltarSectionUm()" class="botao-voltar" id="botao-voltar"><img class="seta-para-esquerda" src="../styles/imagens/seta-voltar-preta.svg" alt="" />Voltar</button>
      </div>

      <div class="faca-seu-cadastro">
        <h2>Faça o seu cadastro</h2>
        <p class="paragrafo-informacoes-cadastro">Informações de Conta</p>
      </div>

      <div class="classe-do-cadastro">
          <div class="divisoes-formulario">
            <label for="nome-de-usuario">Nome de usuário:</label>
            <input type="text" name="nome-de-usuario" id="nome-de-usuario" required />
          </div>

          <div class="divisoes-formulario divisao-2-formulario">
            <label for="email-usuario" class="campo-guia-cadastro">Email:</label>
            <input type="email" name="email-usuario" id="email-usuario" required />
          </div>

          <div class="divisoes-formulario">
            <p>Escolha a opção que mais se adequa a você:</p>
            <div id="div-opc-estudante">
                <select name="estudante-ensino-medio-fundamental" id="estudante-ensino-medio-fundamental">
                    <option selected disabled value="default">Selecione uma opção</option>
                    <option value="1">Estou estudando no Ensino médio ou Fundamental</option>
                    <option value="0">Não estou mais no Ensino médio ou Fundamental</option>
                </select>
            </div>
          </div>
          <div class="div-passos-cadastro">
            <input id="criar-novo-array" type="button" value="Seguinte" class="botao-seguinte" name="tela-cadastro-dois">
            <div id="div-bolas">
              <span class="bola-aberta"></span>
              <span class="bola-aberta"></span>
              <span class="bola-fechado"></span>
              <span class="bola-fechado"></span>
              <span class="bola-fechado"></span>
            </div>
          </div>
      </div>
    </section>
    <!--Fim da tela cadastro 2-->

    <!--Inicio da tela cadastro 3-->
    <section id="section-principal-tela-3" class="none">
      <div>
        <button class="botao-voltar" onclick="voltarSectionDois()"><img class="seta-para-esquerda" src="../styles/imagens/seta-voltar-preta.svg" alt="" />Voltar</button>
      </div>
      <div class="faca-seu-cadastro">
        <h2>Faça o seu cadastro</h2>
        <p class="paragrafo-informacoes-cadastro">Informações Institucionais</p>
      </div>
      <div class="classe-do-cadastro">
          <div class="divisoes-formulario">
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
              <option value="8º série">9º ano do Ensino Fundamental</option>
              <option value="1º série ensino médio">1º ano do Ensino Médio</option>
              <option value="2º série ensino médio">2º ano do Ensino Médio</option>
              <option value="3º série ensino médio">3º ano do Ensino Médio</option>
              <option value="4º série ensino médio">4º ano do Ensino Médio</option>
            </select>
          </div>

          <div class="divisoes-formulario divisao-4-formulario">
            <label for="nome-escola" class="campo-guia-cadastro">Instituição de Ensino:</label>
            <select name="instituicao-do-aluno" required>
                <option selected disabled >Selecione uma instituição</option>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?= $row['nome_escola']; ?>">
                        <?= $row['nome_escola']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <div class="div-passos-cadastro">
              <input id="criar-array-serie" type="button" value="Seguinte" class="botao-seguinte" name="tela-cadastro-tres">

              <div id="div-bolas">
                <span class="bola-aberta"></span>
                <span class="bola-aberta"></span>
                <span class="bola-aberta"></span>
                <span class="bola-fechado"></span>
                <span class="bola-fechado"></span>
              </div>
            </div>
          </div>
      </div>
    </section>
    <!--Fim tela cadastro 3-->

    <!--Inicio da tela cadastro 4-->
    <section id="section-principal-tela-4" class="none">
      <div>
        <button class="botao-voltar" onclick="voltarSectionTres()"><img class="seta-para-esquerda" src="../styles/imagens/seta-voltar-preta.svg" alt="" />Voltar</button>
      </div>


      <div class="faca-seu-cadastro">
        <h2>Faça o seu cadastro</h2>
        <p class="paragrafo-informacoes-cadastro">Informações Pessoais</p>
      </div>

      <div class="classe-do-cadastro">
          <div class="divisoes-formulario"> <!--CEP -->
            <label for="cep">CEP(Exatamente 8 caracteres numéricos!):</label>
            <input type="text" name="cep" id="cep" required />
          </div>

          <div class="divisoes-formulario"> <!--Estado -->
            <label for="estado" class="campo-guia-cadastro">Estado:</label>
            <select type="text" name="estado" id="estado" value="Santa Catarina" required>
              <option selected disabled value="default">Selecione uma opção</option>
              <option value="santa-catarina">Santa Catarina</option>
            </select>
          </div>

          <div class="divisoes-formulario"> <!--Bairro -->
            <label for="bairro" class="campo-guia-cadastro">Bairro:</label>
            <input type="text" name="bairro" id="bairro" required />
          </div>

          <div class="divisoes-formulario divisao-3-formulario"> <!--Cidade -->
            <label for="cidade-usuario" class="campo-guia-cadastro">Cidade:</label>
            <select required name="cidade-usuario" id="cidade-usuario">
              <option selected disabled value="default">Selecione uma opção</option>
              <option value="abelardo-luz">Abelardo Luz</option>
              <option value="agrolandia">Agrolândia</option>
              <option value="agronomica">Agronômica</option>
              <option value="agua-doce">Água Doce</option>
              <option value="aguas-de-chapeco">Águas de Chapecó</option>
              <option value="aguas-frias">Águas Frias</option>
              <option value="aguas-mornas">Águas Mornas</option>
              <option value="alfredo-wagner">Alfredo Wagner</option>
              <option value="alto-bela-vista">Alto Bela Vista</option>
              <option value="anchieta">Anchieta</option>
              <option value="angelina">Angelina</option>
              <option value="anita-garibaldi">Anita Garibaldi</option>
              <option value="anitapolis">Anitápolis</option>
              <option value="antonio-carlos">Antônio Carlos</option>
              <option value="apiuna">Apiúna</option>
              <option value="arabuta">Arabutã</option>
              <option value="araquari">Araquari</option>
              <option value="ararangua">Araranguá</option>
              <option value="armazem">Armazém</option>
              <option value="arroio-trinta">Arroio Trinta</option>
              <option value="arvoredo">Arvoredo</option>
              <option value="ascurra">Ascurra</option>
              <option value="atalanta">Atalanta</option>
              <option value="aurora">Aurora</option>
              <option value="balneario-arroio-do-silva">Balneário Arroio do Silva</option>
              <option value="balneario-barra-do-sul">Balneário Barra do Sul</option>
              <option value="balneario-camboriu">Balneário Camboriú</option>
              <option value="balneario-gaivota">Balneário Gaivota</option>
              <option value="bandeirante">Bandeirante</option>
              <option value="barra-bonita">Barra Bonita</option>
              <option value="barra-velha">Barra Velha</option>
              <option value="bela-vista-do-toldo">Bela Vista do Toldo</option>
              <option value="belmonte">Belmonte</option>
              <option value="benedito-novo">Benedito Novo</option>
              <option value="biguacu">Biguaçu</option>
              <option value="blumenau">Blumenau</option>
              <option value="bocaina-do-sul">Bocaina do Sul</option>
              <option value="bom-jardim-da-serra">Bom Jardim da Serra</option>
              <option value="bom-jesus">Bom Jesus</option>
              <option value="bom-jesus-do-oeste">Bom Jesus do Oeste</option>
              <option value="bom-retiro">Bom Retiro</option>
              <option value="bombinhas">Bombinhas</option>
              <option value="botuvera">Botuverá</option>
              <option value="braco-do-norte">Braço do Norte</option>
              <option value="braco-do-trombudo">Braço do Trombudo</option>
              <option value="brunopolis">Brunópolis</option>
              <option value="brusque">Brusque</option>
              <option value="cacador">Caçador</option>
              <option value="caibi">Caibi</option>
              <option value="calmon">Calmon</option>
              <option value="camboriu">Camboriú</option>
              <option value="campo-alegre">Campo Alegre</option>
              <option value="campo-belo-do-sul">Campo Belo do Sul</option>
              <option value="campo-ere">Campo Erê</option>
              <option value="campos-novos">Campos Novos</option>
              <option value="canelinha">Canelinha</option>
              <option value="canoinhas">Canoinhas</option>
              <option value="capao-alto">Capão Alto</option>
              <option value="capinzal">Capinzal</option>
              <option value="capivari-de-baixo">Capivari de Baixo</option>
              <option value="catanduvas">Catanduvas</option>
              <option value="caxambu-do-sul">Caxambu do Sul</option>
              <option value="celso-ramos">Celso Ramos</option>
              <option value="cerro-negro">Cerro Negro</option>
              <option value="chapadao-do-lageado">Chapadão do Lageado</option>
              <option value="chapeco">Chapecó</option>
              <option value="cocal-do-sul">Cocal do Sul</option>
              <option value="concordia">Concórdia</option>
              <option value="cordilheira-alta">Cordilheira Alta</option>
              <option value="coronel-freitas">Coronel Freitas</option>
              <option value="coronel-martins">Coronel Martins</option>
              <option value="correia-pinto">Correia Pinto</option>
              <option value="corupa">Corupá</option>
              <option value="criciuma">Criciúma</option>
              <option value="cunha-pora">Cunha Porã</option>
              <option value="cunhatai">Cunhataí</option>
              <option value="curitibanos">Curitibanos</option>
              <option value="descanso">Descanso</option>
              <option value="dionisio-cerqueira">Dionísio Cerqueira</option>
              <option value="dona-emma">Dona Emma</option>
              <option value="doutor-pedrinho">Doutor Pedrinho</option>
              <option value="entre-rios">Entre Rios</option>
              <option value="ermo">Ermo</option>
              <option value="erval-velho">Erval Velho</option>
              <option value="faxinal-dos-guedes">Faxinal dos Guedes</option>
              <option value="flor-do-sertao">Flor do Sertão</option>
              <option value="florianopolis">Florianópolis</option>
              <option value="formosa-do-sul">Formosa do Sul</option>
              <option value="forquilhinha">Forquilhinha</option>
              <option value="fraiburgo">Fraiburgo</option>
              <option value="frei-rogerio">Frei Rogério</option>
              <option value="galvao">Galvão</option>
              <option value="garopaba">Garopaba</option>
              <option value="garuva">Garuva</option>
              <option value="gaspar">Gaspar</option>
              <option value="governador-celso-ramos">Governador Celso Ramos</option>
              <option value="grao-para">Grão-Pará</option>
              <option value="gravatal">Gravatal</option>
              <option value="guabiruba">Guabiruba</option>
              <option value="guaraciaba">Guaraciaba</option>
              <option value="guaramirim">Guaramirim</option>
              <option value="guaruja-do-sul">Guarujá do Sul</option>
              <option value="guatambu">Guatambu</option>
              <option value="herval-doeste">Herval d'Oeste</option>
              <option value="ibiam">Ibiam</option>
              <option value="ibicare">Ibicaré</option>
              <option value="ibirama">Ibirama</option>
              <option value="icara">Içara</option>
              <option value="ilhota">Ilhota</option>
              <option value="imarui">Imaruí</option>
              <option value="imbituba">Imbituba</option>
              <option value="imbuia">Imbuia</option>
              <option value="indaial">Indaial</option>
              <option value="iomere">Iomerê</option>
              <option value="ipira">Ipira</option>
              <option value="ipora-do-oeste">Iporã do Oeste</option>
              <option value="ipuacu">Ipuaçu</option>
              <option value="ipumirim">Ipumirim</option>
              <option value="iraceminha">Iraceminha</option>
              <option value="irani">Irani</option>
              <option value="irati">Irati</option>
              <option value="irineopolis">Irineópolis</option>
              <option value="ita">Itá</option>
              <option value="itaiopolis">Itaiópolis</option>
              <option value="itajai">Itajaí</option>
              <option value="itapema">Itapema</option>
              <option value="itapiranga">Itapiranga</option>
              <option value="itapoa">Itapoá</option>
              <option value="ituporanga">Ituporanga</option>
              <option value="jabora">Jaborá</option>
              <option value="jacinto-machado">Jacinto Machado</option>
              <option value="jaguaruna">Jaguaruna</option>
              <option value="jaragua-do-sul">Jaraguá do Sul</option>
              <option value="jardinopolis">Jardinópolis</option>
              <option value="joacaba">Joaçaba</option>
              <option value="joinville">Joinville</option>
              <option value="jose-boiteux">José Boiteux</option>
              <option value="jupia">Jupiá</option>
              <option value="lacerdopolis">Lacerdópolis</option>
              <option value="lages">Lages</option>
              <option value="laguna">Laguna</option>
              <option value="lajeado-grande">Lajeado Grande</option>
              <option value="laurentino">laurentino</option>
              <option value="lauro_muller">Lauro Müller</option>
              <option value="lebon_regis">Lebon Régis</option>
              <option value="leoberto_leal">Leoberto Leal</option>
              <option value="lindoia_do_sul">Lindóia do Sul</option>
              <option value="lontras">Lontras</option>
              <option value="luiz_alves">Luiz Alves</option>
              <option value="luzerna">Luzerna</option>
              <option value="macieira">Macieira</option>
              <option value="mafra">Mafra</option>
              <option value="major_gercino">Major Gercino</option>
              <option value="major_vieira">Major Vieira</option>
              <option value="maracaja">Maracajá</option>
              <option value="maravilha">Maravilha</option>
              <option value="marema">Marema</option>
              <option value="massaranduba">Massaranduba</option>
              <option value="matos_costa">Matos Costa</option>
              <option value="meleiro">Meleiro</option>
              <option value="mirim_doce">Mirim Doce</option>
              <option value="modelo">Modelo</option>
              <option value="mondai">Mondaí</option>
              <option value="monte_carlo">Monte Carlo</option>
              <option value="monte_castelo">Monte Castelo</option>
              <option value="morro_da_fumaca">Morro da Fumaça</option>
              <option value="morro_grande">Morro Grande</option>
              <option value="navegantes">Navegantes</option>
              <option value="nova_erechim">Nova Erechim</option>
              <option value="nova_itaberaba">Nova Itaberaba</option>
              <option value="nova_trento">Nova Trento</option>
              <option value="nova_veneza">Nova Veneza</option>
              <option value="novo_horizonte">Novo Horizonte</option>
              <option value="orleans">Orleans</option>
              <option value="otacilio_costa">Otacílio Costa</option>
              <option value="ouro">Ouro</option>
              <option value="ouro_verde">Ouro Verde</option>
              <option value="paial">Paial</option>
              <option value="painel">Painel</option>
              <option value="palhoca">Palhoça</option>
              <option value="palma_sola">Palma Sola</option>
              <option value="palmeira">Palmeira</option>
              <option value="palmitos">Palmitos</option>
              <option value="papanduva">Papanduva</option>
              <option value="paraiso">Paraíso</option>
              <option value="passo_de_torres">Passo de Torres</option>
              <option value="passos_maia">Passos Maia</option>
              <option value="paulo_lopes">Paulo Lopes</option>
              <option value="pedras_grandes">Pedras Grandes</option>
              <option value="penha">Penha</option>
              <option value="peritiba">Peritiba</option>
              <option value="pescaria_brava">Pescaria Brava</option>
              <option value="petrolandia">Petrolândia</option>
              <option value="pinhalzinho">Pinhalzinho</option>
              <option value="pinheiro_preto">Pinheiro Preto</option>
              <option value="piratuba">Piratuba</option>
              <option value="planalto_alegre">Planalto Alegre</option>
              <option value="pomerode">Pomerode</option>
              <option value="ponte_alta">Ponte Alta</option>
              <option value="ponte_alta_do_norte">Ponte Alta do Norte</option>
              <option value="ponte_serrada">Ponte Serrada</option>
              <option value="porto_belo">Porto Belo</option>
              <option value="porto_uniao">Porto União</option>
              <option value="pouso_redondo">Pouso Redondo</option>
              <option value="praia_grande">Praia Grande</option>
              <option value="presidente_castello_branco">Presidente Castello Branco</option>
              <option value="presidente_getulio">Presidente Getúlio</option>
              <option value="presidente_nereu">Presidente Nereu</option>
              <option value="princesa">Princesa</option>
              <option value="quilombo">Quilombo</option>
              <option value="rancho_queimado">Rancho Queimado</option>
              <option value="rio_das_antas">Rio das Antas</option>
              <option value="rio_do_campo">Rio do Campo</option>
              <option value="rio_do_oeste">Rio do Oeste</option>
              <option value="rio_do_sul">Rio do Sul</option>
              <option value="rio_dos_cedros">Rio dos Cedros</option>
              <option value="rio_fortuna">Rio Fortuna</option>
              <option value="rio_negrinho">Rio Negrinho</option>
              <option value="rio_rufino">Rio Rufino</option>
              <option value="riqueza">Riqueza</option>
              <option value="rodeio">Rodeio</option>
              <option value="romelandia">Romelândia</option>
              <option value="salete">Salete</option>
              <option value="saltinho">Saltinho</option>
              <option value="salto_veloso">Salto Veloso</option>
              <option value="sangao">Sangão</option>
              <option value="santa_cecilia">Santa Cecília</option>
              <option value="santa_helena">Santa Helena</option>
              <option value="santa_rosa_de_lima">Santa Rosa de Lima</option>
              <option value="santa_rosa_do_sul">Santa Rosa do Sul</option>
              <option value="santa_terezinha">Santa Terezinha</option>
              <option value="santa_terezinha_do_progresso">Santa Terezinha do Progresso</option>
              <option value="santiago_do_sul">Santiago do Sul</option>
              <option value="santo_amaro_da_imperatriz">Santo Amaro da Imperatriz</option>
              <option value="sao_bento_do_sul">São Bento do Sul</option>
              <option value="sao_bernardino">São Bernardino</option>
              <option value="sao_bonifacio">São Bonifácio</option>
              <option value="sao_carlos">São Carlos</option>
              <option value="sao_cristovao_do_sul">São Cristóvão do Sul</option>
              <option value="sao_domingos">São Domingos</option>
              <option value="sao_francisco_do_sul">São Francisco do Sul</option>
              <option value="sao_joao_batista">São João Batista</option>
              <option value="sao_joao_do_itaperiu">São João do Itaperiú</option>
              <option value="sao_joao_do_oeste">São João do Oeste</option>
              <option value="sao_joao_do_sul">São João do Sul</option>
              <option value="sao_joaquim">São Joaquim</option>
              <option value="sao_jose">São José</option>
              <option value="sao_jose_do_cedro">São José do Cedro</option>
              <option value="sao_jose_do_cerrito">São José do Cerrito</option>
              <option value="sao_lourenco_do_oeste">São Lourenço do Oeste</option>
              <option value="sao_ludgero">São Ludgero</option>
              <option value="sao_martinho">São Martinho</option>
              <option value="sao_miguel_da_boa_vista">São Miguel da Boa Vista</option>
              <option value="sao_miguel_do_oeste">São Miguel do Oeste</option>
              <option value="sao_pedro_de_alcantara">São Pedro de Alcântara</option>
              <option value="saudades">Saudades</option>
              <option value="schroeder">Schroeder</option>
              <option value="seara">Seara</option>
              <option value="serra_alta">Serra Alta</option>
              <option value="sideropolis">Siderópolis</option>
              <option value="sombrio">Sombrio</option>
              <option value="sul_brasil">Sul Brasil</option>
              <option value="taio">Taió</option>
              <option value="tangara">Tangará</option>
              <option value="tigrinhos">Tigrinhos</option>
              <option value="tijucas">Tijucas</option>
              <option value="timbe_do_sul">Timbé do Sul</option>
              <option value="timbo">Timbó</option>
              <option value="timbo_grande">Timbó Grande</option>
              <option value="tres_barras">Três Barras</option>
              <option value="treviso">Treviso</option>
              <option value="treze_de_maio">Treze de Maio</option>
              <option value="treze_tilias">Treze Tílias</option>
              <option value="trombudo_central">Trombudo Central</option>
              <option value="tubarao">Tubarão</option>
              <option value="tunapolis">Tunápolis</option>
              <option value="turvo">Turvo</option>
              <option value="uniao_do_oeste">União do Oeste</option>
              <option value="urubici">Urubici</option>
              <option value="urupema">Urupema</option>
              <option value="urussanga">Urussanga</option>
              <option value="vargeao">Vargeão</option>
              <option value="vargeao">Vargem</option>
              <option value="vargeao">Vargem Bonita</option>
              <option value="vargeao">Vidal Ramos</option>
              <option value="vargeao">Videira</option>
              <option value="vargeao">Vitor Meireles</option>
              <option value="vargeao">Witmarsum</option>
              <option value="vargeao">Xanxerê</option>
              <option value="vargeao">Xavantina</option>
              <option value="vargeao">Xaxim</option>
              <option value="vargeao">Zórtea</option>
            </select>
          </div>

          <div class="div-passos-cadastro">
            <input id="criar-array-geral" type="button" name="form-endereco" value="Seguinte" class="botao-seguinte" required/>
            <div id="div-bolas">
              <span class="bola-aberta"></span>
              <span class="bola-aberta"></span>
              <span class="bola-aberta"></span>
              <span class="bola-aberta"></span>
              <span class="bola-fechado"></span>
            </div>
          </div>
      </div>
    </section>
    <!--Fim da tela cadastro 4-->

    <!--Inicio tela-cadrastro-5-->
    <section id="section-principal-tela-5" class="none">
      <div>
        <button class="botao-voltar" type="button" onclick="voltarSectionQuatro()"><img class="seta-para-esquerda" src="../styles/imagens/seta-voltar-preta.svg" alt="" />Voltar</button>
      </div>

      <div class="faca-seu-cadastro">
        <h2>Faça o seu cadastro</h2>
      </div>

      <div class="classe-do-cadastro">
          <div class="divisoes-formulario">
            <label for="senha-usuario">Crie sua senha:</label>
            <input type="password" name="senha-usuario" id="senha-usuario">
          </div>

          <div class="divisoes-formulario divisao-5-formulario">
            <label for="confirma-senha-usuario" class="campo-guia-cadastro">Confirme sua senha:</label>
            <input type="password" name="confirma-senha-usuario" id="confirma-senha-usuario">
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

          <div class="div-passos-cadastro campo-guia-cadastro">
            <input type="submit" name="tela-cadastro-cinco" value="Seguinte" class="botao-seguinte" id="seguinte" disabled>
            <div id="div-bolas">
              <span class="bola-aberta"></span>
              <span class="bola-aberta"></span>
              <span class="bola-aberta"></span>
              <span class="bola-aberta"></span>
              <span class="bola-aberta"></span>
            </div>
          </div>
      </div>
    </section>
    </form>
    <!-- Fim tela-cadrastro 5-->
  </body>
</html>