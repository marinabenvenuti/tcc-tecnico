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

$sql = "SELECT * FROM respostas";
$query = mysqli_query($conn, $sql);
?>
<div class='container'>

    <h3 class='p-3'>Respostas Cadastradas</h3>
    <input type="text" name="texto_resposta" id="texto_resposta" placeholder="Pesquise a resposta">


    <table class="table">
        <tr>
            <td>ID</td>
            <td>Texto Resposta</td>
            <td>ID Pergunta</td>
            <td></td>
        </tr>

        <?php while ($dados = mysqli_fetch_array($query)) { ?>
            <tr class="userrow" texto_resposta="<?= $dados['texto_resposta'] ?>" >
                <td><?php echo $dados['cod_resposta'] ?></td>
                <td><?php echo $dados['texto_resposta'] ?></td>
                <td><?php echo $dados['cod_pergunta'] ?></td>   
        
                <td colspan="2" class="text-center">
                    
                    <a class="btex" onclick="confirmar(<?php echo $dados['cod_resposta'] ?>)">Excluir</a></td>
            </tr>
        <?php } ?>
    </table>
</div>
<script>
    const users = document.querySelectorAll('.userrow');
    document.querySelector('#texto_resposta').addEventListener('input', ()=>{
        document.querySelectorAll('.table tr').forEach(v=>{
            if(v.classList.contains('userrow')){
                v.remove()
            }
        })
        users.forEach(v=>{
            if(v.getAttribute('texto_resposta').toLowerCase().includes(document.querySelector('#texto_resposta').value)){
                document.querySelector('.table').appendChild(v)
            }
        })
    })
    function confirmar(cod) {
        if (confirm('Você realmente deseja excluir esta linha?'))
            location.href = 'excluirespostaforum.php?cod_resposta=' + cod;
    }
</script> 