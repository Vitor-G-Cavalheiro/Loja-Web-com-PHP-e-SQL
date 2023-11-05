<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
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
    <link rel="icon" type="" href="./imgs/StreetPlayLogo.jpeg">
    <link rel="stylesheet" href="../../css/main.css">
    <title>StreetPlay :: Registrar-se</title>
</head>
<body>
    <?php //require('../components/header.php') ?>
    <form action="./registerBD.php" method="post">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" required>
        <label for="senha">Senha: </label>
        <input type="password" name="senha" maxlength="8" required>
        <label for="email">Email: </label>
        <input type="email" name="email" required>
        <label for="tipoUsuario">Qual seu tipo de conta: </label>
        <input type="radio" name="tipoUsuario" value="usuarios" checked>
        <label for="usuarios">Usuário</label>
        <input type="radio" name="tipoUsuario" value="desenvolvedoras">
        <label for="desenvolvedoras">Desenvolvedora</label>
        <input type="radio" name="tipoUsuario" value="publicadoras">
        <label for="publicadoras">Publicadora</label>
        <button type="submit">Registrar-se</button>
    </form>
    <a href="./login.php">Logar-se</a>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>