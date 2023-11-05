<?php

//Link Sublinhado
if(empty($_GET["ativo"])){
    $ativo = 0;
} else {
    $ativo = $_GET["ativo"];
}

for($i = 1; $i < 4; $i++){
    $linkAtivo[$i] = "";
}
$linkAtivo[$ativo] = "active";

//Foto de Perfil
if(empty($_SESSION["user"])){
    $_SESSION["user"] = "anonimo";
    $fotoPerfil = "./imgs/profile.png";
} elseif($_SESSION["user"] == "usuario" || $_SESSION["user"] == "admin"){
    $comandoPerfil = "SELECT * FROM Usuarios WHERE idUsuario = ".$_SESSION["profile"];
    $nomePerfil = "nome";
} elseif($_SESSION["user"] == "dev/pub" && isset($_SESSION["idDev"])){
    $comandoPerfil = "SELECT * FROM Desenvolvedoras WHERE idDesenvolvedora = ".$_SESSION["idDev"];
    $nomePerfil = "nomeDev";
} elseif($_SESSION["user"] == "dev/pub" && isset($_SESSION["idPub"])){
    $comandoPerfil = "SELECT * FROM Publicadoras WHERE idPublicadora = ".$_SESSION["idPub"];
    $nomePerfil = "nomePub";
}

if(isset($comandoPerfil)){
    $resultadoPerfil = mysqli_query($conexao, $comandoPerfil);
    $registroPerfil = mysqli_fetch_assoc($resultadoPerfil);
    $fotoPerfil = $registroPerfil["foto"];
}

?>
<header>
    <div class="menu-bar">
        <a href="../store/index.php?ativo=1"><img class="menu-bar-logo" src="../../imgs/StreetPlayLogoExtend.png"></a>
        <a class="menu-bar-link <?=$linkAtivo[1]?>" href="../store/index.php?ativo=1">LOJA</a>
        <a class="menu-bar-link <?=$linkAtivo[2]?>" href="../community/manageUsers.php?ativo=2">COMUNIDADE</a>
        <a class="menu-bar-link <?=$linkAtivo[3]?>" href="?ativo=3">BIBLIOTECA</a>
        <!-- Sub Menu do Perfil -->
        <?php if($_SESSION["user"] == "anonimo"):?>
                <a href="../login&register/login.php">Entrar na Conta</a>
        <?php elseif($_SESSION["user"] != "anonimo"):?>
        <div>
            <span class="sub-menu-nome" onclick="subMenuBar()"><?=$registroPerfil["$nomePerfil"]?></span>
            <div class="sub-menu-perfil">
        <?php endif;
        if ($_SESSION["user"] == "dev/pub" && isset($_SESSION["idDev"])):?>
                <a class="sub-menu-link" href="../dev&pub/profileDevPub.php?idDesenvolvedora=<?=$_SESSION["idDev"]?>">Acessar Minha Página</a>
                <?php elseif ($_SESSION["user"] == "dev/pub" && isset($_SESSION["idPub"])):?>
                <a class="sub-menu-link" href="../dev&pub/profileDevPub.php?idPublicadora=<?=$_SESSION["idPub"]?>">Acessar Minha Página</a>
                <?php elseif ($_SESSION["user"] == "usuario" || $_SESSION["user"] == "admin"):?>
                <a class="sub-menu-link" href="../user/profileUser.php?idUsuario=<?=$_SESSION["profile"]?>">Acessar Minha Conta</a>
                <?php endif;
                if($_SESSION["user"] != "anonimo"):?>
                <a class="sub-menu-link" href="../user/favoritesGames.php">Lista de Desejos</a>
                <a class="sub-menu-link" href="../store/cartGames.php">Carrinho</a>
                <a class="sub-menu-link" href="../login&register/logOut.php">Sair da Conta</a>
                <?php endif?>
            </div>
        </div>
        <img src="<?=$fotoPerfil?>" alt="foto do perfil" class="menu-foto-perfil">
    </div>
    <!-- Menus de gerenciamento -->
    <?php if($_SESSION["user"] == "dev/pub" || $_SESSION["user"] == "admin"):?>
        <div class="menu-manager">
            <a href="../game/pubGame.php">Publicar Jogo</a>
            <a href="../game/manageGames.php">Gerenciar Jogos</a>
            <?php if($_SESSION["user"] == "admin"):?>
            <a href="../community/manageUsers.php">Gerenciar Usuários</a>
            <a href="../category/addCategory.php">Gerenciar Categorias</a>
            <?php endif ?>
        </div>
        <?php endif;?>
</header>