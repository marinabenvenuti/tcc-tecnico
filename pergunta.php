<?php 
include('cabecalho.php');
if(!isset($_GET['id'])){
    header('Location: ./forum.php');
}
$pergunta_id = $_GET['id'];
$sql = "SELECT p.*, nome from perguntas p inner join usuarios u on u.cod_usuario = p.cod_usuario WHERE p.cod_pergunta = $pergunta_id";
$result = mysqli_query($conn, $sql);
$pergunta = mysqli_fetch_array($result, MYSQLI_ASSOC);

if(isset($_POST['post'])){
  $resposta = $_POST['resposta'];
  $cod_user = $user['cod_usuario'];
  if(strlen($resposta) > 0){
    $sql = "INSERT INTO respostas (cod_pergunta, texto_resposta, cod_usuario) VALUES 
    ('$pergunta_id','$resposta', '$cod_user')";
    mysqli_query($conn, $sql);
  }
}
$sql = "SELECT r.*, nome from respostas r inner join usuarios u on u.cod_usuario = r.cod_usuario WHERE r.cod_pergunta = $pergunta_id";
$result = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css" />
  <link rel="stylesheet" href="styleforum.css" />
  <link rel="icon" type="image/x-icon" href="images/logo2.ico">

</head>
 
  <div>
    <a class="perguntatp" > </a><h2><?= $pergunta['texto_pergunta'] ?>   </h2>
    <a class="postadopor" > </a><h3> Postado por: <?= $pergunta['nome'] ?> </h3>
    <form action="" method="post">
      <input placeholder="Escreva sua resposta aqui" class="campo" type="text" name="resposta" />
      <input class="buten2" type="submit" value="Enviar" name="post">
    </form>
  <?php
   while($row = mysqli_fetch_assoc($result))
   {
  ?> 
     <div class="pergunta2">
  <span> <?= $row["texto_resposta"] ?> <p class="paragrafo"> Respondido por: <?= $row['nome'] ?></span>
  <?php } ?>
  </div>
  </div>
</body>


