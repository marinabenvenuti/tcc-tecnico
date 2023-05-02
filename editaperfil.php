<?php

session_start();

$emailuser = $_SESSION["email_logado"];
if(!isset($emailuser)){
    header('location: login.php');
    exit;
}
include("conexao.php"); // inclui o arquivo de conexão com BD

if(isset($_POST['submit'])){
    if($_POST['submit'] == 'exclui'){
        $sql = "Delete from usuarios where email='$emailuser'";
        mysqli_query($conn, $sql);
        unset($_SESSION['email_logado']);
        header('location: telaentrada.php');
        exit;
    }
    $bio = $_POST['bio'];
    $nome = $_POST['nome'];
    $pasta_uploads = "uploads/";
    $now = time();
    $caminho_arquivo = '';
    if($_FILES["foto"]['name'] != ''){
        $path_parts = pathinfo(basename($_FILES["foto"]["name"]));
        $caminho_arquivo = $pasta_uploads . $path_parts['filename'] . $emailuser . $now . '.'.$path_parts['extension'];
        $uploadOk = 1;
        $extensao = strtolower(pathinfo(basename($_FILES["foto"]["name"]),PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        if (file_exists($caminho_arquivo)) {
            $uploadOk = 0;
        }
        if ($_FILES["foto"]["size"] > 500000000) {
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg"
        && $extensao != "gif" ) {
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Ocorreu um erro";
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminho_arquivo)) {
            
            } else {
                $uploadOk = 0;
            }
        }
    }
    if($_POST['senha'] != ''){
        $senha_criptografada = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        if($_FILES["foto"]["tmp_name"] != ''){
            $sql = "UPDATE usuarios set senha = '$senha_criptografada', nome = '$nome', descricao_perfil = '$bio', foto_perfil = '$caminho_arquivo' WHERE email = '$emailuser'";
        }else{
            $sql = "UPDATE usuarios set senha = '$senha_criptografada', nome = '$nome', descricao_perfil = '$bio' WHERE email = '$emailuser'";
        }        
    }else{
        if($_FILES["foto"]["tmp_name"] != ''){
            $sql = "UPDATE usuarios set nome = '$nome', descricao_perfil = '$bio', foto_perfil = '$caminho_arquivo' WHERE email = '$emailuser'";
        }else{
            $sql = "UPDATE usuarios set nome = '$nome', descricao_perfil = '$bio' WHERE email = '$emailuser'";
        }
    }
    mysqli_query($conn, $sql);
    header('location: perfil.php');
    exit;
}




include('getuser.php');
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cutive+Mono&family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="styleperfil.css">
    <link rel="icon" type="image/x-icon" href="images/logo2.ico">

    <title>Meu Pefil</title>
</head>


<body>
    
    <div class="container">
        <div class="card">
            <div class="header">

                <form method="post" enctype="multipart/form-data">
                <div class="main">
                    <div class="image">
                        <img src="" alt="" id="display" width="110" height="110">
                        <div class="hover">
                            <label for="foto" style="cursor:pointer;">
                                <input style="display:none;" id="foto" type="file" name="foto" accept="image/png, image/jpg, image/gif, image/jpeg"/>
                                <i class="fas fa-camera fa-2x"></i>
                            </label>
                        </div>
                    </div>
                    
                    
                        <div class="form-group">
                            <input class='form-control' type="text" name="nome" value="<?= $user['nome'] ?>" />
                        </div>
                        <div class="form-group">
                            <input class='form-control' placeholder="senha" type="password" name="senha" />
                        </div>
                </div>
            </div>

                <div class="content">
                    <div class="left">
                    
                    <h3 class="title">Sobre</h3>
                        <div class="form-group">
                            <input class='form-control2' type="text" name="bio" value="<?= $user['descricao_perfil'] ?>" />
                        </div>
                        
                        <div class="share-wrap"> 
                            <button name="submit" class="follow2" style="background-color: white; cursor:pointer;">Salvar</button>
                            <button name="submit" value="exclui" class="follow2" style="background-color: #FFBD59; cursor:pointer;">Excluir </button>

                        </div>
                    </form>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
    <!-- <script src="app.js"></script> -->
    <script>
        document.querySelector('button[value=exclui]').addEventListener('click', (e)=>{
            if(!confirm('Tem certeza que deseja excluir o usuario?')){
                e.preventDefault()
            }
        })
        let input = document.getElementById("foto");
        let displayImg = document.getElementById("display")
        displayImg.style.display = 'none';

        input.addEventListener("change", ()=>{
            displayImg.style.display = 'block';

            let inputImage = document.querySelector("#foto").files[0];
            var reader  = new FileReader();
            reader.onloadend = function () {
                displayImg.src = reader.result;
            }

            if (inputImage) {
                reader.readAsDataURL(inputImage);
            } else {
                displayImg.src = "";
            }
        })
    </script>
</body>
</html>