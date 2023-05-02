<?php
include('conexao.php');
include('cabecalho.php');
if(isset($_SESSION["email_logado"]) == true) {
  include('getuser.php');
};
$sql = "SELECT * from conteudo";
$conteudos = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css" />
  <link rel="stylesheet" href="styletreinar.css" />
  <link rel="icon" type="image/x-icon" href="images/logo2.ico">

</head>

<body style="background-color:white;">


    <ul class="cards">

      <?php while($row = mysqli_fetch_assoc($conteudos)) {
        if(isset($user)){
          $cid = $row['cod_conteudo'];
          $uid = $user['cod_usuario'];
          $sql = "select * from conteudos_usuarios where cod_usuario = '$uid' and cod_conteudo = '$cid'";
          $cont_user = mysqli_query($conn, $sql);
          $cont_user = mysqli_fetch_array($cont_user, MYSQLI_ASSOC);
          $completo = isset($cont_user);
          if($completo){
            $sql = "SELECT COUNT(*) as c from questao where cod_conteudo = '$cid'";
            $cont_quest = mysqli_query($conn, $sql);
            $cont_quest = mysqli_fetch_array($cont_quest, MYSQLI_ASSOC);
            $acertos = $cont_user['acertos'] . '/' . $cont_quest['c'];
          }
        }
        ?>
        <li class="<?=$completo?>">
          <a href="conteudo.php?id=<?=$row['cod_conteudo']?>" class="card">
            <img src="images/back.jpg" class="card__image" alt="" />
            <div class="card__overlay">
              <div class="card__header">
                <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
                  <path />
                </svg>
                <div class="card__header-text">
                  <h1 class="card__title"><?= $row['titulo']?>
                    <?php if($completo){ ?>
                      &nbsp; &nbsp; <i class="fa-solid fa-check green"></i> &nbsp; &nbsp; <span class="green"><?=$acertos?></span>
                    <?php } ?>
                  </h1>

                </div>
              </div>
              <p class="card__description"><?= $row['descricao']?> </p>
            </div>
          </a>
        </li>
      <?php } ?>
      </ul>


</body>
</html>