<?php

$sessao = require('session.php');
$conexao = require('connection.php');

$idJogo = $_POST["idJogo"];
$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$desenvolvedora = $_POST["desenvolvedora"];
$publicadora = $_POST["publicadora"];
$categoria = $_POST["categoria"];
$foto = isset($_FILES['foto']) ? $_FILES['foto'] : FALSE;

$atualizarJogo = "UPDATE jogos SET nome = '$nome', descricao = '$descricao' WHERE idJogo = '$idJogo'";
if(!$resultadoJogo = mysqli_query($conexao, $atualizarJogo)){
    $_SESSION["mensagem"] = "Falha ao Atualizar Jogo";
    Header("Location:updateGame.php");
    die;
}

if(isset($foto)){
    $destino = '../imgs/' . $_FILES['foto']['name'];
    $arquivo_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($arquivo_tmp, $destino);
    $comandoFoto = "INSERT INTO fotosJogos (idJogo, foto) values ('$idJogo', '$destino')";
    $resultadoFoto = mysqli_query($conexao, $comandoFoto);
}

$publicarJogo = "UPDATE jogosPublicados SET idDesenvolvedora = '$desenvolvedora', idPublicadora = '$publicadora', idJogo = '$idJogo', idCategoria = '$categoria' WHERE idJogo = '$idJogo'";
$publicadoJogo = mysqli_query($conexao, $publicarJogo);

if(!$publicadoJogo){
    $_SESSION["mensagem"] = "Algo deu errado, Tente Novamente";
} else {
    $_SESSION["mensagem"] = "Jogo Atualizado com Sucesso";
    Header("Location:../indexAdmin.php");
}

?>