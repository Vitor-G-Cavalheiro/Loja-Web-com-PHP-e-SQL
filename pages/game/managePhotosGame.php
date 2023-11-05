<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

if(isset($_POST["idJogo"])){
    $idJogo = $_POST["idJogo"];
    $destino = '../../imgs/game/' . $_FILES['foto']['name'];
    $arquivo_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($arquivo_tmp, $destino);
    $verificacao = "SELECT * FROM fotosjogos WHERE idJogo = $idJogo";
    $resultadoVerificacao = mysqli_query($conexao, $verificacao);
    $registroVerificacao = mysqli_fetch_assoc($resultadoVerificacao);
    $ordem = $registroVerificacao["ordem"] + 1;
    $comandoFoto = "INSERT INTO fotosJogos (idJogo, foto, ordem) values ('$idJogo', '$destino', '$ordem')";
    if($resultadoFoto = mysqli_query($conexao, $comandoFoto)){
        $_SESSION["mensagem"] = "Foto Adicionada com Sucesso";
    } else {
        $_SESSION["mensagem"] = "Falha ao Adicionar Foto";
    } Header("Location:./updateGame.php?idJogo=$idJogo");
} elseif(isset($_GET["acao"])){
    $idFotoJogo = $_GET["idFotoJogo"];
    $idJogo = $_GET["idJogo"];
    if($_GET["acao"] == "rem"){
        $deleteFotoJogo = "DELETE FROM FotosJogos WHERE idFotoJogo = $idFotoJogo";
        if($resultadoDelete = mysqli_query($conexao, $deleteFotoJogo)){
            $_SESSION["mensagem"] = "Foto Apagada com Sucesso";
        } else {
            $_SESSION["mensagem"] = "Falha ao Apagar Foto";
        } Header("Location:./updateGame.php?idJogo=$idJogo");
    } elseif($_GET["acao"] == "capa"){
        $atualizarGeral = "UPDATE fotosjogos SET ordem = 2 WHERE idJogo = $idJogo";
        $resultadoGeral = mysqli_query($conexao, $atualizarGeral);
        $atualizarCapa = "UPDATE fotosjogos SET ordem = 1 WHERE idFotoJogo = $idFotoJogo";
        if($resultadoCapa = mysqli_query($conexao, $atualizarCapa)){
            $_SESSION["mensagem"] = "Capa Alterada com Sucesso";
        } else {
            $_SESSION["mensagem"] = "Falha ao Alterar Capa";
        } Header("Location:./updateGame.php?idJogo=$idJogo");
    }
} 
 
?>