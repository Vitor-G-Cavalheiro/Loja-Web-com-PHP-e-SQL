<?php

$sessao = require('session.php');
$conexao = require('connection.php');

$comandoJogos = "SELECT * FROM jogos";
$resultadoJogos = mysqli_query($conexao, $comandoJogos);

$jogoDuplicado = 0;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar jogos</title>
</head>
<body>
    <?php
    while($registroJogos = mysqli_fetch_assoc($resultadoJogos)){
        $comandoFotosJogos = "SELECT * FROM fotosJogos";
        $resultadoFotosJogos = mysqli_query($conexao, $comandoFotosJogos);
        while($registroFotosJogos = mysqli_fetch_assoc($resultadoFotosJogos)){
            if($registroFotosJogos["idJogo"] == $registroJogos["idJogo"]){
                if($jogoDuplicado != $registroJogos["idJogo"]){
                    echo "<div><img src='".$registroFotosJogos["foto"]."'><h2>".$registroJogos["nome"]."</h2></div>";
                    echo "<a href='./updateGame.php?idJogo=".$registroJogos["idJogo"]."'>Atualizar Jogo</a>";
                    $jogoDuplicado = $registroJogos["idJogo"];
                }
            }
        }
    }
    ?>
</body>
</html>