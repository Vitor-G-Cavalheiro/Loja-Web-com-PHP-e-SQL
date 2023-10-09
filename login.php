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
    <title>Iniciar Sessão</title>
</head>
<body>
    <form action="loginValidation.php" method="post">
        <label for="nome">Nome: </label>
        <input type="text" name="nome">
        <label for="senha">Senha: </label>
        <input type="password" name="senha">
        <button type="submit">Logar</button>
    </form>
</body>
</html>