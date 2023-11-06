<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

$idJogo = $_GET["idJogo"];

$comandoFotos = "DELETE FROM FotosJogos WHERE idJogo = $idJogo";
$comandoPublicado = "DELETE FROM JogosPublicados WHERE idJogo = $idJogo";

$verificacaoFavorito = "SELECT * FROM Favoritos WHERE idJogoPublicado = $idJogo";
$verificandoFavorito = mysqli_query($conexao, $verificacaoFavorito);
$verificadoFavorito = mysqli_fetch_assoc($verificandoFavorito);
if($verificadoFavorito){
    $comandoFavorito = "DELETE FROM Favoritos WHERE idJogoPublicado = $idJogo";
    $resultadoFavorito = mysqli_query($conexao, $comandoFavorito);
}

$verificacaoCarrinho = "SELECT * FROM Carrinho WHERE idJogoPublicado = $idJogo";
$verificandoCarrinho = mysqli_query($conexao, $verificacaoCarrinho);
$verificadoCarrinho = mysqli_fetch_assoc($verificandoCarrinho);
if($verificadoCarrinho){
    $comandoCarrinho = "DELETE FROM Carrinho WHERE idJogoPublicado = $idJogo";
    $resultadoCarrinho = mysqli_query($conexao, $comandoCarrinho);
}

$verificacaoBiblioteca = "SELECT * FROM Biblioteca WHERE idJogoPublicado = $idJogo";
$verificandoBiblioteca = mysqli_query($conexao, $verificacaoBiblioteca);
$verificadoBiblioteca = mysqli_fetch_assoc($verificandoBiblioteca);
if($verificadoBiblioteca){
    $comandoBiblioteca = "DELETE FROM Biblioteca WHERE idJogoPublicado = $idJogo";
    $resultadoBiblioteca = mysqli_query($conexao, $comandoBiblioteca);
}
$comandoCategoria = "DELETE FROM CategoriasJogos WHERE idJogo = $idJogo";
$comandoJogo = "DELETE FROM Jogos WHERE idJogo = $idJogo";

$resultadoFotos = mysqli_query($conexao, $comandoFotos);
$resultadoPublicado = mysqli_query($conexao, $comandoPublicado);
$resultadoCategoria = mysqli_query($conexao, $comandoCategoria);
$resultadoJogo = mysqli_query($conexao, $comandoJogo);

if($resultadoFotos == TRUE && $resultadoJogo == TRUE && $resultadoPublicado == TRUE){
    $_SESSION["mensagem"] = "Jogo Apagado com Sucesso";
} else {
    $_SESSION["mensagem"] = "Erro ao Apagar Jogo";
} Header("Location:./manageGames.php");

?>