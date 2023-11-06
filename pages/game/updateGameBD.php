<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

$idJogo = $_POST["idJogo"];
$nome = $_POST["nome"];
$preco = $_POST["preco"];
$descricao = $_POST["descricao"];
$desenvolvedora = $_POST["desenvolvedora"];
$publicadora = $_POST["publicadora"];

$atualizarJogo = "UPDATE Jogos SET nome = '$nome', preco = '$preco', descricao = '$descricao' WHERE idJogo = '$idJogo'";
if(!$resultadoJogo = mysqli_query($conexao, $atualizarJogo)){
    $_SESSION["mensagem"] = "Falha ao Atualizar Jogo";
    Header("Location:./updateGame.php");
    die;
}

$publicarJogo = "UPDATE JogosPublicados SET idDesenvolvedora = '$desenvolvedora', idPublicadora = '$publicadora', idJogo = '$idJogo' WHERE idJogo = '$idJogo'";
$publicadoJogo = mysqli_query($conexao, $publicarJogo);

if(!$publicadoJogo){
    $_SESSION["mensagem"] = "Algo deu errado, Tente Novamente";
} else {
    $_SESSION["mensagem"] = "Jogo Atualizado com Sucesso";
} Header("Location:../store/index.php");

?>
