<?php

$sessao = require('session.php');
$conexao = require('connection.php');

$idJogo = $_GET["idJogo"];

$comandoFotos = "DELETE FROM fotosjogos WHERE $idJogo";
$comandoPublicado = "DELETE FROM jogosPublicados WHERE $idJogo";
$comandoJogo = "DELETE FROM jogos WHERE $idJogo";

$resultadoFotos = mysqli_query($conexao, $comandoFotos);
$resultadoPublicado = mysqli_query($conexao, $comandoPublicado);
$resultadoJogo = mysqli_query($conexao, $comandoJogo);

if($resultadoFotos == TRUE && $resultadoJogo == TRUE && $resultadoPublicado == TRUE){
    $_SESSION["mensagem"] = "Jogo Apagado com Sucesso";
    Header("Location:manageGames.php");
} else {
    $_SESSION["mensagem"] = "Erro ao Apagar Jogo";
    Header("Location:manageGames.php");
}

?>