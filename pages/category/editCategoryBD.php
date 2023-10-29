<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

if(isset($_GET["idCategoria"])){
    $idCategoria = $_GET["idCategoria"];
    $updateColecoes = "UPDATE colecoes SET idCategoria = NULL WHERE idCategoria = $idCategoria";
    $updateJogosPublicados = "UPDATE jogospublicados SET idCategoria = NULL WHERE idCategoria = $idCategoria";
    $deleteCategoria = "DELETE FROM categorias WHERE idCategoria = $idCategoria";
    $resultadoColecoes = mysqli_query($conexao, $updateColecoes);
    $resultadoJogosPublicados = mysqli_query($conexao, $updateJogosPublicados);
    $resultadoCategoria = mysqli_query($conexao, $deleteCategoria);
    if($resultadoCategoria){
        $_SESSION["mensagem"] = "Categoria Apagada com Sucesso";
    } else {
        $_SESSION["mensagem"] = "Erro ao Apagar Categoria";
    } Header("Location:./addCategory.php?idJogo=$idJogo");
} elseif (isset($_POST["idCategoria"])){
    $idCategoria = $_POST["idCategoria"];
    $nome = $_POST["nome"];
    $updateCategoria = "UPDATE categorias SET nome = '$nome' WHERE idCategoria = $idCategoria";
    $resultadoCategoria = mysqli_query($conexao, $updateCategoria);
    if($resultadoCategoria){
        $_SESSION["mensagem"] = "Categoria Atualizada com Sucesso";
    } else {
        $_SESSION["mensagem"] = "Erro ao Atualizar Categoria";
    } Header("Location:./addCategory.php?idJogo=$idJogo");
}

?>