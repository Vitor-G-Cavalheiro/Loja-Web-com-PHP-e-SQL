<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

if(isset($_GET["idFotoJogo"])){
    $idFotoJogo = $_GET["idFotoJogo"];
    $idJogo = $_GET["idJogo"];
    $deleteFotoJogo = "DELETE FROM FotosJogos WHERE idFotoJogo = $idFotoJogo";
    if($resultado = mysqli_query($conexao, $deleteFotoJogo)){
        $_SESSION["mensagem"] = "Foto Apagada com Sucesso";
    } else {
        $_SESSION["mensagem"] = "Falha ao Apagar Foto";
    } Header("Location:./updateGame.php?idJogo=$idJogo");
} elseif(isset($_POST["idJogo"])){
    $idJogo = $_POST["idJogo"];
    $destino = '../../imgs/' . $_FILES['foto']['name'];
    $arquivo_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($arquivo_tmp, $destino);
    $comandoFoto = "INSERT INTO fotosJogos (idJogo, foto) values ('$idJogo', '$destino')";
    if($resultadoFoto = mysqli_query($conexao, $comandoFoto)){
        $_SESSION["mensagem"] = "Foto Adicionada com Sucesso";
    } else {
        $_SESSION["mensagem"] = "Falha ao Adicionar Foto";
    } Header("Location:./updateGame.php?idJogo=$idJogo");
}
 
?>