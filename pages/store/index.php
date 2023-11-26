<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$tema = require('../functions/themeVerification.php');
$messagem = require('../functions/message.php');

//Jogos Aleatórios para os Slides
$comandoJogosSlide = "SELECT j.nome, fj.foto, j.preco, j.descricao, j.idJogo FROM JogosPublicados jp INNER JOIN Jogos j ON jp.idJogo = j.idJogo INNER JOIN FotosJogos fj ON fj.idJogo = jp.idJogo WHERE fj.ordem = 1 ORDER BY RAND() LIMIT 8";
$resultadoJogosSlide = mysqli_query($conexao, $comandoJogosSlide);

//Jogos Recentes
$comandoJogos = "SELECT j.nome, fj.foto, j.preco, j.descricao, j.idJogo FROM JogosPublicados jp INNER JOIN Jogos j ON jp.idJogo = j.idJogo INNER JOIN FotosJogos fj ON fj.idJogo = jp.idJogo WHERE fj.ordem = 1 ORDER BY j.idJogo DESC LIMIT 16";
$resultadoJogos = mysqli_query($conexao, $comandoJogos);

//Categorias
$comandoCategorias = "SELECT * FROM Categorias ORDER BY nome LIMIT 32";
$resultadoCategorias = mysqli_query($conexao, $comandoCategorias);

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
    <title>Bem-vindo(a) ao StreetPlay</title>
</head>
<body class="<?=$tema?>">
    <!-- Cabeçalho -->
    <?php require('../components/header.php') ?>
    <!-- Sub Menu da Loja -->
    <?php require('../components/headerStore.php')?>
    <session>
        <!-- Slide com Swiper JS -->
        <div class="back-swiper">
            <div class="swiper mySwiper back-<?=$tema?>">
                <div class="swiper-wrapper">
                    <?php while($registroJogosSlide = mysqli_fetch_assoc($resultadoJogosSlide)):?>
                    <div class="swiper-slide">
                        <a class="swiper-content" href="./gamePage.php?idJogo=<?=$registroJogosSlide["idJogo"]?>">
                            <div class="swiper-content back-<?=$tema?>">
                                <img class="swiper-img" src="<?=$registroJogosSlide["foto"]?>">
                                <div class="swiper-text">
                                    <span class="text-color-<?=$tema?>"><?=$registroJogosSlide["nome"]?></span>
                                    <div class="slide-imgs-div">
                                        <?php $comandoFotosJogos = "SELECT * FROM FotosJogos WHERE idJogo = ".$registroJogosSlide["idJogo"]." AND ordem <> 1 LIMIT 4";                               
                                        $resultadoFotosSlides = mysqli_query($conexao, $comandoFotosJogos);
                                        while($fotosJogosSlides = mysqli_fetch_assoc($resultadoFotosSlides)):?>
                                            <img class="slide-imgs-in" src="<?=$fotosJogosSlides["foto"]?>">
                                        <?php endwhile; ?>
                                    </div>
                                    <span class="text-color-<?=$tema?>"><?=$registroJogosSlide["preco"]?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
                </div>
                <div class="text-color-<?=$tema?> swiper-button-next"></div>
                <div class="text-color-<?=$tema?> swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!-- Corpo da Página -->
        <div class="body-page">
            <div class="body-category">
                <span class="text-color-<?=$tema?>">CATEGORIAS</span>
                <?php while($registroCategorias = mysqli_fetch_assoc($resultadoCategorias)):?>
                    <a class="hover-text-<?=$tema?>" href="./listGames.php?inicio=0&acao=mais&idCategoria=<?=$registroCategorias["idCategoria"]?>"><?=$registroCategorias["nome"]?></a>
                <?php endwhile; ?>
            </div>
            <div class="body-games">
                <?php while($registroJogos = mysqli_fetch_assoc($resultadoJogos)):?>
                    <a class="card-game back-emphasys-<?=$tema?>" href="./gamePage.php?idJogo=<?=$registroJogos["idJogo"]?>">
                        <img class="card-game-img" src="<?=$registroJogos["foto"]?>">
                        <div class="card-game-content">
                            <span class="card-game-text text-color-<?=$tema?>"><?=$registroJogos["nome"]?></span>
                            <span class="card-game-text text-color-<?=$tema?>"><?=$registroJogos["descricao"]?></span>
                            <span class="card-game-price text-color-<?=$tema?>"><?=$registroJogos["preco"]?></span>
                        </div>
                    </a>
                <?php endwhile;?>  
                <a class="link-pages back-emphasys-<?=$tema?> text-color-<?=$tema?>" href="./listGames.php?inicio=0&acao=mais&modificador=nao">Ver Mais Jogos</a>  
            </div>
        </div>
    </session>
    <!-- Rodapé -->
    <?php require('../components/footer.php') ?>
    <script src="../../js/swiper.js"></script>
    <script src="../../js/slider.js"></script>
    <script src="../../js/index.js"></script>
</body>
</html>