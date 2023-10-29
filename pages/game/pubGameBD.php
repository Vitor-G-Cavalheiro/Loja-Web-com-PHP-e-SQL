<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$desenvolvedora = $_POST["desenvolvedora"];
$publicadora = $_POST["publicadora"];
$categoria = $_POST["categoria"];
$foto = $_FILES['foto'];

$confirmacao = "SELECT * FROM Jogos";
$existe = mysqli_query($conexao, $confirmacao);
while($registro = mysqli_fetch_assoc($existe)){
    if($registro["nome"] == $nome){
        $_SESSION["mensagem"] = "Jogo já Existe";
        Header("Location:./pubGame.php");
        die;
    }
}

$adicionarJogo = "INSERT INTO jogos (nome, preco, descricao) values('$nome', '$preco', '$descricao')";
if(!$resultadoJogo = mysqli_query($conexao, $adicionarJogo)){
    $_SESSION["mensagem"] = "Falha ao Adicionar Jogo";
    Header("Location:./pubGame.php");
    die;
} else {
    $verificarJogo ="SELECT * FROM jogos";
    $acharJogo = mysqli_query($conexao, $verificarJogo);
    while($registroJogo = mysqli_fetch_assoc($acharJogo)){
        if($registroJogo["nome"] == $nome){
            $idJogo = $registroJogo["idJogo"];
        }
    }
}

$adicionarCategoriaJogo = "INSERT INTO categoriasjogos (idjogo, idCategoria) values ('$idJogo','$categoria')";
$resultadoCategoriaJogo = mysqli_query($conexao, $adicionarCategoriaJogo);

if(isset($foto)){
    $destino = '../../imgs/' . $_FILES['foto']['name'];
    $arquivo_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($arquivo_tmp, $destino);
    $comandoFoto = "INSERT INTO fotosJogos (idJogo, foto) values ('$idJogo', '$destino')";
    $resultadoFoto = mysqli_query($conexao, $comandoFoto);
}

$publicarJogo = "INSERT INTO jogosPublicados (idDesenvolvedora, idPublicadora, idJogo) values('$desenvolvedora','$publicadora','$idJogo')";
$publicadoJogo = mysqli_query($conexao, $publicarJogo);

if(!$publicadoJogo){
    $_SESSION["mensagem"] = "Algo deu errado, Tente Novamente";
} else {
    $_SESSION["mensagem"] = "Jogo Publicado com Sucesso";
} Header("Location:../../index.php");

?>
