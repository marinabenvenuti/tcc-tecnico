<!DOCTYPE html>
<html lang="pt-br">
    <head>
<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="stylelistagem3.css">
<link rel="icon" type="image/x-icon" href="images/logo2.ico">

    </head>

<?php 
include('conexao.php');
include('cabecalho.php');

$sql = "SELECT * FROM usuarios";
$query = mysqli_query($conn, $sql);
?>
<div class='container'>

    <h3 class='user'>Usuários Cadastrados</h3>
    <input type="text" name="nome" id="nome" placeholder="Pesquise o usuário">

    <table class="table">
        <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>Administrador</td>
            <td>Email</td>
            <td>Descrição Perfil</td>
            <td>Módulo</td>
            <td>Foto Perfil</td>
            <td></td>
        </tr>

        <?php while ($dados = mysqli_fetch_array($query)) { ?>
            <tr class="userrow" nome="<?= $dados['nome'] ?>" >
                <td><?php echo $dados['cod_usuario'] ?></td>
                <td><?php echo $dados['nome'] ?></td>
                <td><?= $dados['is_admin'] ? "Sim" : "Não" ?></td>
                <td><?php echo $dados['email'] ?></td>
                <td><?php echo $dados['descricao_perfil'] ?></td>
                <td><?php echo $dados['nivel'] ?></td>
                <td>
                    <img src="<?= $dados['foto_perfil'] ?>" height="50" alt="foto_perfil"></td>
                
                <td colspan="2" class="text-center">
                <a class="btex" onclick="confirmar(<?php echo $dados['cod_usuario'] ?>)">Excluir</a></td>

                <td colspan="2" class="text-center">
                <a class="btex" onclick="confirmarAdm(<?php echo $dados['cod_usuario'] ?>)">Administrador</a></td>
</tr>
        <?php } ?>
    </table>
</div>
<script>
    const users = document.querySelectorAll('.userrow');
    document.querySelector('#nome').addEventListener('input', ()=>{
        document.querySelectorAll('.table tr').forEach(v=>{
            if(v.classList.contains('userrow')){
                v.remove()
            }
        })
        users.forEach(v=>{
            if(v.getAttribute('nome').toLowerCase().includes(document.querySelector('#nome').value)){
                document.querySelector('.table').appendChild(v)
            }
        })
    })
    function confirmar(cod) {
        if (confirm('Você realmente deseja excluir esta linha?'))
            location.href = 'excluiUsuario.php?cod_usuario=' + cod;
    }
    function confirmarAdm(cod) {
        if (confirm('Você realmente transformar este usuario?'))
            location.href = 'toggleadm.php?cod_usuario=' + cod;
    }
</script> 