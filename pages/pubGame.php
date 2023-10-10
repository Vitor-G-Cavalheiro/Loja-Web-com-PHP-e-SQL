<?php

$sessao = require('session.php');
$conexao = require('connection.php');

if(isset($_SESSION["mensagem"])){
    echo $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
}

$comandoDesenvolvedora = "SELECT * FROM Desenvolvedoras";
$comandoPublicadora = "SELECT * FROM Publicadoras";

$resultadoDesenvolvedora = mysqli_query($conexao, $comandoDesenvolvedora);
$resultadoPublicadora = mysqli_query($conexao, $comandoPublicadora);

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
        <input type="text" name="nome">
        <label for="descricao">Descrição: </label>
        <input type="text" name="descricao">
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
        <label for="foto">Fotos do Jogo: </label>
        <input type="file" name="foto[]" multiple="multiple">
        <button type="submit">Publicar</button>
    </form>
</body>
</html>