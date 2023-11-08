<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$verificacao = require('../functions/userVerification.php');
$message = require('../functions/message.php');

$comandoJogos = "SELECT * FROM Jogos";
$resultadoJogos = mysqli_query($conexao, $comandoJogos);

$comandoFotosJogos = "SELECT * FROM fotosJogos";
$resultadoFotosJogos = mysqli_query($conexao, $comandoFotosJogos);

if(isset($_SESSION["idDev"])){
    $comandoPublicado = 'SELECT j.nome, fj.foto, jp.idJogo FROM JogosPublicados jp INNER JOIN Jogos j ON jp.idJogo = j.idJogo INNER JOIN FotosJogos fj ON jp.idjogo = fj.idjogo WHERE fj.ordem = 1 AND idDesenvolvedora = '.$_SESSION["idDev"]; 
} elseif (isset($_SESSION["idPub"])){
    $comandoPublicado = 'SELECT j.nome, fj.foto, jp.idJogo FROM JogosPublicados jp INNER JOIN Jogos j ON jp.idJogo = j.idJogo INNER JOIN FotosJogos fj ON jp.idjogo = fj.idjogo WHERE fj.ordem = 1 AND idPublicadora = '.$_SESSION["idPub"];
} else{
    $comandoPublicado = 'SELECT j.nome, fj.foto, jp.idJogo FROM JogosPublicados jp INNER JOIN Jogos j ON jp.idJogo = j.idJogo INNER JOIN FotosJogos fj ON jp.idjogo = fj.idjogo WHERE fj.ordem = 1';
}

$resultadoPublicado = mysqli_query($conexao, $comandoPublicado);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="" href="../../imgs/StreetPlayLogo.jpeg">
    <link rel="stylesheet" href="../../css/main.css">
    <title>StreetPlay :: Gerenciar jogos</title>
</head>
<body>
    <?php require('../components/header.php') ?>
    <?php while($registro = mysqli_fetch_assoc($resultadoPublicado)):?>
            <div>
                <img src="<?=$registro["foto"]?>">
                <h2><?=$registro["nome"]?></h2>
            </div>
            <a href="./updateGame.php?idJogo=<?=$registro["idJogo"]?>">Atualizar Jogo</a>
            <a href="./deleteGame.php?idJogo=<?=$registro["idJogo"]?>">Deletar Jogo</a>
    <?php endwhile;?>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>