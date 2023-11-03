<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$mensagem = require('../functions/message.php');

$idUsuario = isset($_SESSION["profile"]);

if(isset($_GET["idDesenvolvedora"])){
    $idDevPub = $_GET["idDesenvolvedora"];
    $nomeColuna = "idDesenvolvedora";
    $tabela = "Desenvolvedoras";
    
} elseif (isset($_GET["idPublicadora"])){
    $idDevPub = $_GET["idPub"];
    $nomeColuna = "idPublicadora";
    $tabela = "Publicadoras";
    
}

if(isset($_SESSION["profile"])){
    $seguindo = "SELECT * FROM Seguindo WHERE $nomeColuna = $idDevPub AND idUsuario = $idUsuario";
    $resultadoSeguindo = mysqli_query($conexao, $seguindo);
    $registroSeguindo = mysqli_fetch_assoc($resultadoSeguindo);
    $seguir = "./followDevPub.php?$nomeColuna=$idDevPub&idUsuario=$idUsuario";
}

$comandoSeguidores = "SELECT COUNT(idUsuario) AS NumeroSeguidores FROM Seguindo WHERE $nomeColuna = $idDevPub";
$resultadoSeguidores = mysqli_query($conexao, $comandoSeguidores);
$registroSeguidores = mysqli_fetch_assoc($resultadoSeguidores);

$comando = "SELECT * FROM $tabela WHERE $nomeColuna = $idDevPub";
$resultado = mysqli_query($conexao, $comando);
$registro = mysqli_fetch_assoc($resultado);

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
    <title>StreetPlay :: Página de <?=$registro["nome"]?></title>
</head>
<body>
    <?php require('../components/header.php') ?>
    <session>
        <div>
            <img src="<?=$registro["foto"]?>">
            <span><?=$registro["nome"]?></span>
            <span><?=$registro["descricao"]?></span>
            <span>Seguidores: <?=$registroSeguidores["NumeroSeguidores"]?></span>
            <!-- Verificação Seguidor -->
            <?php if(isset($registroSeguindo)):?>
                <a href="<?=$seguir?>&seguir=nao">Deixar de Seguir</a>
            <?php elseif(isset($_SESSION["profile"])):?>
                <a href="<?=$seguir?>&seguir=sim">Seguir</a>
            <?php endif;?>
            <!-- Editar Página Dev ou Pub -->
            <?php if($idDevPub == isset($_SESSION["idPub"]) || $idDevPub == isset($_SESSION["idDev"])):?>
                <a href="./editProfileDevPub.php?<?=$nomeColuna?>=<?=$idDevPub?>">Editar Página</a>
            <?php endif;?>
        </div>
        <!-- Redes Sociais -->
        <div>
        <?php if(isset($registro["youtube"])):?>
            <div>
                <img src=''>
                <a href='<?=$registro["youtube"]?>'>Youtube</a>
            </div>
        <?php elseif(isset($registro["twitter"])):?>
            <div>
                <img src=''>
                <a href='<?=$registro["twitter"]?>'>Twitter</a>
            </div>
        <?php elseif(isset($registro["twitch"])):?>
            <div>
                <img src=''>
                <a href='<?=$registro["twitch"]?>'>twitch</a>
            </div>
        <?php elseif(isset($registro["Site"])):?>
            <div>
                <img src=''>
                <a href='<?=$registro["Site"]?>'><?=$registro["nome"]?></a>
            </div>
        <?php endif;?>
        </div>
    </session>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>