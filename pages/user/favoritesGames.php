<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$tema = require('../functions/themeVerification.php');
$message = require('../functions/message.php');

$idUsuario = $_SESSION["profile"]; 

if (isset($_POST["pesquisa"])){
    $idModificador = $_POST["pesquisa"];
    $comando = "SELECT j.nome, fj.foto, j.preco, j.idJogo FROM Favoritos f INNER JOIN Jogos j ON f.idJogoPublicado = j.idJogo INNER JOIN FotosJogos fj ON fj.idJogo = j.idJogo WHERE j.nome LIKE '%$idModificador%' AND fj.ordem = 1 AND f.idUsuario = $idUsuario";
} else {
    $comando = "SELECT j.nome, j.preco, fj.foto, j.idJogo FROM Favoritos f INNER JOIN Jogos j ON f.idJogoPublicado = j.idJogo INNER JOIN FotosJogos fj ON fj.idJogo = j.idJogo WHERE f.idUsuario = $idUsuario AND fj.ordem = 1";
}

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
    <title>StreetPlay :: Lista de Desejos</title>
</head>
<body class="<?=$tema?>">
    <?php require('../components/header.php') ?>
    <session class="fav-session">
        <form action="./favoritesGames.php" method="post">
            <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="text" name="pesquisa" placeholder="Buscar Jogo">
            <button class="back-search-<?=$tema?>"type="submit"><img class="text-color-<?=$tema?> search-logo" src="../../imgs/search.png"></button>
        </form>
        <?php while($registro = mysqli_fetch_assoc($resultado)):?>
        <div class="fav-game back-<?=$tema?>">
            <a href="../store/gamePage.php?idJogo=<?=$registro["idJogo"]?>">
                <img src="<?=$registro["foto"]?>">
                <span class="text-color-<?=$tema?>"><?=$registro["nome"]?></span>
            </a>
            <div>
                <a href="../store/editCartGame.php?idJogo=<?=$registro["idJogo"]?>&idUsuario=<?=$_SESSION["profile"]?>&comprar=sim"><?=$registro["preco"]?></a>
                <a class="hover-text-<?=$tema?>" href="./editFavoriteGames.php?idJogo=<?=$registro["idJogo"]?>&idUsuario=<?=$_SESSION["profile"]?>&seguir=nao&pagina=desejos">Remover Jogo</a>
            </div>
        </div>
        <?php endwhile; ?>
    </session>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>