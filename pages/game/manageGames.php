<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$verificacao = require('../functions/userVerification.php');

$comandoJogos = "SELECT * FROM jogos";
$resultadoJogos = mysqli_query($conexao, $comandoJogos);

$comandoFotosJogos = "SELECT * FROM fotosJogos";
$resultadoFotosJogos = mysqli_query($conexao, $comandoFotosJogos);

if(isset($_SESSION["idDev"])){
    $comandoPublicado = 'SELECT j.nome, fj.foto, jf.idJogo FROM jogosPublicados jf INNER JOIN jogos j ON jf.idJogo = j.idJogo INNER JOIN fotosjogos fj ON jf.idjogo = fj.idjogo WHERE idDesenvolvedora = '.$_SESSION["idDev"]; 
} elseif (isset($_SESSION["idPub"])){
    $comandoPublicado = 'SELECT j.nome, fj.foto, jf.idJogo FROM jogosPublicados jf INNER JOIN jogos j ON jf.idJogo = j.idJogo INNER JOIN fotosjogos fj ON jf.idjogo = fj.idjogo WHERE idPublicadora = '.$_SESSION["idPub"];
} else{
    $comandoPublicado = 'SELECT j.nome, fj.foto, jf.idJogo FROM jogosPublicados jf INNER JOIN jogos j ON jf.idJogo = j.idJogo INNER JOIN fotosjogos fj ON jf.idjogo = fj.idjogo';
}

$resultadoPublicado = mysqli_query($conexao, $comandoPublicado);

$jogoDuplicado = 0;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" src="../../css/main.css">
    <title>Gerenciar jogos</title>
</head>
<body>
    <?php require('../components/header.php') ?>
    <?php
    while($registro = mysqli_fetch_assoc($resultadoPublicado)){
        if($jogoDuplicado != $registro["idJogo"]){
            echo "<div><img src='".$registro["foto"]."'><h2>".$registro["nome"]."</h2></div>";
            echo "<a href='./updateGame.php?idJogo=".$registro["idJogo"]."'>Atualizar Jogo</a>";
            echo "<a href='./deleteGame.php?idJogo=".$registro["idJogo"]."'>Deletar Jogo</a>";
            $jogoDuplicado = $registro["idJogo"];
        }
    }
    ?>
    <?php require('../components/footer.php') ?>
</body>
</html>