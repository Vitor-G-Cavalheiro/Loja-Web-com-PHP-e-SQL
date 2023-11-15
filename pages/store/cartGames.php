<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$tema = require('../functions/themeVerification.php');
$message = require('../functions/message.php');

$idUsuario = $_SESSION["profile"];
$comando = "SELECT j.nome, j.preco, j.descricao, fj.foto, j.idJogo FROM Carrinho c INNER JOIN Jogos j ON c.idJogoPublicado = j.idJogo INNER JOIN FotosJogos fj ON fj.idJogo = j.idJogo WHERE c.idUsuario = $idUsuario AND fj.ordem = 1";
$resultado = mysqli_query($conexao, $comando);

?>

<!DOCTYPE html>
<html lang="Pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="" href="../../imgs/StreetPlayLogo.jpeg">
    <link rel="stylesheet" href="../../css/main.css">
    <title>StreetPlay :: Carrinho</title>
</head>
<body>
    <!-- Cabeçalho -->
    <?php require('../components/header.php') ?>
    <!-- Sub Menu da Loja -->
    <?php require('../components/headerStore.php')?>
    <session>
        <?php while($registro = mysqli_fetch_assoc($resultado)):?>
        <a href="../store/gamePage.php?idJogo=<?=$registro["idJogo"]?>">
            <div>
                <img src="<?=$registro["foto"]?>">
                <span><?=$registro["nome"]?></span>
                <span><?=$registro["descricao"]?></span>
                <a href=""><?=$registro["preco"]?></a href="">
            </div>
        </a>
        <a href="./editCartGame.php?idJogo=<?=$registro["idJogo"]?>&idUsuario=<?=$_SESSION["profile"]?>&comprar=nao">Remover Jogo</a>
        <?php endwhile; ?>
    </session>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>