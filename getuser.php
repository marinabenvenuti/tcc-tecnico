<?php
$emailuser = $_SESSION["email_logado"];
$sql = "SELECT * from usuarios WHERE email = '$emailuser'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>