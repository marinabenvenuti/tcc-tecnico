<?php
session_start();
if(!isset($_GET['cont_id'])){
  if(!isset($_POST['cont_id'])){
    header('Location: treinar.php');
    exit;
  }else{
    $cod = $_POST['cont_id'];
  }
}else{
  $cod = $_GET['cont_id'];
}
include('conexao.php');
if(isset($_SESSION["email_logado"]) == false) {
    header('location: cadastrousuario.php');
    exit;
};
include('getuser.php');

$sql = "SELECT * from conteudo WHERE cod_conteudo = '$cod'";
$result = mysqli_query($conn, $sql);
$conteudo = mysqli_fetch_array($result, MYSQLI_ASSOC);
if(!isset($conteudo)){
  header('Location: treinar.php');
  exit;
}
$sql = "SELECT * from questao where cod_conteudo = '$cod'";
$questoes = mysqli_query($conn, $sql);
$erros = [];

if(isset($_POST['sub_questoes'])){
  $acertos = 0;
  while($questao = mysqli_fetch_assoc($questoes)) {
    
      if(isset($_POST[$questao['cod_questao']])){
        $marcou = $_POST[$questao['cod_questao']];
      }else{
        $marcou = 'asdjasnksfasdbhf';
      }
      if($marcou == 'alt'.$questao['alt_correta']){
        $acertos++;
      }
      $erros[$questao['cod_questao']] = ['marcou'=> $marcou, 'certa'=>'alt'.$questao['alt_correta']];
  }
  $uid = $user['cod_usuario'];
  $sql = "select * from conteudos_usuarios where cod_usuario = '$uid' and cod_conteudo = '$cod'";
  $cont_user = mysqli_query($conn, $sql);
  $cont_user = mysqli_fetch_array($cont_user, MYSQLI_ASSOC);
  if(!$cont_user){
    $sql = "update usuarios set nivel = nivel+1 where cod_usuario = '$uid'"; 
    mysqli_query($conn, $sql);
    $sql = "insert into conteudos_usuarios (cod_usuario, cod_conteudo, acertos) values('$uid','$cod', '$acertos')";
    mysqli_query($conn, $sql);
  }
}
$sql = "SELECT * from questao where cod_conteudo = '$cod'";
$questoes = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="pt-br">
<link rel="preconnect" href="https://fonts.googleapis.com">
  <script src="https://kit.fontawesome.com/9884a810af.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css" />
<link rel="stylesheet" href="stylequest.css">
<link rel="icon" type="image/x-icon" href="images/logo2.ico">

<style>
    body {
margin: 0;

font-family: 'Open Sans', sans-serif;

background: white;

min-height: 100vh;
}

.page {

width: 1000px;
margin: 0 auto;
padding-top: 50px;
}

nav {
display: flex;
justify-content: space-between;
align-items: center;
text-transform: none !important;
margin-bottom: 40px;
}

nav ul {
display: flex;
gap: 48px;
list-style: none;
margin: 0;
padding: 0;
}

nav a {
color: #191616;
text-decoration: none;
}

nav ul li a {
opacity: 0.;
}

nav ul li a:hover {
font-weight: bold;
opacity: 1;
}

nav h1, ul {
font-family: 'Mulish', sans-serif;
}

main {
display: flex;
align-items: center;
justify-content: space-between;
}

nav h1 {
font-size: 49px;
line-height: 56px;
color: #191616;

font-weight: normal;

width: 490px; 
}

h1 span {
color: #FFBD59;
font-weight: bold;
}

section p {
font-size: 15px;
line-height: 28px;
color: #4f4d55;

width: 440px;

margin: 40px 0;
}

.table {
border-collapse: collapse;
width: 100%;
background-color: #ecf0f1;
border-radius: 4px;
}

th, td {
padding: 8px;
text-align: left;
}

tr:hover {
background-color: white;    

}


.btex {
text-transform: uppercase;
color: white;
background: #FFBD59; 
border: 0;
padding: 14px 10px 15px;
display: inline-flex;
align-items: center;
justify-content: center;
gap: 5px;
border-radius: 4px;
cursor: pointer;
font-family: 'Open Sans', sans-serif;
margin-bottom: 4px;

}


.button {
text-transform: uppercase;
color: white;
background: #FFBD59; 
border: 0;
padding: 14px 10px 15px;
display: inline-flex;
align-items: center;
justify-content: center;
gap: 5px;
border-radius: 4px;
cursor: pointer;
font-family: 'Open Sans', sans-serif;
margin-bottom: 4px;

}


.button:hover {
background: #fcc067; 
}

</style>

<head>
  <title>Golden Voice</title>
</head>

<body>
  <div class="page">
    <nav class="page-nav">
      <a id="logo" href="paginainicial.php">
        <img src="images/logohor.png" alt="logo" width="200px">
      </a>
      <ul>
        <?php if($user['is_admin']){?>
        <li> <i class="fa fa-list-check" aria-hidden="true"> </i><a href="admin.php"> Administrador</a></li>
        <?php } ?>
        <li> <i class="fa fa-microphone" aria-hidden="true"> </i> <a href="treinar.php"> Treinar</a></li>
        <li> <i class="fa fa-user" aria-hidden="true"> </i> <a href="perfil.php"> Perfil</a></li>
        <li> <i class="fa fa-question-circle" aria-hidden="true"> </i><a href="forum.php"> Fórum</a></li>
        <li> <i class="fa fa-power-off" aria-hidden="true"> </i><a href="logout.php"> Sair</a></li> 
      </ul>
    </nav>

      <div class="continput">

        <form action="" method="POST">
        <h1 style="font-size:xx-large;"><?=$conteudo['titulo']?></h1>
        <?php while($row = mysqli_fetch_assoc($questoes)) {?>
          
            <h4><?=$row['enunciado']?></h4>
            <?php 
            if($row['midia']){
              $midialink = "https://www.youtube.com/embed/".explode("https://www.youtube.com/watch?v=",$row['midia'])[1];
            }
            if($row['midia']){?>
                <iframe id="video" width="560" height="315" src=<?=$midialink?> title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <?php 
            } ?>
            <ul>
              <?php for ($i=1; $i <= 5; $i++) { ?>
                <li>
                  <input type="radio" name="<?=$row['cod_questao']?>" value="<?="alt".$i?>" required>
                  <label id="questao" class="<?php
                    if(count($erros) > 0){
                      if($erros[$row['cod_questao']]['certa'] == 'alt'.$i){
                        echo 'correta';
                        }
                        if($erros[$row['cod_questao']]['marcou'] == 'alt'.$i && $erros[$row['cod_questao']]['certa'] != 'alt'.$i){
                          echo 'errada';
                        }
                    }
                    ?>"><?=$row['alt'.$i]?></label>

                  <div class="bullet">
                    <div class="line zero"></div>
                    <div class="line one"></div>
                    <div class="line two"></div>
                    <div class="line three"></div>
                    <div class="line four"></div>
                    <div class="line five"></div>
                    <div class="line six"></div>
                    <div class="line seven"></div>
                  </div>
                </li>
              <?php } ?>
            </ul>
          <?php } ?>
          <?php if(!isset($_POST['sub_questoes'])){?>
          <button class= "button" type="submit" name="sub_questoes">Enviar</button>
          <?php } ?>
        </form>
      </div>
    </div>
</body>
