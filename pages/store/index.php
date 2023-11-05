<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$messagem = require('../functions/message.php');

//Jogos Aleatórios para os Slides
$comandoJogosSlide = "SELECT j.nome, fj.foto, j.preco, j.descricao, j.idJogo, fj.ordem FROM jogospublicados jp INNER JOIN jogos j ON jp.idJogo = j.idJogo INNER JOIN fotosjogos fj ON fj.idJogo = jp.idJogo WHERE fj.ordem = 1 ORDER BY RAND() LIMIT 8";
$resultadoJogosSlide = mysqli_query($conexao, $comandoJogosSlide);

//Jogos Recentes
$comandoJogos = "SELECT j.nome, fj.foto, j.preco, j.descricao, j.idJogo, fj.ordem FROM jogospublicados jp INNER JOIN jogos j ON jp.idJogo = j.idJogo INNER JOIN fotosjogos fj ON fj.idJogo = jp.idJogo WHERE fj.ordem = 1 ORDER BY j.idJogo DESC LIMIT 16";
$resultadoJogos = mysqli_query($conexao, $comandoJogos);

//Categorias
$comandoCategorias = "SELECT * FROM categorias ORDER BY nome LIMIT 32";
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
<body>
    <!-- Cabeçalho -->
    <?php require('../components/header.php') ?>
    <session>
        <!-- Slide com Swiper JS -->
        <div class="back-swiper">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php while($registroJogosSlide = mysqli_fetch_assoc($resultadoJogosSlide)):
                    if($registroJogosSlide["ordem"] == '1'):?>
                    <div class="swiper-slide">
                        <a class="swiper-content" href="./gamePage.php?idJogo=<?=$registroJogosSlide["idJogo"]?>">
                            <div class="swiper-content">
                                <img class="swiper-img" src="<?=$registroJogosSlide["foto"]?>">
                                <div class="swiper-text">
                                    <span><?=$registroJogosSlide["nome"]?></span>
                                    <span><?=$registroJogosSlide["descricao"]?></span>
                                    <span><?=$registroJogosSlide["preco"]?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; 
                endwhile; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!-- Corpo da Página -->
        <div class="body-page">
            <div class="body-category">
                <span>Categorias</span>
                <?php while($registroCategorias = mysqli_fetch_assoc($resultadoCategorias)):?>
                    <a href="./listGames.php?inicio=0&acao=mais&idCategoria=<?=$registroCategorias["idCategoria"]?>"><?=$registroCategorias["nome"]?></a>
                <?php endwhile; ?>
            </div>
            <div class="body-games">
                <?php while($registroJogos = mysqli_fetch_assoc($resultadoJogos)):
                if($registroJogos["ordem"] == '1'):?>
                    <a class="card-game" href="./gamePage.php?idJogo=<?=$registroJogos["idJogo"]?>">
                        <img class="card-game-img" src="<?=$registroJogos["foto"]?>">
                        <div class="card-game-content">
                            <span class="card-game-text"><?=$registroJogos["nome"]?></span>
                            <span class="card-game-text"><?=$registroJogos["descricao"]?></span>
                            <span class="card-game-price"><?=$registroJogos["preco"]?></span>
                        </div>
                    </a>
                <?php endif;
                endwhile;?>  
                <a href="./listGames.php?inicio=0&acao=mais&modificador=nao">Ver Mais Jogos</a>  
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