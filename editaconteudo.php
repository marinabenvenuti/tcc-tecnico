<!DOCTYPE html>
<html lang="pt-br">
<meta charset="UTF-8">
<link rel="stylesheet" href="styleeditaquestao.css">
<link rel="icon" type="image/x-icon" href="images/logo2.ico">

<?php
include('cabecalho.php');
include('conexao.php');


$cod_conteudo = $_GET['cod_conteudo']; 

if (isset($_POST['btnSalvar'])) {
    $titulo = $_POST['titulo'];
    $midia = $_POST['midia'];
    $descricao = $_POST['descricao'];
    $enunciado =  $_POST['enunciado'];

    $sql = "UPDATE conteudo SET 
                titulo='$titulo', 
                midia='$midia', 
                descricao='$descricao',
                enunciado='$enunciado' 
            WHERE cod_conteudo='$cod_conteudo'";
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script> alert('Usuário alterado com sucesso.') </script>";
        header("Location: listaconteudos.php");
    } else {
        echo "<script> alert('Ocorreu algum erro.') </script>";
    }
}
$sql = "SELECT * FROM conteudo WHERE cod_conteudo =$cod_conteudo";
$rs = mysqli_query($conn, $sql);
$linha = mysqli_fetch_array($rs);
?>
<div class='container'>
    <h3 class='p-3'>Editar Conteúdo</h3>

    <form method="post">
        <div class="form-group">
            Título <input class='form-control' type="text" name="titulo" value="<?php echo $linha['titulo'] ?>" />
        </div>
        <div class="form-group">
            Mídia <input class='form-control' type="text" name="midia" value="<?php echo $linha['midia'] ?>" />
        </div>
        <div class="form-group">
            Descrição <input class='form-control' type="text" name="descricao" value="<?php echo $linha['descricao'] ?>" />
        </div>
        <div class="form-group">
            Enunciado
            <textarea name="enunciado" cols="30" rows="10" class='form-control'>
                <?php echo $linha['enunciado'] ?>
            </textarea>
        </div>
        <div class="form-group">
            <input class='btex' type="submit" value="Salvar" name="btnSalvar" />
            <input class='btex' type="reset" value="Redefinir" />
        </div>
    </form>
</div>
</body>

</html>