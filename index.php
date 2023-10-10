<?php

$sessao = require('pages/session.php');
$conexao = require('pages/connection.php');

if(isset($_SESSION["mensagem"])){
    echo $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
}

$comando = "SELECT j.nome, fj.foto FROM jogospublicados jp inner join jogos j on jp.idJogo = j.idJogo inner join fotosjogos fj on fj.idJogo = jp.idJogo";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo(a) ao StreetPlay</title>
</head>
<body>
    
</body>
</html>