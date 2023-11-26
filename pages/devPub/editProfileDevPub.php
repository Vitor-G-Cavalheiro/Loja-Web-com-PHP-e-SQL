<?php 

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$tema = require('../functions/themeVerification.php');
$messagem = require('../functions/message.php');
$userVerification = require('../functions/userVerification.php');

if(isset($_GET["idDesenvolvedora"])){
    $idDevPub = $_GET["idDesenvolvedora"];
    $nomeColuna = "idDesenvolvedora";
    $tabela = "Desenvolvedoras";
    $nome = "nomeDev";
} elseif (isset($_GET["idPublicadora"])){
    $idDevPub = $_GET["idPublicadora"];
    $nomeColuna = "idPublicadora";
    $tabela = "Publicadoras";
    $nome = "nomePub";
}

$comando = "SELECT * FROM $tabela WHERE $nomeColuna = $idDevPub";
$resultado = mysqli_query($conexao, $comando);
$registro = mysqli_fetch_assoc($resultado);

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
    <title>StreetPlay :: Editar Página de <?=$tabela?></title>
</head>
<body class="<?=$tema?>">
    <?php require('../components/header.php') ?>
    <session class="profile-edit-session">
        <!-- Menu Lateral -->
        <div class="profile-menu">
            <input class="text-color-<?=$tema?>" type="radio" name="menu-edit-user" onclick="divEditActive(0)" value="perfil" checked>
            <label class="text-color-<?=$tema?>" for="perfil">Perfil Público</label>
            <input class="text-color-<?=$tema?>" type="radio" name="menu-edit-user" onclick="divEditActive(1)" value="senha">
            <label class="text-color-<?=$tema?>" for="senha">Alterar Senha</label>
            <input class="text-color-<?=$tema?>" type="radio" name="menu-edit-user" onclick="divEditActive(2)" value="email">
            <label class="text-color-<?=$tema?>" for="email">Verificar Email</label>
            <input class="text-color-<?=$tema?>" type="radio" name="menu-edit-user" onclick="divEditActive(3)" value="social">
            <label class="text-color-<?=$tema?>" for="email">Redes Sociais</label>
            <input class="text-color-<?=$tema?>" type="radio" name="menu-edit-user" onclick="divEditActive(4)" value="apagar">
            <label class="text-color-<?=$tema?>" for="email">Apagar Conta</label>
        </div>
        <!-- Perfil Público -->
        <div class="div-edit-user back-<?=$tema?>">
            <span class="text-emphasys-<?=$tema?>">Atualizar Perfil Público</span>
            <form action="./editProfileDevPubBD.php" method="post" enctype="multipart/form-data">
                <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="text" name="<?=$nomeColuna?>" value="<?=$idDevPub?>" hidden>
                <label class="text-color-<?=$tema?>" for="nome">Nome: </label>
                <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" name="nome" type="text" value="<?=$registro["$nome"]?>" required>
                <label class="text-color-<?=$tema?>" for="descricao">Descrição: </label>
                <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" name="descricao" type="text" value="<?=$registro["descricao"]?>">
                <label class="text-color-<?=$tema?>"  for="foto">Foto de Perfil: </label>
                <input class="text-color-<?=$tema?>" type="file" name="foto">
                <button class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="submit">Salvar Alterações</button>
            </form>
        </div>
        <!-- Atualizar Senha -->
        <div class="div-edit-user back-<?=$tema?> invisible">
            <span class="text-emphasys-<?=$tema?>">Atualizar Senha</span>
            <form action="./editProfileDevPubBD.php" method="post">
                <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="text" name="<?=$nomeColuna?>" value="<?=$idDevPub?>" hidden>
                <label class="text-color-<?=$tema?>" for="senha">Senha: </label>
                <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" name="senha" type="password" maxlength="8" required>
                <label class="text-color-<?=$tema?>" for="confSenha">Confirme sua Senha: </label>
                <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" name="confSenha" type="password" maxlength="8" required>
                <button class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="submit">Salvar Alterações</button>
            </form>
        </div>
        <!-- Verificar Email -->
        <div class="div-edit-user back-<?=$tema?> invisible">
            <span class="text-emphasys-<?=$tema?>">Verificação de Email - EM BREVE</span>
        </div>
        <!-- Redes Sociais -->
        <div class="div-edit-user back-<?=$tema?> invisible edit-social-media">
            <span class="text-emphasys-<?=$tema?>">Redes Sociais</span>
            <form action="./editProfileDevPubBD.php" method="post">
                <input type="text" name="<?=$nomeColuna?>" value="<?=$idDevPub?>" hidden>
                <div>
                    <label class="text-color-<?=$tema?>" for="youtube">Youtube: </label>
                    <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" name="youtube" type="text" value="<?=$registro["youtube"]?>">
                    <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="checkbox" name="delYoutube" value="delYoutube">
                </div>
                <div>
                    <label class="text-color-<?=$tema?>" for="twitter">Twitter: </label>
                    <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" name="twitter" type="text" value="<?=$registro["twitter"]?>">
                    <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="checkbox" name="delTwitter" value="delTwitter">
                </div>
                <div>
                    <label class="text-color-<?=$tema?>" for="twitch">Twitch: </label>
                    <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" name="twitch" type="text" value="<?=$registro["twitch"]?>">
                    <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="checkbox" name="delTwitch" value="delTwitch">
                </div>
                <div>
                    <label class="text-color-<?=$tema?>" for="site">Site: </label>
                    <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" name="site" type="text" value="<?=$registro["site"]?>">
                    <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="checkbox" name="delSite" value="delSite">
                </div>
                <button class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="submit">Salvar Alterações</button>
            </form>
        </div>
        <!-- Excluir Conta -->
        <div class="div-edit-user back-<?=$tema?> invisible">
            <span class="text-emphasys-<?=$tema?>">Apagar Conta</span>
            <button class="delete-profile back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="button" onclick="popUpGen('open')">Excluir Conta</button>
            <div class="pop-up delete-pop-up back-emphasys-<?=$tema?> text-color-<?=$tema?>">
                <span class="text-color-<?=$tema?>">Tem Certeza Que Deseja Excluir Sua Conta?</span>
                <div>
                    <a class="hover-text-<?=$tema?>" href="./editProfileDevPubBD.php?delete=sim&<?=$nomeColuna?>=<?=$idDevPub?>">Sim</a>
                    <button class="hover-text-<?=$tema?> back-emphasys-<?=$tema?>" type="button" onclick="popUpGen('close')">Não</button >
                </div>
            </div>
        </div>
    </session>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>