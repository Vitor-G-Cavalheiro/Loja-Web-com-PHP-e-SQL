<?php

$sessao = require('./pages/functions/session.php');
$conexao = require('./pages/functions/connection.php');
$messagem = require('./pages/functions/message.php');

$comandoJogos = "SELECT j.nome, fj.foto FROM jogospublicados jp INNER JOIN jogos j ON jp.idJogo = j.idJogo INNER JOIN fotosjogos fj ON fj.idJogo = jp.idJogo ORDER BY jp.idJogo DESC";

//Foto de Perfil
if(empty($_SESSION["user"]) || $_SESSION["user"] == "anonimo"){
    $_SESSION["user"] = "anonimo";
    $fotoPerfil = "./imgs/profile.png";
} elseif($_SESSION["user"] == "usuario" || $_SESSION["user"] == "admin"){
    $comandoPerfil = "SELECT * FROM Usuarios WHERE idUsuario = ".$_SESSION["profile"];
} elseif($_SESSION["user"] == "dev/pub" && isset($_SESSION["idDev"])){
    $comandoPerfil = "SELECT * FROM Desenvolvedoras WHERE idDesenvolvedora = ".$_SESSION["idDev"];
} elseif($_SESSION["user"] == "dev/pub" && isset($_SESSION["idPub"])){
    $comandoPerfil = "SELECT * FROM Publicadoras WHERE idPublicadora = ".$_SESSION["idPub"];
}

if(isset($comandoPerfil)){
    $resultadoPerfil = mysqli_query($conexao, $comandoPerfil);
    $registroPerfil = mysqli_fetch_assoc($resultadoPerfil);
    $fotoPerfil = $registroPerfil["foto"];
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
    <link rel="icon" type="" href="./imgs/StreetPlayLogo.jpeg">
    <link rel="stylesheet" href="./css/main.css">
    <title>Bem-vindo(a) ao StreetPlay</title>
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <div class="menu-bar">
            <img class="menu-bar-logo" src="./imgs/StreetPlayLogoExtend.png">
            <a class="menu-bar-link active" href="./index.php">LOJA</a>
            <a class="menu-bar-link" href="?ativo=0">COMUNIDADE</a>
            <a class="menu-bar-link" href="?ativo=1">BIBLIOTECA</a>
            <!-- Sub Menu do Perfil-->
            <?php if($_SESSION["user"] == "anonimo"):?>
                <a class="sub-menu-link" href="./pages/login&register/login.php">Entrar na Conta</a>
            <?php elseif ($_SESSION["user"] == "dev/pub" && isset($_SESSION["idDev"])):?> 
            <div>
                <span class="sub-menu-nome" onclick="subMenuBar()"><?=$registroPerfil["nome"]?></span>    
                <div class="sub-menu-perfil">
                <a class="sub-menu-link" href="./pages/dev&pub/profileDevPub.php?idDesenvolvedora=<?=$_SESSION["idDev"]?>">Acessar Minha Página</a>
                <?php elseif ($_SESSION["user"] == "dev/pub" && isset($_SESSION["idPub"])):?>
                <a class="sub-menu-link" href="./pages/dev&pub/profileDevPub.php?idPublicadora=<?=$_SESSION["idPub"]?>">Acessar Minha Página</a>
                <?php elseif ($_SESSION["user"] == "usuario" || $_SESSION["user"] == "admin"):?>
                <a class="sub-menu-link" href="./pages/user/profileUser.php?idUsuario=<?=$_SESSION["profile"]?>">Acessar Minha Conta</a>
                <?php endif;
                if($_SESSION["user"] != "anonimo"):?>
                <a class="sub-menu-link" href="./pages/user/favoritesGames.php">Lista de Desejos</a>
                <a class="sub-menu-link" href="">Carrinho</a>
                <a class="sub-menu-link" href="./pages/login&register/logOut.php">Sair da Conta</a>
                <?php endif?>
                </div>
            </div>
            <img src="<?=$fotoPerfil?>" alt="foto do perfil" class="menu-foto-perfil">     
        </div>
    </header>
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
        <?php endif;?>
        
        <div>
            
        </div>
    </session>
    <!-- Rodapé -->
    <?php require('./pages/components/footer.php') ?>
    <script src="./js/index.js"></script>
</body>
</html>