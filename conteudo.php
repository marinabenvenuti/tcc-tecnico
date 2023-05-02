<!DOCTYPE html>
<html lang="pt-br">
<?php
include('conexao.php');
session_start();
if(isset($_SESSION["email_logado"]) == false) {
    header('location: cadastrousuario.php');
    exit;
};
include('getuser.php');
?>

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <script src="https://kit.fontawesome.com/9884a810af.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Golden Voice</title>

  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="styleconteudo.css">
  <link rel="icon" type="image/x-icon" href="images/logo2.ico">
</head>
 
<body>


  <div class="page">

    <nav>
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
<?php

if(!isset($_GET['id'])){
    header('Location: treinar.php');
    exit;
}
include("conexao.php"); // inclui o arquivo de conexão com BD
$id = $_GET["id"];
$sql = "SELECT * from conteudo WHERE cod_conteudo = '$id'";
$result = mysqli_query($conn, $sql);
$conteudo = mysqli_fetch_array($result, MYSQLI_ASSOC);
if($conteudo['midia']){
    $midialink = "https://www.youtube.com/embed/".explode("https://www.youtube.com/watch?v=",$conteudo['midia'])[1];
}
 
?>
<div class="titulo">
<?=$conteudo['titulo']?>
</div>
<?php 
if($conteudo['midia']){?>
    <iframe id="video" width="560" height="315" src=<?=$midialink?> title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php 
} ?>
<div class="enunciado">
  <?=$conteudo['enunciado']?>
</div>

<a href="questoes.php?cont_id=<?=$id?>" class="btex"> IR PARA AS QUESTÕES </a>
<style> 
.btex {
    text-align: center;
    text-transform: uppercase;
    color: white;
    background: #FFBD59; 
    border: 0;
    padding: 14px 35px 15px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 23%;
    border-radius: 4px;
    cursor: pointer;
    font-family: 'Open Sans', sans-serif;
    margin-bottom: 4px;
    margin-left: 400px;
    margin-top: 1rem;
}
.btex:hover {
  background: #ecf0f1;
  color:#FFBD59;
  transition: 0.5s;
}

#video {
  position: relative;
  width: 560px;
  display: flex;
  margin-top: 40px;
  margin-left: 220px; 
  margin-right: 40px; 
  margin-bottom: 40px;
}

.titulo {
  font-family: 'Open Sans', sans-serif;
  font-size: 25px;
  line-height: 28px;
  color: #4f4d55;
  width: 440px;
  margin: 40px 0;
  text-align: justify;

}

.enunciado {
  font-family: 'Open Sans', sans-serif;
  font-size: 15px;
  line-height: 28px;
  color: #4f4d55;
  width: 1050px;
  margin: 40px 5px;
  text-align: justify;
}
</style>
</body>
</html>
