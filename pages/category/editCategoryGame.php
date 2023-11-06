<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

$idCategoria = $_GET["idCategoria"];
$idJogo = $_GET["idJogo"];
$acao = $_GET["acao"];

$comandoVerificacao = "SELECT * FROM CategoriasJogos WHERE idCategoria = $idCategoria AND idJogo = $idJogo";
$resultadoVerificacao = mysqli_query($conexao, $comandoVerificacao);

if($acao == "rem"){
    $comandoDelete = "DELETE FROM CategoriasJogos WHERE idJogo = $idJogo AND idCategoria = $idCategoria";
    $resultadoDelete = mysqli_query($conexao, $comandoDelete);
    $_SESSION["mensagem"] = "Categoria Removida com Sucesso";
    Header("Location:../game/updateGame.php?idJogo=$idJogo");
} else if($acao == "add"){
    if($registroVerificacao = mysqli_fetch_assoc($resultadoVerificacao)){
        $_SESSION["mensagem"] = "Categoria já Adicionada";
        Header("Location:../game/updateGame.php?idJogo=$idJogo");
        die;
    }

    $comandoInsercao = "INSERT INTO CategoriasJogos (idCategoria, idJogo) VALUES ($idCategoria, $idJogo)";
    if($resultadoInsercao = mysqli_query($conexao, $comandoInsercao)){
        $_SESSION["mensagem"] = "Categoria Adicionada com Sucesso";
    } else {
        $_SESSION["mensagem"] = "Falha ao Adicionar Categoria";
    } Header("Location:../game/updateGame.php?idJogo=$idJogo");
}

?>