<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$tema = require('../functions/themeVerification.php');
$mensagem = require('../functions/message.php');

if(isset($_SESSION["profile"])){
    $idUsuario = $_SESSION["profile"];
}

if(isset($_GET["idDesenvolvedora"])){
    $idDevPub = $_GET["idDesenvolvedora"];
    $idDesenvolvedora = $_GET["idDesenvolvedora"];
    $nomeColuna = "idDesenvolvedora";
    $tabela = "Desenvolvedoras";
    $nome = "nomeDev";
} elseif (isset($_GET["idPublicadora"])){
    $idDevPub = $_GET["idPublicadora"];
    $idPublicadora = $_GET["idPublicadora"];
    $nomeColuna = "idPublicadora";
    $tabela = "Publicadoras";
    $nome = "nomePub";
}

if(isset($_SESSION["profile"])){
    $seguindo = "SELECT * FROM Seguindo WHERE $nomeColuna = $idDevPub AND idUsuario = $idUsuario";
    $resultadoSeguindo = mysqli_query($conexao, $seguindo);
    $registroSeguindo = mysqli_fetch_assoc($resultadoSeguindo);
    $seguir = "./followDevPub.php?$nomeColuna=$idDevPub&idUsuario=$idUsuario";
}

//Comando Seguidores
$comandoSeguidores = "SELECT COUNT(idUsuario) AS NumeroSeguidores FROM Seguindo WHERE $nomeColuna = $idDevPub";
$resultadoSeguidores = mysqli_query($conexao, $comandoSeguidores);
$registroSeguidores = mysqli_fetch_assoc($resultadoSeguidores);

//Comando Página Dev/Pub
$comando = "SELECT * FROM $tabela WHERE $nomeColuna = $idDevPub";
$resultado = mysqli_query($conexao, $comando);
$registro = mysqli_fetch_assoc($resultado);

//Comando Jogos da Dev/Pub
$comandoJogosDevPub = "SELECT fj.foto, fj.ordem, j.nome, j.preco, j.descricao, j.idJogo FROM JogosPublicados jp INNER JOIN Jogos j ON jp.idJogo = j.idJogo INNER JOIN FotosJogos fj ON fj.idJogo = j.idJogo WHERE $nomeColuna = $idDevPub AND fj.ordem = 1 ORDER BY j.idJogo DESC LIMIT 8";
$resultadoJogosDevPub = mysqli_query($conexao, $comandoJogosDevPub);

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
    <title>StreetPlay :: Página de <?=$registro["$nome"]?></title>
</head>
<body>
    <?php require('../components/header.php') ?>
    <session>
        <div>
            <img src="<?=$registro["foto"]?>">
            <span><?=$registro["$nome"]?></span>
            <span><?=$registro["descricao"]?></span>
            <span>Seguidores: <?=$registroSeguidores["NumeroSeguidores"]?></span>
            <!-- Verificação Seguidor -->
            <?php if(isset($registroSeguindo) && $registroSeguindo["idUsuario"] == $idUsuario):?>
                <a href="<?=$seguir?>&seguir=nao">Deixar de Seguir</a>
            <?php elseif(isset($_SESSION["profile"])):?>
                <a href="<?=$seguir?>&seguir=sim">Seguir</a>
            <?php endif;?>
            <!-- Editar Página Dev ou Pub -->
            <?php if(isset($_SESSION["idPub"]) && isset($idPublicadora)): 
            if($idPublicadora == $_SESSION["idPub"]):?>
                <a href="./editProfileDevPub.php?<?=$nomeColuna?>=<?=$idDevPub?>">Editar Página</a>
            <?php endif;
            elseif(isset($_SESSION["idDev"]) && isset($idDesenvolvedora)):
            if($idDesenvolvedora == $_SESSION["idDev"]):?>
                <a href="./editProfileDevPub.php?<?=$nomeColuna?>=<?=$idDevPub?>">Editar Página</a>
            <?php endif;
            elseif($_SESSION["user"] == "admin"):?>
                <a href="./editProfileDevPub.php?<?=$nomeColuna?>=<?=$idDevPub?>">Editar Página</a>
            <?php endif; ?>
        </div>
        <!-- Redes Sociais -->
        <div>
        <?php if(isset($registro["youtube"]) && $registro["youtube"] != NULL):?>
            <div>
                <img src=''>
                <a href='<?=$registro["youtube"]?>'>Youtube</a>
            </div>
        <?php endif;
        if(isset($registro["twitter"]) && $registro["twitter"] != NULL):?>
            <div>
                <img src=''>
                <a href='<?=$registro["twitter"]?>'>Twitter</a>
            </div>
        <?php endif;
        if(isset($registro["twitch"]) && $registro["twitch"] != NULL):?>
            <div>
                <img src=''>
                <a href='<?=$registro["twitch"]?>'>Twitch</a>
            </div>
        <?php endif;
        if(isset($registro["Site"]) && $registro["site"] != NULL):?>
            <div>
                <img src=''>
                <a href='<?=$registro["Site"]?>'><?=$registro["$nome"]?></a>
            </div>
        <?php endif;?>
        </div>
        <!-- Jogos da Dev/Pub -->
        <div>
        <?php while($registroJogosDevPub = mysqli_fetch_assoc($resultadoJogosDevPub)):
            if($registroJogosDevPub["ordem"] == '1'):?>
                <a class="card-game" href="../store/gamePage.php?idJogo=<?=$registroJogosDevPub["idJogo"]?>">
                    <img class="card-game-img" src="<?=$registroJogosDevPub["foto"]?>">
                    <div class="card-game-content">
                        <span class="card-game-text"><?=$registroJogosDevPub["nome"]?></span>
                        <span class="card-game-text"><?=$registroJogosDevPub["descricao"]?></span>
                        <span class="card-game-price"><?=$registroJogosDevPub["preco"]?></span>
                    </div>
                </a>
            <?php endif;
            endwhile;?>   
        </div>
        <a href="../store/listGames.php?inicio=0&acao=mais&<?=$nomeColuna?>=<?=$idDevPub?>">Ver Mais Jogos de <?=$registro["$nome"]?></a>
    </session>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>