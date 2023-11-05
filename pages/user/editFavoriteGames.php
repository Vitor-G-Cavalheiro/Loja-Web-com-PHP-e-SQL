<?php 

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

$idJogo = $_GET["idJogo"];
$idUsuario = $_GET["idUsuario"];
$seguir = $_GET["seguir"];

if($seguir == "sim"){
    $comando = "INSERT INTO favoritos (idUsuario, idJogoPublicado) VALUES ('$idUsuario','$idJogo')";
    $_SESSION["mensagem"] = "Jogo Adicionado a Lista de Desejos";
    $link = "../store/gamePage.php?idJogo=$idJogo";
} elseif($seguir == "nao"){
    $comando = "DELETE FROM favoritos WHERE idUsuario = $idUsuario AND idJogoPublicado = $idJogo";
    $_SESSION["mensagem"] = "Jogo Removido da sua Lista de Desejos";
    if($_GET["pagina"] == "desejos"){
        $link = "./favoritesGames.php?idJogo=$idJogo&idUsuario=$idUsuario";
    }elseif($_GET["pagina"] == "jogo"){
        $link ="../store/gamePage.php?idJogo=$idJogo";
    }
}
$resultado = mysqli_query($conexao, $comando);
if(!$resultado){
    $_SESSION["mensagem"] = "Falha ao Gerenciar a Lista de Desejos";
}
Header("Location:$link");
?>