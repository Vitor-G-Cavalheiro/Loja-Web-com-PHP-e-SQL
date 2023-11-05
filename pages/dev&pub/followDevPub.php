<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

$idUsuario = $_GET["idUsuario"];
$seguir = $_GET["seguir"];

if(isset($_GET["idDesenvolvedora"])){
    $idDevPub = $_GET["idDesenvolvedora"];
    $nomeColuna = "idDesenvolvedora";
} elseif (isset($_GET["idPublicadora"])){
    $idDevPub = $_GET["idPublicadora"];
    $nomeColuna = "idPublicadora";
}

if($seguir == "sim"){
    $comando = "INSERT INTO Seguindo (idUsuario, $nomeColuna) VALUES ('$idUsuario','$idDevPub')";
} elseif($seguir == "nao"){
    $comando = "DELETE FROM Seguindo WHERE idUsuario = '$idUsuario' AND $nomeColuna = '$idDevPub'";
}
$resultado = mysqli_query($conexao, $comando);
if(!$resultado){
    $_SESSION["mensagem"] = "Erro ao Seguir Perfil";
}
Header("Location:./profileDevPub.php?$nomeColuna=$idDevPub");


?>