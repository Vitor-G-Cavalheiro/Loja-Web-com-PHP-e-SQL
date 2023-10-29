<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

$idJogo = $_GET["idJogo"];

$comandoFotos = "DELETE FROM fotosjogos WHERE idJogo = $idJogo";
$comandoPublicado = "DELETE FROM jogosPublicados WHERE idJogo = $idJogo";
$comandoFavorito = "DELETE FROM favoritos WHERE idJogo = $idJogo";
$comandoCarrinho = "DELETE FROM carrinho WHERE idJogo = $idJogo";
$comandoBiblioteca = "DELETE FROM biblioteca WHERE idJogo = $idJogo";
$comandoCategoria = "DELETE FROM categoriasJogos WHERE idJogo = $idJogo";
$comandoJogo = "DELETE FROM jogos WHERE idJogo = $idJogo";

$resultadoFotos = mysqli_query($conexao, $comandoFotos);
$resultadoPublicado = mysqli_query($conexao, $comandoPublicado);
$resultadoFavorito = mysqli_query($conexao, $comandoFavorito);
$resultadoCarrinho = mysqli_query($conexao, $comandoCarrinho);
$resultadoBiblioteca = mysqli_query($conexao, $comandoBiblioteca);
$resultadoCategoria = mysqli_query($conexao, $comandoCategoria);
$resultadoJogo = mysqli_query($conexao, $comandoJogo);

if($resultadoFotos == TRUE && $resultadoJogo == TRUE && $resultadoPublicado == TRUE){
    $_SESSION["mensagem"] = "Jogo Apagado com Sucesso";
} else {
    $_SESSION["mensagem"] = "Erro ao Apagar Jogo";
} Header("Location:./manageGames.php");

?>