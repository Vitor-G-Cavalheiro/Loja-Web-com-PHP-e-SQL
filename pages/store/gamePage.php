<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$tema = require('../functions/themeVerification.php');
$messagem = require('../functions/message.php');

$idJogo = $_GET["idJogo"];

//Comando Jogo
$comandoJogo = "SELECT *, j.descricao FROM jogos j INNER JOIN JogosPublicados jp ON j.idJogo = jp.idJogo INNER JOIN Desenvolvedoras d ON jp.idDesenvolvedora = d.idDesenvolvedora INNER JOIN Publicadoras p ON jp.idPublicadora = p.idPublicadora WHERE j.idJogo = $idJogo";
$resultadoJogo = mysqli_query($conexao, $comandoJogo);
$registroJogo = mysqli_fetch_assoc($resultadoJogo);

//Comando Fotos Slide
$comandoFotos = "SELECT * FROM FotosJogos WHERE idJogo = $idJogo";
$resultadoFotos = mysqli_query($conexao, $comandoFotos);

//Comando Categorias do jogo
$comandoCategoriasJogo = "SELECT * FROM CategoriasJogos cj INNER JOIN Categorias c ON cj.idCategoria = c.idCategoria WHERE idJogo = $idJogo ORDER BY c.nome";
$resultadoCategoriasJogo = mysqli_query($conexao, $comandoCategoriasJogo);

//Comando Jogos da Mesma Dev
$idDesenvolvedora = $registroJogo["idDesenvolvedora"];
$comandoJogosDesenvolvedora = "SELECT j.nome, fj.foto, j.preco, j.idJogo, fj.ordem FROM JogosPublicados jp INNER JOIN jogos j ON jp.idJogo = j.idJogo INNER JOIN FotosJogos fj ON j.idJogo = fj.idJogo WHERE idDesenvolvedora = $idDesenvolvedora AND fj.ordem = 1 ORDER BY RAND() LIMIT 12";
$resultadoJogosDesenvolvedora = mysqli_query($conexao, $comandoJogosDesenvolvedora);

//Jogos Recentes
$comandoJogos = "SELECT j.nome, fj.foto, j.preco, j.descricao, j.idJogo, fj.ordem FROM JogosPublicados jp INNER JOIN jogos j ON jp.idJogo = j.idJogo INNER JOIN FotosJogos fj ON fj.idJogo = jp.idJogo AND fj.ordem = 1 ORDER BY j.idJogo DESC LIMIT 12";
$resultadoJogos = mysqli_query($conexao, $comandoJogos);

//Comando Lista de Desejos
if($_SESSION["user"] == "admin" || $_SESSION["user"] == "usuario"){
    $comandoFavoritos = "SELECT * FROM Favoritos WHERE idJogoPublicado = $idJogo AND idUsuario = ".$_SESSION["profile"];
    $resultadoFavoritos = mysqli_query($conexao, $comandoFavoritos);
    $registroFavoritos = mysqli_fetch_assoc($resultadoFavoritos);

    $comandoCarrinho = "SELECT * FROM Carrinho WHERE idJogoPublicado = $idJogo AND idUsuario = ".$_SESSION["profile"];
    $resultadoCarrinho = mysqli_query($conexao, $comandoCarrinho);
    $registroCarrinho = mysqli_fetch_assoc($resultadoCarrinho);
}

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
<body class="<?=$tema?>">
    <!-- Cabeçalho -->
    <?php require('../components/header.php') ?>
    <!-- Sub Menu da Loja -->
    <?php require('../components/headerStore.php')?>
    <!-- Menus de gerenciamento -->
    <session class="game-page">
        <!-- Título -->
        <span class="text-color-<?=$tema?>"><?=$registroJogo["nome"]?></span>
        <?php if($_SESSION["user"] == "admin"):?>
            <a class="hover-text-<?=$tema?>" href="../game/updateGame.php?idJogo=<?=$idJogo?>">Editar Jogo</a>
        <?php endif;
        if(isset($_SESSION["idDev"])):
            if($_SESSION["idDev"] == $registroJogo["idDesenvolvedora"]):?> 
            <a class="hover-text-<?=$tema?>" href="../game/updateGame.php?idJogo=<?=$idJogo?>">Editar Jogo</a>
        <?php endif;
        elseif(isset($_SESSION["idPub"])):
            if($_SESSION["idPub"] == $registroJogo["idPublicadora"]):?>
            <a class="hover-text-<?=$tema?>" href="../game/updateGame.php?idJogo=<?=$idJogo?>">Editar Jogo</a>
        <?php endif;
        endif; ?>
        <!-- Slide Sobre o Jogo -->
        <div class="back-swiper back-swiper-recomedation">
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
                <div class="swiper-button-next text-color-<?=$tema?>"></div>
                <div class="swiper-button-prev text-color-<?=$tema?>"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="favorite-game">
            <!-- Verificação se já tem na lista de desejos ou não -->
            <?php if(isset($registroFavoritos) && $registroFavoritos["idUsuario"] == $_SESSION["profile"]):?>
                <a class="text-color-<?=$tema?> back-emphasys-<?=$tema?>" href="../user/editFavoriteGames.php?idJogo=<?=$idJogo?>&idUsuario=<?=$_SESSION["profile"]?>&seguir=nao&pagina=jogo">Remover da Lista de Desejos</a>
            <?php else: ?>
                <a class="text-color-<?=$tema?> back-emphasys-<?=$tema?>" href="../user/editFavoriteGames.php?idJogo=<?=$idJogo?>&idUsuario=<?=$_SESSION["profile"]?>&seguir=sim">Adicionar a Lista de Desejos</a>
            <?php endif; ?>
        </div>
        <!-- Preço -->
        <div class="buy-div back-<?=$tema?>">
            <span class="text-color-<?=$tema?>">Comprar <?=$registroJogo["nome"]?></span>
            <div>
                <span class="standard-<?=$tema?> text-color-<?=$tema?>"><?=$registroJogo["preco"]?></span>
                <!-- Verificação se já ta no carrinho ou não FALTA VERSÃO COMPRADO -->
                <?php if(isset($registroCarrinho) && $registroCarrinho["idUsuario"] == $_SESSION["profile"]):?>
                    <a href="./cartGames.php?idUsuario=<?=$_SESSION["profile"]?>">Comprar</a>
                <?php else: ?>
                    <a href="./editCartGame.php?idJogo=<?=$idJogo?>&idUsuario=<?=$_SESSION["profile"]?>&comprar=sim">Comprar</a>
                <?php endif; ?>
            </div>
        </div>
        <!-- Descrição -->
        <div class="game-desc">
            <span class="text-color-<?=$tema?>"><?=$registroJogo["descricao"]?></span>
            <!-- Desenvolvedora e Publicadora -->
            <div class="game-dev-pub">
                <span class="text-color-<?=$tema?>">DESENVOLVEDORA: <a class="hover-text-<?=$tema?>" href="../devPub/profileDevPub.php?idDesenvolvedora=<?=$registroJogo["idDesenvolvedora"]?>"><?=$registroJogo["nomeDev"]?></a></span>
                <span class="text-color-<?=$tema?>">PUBLICADORA: <a class="hover-text-<?=$tema?>" href="../devPub/profileDevPub.php?idPublicadora=<?=$registroJogo["idPublicadora"]?>"><?=$registroJogo["nomePub"]?></a></span>
            </div>
        </div>
        <!-- Categorias -->
        <div class="game-category">
            <span class="text-color-<?=$tema?>">Categorias que esse jogo pertence: </span>
            <?php while($registroCategoriasJogo = mysqli_fetch_assoc($resultadoCategoriasJogo)):?>
            <a class="back-emphasys-<?=$tema?> hover-text-<?=$tema?>" href="./listGames.php?inicio=0&acao=mais&idCategoria=<?=$registroCategoriasJogo["idCategoria"]?>"><?=$registroCategoriasJogo["nome"]?></a>
            <?php endwhile; ?>
        </div>
        <!-- Jogos da Mesma Dev -->
        <div class="back-swiper">
            <span class="text-color-<?=$tema?>">Jogos de <?=$registroJogo["nomeDev"]?></span>
            <div class="swiper swiper-game-recomedation mySwiper-recomedation">
                <div class="swiper-wrapper">
                <?php while($registroJogosDesenvolvedora = mysqli_fetch_assoc($resultadoJogosDesenvolvedora)):
                    if($registroJogosDesenvolvedora["idJogo"] != $idJogo):?>
                    <div class="swiper-slide back-emphasys-<?=$tema?>">
                        <a class="swiper-content-recomedation <?=$tema?>" href="./gamePage.php?idJogo=<?=$registroJogosDesenvolvedora["idJogo"]?>">
                            <img class="swiper-img" src="<?=$registroJogosDesenvolvedora["foto"]?>">
                            <div class="swiper-text">
                                <span class="text-color-<?=$tema?>"><?=$registroJogosDesenvolvedora["nome"]?></span>
                                <span class="text-color-<?=$tema?>"><?=$registroJogosDesenvolvedora["preco"]?></span>
                            </div>
                        </a>
                    </div>
                <?php endif; 
                endwhile; ?>
                </div>
                <div class="swiper-button-next text-color-<?=$tema?>"></div>
                <div class="swiper-button-prev text-color-<?=$tema?>"></div>
            </div>
        </div>
        <!-- Jogos Novos -->
        <div class="back-swiper">
            <span class="text-color-<?=$tema?>">Lançamentos</span>
            <div class="swiper swiper-game-recomedation mySwiper-recomedation">
                <div class="swiper-wrapper">
                <?php while($registroJogos = mysqli_fetch_assoc($resultadoJogos)):
                    if($registroJogos["idJogo"] != $idJogo):?>
                    <div class="swiper-slide back-emphasys-<?=$tema?>">
                        <a class="swiper-content-recomedation" href="./gamePage.php?idJogo=<?=$registroJogos["idJogo"]?>">
                            <img class="swiper-img" src="<?=$registroJogos["foto"]?>">
                            <div class="swiper-text">
                                <span class="text-color-<?=$tema?>"><?=$registroJogos["nome"]?></span>
                                <span class="text-color-<?=$tema?>"><?=$registroJogos["preco"]?></span>
                            </div>
                        </a>
                    </div>
                <?php endif; 
                endwhile; ?>
                </div>
                <div class="swiper-button-next text-color-<?=$tema?>"></div>
                <div class="swiper-button-prev text-color-<?=$tema?>"></div>
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