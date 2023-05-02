<?php
session_start();
if(isset($_SESSION["email_logado"]) == false) {
    header('location: cadastrousuario.php');
    exit;
};
include("conexao.php"); // inclui o arquivo de conexão com BD
if(isset($_POST['conteudo_envia'])){
  $midia = $_POST['midia'];
  $titulo = $_POST['titulo'];
  $descricao = $_POST ['descricao'];
  $enunciado = $_POST ['enunciado'];
  $sql = "INSERT INTO conteudo(midia, titulo, descricao, enunciado) VALUES('$midia', '$titulo', '$descricao', '$enunciado')";
  $result = mysqli_query($conn, $sql);
}
if(isset($_POST['questao'])){
  $enunciado = $_POST['enunciado'];
  $midia = $_POST['midia'];
  $alt1 = $_POST['alt1'];
  $alt2 = $_POST['alt2'];
  $alt3 = $_POST['alt3'];
  $alt4 = $_POST['alt4'];
  $alt5 = $_POST['alt5'];
  $conteudo = $_POST['conteudo'];
  $altcorreta = $_POST['altcorreta'];

  $sql = "INSERT INTO questao(enunciado, midia, alt1, alt2, alt3, alt4, alt5, alt_correta, cod_conteudo) 
  VALUES('$enunciado', '$midia', '$alt1', '$alt2', '$alt3', '$alt4', '$alt5', '$altcorreta', '$conteudo')";
  $result = mysqli_query($conn, $sql);
}

$emailuser = $_SESSION["email_logado"];
$sql = "SELECT * from usuarios WHERE email = '$emailuser'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_array($result, MYSQLI_ASSOC);
if(!$user['is_admin']){
    header('location: paginainicial.php');
    exit;
}

$sql = "SELECT * from conteudo";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <script src="https://kit.fontawesome.com/9884a810af.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Golden Voice</title>

  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="styleadmin.css">
  <link rel="icon" type="image/x-icon" href="images/logo2.ico">
</head>

<body> 
 
  <div class="page">

    <nav>
      <a id="logo" href="paginainicial.php">
        <img src="images/logohor.png" alt="logo" width="200px">
      </a>
      <ul>
        <li> <i class="fa fa-microphone" aria-hidden="true"> </i> <a href="treinar.php"> Treinar</a></li>
        <li> <i class="fa fa-user" aria-hidden="true"> </i> <a href="perfil.php"> Perfil</a></li>
        <li> <i class="fa fa-question-circle" aria-hidden="true"> </i><a href="forum.php"> Fórum</a></li>
      </ul>
    </nav>


    <title>Admin</title>
    <style>
        form{
            display: flex;
            flex-direction: column;
            width: 50%;
        }
    </style>
</head>
<body>
        <a class="btfafa" href="listaconteudos.php">
          <i class="fa fa-book" ></i>
          Conteúdos 
        </a>
        <a class="btfafa" href="listaquestoes.php">
          <i class="fa fa-question" ></i>
          Questões 
        </a>
        <a class="btfafa" href="listausuarios.php">
          <i class="fa fa-user" ></i>
          Usuários 
        </a>
        <a class="btfafa" href="listaperguntasforum.php">
        <i class="fa fa-forumbee" aria-hidden="true"></i>
          Perguntas do Fórum 
        </a>
        <a class="btfafa" href="listarespostasforum.php">
        <i class="fa fa-users" aria-hidden="true"></i>
          Respostas do Fórum 
        </a>
 
    <form action="" method="post">
        <h3>Conteúdo</h3> 
        <input type="text" class="selectionbox" name="titulo" placeholder="Título">
        <input type="text" class="selectionbox" name="midia" placeholder="Mídia" >
        <input type="text" class="selectionbox" name="descricao" placeholder="Descrição Módulo" >
        <input type="text" class="selectionbox" name="enunciado" placeholder="Matéria" >
        <input type="submit" class="button" value="Enviar" name="conteudo_envia" >
    </form>
    <form action="#" method="post">
        <h3>Questão</h3>  
        <select class="form-select" name="conteudo">
        <?php
        while($row = mysqli_fetch_assoc($result)) {?>
            <option class=""  value="<?=$row['cod_conteudo']?>"><?=$row['titulo']?></option>
            <?php } ?>
        </select>
        <input type="text" class="selectionbox" name="enunciado" placeholder="Enunciado">
        <input type="text" class="selectionbox" name="alt1" placeholder="Alternativa 1">
        <input type="text" class="selectionbox" name="alt2" placeholder="Alternativa 2">
        <input type="text" class="selectionbox" name="alt3" placeholder="Alternativa 3">
        <input type="text" class="selectionbox" name="alt4" placeholder="Alternativa 4">
        <input type="text" class="selectionbox" name="alt5" placeholder="Alternativa 5">
        <input type="number" class="selectionbox" name="altcorreta" placeholder="Alternativa correta">
        <input type="text" class="selectionbox" name="midia" placeholder="Mídia">
        <input type="submit" class="button" value="Enviar" name="questao" >
</form>

</body>
</html>
