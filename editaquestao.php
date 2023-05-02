<!DOCTYPE html>
<html lang="pt-br">
<meta charset="UTF-8">
<link rel="stylesheet" href="styleeditaquestao.css">
<link rel="icon" type="image/x-icon" href="images/logo2.ico">


<?php
include('cabecalho.php');
include('conexao.php');


$cod_questao = $_GET['cod_questao'];

if (isset($_POST['btnSalvar'])) {
    $enunciado = $_POST['enunciado'];
    $midia = $_POST['midia'];
    $alt1 = $_POST['alt1'];
    $alt2 = $_POST['alt2'];
    $alt3 = $_POST['alt3'];
    $alt4 = $_POST['alt4'];
    $alt5 = $_POST['alt5'];
    $alt_correta = $_POST['alt_correta'];
    $cod_conteudo = $_POST['cod_conteudo'];

    $sql = "UPDATE questao SET 
                enunciado='$enunciado', 
                midia='$midia', 
                alt1='$alt1',
                alt2='$alt2',
                alt3='$alt3',
                alt4='$alt4',
                alt5='$alt5',
                alt_correta='$alt_correta',
                cod_conteudo='$cod_conteudo'
            WHERE cod_questao='$cod_questao'";
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script> alert('Usuário alterado com sucesso.') </script>";
        header("Location: listaquestoes.php");
    } else {
        echo "<script> alert('Ocorreu algum erro.') </script>";
    }
}
$sql = "SELECT * FROM questao WHERE cod_questao =$cod_questao";
$rs = mysqli_query($conn, $sql);
$linha = mysqli_fetch_array($rs);
?>
<div class='container'>
    <h3 class='p-3'>Editar Questão</h3>

    <form method="post">
        <div class="form-group">
            Enunciado <input class='form-control' type="text" name="enunciado" value="<?php echo $linha['enunciado'] ?>" />
        </div>
        <div class="form-group">
            Mídia <input class='form-control' type="text" name="midia" value="<?php echo $linha['midia'] ?>" />
        </div>
        <div class="form-group">
            Alternativa 1 <input class='form-control' type="text" name="alt1" value="<?php echo $linha['alt1'] ?>" />
        </div>
        <div class="form-group">
            Alternativa 2 <input class='form-control' type="text" name="alt2" value="<?php echo $linha['alt2'] ?>" />
        </div>
        <div class="form-group">
            Alternativa 3 <input class='form-control' type="text" name="alt3" value="<?php echo $linha['alt3'] ?>" />
        </div>
        <div class="form-group">
            Alternativa 4 <input class='form-control' type="text" name="alt4" value="<?php echo $linha['alt4'] ?>" />
        </div>
        <div class="form-group">
            Alternativa 5 <input class='form-control' type="text" name="alt5" value="<?php echo $linha['alt5'] ?>" />
        </div>
        <div class="form-group">
            Alternativa correta <input class='form-control' type="text" name="alt_correta" value="<?php echo $linha['alt_correta'] ?>" />
        </div>
        <div class="form-group">
            Código conteúdo <input class='form-control' type="text" name="cod_conteudo" value="<?php echo $linha['cod_conteudo'] ?>" />
        </div>
        <div class="form-group">
            <input class='btex' type="submit" value="Salvar" name="btnSalvar" />
            <input class='btex' type="reset" value="Redefinir" />
        </div>
    </form>
</div>
</body>

</html>