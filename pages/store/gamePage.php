<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$messagem = require('../functions/message.php');

$idJogo = $_GET["idJogo"];

//Comando Jogo
$comandoJogo = "SELECT * FROM jogos j INNER JOIN jogospublicados jp ON j.idJogo = jp.idJogo WHERE j.idJogo = $idJogo";
$resultadoJogo = mysqli_query($conexao, $comandoJogo);
$registroJogo = mysqli_fetch_assoc($resultadoJogo);

//Comando Desenvolvedora
$comandoDesenvolvedora = "SELECT * FROM desenvolvedoras d INNER JOIN jogospublicados jp ON jp.idDesenvolvedora = d.idDesenvolvedora WHERE jp.idJogo = $idJogo";
$resultadoDesenvolvedora = mysqli_query($conexao, $comandoDesenvolvedora);
$registroDesenvolvedora = mysqli_fetch_assoc($resultadoDesenvolvedora);

//Comando Publicadora
$comandoPublicadora = "SELECT * FROM Publicadoras d INNER JOIN jogospublicados jp ON jp.idPublicadora = d.idPublicadora WHERE jp.idJogo = $idJogo";
$resultadoPublicadora = mysqli_query($conexao, $comandoPublicadora);
$registroPublicadora = mysqli_fetch_assoc($resultadoPublicadora);

//Comando Fotos Slide
$comandoFotos = "SELECT * FROM fotosjogos WHERE idJogo = $idJogo";
$resultadoFotos = mysqli_query($conexao, $comandoFotos);

//Comando Categorias do jogo
$comandoCategoriasJogo = "SELECT * FROM categoriasjogos cj INNER JOIN categorias c ON cj.idCategoria = c.idCategoria WHERE idJogo = $idJogo";
$resultadoCategoriasJogo = mysqli_query($conexao, $comandoCategoriasJogo);

//Comando Jogos da Mesma Dev
$idDesenvolvedora = $registroJogo["idDesenvolvedora"];
$comandoJogosDesenvolvedora = "SELECT j.nome, fj.foto, j.preco, j.idJogo, fj.ordem FROM jogospublicados jp INNER JOIN jogos j ON jp.idJogo = j.idJogo INNER JOIN fotosjogos fj ON j.idJogo = fj.idJogo WHERE idDesenvolvedora = $idDesenvolvedora ORDER BY RAND() LIMIT 12";
$resultadoJogosDesenvolvedora = mysqli_query($conexao, $comandoJogosDesenvolvedora);

//Jogos Recentes
$comandoJogos = "SELECT j.nome, fj.foto, j.preco, j.descricao, j.idJogo, fj.ordem FROM jogospublicados jp INNER JOIN jogos j ON jp.idJogo = j.idJogo INNER JOIN fotosjogos fj ON fj.idJogo = jp.idJogo ORDER BY j.idJogo DESC LIMIT 12";
$resultadoJogos = mysqli_query($conexao, $comandoJogos);

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
    <title><?=$registroJogo["nome"]?> no StreetPlay</title>
</head>
<body>
    <!-- Cabeçalho -->
    <?php require('../components/header.php') ?>
    <!-- Menus de gerenciamento -->
    <session>
        <!-- Título -->
        <span><?=$registroJogo["nome"]?></span>
        <!-- Slide Sobre o Jogo -->
        <div class="back-swiper">
            <div class="swiper swiper-game mySwiper">
                <div class="swiper-wrapper">
                    <?php while($registroFotos = mysqli_fetch_assoc($resultadoFotos)):?>
                    <div class="swiper-slide">
                        <div class="swiper-content">
                            <img class="swiper-img-game" src="<?=$registroFotos["foto"]?>">
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!-- Preço -->
        <div>
            <span>Comprar <?=$registroJogo["nome"]?></span>
            <div>
                <span><?=$registroJogo["preco"]?></span>
                <!-- Verificação se já tem comprado ou não -->
                <a href="?idJogo=<?=$idJogo?>">Comprar</a>
            </div>
        </div>
        <!-- Descrição -->
        <div>
            <span><?=$registroJogo["descricao"]?></span>
            <!-- Desenvolvedora e Publicadora -->
            <div>
                <a href="../dev&pub/profileDevPub.php?idDesenvolvedora=<?=$registroDesenvolvedora["idDesenvolvedora"]?>"><?=$registroDesenvolvedora["nome"]?></a >
                <a href="../dev&pub/profileDevPub.php?idPublicadora=<?=$registroPublicadora["idPublicadora"]?>"><?=$registroPublicadora["nome"]?></a >
            </div>
        </div>
        <!-- Categorias -->
        <div>
            <?php while($registroCategoriasJogo = mysqli_fetch_assoc($resultadoCategoriasJogo)):?>
            <a href="./listGames.php?idCategoria=<?=$registroCategoriasJogo["idCategoria"]?>"><?=$registroCategoriasJogo["nome"]?></a>
            <?php endwhile; ?>
        </div>
        <!-- Jogos da Mesma Dev -->
        <div class="back-swiper">
            <span>Jogos de <?=$registroDesenvolvedora["nome"]?></span>
            <div class="swiper swiper-game-recomedation mySwiper-recomedation">
                <div class="swiper-wrapper">
                <?php while($registroJogosDesenvolvedora = mysqli_fetch_assoc($resultadoJogosDesenvolvedora)):
                    if($registroJogosDesenvolvedora["ordem"] == '1' && $registroJogosDesenvolvedora["idJogo"] != $idJogo):?>
                    <div class="swiper-slide">
                        <a class="swiper-content-recomedation" href="./gamePage.php?idJogo=<?=$registroJogosDesenvolvedora["idJogo"]?>">
                            <div class="swiper-content-recomedation">
                                <img class="swiper-img" src="<?=$registroJogosDesenvolvedora["foto"]?>">
                                <div class="swiper-text">
                                    <span><?=$registroJogosDesenvolvedora["nome"]?></span>
                                    <span><?=$registroJogosDesenvolvedora["preco"]?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; 
                endwhile; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <!-- Jogos Novos -->
        <div class="back-swiper">
            <span>Lançamentos</span>
            <div class="swiper swiper-game-recomedation mySwiper-recomedation">
                <div class="swiper-wrapper">
                <?php while($registroJogos = mysqli_fetch_assoc($resultadoJogos)):
                    if($registroJogos["ordem"] == '1' && $registroJogos["idJogo"] != $idJogo):?>
                    <div class="swiper-slide">
                        <a class="swiper-content-recomedation" href="./gamePage.php?idJogo=<?=$registroJogos["idJogo"]?>">
                            <div class="swiper-content-recomedation">
                                <img class="swiper-img" src="<?=$registroJogos["foto"]?>">
                                <div class="swiper-text">
                                    <span><?=$registroJogos["nome"]?></span>
                                    <span><?=$registroJogos["preco"]?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; 
                endwhile; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
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