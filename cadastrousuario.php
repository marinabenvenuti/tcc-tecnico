<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="stylecadastro.css">
    <link rel="icon" type="image/x-icon" href="images/logo2.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title title-primary">Bem-vindo de volta!</h2>
                <p class="description description-primary">Para continuar conectado conosco,</p>
                <p class="description description-primary">por favor faça o login com sua conta</p>
                <button id="signin" class="btn btn-primary">Entrar</button>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Criar conta</h2>
                <p class="description description-second">Use seu e-mail para o registro:</p>
                <form class="form" method="post">
                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" placeholder="Nome" name="nome">
                    </label>

                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" placeholder="E-mail" name="email">
                    </label>

                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" placeholder="Senha" name="senha" required minlength="8">
                    </label>
                    <input name="tipo" value="cadastro" type="hidden">
                    <button class="btn btn-second">Inscreva-se</button>
                </form>
            </div><!-- segunda coluna -->
        </div><!-- primeiro content -->
        <div class="content second-content">
            <div class="first-column">
                <h2 class="title title-primary">Olá, amigo!</h2>
                <p class="description description-primary">Insira seus dados pessoais</p>
                <p class="description description-primary">e comece sua jornada musical conosco</p>
                <button id="signup" class="btn btn-primary">Inscreva-se</button>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Entre com</h2>
                <p class="description description-second"> Use sua conta de e-mail:</p>
                <form class="form" method="post">
                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" placeholder="E-mail" name="email">
                    </label>

                    <label class="label-input" for=""> 
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" placeholder="Senha" name="senha">
                    </label>
                    <input name="tipo" value="login" type="hidden" />

                    <!-- <a class="password" href="#">Esqueceu sua senha?</a> -->
                    <button type="submit" class="btn btn-second"> Entrar</button>
                </form>
            </div><!-- segunda coluna -->
        </div><!-- segundo column -->
    </div>
    <script src="app.js"></script>
</body>

</html>


<?php
session_start();

if (isset($_POST['tipo'])) {
    include("conexao.php"); // inclui o arquivo de conexão com BD
    $tipo = $_POST['tipo'];
    $emailuser = $_POST['email'];
    $senhauser = $_POST['senha'];
    $senha_criptografada = password_hash($senhauser, PASSWORD_DEFAULT);
    switch ($tipo) {
        case 'cadastro':
            if (strlen($senhauser) >= 8) {
                $nomeuser = $_POST['nome'];
                $sql = "INSERT INTO usuarios (nome, email, senha) 
                VALUES ('$nomeuser', '$emailuser', '$senha_criptografada')";

                mysqli_query($conn, $sql);
                if (mysqli_affected_rows($conn) > 0) {
                    $_SESSION["email_logado"] = $emailuser;
                    header('location: paginainicial.php');
                    exit;
                } else {
                    echo "<script>alert('erro')</script>";
                    header('Refresh: 0;url=cadastrousuario.php');
                }
            }

            break;
        case 'login':

            $sql = "SELECT * from usuarios where email = '$emailuser'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $senha_criptografada = $row['senha'];
            if (password_verify($senhauser, $senha_criptografada)) {
                $_SESSION["email_logado"] = $emailuser;
                var_dump($_SESSION['email_logado']);
                header("location: paginainicial.php");
                exit;
            } else {
                echo "<script>alert('erro')</script>";
                header('Refresh: 0;url=cadastrousuario.php');
            };
            break;
    }
    mysqli_close($conn);
}

?>