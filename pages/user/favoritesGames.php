<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$message = require('../functions/message.php');

$idUsuario = $_SESSION["profile"];
$comando = "SELECT j.nome, j.preco, j.descricao, fj.foto, j.idJogo FROM Favoritos f INNER JOIN Jogos j ON f.idJogoPublicado = j.idJogo INNER JOIN FotosJogos fj ON fj.idJogo = j.idJogo WHERE f.idUsuario = $idUsuario AND fj.ordem = 1";
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
    <link rel="icon" type="" href="./imgs/StreetPlayLogo.jpeg">
    <link rel="stylesheet" href="../../css/main.css">
    <title>StreetPlay :: Lista de Desejos</title>
</head>
<body>
    <?php require('../components/header.php') ?>
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
        <a href="./editFavoriteGames.php?idJogo=<?=$registro["idJogo"]?>&idUsuario=<?=$_SESSION["profile"]?>&seguir=nao&pagina=desejos">Remover Jogo</a>
        <?php endwhile; ?>
    </session>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>