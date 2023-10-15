<?php

$sessao = require('pages/session.php');
$conexao = require('pages/connection.php');

if(isset($_SESSION["mensagem"])){
    echo $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo(a) ao StreetPlay</title>
</head>
<body>
    <a href="pages/pubGame.php">Publicar Jogo</a>
    <a href="pages/manageGames.php">Lista de Jogos</a>
</body>
</html>