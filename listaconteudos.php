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
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="stylelistagem.css"> 
  <link rel="icon" type="image/x-icon" href="images/logo2.ico">
 
</head>
 

<?php
include('conexao.php');
include('cabecalho.php');

$sql = "SELECT * FROM conteudo";
$query = mysqli_query($conn, $sql);
?>
<div class='container'> 

    <h3 class='user'>Conteúdos Cadastrados</h3>
    <input type="text" name="titulo" id="titulo" placeholder="Pesquisar conteúdo">

    <a class="button" href="admin.php" >
          <i class="fa fa-book" ></i>
          Cadastrar novo
        </a>

    <table class="table">
        <tr>
            <td>ID</td>
            <td>Título</td>
            <td>Mídia</td>
            <td>Descrição Módulo</td>
            <td>Matéria</td>
            <td></td>
        </tr>

        <?php while ($dados = mysqli_fetch_array($query)) { ?>
                <tr class="userrow" titulo="<?= $dados['titulo'] ?>" >
                <td><?php echo $dados['cod_conteudo'] ?></td>
                <td><?php echo $dados['titulo'] ?></td>
                <td><?php echo $dados['midia'] ?></td>
                <td><?php echo $dados['descricao'] ?></td>
                <td><?php echo $dados['enunciado'] ?></td>     
        
                <td colspan="2" class="text-center">
                    <a class="btex" href='editaconteudo.php?cod_conteudo=<?php echo $dados['cod_conteudo'] ?>'>Editar</a>
                    <a class="btex" onclick="confirmar(<?php echo $dados['cod_conteudo'] ?>)">Excluir</a></td>
            </tr>
        <?php } ?>
    </table>
</div>
<script>
    const users = document.querySelectorAll('.userrow');
    document.querySelector('#titulo').addEventListener('input', ()=>{
        document.querySelectorAll('.table tr').forEach(v=>{
            if(v.classList.contains('userrow')){
                v.remove()
            }
        })
        users.forEach(v=>{
            if(v.getAttribute('titulo').toLowerCase().includes(document.querySelector('#titulo').value)){
                document.querySelector('.table').appendChild(v)
            }
        })
    })
    function confirmar(cod) {
        if (confirm('Você realmente deseja excluir esta linha?'))
            location.href = 'excluiconteudo.php?cod_conteudo=' + cod;
    }
</script>