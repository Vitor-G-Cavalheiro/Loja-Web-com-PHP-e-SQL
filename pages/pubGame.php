<?php

$sessao = require('session.php');
$conexao = require('connection.php');
$verificacao = require('userVerification.php');

if(isset($_SESSION["mensagem"])){
    echo $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
}

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
    <title>Publicar Jogo</title>
</head>
<body>
    <form action="pubGameBD.php" method="post" enctype="multipart/form-data">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" required>
        <label for="descricao">Descrição: </label>
        <input type="text" name="descricao" required>
        <label for="preco">Preço: </label>
        <input type="number" name="preco" required>
        <label for="desenvolvedora">Desenvolvedora: </label>
        <select name="desenvolvedora">
            <?php
            while($registroDesenvolvedora = mysqli_fetch_assoc($resultadoDesenvolvedora)){
                echo "<option value='".$registroDesenvolvedora["idDesenvolvedora"]."'>".$registroDesenvolvedora["nome"]."</option>";
            }
            ?>
        </select>
        <label for="publicadora">Publicadora: </label>
        <select name="publicadora">
            <?php
            while($registroPublicadora = mysqli_fetch_assoc($resultadoPublicadora)){
                echo "<option value='".$registroPublicadora["idPublicadora"]."'>".$registroPublicadora["nome"]."</option>";
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
</body>
</html>
