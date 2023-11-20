<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$verificacao = require('../functions/userVerification.php');
$tema = require('../functions/themeVerification.php');
$messagem = require('../functions/message.php');

if(isset($_SESSION["idDev"])){
    $comandoDesenvolvedora = 'SELECT * FROM Desenvolvedoras WHERE idDesenvolvedora = '.$_SESSION["idDev"];
} else {
    $comandoDesenvolvedora = "SELECT * FROM Desenvolvedoras";
}

if(isset($_SESSION["idPub"])){
    $comandoPublicadora = 'SELECT * FROM Publicadoras WHERE idPublicadora = '.$_SESSION["idPub"];
} else {
    $comandoPublicadora = "SELECT * FROM Publicadoras";
}

$comandoCategoria = "SELECT * FROM Categorias";

$resultadoDesenvolvedora = mysqli_query($conexao, $comandoDesenvolvedora);
$resultadoPublicadora = mysqli_query($conexao, $comandoPublicadora);
$resultadoCategoria = mysqli_query($conexao, $comandoCategoria);

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
    <title>StreetPlay :: Publicar Jogo</title>
</head>
<body class="<?=$tema?>">
    <?php require('../components/header.php') ?>
    <form action="./pubGameBD.php" method="post" enctype="multipart/form-data">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" required>
        <label for="preco">Preço: </label>
        <input type="number" name="preco" placeholder="00,00" step="0.01" required>
        <label for="descricao">Descrição: </label>
        <input type="text" name="descricao" required>
        <label for="desenvolvedora">Desenvolvedora: </label>
        <select name="desenvolvedora">
            <?php
            while($registroDesenvolvedora = mysqli_fetch_assoc($resultadoDesenvolvedora)){
                echo "<option value='".$registroDesenvolvedora["idDesenvolvedora"]."'>".$registroDesenvolvedora["nomeDev"]."</option>";
            }
            ?>
        </select>
        <label for="publicadora">Publicadora: </label>
        <select name="publicadora">
            <?php
            while($registroPublicadora = mysqli_fetch_assoc($resultadoPublicadora)){
                echo "<option value='".$registroPublicadora["idPublicadora"]."'>".$registroPublicadora["nomePub"]."</option>";
            }
            ?>
        </select>
        <label for="categoria">Categoria: </label>
        <select name="categoria">
            <?php
            while($registroCategoria = mysqli_fetch_assoc($resultadoCategoria)){
                echo "<option value='".$registroCategoria["idCategoria"]."'>".$registroCategoria["nome"]."</option>";
            }
            ?>
        </select>
        <label for="foto">Capa do Jogo: </label>
        <input type="file" name="foto" required>
        <button type="submit">Publicar</button>
    </form>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>
