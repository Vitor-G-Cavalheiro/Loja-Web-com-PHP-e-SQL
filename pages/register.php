<?php

$sessao = require('session.php');
$conexao = require('connection.php');

if(isset($_SESSION["mensagem"])){
    echo $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar-se</title>
</head>
<body>
    <form action="registerBD.php" method="post">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" required>
        <label for="senha">Senha: </label>
        <input type="password" name="senha" required>
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
</body>
</html>