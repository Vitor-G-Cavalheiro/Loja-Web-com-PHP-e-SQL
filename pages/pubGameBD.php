<?php

$sessao = require('session.php');
$conexao = require('connection.php');


$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$desenvolvedora = $_POST["desenvolvedora"];
$publicadora = $_POST["publicadora"];
$fotos = isset($_FILES['foto']) ? $_FILES['foto'] : FALSE;

$confirmacao = "SELECT * FROM Jogos";
$existe = mysqli_query($conexao, $confirmacao);
while($registro = mysqli_fetch_assoc($existe)){
    if($registro["nome"] == $nome){
        $_SESSION["mensagem"] = "Jogo já Existe";
        Header("Location:pubGame.php");
        die;
    }
}

$adicionarJogo = "INSERT INTO jogos (nome, descricao) values('$nome','$descricao')";
if(!$resultadoJogo = mysqli_query($conexao, $adicionarJogo)){
    $_SESSION["mensagem"] = "Falha ao Adicionar Jogo";
    Header("Location:pubGame.php");
    die;
} else {
    $verificarJogo ="SELECT * FROM jogos";
    $acharJogo = mysqli_query($conexao, $verificarJogo);
    while($registroJogo = mysqli_fetch_assoc($acharJogo)){
        if($registroJogo["nome"] == '$nome'){
            $idJogo = $registroJogo["idJogo"];
        }
    }
}

for ($i = 0; $i < count($fotos['name']); $i++){
    $comandoFotos = "INSERT INTO fotosjogos (idJogo, foto) values($idJogo, $fotos['name'])";
    $resultadoFotos = mysqli_query($conexao, $comandoFotos);
}

$publicarJogo = "INSERT INTO jogosPublicados (idDesenvolvedora, idPublicadora, idJogo, idCategoria) values('$idDesenvolvedora','$idPublicadora','$idJogo','$idCategoria')";
?>