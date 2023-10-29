<?php

$sessao = require('./pages/functions/session.php');
$conexao = require('./pages/functions/connection.php');

if(isset($_SESSION["mensagem"])){
    echo $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
}

$comando = "SELECT j.nome, fj.foto FROM jogospublicados jp INNER JOIN jogos j ON jp.idJogo = j.idJogo INNER JOIN fotosjogos fj ON fj.idJogo = jp.idJogo";

if(empty($_SESSION["user"])){
    $_SESSION["user"] = "anonimo";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" src="./css/main.css">
    <title>Bem-vindo(a) ao StreetPlay</title>
</head>
<body>
    <!-- Cabeçalho -->
    <?php require('./pages/components/header.php') ?>
    <!-- Menus de gerenciamento -->
    <session>
        <?php
        if($_SESSION["user"] == "dev/pub" || $_SESSION["user"] == "admin"):?>
        <div>
            <a href="./pages/game/pubGame.php">Publicar Jogo</a>
            <a href="./pages/game/manageGames.php">Lista de Jogos</a>
            <?php if($_SESSION["user"] == "admin"):?>
            <a href="./pages/category/addCategory.php">Gerenciar Categorias</a>
            <?php endif ?>
        </div>
        <?php endif;
        if($_SESSION["user"] != "anonimo"):?>
            <a href="./pages/user/profileUser.php?idUsuario=<?=$_SESSION["profile"]?>">Acessar Minha Conta</a>
            <a href="./pages/user/logOut.php">Sair da Conta</a>
        <?php elseif ($_SESSION["user"] == "anonimo"):?>
            <a href="./pages/user/login.php">Entrar na Conta</a>
        <?php endif?>
    </session>
    <!-- Rodapé -->
    <?php require('./pages/components/footer.php') ?>
</body>
</html>