<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

if(isset($_SESSION["mensagem"])){
    echo $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
}

if(isset($_SESSION["user"]) && $_SESSION["user"] != "anonimo"){
    Header("Location:../../index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" src="../../css/main.css">
    <title>Registrar-se</title>
</head>
<body>
    <?php require('../components/header.php') ?>
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
</body>
</html>