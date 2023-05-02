<?php
session_start();
include("conexao.php"); // inclui o arquivo de conexão com BD

$emailuser = $_SESSION["email_logado"];
$sql = "SELECT * from usuarios WHERE email = '$emailuser'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);


mysqli_close($conn);

if(isset($_SESSION["email_logado"]) == false) {
 header('location: login.php');
 exit;
};
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

                <div class="main">
                    <?php if($row['foto_perfil']){ ?>
                        <img id="ft_perfil" src="<?=$row['foto_perfil']?>" alt="foto_perfil" width="110" height="110">
                    <?php }else{?>
                    <div class="image">
                        <div class="hover">
                            <i class="fas fa-camera fa-2x"></i>
                        </div>
                    </div>
                    <?php } ?>
                    <h3 class="name"><?= $row['nome'] ?> </h3>
                </div>
            </div>

                <div class="content">
                    <div class="left">
                        <div class="about-container">
                            <h3 class="title">Sobre</h3>
                            <p class="text"><?= $row['descricao_perfil']?></p>
                        </div>
                    
                        <div class="right">
                    <div>
                        <h3 class="number"><?= isset($row['nivel']) ? $row['nivel'] : '?' ?></h3>
                        <h3 class="number-title">Módulos</h3>
                    </div>
                </div>
                    <div class="buttons-wrap">
                        <div class="follow-wrap">
                            <a href="paginainicial.php" class="follow">Voltar</a>
                        </div>
                        <div class="share-wrap">
                            <a href='editaperfil.php?cod_usuario=<?php echo $row['cod_usuario'] ?>' class="share">Editar Perfil</a>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
    <script src="app.js"></script>
</body>
</html> 