<?php
include('conexao.php');
session_start();
if(isset($_SESSION["email_logado"]) == false) {
    header('location: cadastrousuario.php');
    exit;
};
include('getuser.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <script src="https://kit.fontawesome.com/9884a810af.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Golden Voice</title>

  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="stylecabecalho.css">
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