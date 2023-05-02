<?php
include('cabecalho.php');


if(isset($_SESSION["email_logado"]) == false) {
 header('location: cadastrousuario.php');
 exit;
};
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="stylepaginainicial.css">
  <link rel="icon" type="image/x-icon" href="images/logo2.ico">

</head>

<body>

  <div class="page">

    <nav>
    <main>
      <section>

        <h1>Treinos <span>exclusivos</span>
          para você!</h1>

        <p>
          Nós criamos treinos <strong>exclusivos e únicos para você.</strong><br />
          Invista na sua voz e <strong>tenha muito mais performance</strong> e qualidade de vida.

        </p>

        <a class="button" href="treinar.php" target="_blank">
          <i class="fa fa-microphone" ></i>
          Treine agora!
        </a>
      </section>


      <img src="images/menina.svg" alt="music" height="500 px">


    </main>

  </div>

  <img id="balls" src="images/fireball.svg" alt="Bolinhas decorativas amarelas no canto inferior direito da página." width="80px">

</body>

</html>