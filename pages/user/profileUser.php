<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$tema = require('../functions/themeVerification.php');

$idUsuario = $_GET["idUsuario"];
$comando = "SELECT * FROM Usuarios WHERE idUsuario = $idUsuario";
$resultado = mysqli_query($conexao, $comando);
$registro = mysqli_fetch_assoc($resultado);

$comandoJogosSlide = "SELECT j.nome, fj.foto, j.preco, j.descricao, j.idJogo FROM JogosPublicados jp INNER JOIN Jogos j ON jp.idJogo = j.idJogo INNER JOIN FotosJogos fj ON fj.idJogo = jp.idJogo WHERE fj.ordem = 1 ORDER BY RAND() LIMIT 4";
$resultadoJogosSlide = mysqli_query($conexao, $comandoJogosSlide);

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
    <title>StreetPlay :: Perfil de <?=$registro["nome"]?></title>
</head>
<body class="<?=$tema?>">
    <?php require('../components/header.php') ?>
    <session class="profile-session back-<?=$tema?>">
        <div>
            <img src="<?=$registro["foto"]?>">
            <span class="text-color-<?=$tema?>"><?=$registro["nome"]?></span>
            <span class="text-color-<?=$tema?>"><?=$registro["descricao"]?></span>
            <?php if($idUsuario == $_SESSION["profile"] || $_SESSION["user"] == "admin"):?>
                <a class="hover-text-<?=$tema?> back-emphasys-<?=$tema?>" href="./editProfileUser.php?idUsuario=<?=$idUsuario?>">Editar Perfil</a>
            <?php endif;?>
        </div>
        <span class="text-color-<?=$tema?>">Atividade Recente: </span>
        <?php while($registroJogosSlide = mysqli_fetch_assoc($resultadoJogosSlide)):?>
        <div class="back-emphasys-<?=$tema?> profile-games">
            <img src="<?=$registroJogosSlide["foto"]?>">
            <span class="text-color-<?=$tema?>"><?=$registroJogosSlide["nome"]?></span>
            <span class="text-color-<?=$tema?>"><?=$registroJogosSlide["descricao"]?></span>
        </div>
        <?php endwhile;?>
        <div>
            <span class="text-color-<?=$tema?>">EM BREVE BIBLIOTECA E MAIS...</span>
        </div>
    </session>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>