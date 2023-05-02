<!DOCTYPE html>
<html lang="pt-br">
<meta charset="UTF-8">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <script src="https://kit.fontawesome.com/9884a810af.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Golden Voice</title>

  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="stylelistagem2.css">
  <link rel="icon" type="image/x-icon" href="images/logo2.ico">
</head>

<body>
  <div class="page"> 
    <nav>
      <a id="logo" href="paginainicial.php">
        <img src="images/logohor.png" alt="logo" width="200px">  
      </a>
      <ul>
        <li> <i class="fa fa-list-check" aria-hidden="true"> </i><a href="admin.php"> Administrador</a></li>
        <li> <i class="fa fa-microphone" aria-hidden="true"> </i> <a href="treinar.php"> Treinar</a></li>
        <li> <i class="fa fa-user" aria-hidden="true"> </i> <a href="perfil.php"> Perfil</a></li>
        <li> <i class="fa fa-question-circle" aria-hidden="true"> </i><a href="forum.php"> Fórum</a></li>
      </ul>
    </nav>
<?php
include('conexao.php');

$sql = "SELECT * FROM questao";
$query = mysqli_query($conn, $sql);
?>
<div class='container'>

    <h3 class='user'>Questões Cadastrados</h3>
    <input type="text" name="enunciado" id="enunciado" placeholder="Pesquise o enunciado">
 
    <a class="button" href="admin.php" >
          <i class="fa fa-book" ></i>
          Cadastrar nova questão
        </a>

    <table class="table">
        <tr>
            <td>ID</td>
            <td>Enunciado</td>
            <td>Mídia</td>
            <td>Alt 1</td>
            <td>Alt 2</td>
            <td>Alt 3</td>
            <td>Alt 4</td>
            <td>Alt 5</td>
            <td>Alt correta</td>
            <td>ID Conteúdo</td>
            <td></td>
        </tr>

        <?php while ($dados = mysqli_fetch_array($query)) { ?>
                <tr class="userrow" enunciado="<?= $dados['enunciado'] ?>" >
                <td><?php echo $dados['cod_questao'] ?></td>
                <td><?php echo $dados['enunciado'] ?></td>
                <td ><?php echo $dados['midia'] ?></td>
                <td><?php echo $dados['alt1'] ?></td>
                <td><?php echo $dados['alt2'] ?></td>  
                <td><?php echo $dados['alt3'] ?></td> 
                <td><?php echo $dados['alt4'] ?></td>
                <td><?php echo $dados['alt5'] ?></td>
                <td><?php echo $dados['alt_correta'] ?></td>
                <td><?php echo $dados['cod_conteudo'] ?></td>
        
                <td colspan="2" class="text-center">
                    <a class="btex" href='editaquestao.php?cod_questao=<?php echo $dados['cod_questao'] ?>'>Editar</a>
                    <a class="btex" onclick="confirmar(<?php echo $dados['cod_questao'] ?>)">Excluir</a></td>
               </tr>

               <?php } ?>
    </table>
</div>
<script>
  const users = document.querySelectorAll('.userrow');
    document.querySelector('#enunciado').addEventListener('input', ()=>{
        document.querySelectorAll('.table tr').forEach(v=>{
            if(v.classList.contains('userrow')){
                v.remove()
            }
        })
        users.forEach(v=>{
            if(v.getAttribute('enunciado').toLowerCase().includes(document.querySelector('#enunciado').value)){
                document.querySelector('.table').appendChild(v)
            }
        })
    })
    function confirmar(cod) {
        if (confirm('Você realmente deseja excluir esta linha?'))
            location.href = 'excluiquestao.php?cod_questao=' + cod;
    }
</script>