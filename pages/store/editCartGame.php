<?php 

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

$idJogo = $_GET["idJogo"];
$idUsuario = $_GET["idUsuario"];
$comprar = $_GET["comprar"];

if($comprar == "sim"){
    $comando = "INSERT INTO carrinho (idUsuario, idJogoPublicado) VALUES ('$idUsuario','$idJogo')";
    $_SESSION["mensagem"] = "Jogo Adicionado ao Carrinho";
} elseif($comprar == "nao"){
    $comando = "DELETE FROM carrinho WHERE idUsuario = $idUsuario AND idJogoPublicado = $idJogo";
    $_SESSION["mensagem"] = "Jogo Removido do seu Carrinho";
}
$resultado = mysqli_query($conexao, $comando);
if(!$resultado){
    $_SESSION["mensagem"] = "Falha ao Gerenciar Carrinho";
}
Header("Location:./cartGames.php?idUsuario=$idUsuario");
?>