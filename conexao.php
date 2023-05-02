<?php
$conn = mysqli_connect('localhost', 'root', '') or die ("Não possível conectar ao banco de dados");
mysqli_select_db($conn, 'tcc');
