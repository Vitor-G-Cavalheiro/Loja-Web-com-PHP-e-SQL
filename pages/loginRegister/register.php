<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$tema = "classic";
$messagem = require('../functions/message.php');

if(isset($_SESSION["user"]) && $_SESSION["user"] != "anonimo"){
    Header("Location:../store/index.php");
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
    <title>StreetPlay :: Registrar-se</title>
</head>
<body>
    <header class="login-header">
        <a href="../store/index.php?ativo=1"><img class="menu-bar-logo" src="../../imgs/StreetPlayLogoExtend.png"></a>
    </header>
    <session class="register-form">
        <form action="./registerBD.php" method="post">
            <span>CADASTRAR-SE</span>
            <div>
                <label class="login-form-text" for="nome">Nome: </label>
                <input class="login-form-input" type="text" name="nome" required>
            </div>
            <div>
                <label class="login-form-text" for="senha">Senha: </label>
                <input class="login-form-input" type="password" name="senha" maxlength="8" required>
            </div>
            <div>
                <label class="login-form-text" for="email">Email: </label>
                <input class="login-form-input" type="email" name="email" required>
            </div>
            <label class="login-form-text" for="tipoUsuario">Qual seu tipo de conta: </label>
            <div class="login-form-options">
                <input class="login-form-input" type="radio" name="tipoUsuario" value="Usuarios" checked>
                <label class="login-form-option" for="Usuarios">Usuário</label>
                <input class="login-form-input" type="radio" name="tipoUsuario" value="Desenvolvedoras">
                <label class="login-form-option" for="Desenvolvedoras">Desenvolvedora</label>
                <input class="login-form-input" type="radio" name="tipoUsuario" value="Publicadoras">
                <label class="login-form-option" for="Publicadoras">Publicadora</label>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
    </session>
    <session class="register-footer">
        <div>
            <span>Já Possui Uma Conta?</span>
            <a href="./login.php">Logar-se</a>
        </div>
        <div>
            <span>É gratuito e fácil. Descrubra novos jogos para jogar com os amigos.</span>
            <a href="">Saiba Mais sobre a StreetPlay</a>
        </div>
    </session>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>