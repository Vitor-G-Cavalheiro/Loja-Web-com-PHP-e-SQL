<?php

//Link Sublinhado
if(empty($_GET["ativo"])){
    $ativo = -1;
} else {
    $ativo = $_GET["ativo"];
}

for($i = 0; $i < 2; $i++){
    $linkAtivo[$i] = "";
}
$linkAtivo[$ativo] = "active";

//Foto de Perfil
if(empty($_SESSION["user"])){
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
<header>
    <div class="menu-bar">
        <img class="menu-bar-logo" src="../../imgs/StreetPlayLogoExtend.png">
        <a class="menu-bar-link" href="../../index.php">LOJA</a>
        <a class="menu-bar-link <?=$linkAtivo[0]?>" href="?ativo=0">COMUNIDADE</a>
        <a class="menu-bar-link <?=$linkAtivo[1]?>" href="?ativo=1">BIBLIOTECA</a>
        <!-- Sub Menu do Perfil -->
        <?php if($_SESSION["user"] == "anonimo"):?>
                <a href="../login&register/login.php">Entrar na Conta</a>
        <?php elseif ($_SESSION["user"] == "dev/pub" && isset($_SESSION["idDev"])):?>
        <div>
            <span class="sub-menu-nome" onclick="subMenuBar()"><?=$registroPerfil["nome"]?></span>
            <div class="sub-menu-perfil">
                <a class="sub-menu-link" href="../dev&pub/profileDevPub.php?idDesenvolvedora=<?=$_SESSION["idDev"]?>">Acessar Minha Página</a>
                <?php elseif ($_SESSION["user"] == "dev/pub" && isset($_SESSION["idPub"])):?>
                <a class="sub-menu-link" href="../dev&pub/profileDevPub.php?idPublicadora=<?=$_SESSION["idPub"]?>">Acessar Minha Página</a>
                <?php elseif ($_SESSION["user"] == "usuario" || $_SESSION["user"] == "admin"):?>
                <a class="sub-menu-link" href="../user/profileUser.php?idUsuario=<?=$_SESSION["profile"]?>">Acessar Minha Conta</a>
                <?php endif;
                if($_SESSION["user"] != "anonimo"):?>
                <a class="sub-menu-link" href="../user/favoritesGames.php">Lista de Desejos</a>
                <a class="sub-menu-link" href="">Carrinho</a>
                <a class="sub-menu-link" href="../login&register/logOut.php">Sair da Conta</a>
                <?php endif?>
            </div>
        </div>
        <img src="<?=$fotoPerfil?>" alt="foto do perfil">
    </div>
</header>