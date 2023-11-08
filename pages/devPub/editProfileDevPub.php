<?php 

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
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
<body>
    <?php require('../components/header.php') ?>
    <session>
        <!-- Menu Lateral -->
        <div>
            <input type="radio" name="menu-edit-user" onclick="divEditActive(0)" value="perfil" checked>
            <label for="perfil">Perfil Público</label>
            <input type="radio" name="menu-edit-user" onclick="divEditActive(1)" value="senha">
            <label for="senha">Alterar Senha</label>
            <input type="radio" name="menu-edit-user" onclick="divEditActive(2)" value="email">
            <label for="email">Verificar Email</label>
            <input type="radio" name="menu-edit-user" onclick="divEditActive(3)" value="social">
            <label for="email">Redes Sociais</label>
            <input type="radio" name="menu-edit-user" onclick="divEditActive(4)" value="apagar">
            <label for="email">Apagar Conta</label>
        </div>
        <!-- Perfil Público -->
        <div class="div-edit-user">
            <span>Atualizar Perfil Público</span>
            <form action="./editProfileDevPubBD.php" method="post" enctype="multipart/form-data">
                <input type="text" name="<?=$nomeColuna?>" value="<?=$idDevPub?>" hidden>
                <label for="nome">Nome: </label>
                <input name="nome" type="text" value="<?=$registro["$nome"]?>" required>
                <label for="descricao">Descrição: </label>
                <input name="descricao" type="text" value="<?=$registro["descricao"]?>">
                <label< for="foto">Foto de Perfil: </label>
                <input type="file" name="foto">
                <button type="submit">Salvar Alterações</button>
            </form>
        </div>
        <!-- Atualizar Senha -->
        <div class="div-edit-user invisible">
            <span>Atualizar Senha</span>
            <form action="./editProfileDevPubBD.php" method="post">
                <input type="text" name="<?=$nomeColuna?>" value="<?=$idDevPub?>" hidden>
                <label for="senha">Senha: </label>
                <input name="senha" type="password" maxlength="8" required>
                <label for="confSenha">Confirme sua Senha: </label>
                <input name="confSenha" type="password" maxlength="8" required>
                <button type="submit">Salvar Alterações</button>
            </form>
        </div>
        <!-- Verificar Email -->
        <div class="div-edit-user invisible">
            <span>Verificação de Email</span>
        </div>
        <!-- Redes Sociais -->
        <div class="div-edit-user invisible">
            <form action="./editProfileDevPubBD.php" method="post">
            <input type="text" name="<?=$nomeColuna?>" value="<?=$idDevPub?>" hidden>
                <label for="youtube">Youtube: </label>
                <input name="youtube" type="text" value="<?=$registro["youtube"]?>">
                <input type="checkbox" name="delYoutube" value="delYoutube">
                <label for="twitter">Twitter: </label>
                <input name="twitter" type="text" value="<?=$registro["twitter"]?>">
                <input type="checkbox" name="delTwitter" value="delTwitter">
                <label for="twitch">Twitch: </label>
                <input name="twitch" type="text" value="<?=$registro["twitch"]?>">
                <input type="checkbox" name="delTwitch" value="delTwitch">
                <label for="site">Site Próprio: </label>
                <input name="site" type="text" value="<?=$registro["site"]?>">
                <input type="checkbox" name="delSite" value="delSite">
                <button type="submit">Salvar Alterações</button>
            </form>
        </div>
        <!-- Excluir Conta -->
        <div class="div-edit-user invisible">
            <button type="button" onclick="popUpGen('open')">Excluir Conta</button>
            <div class="pop-up">
                <span>Tem Certeza Que Deseja Excluir Sua Conta?</span>
                <a href="./editProfileDevPubBD.php?delete=sim&<?=$nomeColuna?>=<?=$idDevPub?>">Sim</a>
                <button type="button" onclick="popUpGen('close')">Não</button >
            </div>
        </div>
    </session>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>