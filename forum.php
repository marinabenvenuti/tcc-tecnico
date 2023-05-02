<?php 
include('cabecalho.php');




if(isset($_POST['post'])){
  $pergunta = $_POST['pergunta'];
  $cod_user = $user['cod_usuario'];
  if(strlen($pergunta) > 0){
    $sql = "INSERT INTO perguntas (texto_pergunta, cod_usuario) VALUES ('$pergunta', '$cod_user')";
    mysqli_query($conn, $sql);
  }
}
$sql = "SELECT p.*, nome from perguntas p inner join usuarios u on u.cod_usuario = p.cod_usuario";
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

<body style="background-color:white;">

  <div class="page">

  <h3>Cadastre um novo tópico</h3>  

  </div>
  <div>
    <form action="" method="post">
      <input placeholder="Escreva sua pergunta aqui" class="campo" type="text" name="pergunta" />
      <input class="buten" type="submit" value="Enviar" name="post">
    </form>
    
  <div class="tpcadastrados"> <h3>Tópicos cadastrados</h3>  </div>
 
  <?php while($row = mysqli_fetch_assoc($result)){?>
   <div class="pergunta">
      <a href='pergunta.php?id=<?= $row["cod_pergunta"] ?>'> <?= $row["texto_pergunta"] ?> <p class="paragrafo"> Postado por: <?=$row['nome']?>  </p> </a>
    </div>  
  <?php } ?>
  </div>
<body style="background-color:white;">
