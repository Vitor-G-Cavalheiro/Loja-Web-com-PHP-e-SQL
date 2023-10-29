<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

$idUsuario = $_GET["idUsuario"];
$comando = "SELECT * FROM Usuarios WHERE idUsuario = $idUsuario";
$resultado = mysqli_query($conexao, $comando);
$registro = mysqli_fetch_assoc($resultado);

?>
<!DOCTYPE html>
<html lang="Pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuário</title>
</head>
<body>
    <?php require('../components/header.php') ?>
    <session>
        <span><?=$registro["nome"]?></span>
    </session>
    <?php require('../components/footer.php') ?>
</body>
</html>