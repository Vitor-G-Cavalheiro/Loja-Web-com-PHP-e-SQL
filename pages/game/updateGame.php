<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$verificacao = require('../functions/userVerification.php');

if(isset($_SESSION["mensagem"])){
    echo $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
}

$idJogo = $_GET["idJogo"];
$comandoJogo = "SELECT * FROM jogos WHERE idJogo = $idJogo";
$resultadoJogo = mysqli_query($conexao, $comandoJogo);
$registroJogo = mysqli_fetch_assoc($resultadoJogo);

$comandoJogoPublicado = "SELECT * FROM jogosPublicados WHERE idJogo = $idJogo";
$resultadoJogoPublicado = mysqli_query($conexao, $comandoJogoPublicado);
$registroJogoPublicado = mysqli_fetch_assoc($resultadoJogoPublicado);

$comandoFotosJogo = "SELECT * FROM fotosjogos WHERE idJogo = $idJogo";
$resultadoFotosJogo = mysqli_query($conexao, $comandoFotosJogo);

$comandoDesenvolvedora = "SELECT * FROM Desenvolvedoras";
$comandoPublicadora = "SELECT * FROM Publicadoras";
$comandoCategoriaJogo = "SELECT * FROM CategoriasJogos INNER JOIN Categorias ON Categorias.idCategoria = CategoriasJogos.idCategoria WHERE idJogo = $idJogo";
$comandoCategoria = "SELECT * FROM Categorias";

$resultadoDesenvolvedora = mysqli_query($conexao, $comandoDesenvolvedora);
$resultadoPublicadora = mysqli_query($conexao, $comandoPublicadora);
$resultadoCategoriaJogo = mysqli_query($conexao, $comandoCategoriaJogo);
$resultadoCategoria = mysqli_query($conexao, $comandoCategoria);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css" type="text/css">
    <title>Atualizar Jogo</title>
</head>
<body>
    <?php require('../components/header.php') ?>
    <form action="./updateGameBD.php" method="post">
        <input name="idJogo" type="text" value="<?=$registroJogo["idJogo"]?>" hidden>
        <label for="nome">Nome: </label>
        <input name="nome" type="text" value="<?=$registroJogo["nome"]?>" required>
        <label for="preco">Preço: </label>
        <input type="number" name="preco" value="<?=$registroJogo["preco"]?>" step="0.01" required>
        <label for="descricao">Descrição: </label>
        <input type="text" name="descricao" value="<?=$registroJogo["descricao"]?>"required>
        <label for="desenvolvedora">Desenvolvedora: </label>
        <select name="desenvolvedora">
            <?php
            while($registroDesenvolvedora = mysqli_fetch_assoc($resultadoDesenvolvedora)){
                if($registroDesenvolvedora["idDesenvolvedora"] == $registroJogoPublicado["idDesenvolvedora"]){
                    echo "<option value='".$registroDesenvolvedora["idDesenvolvedora"]."' selected>".$registroDesenvolvedora["nome"]."</option>";
                } else {
                    echo "<option value='".$registroDesenvolvedora["idDesenvolvedora"]."'>".$registroDesenvolvedora["nome"]."</option>";
                }                
            }
            ?>
        </select>
        <label for="publicadora">Publicadora: </label>
        <select name="publicadora">
            <?php
            while($registroPublicadora = mysqli_fetch_assoc($resultadoPublicadora)){
                if($registroPublicadora["idPublicadora"] == $registroJogoPublicado["idPublicadora"]){
                    echo "<option value='".$registroPublicadora["idPublicadora"]."' selected>".$registroPublicadora["nome"]."</option>";
                } else {
                    echo "<option value='".$registroPublicadora["idPublicadora"]."'>".$registroPublicadora["nome"]."</option>";
                }
            }
            ?>
        </select>
        <!-- Gerenciar Categorias -->
        <div>
            <span>Categorias: </span>
            <?php
            while($registroCategoriaJogo = mysqli_fetch_assoc($resultadoCategoriaJogo)):?>
                <span><?=$registroCategoriaJogo["nome"]?></span>
                <a href="../category/editCategoryGame.php?idCategoria=<?=$registroCategoriaJogo["idCategoria"]?>&acao=rem&idJogo=<?=$idJogo?>">X</a>
            <?php endwhile;?>
            <button type="button" onclick="popAddCategoryGame('open')">+</button>
            <!-- Pop Up Adicionar Categoria -->
            <div class="pop-up">
                <button type="button" onclick="popAddCategoryGame('close')">X</button>
                <?php
                while($registroCategoria = mysqli_fetch_assoc($resultadoCategoria)):?>
                    <div>
                        <span><?=$registroCategoria["nome"]?></span><a href="../category/editCategoryGame.php?idCategoria=<?=$registroCategoria["idCategoria"]?>&acao=add&idJogo=<?=$idJogo?>">+</a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <button type="submit">Atualizar Jogo</button>
    </form>
    <!-- Gerenciar Imagens -->
    <div>
            <?php while($registroFotosJogo = mysqli_fetch_assoc($resultadoFotosJogo)):?>
            <div>
                <img src="<?=$registroFotosJogo["foto"]?>">
                <a href="./managePhotosGame.php?idFotoJogo=<?=$registroFotosJogo["idFotoJogo"]?>&idJogo=<?=$idJogo?>">Remover Foto</a>
            </div>
            <?php endwhile;?>
            <div>
                <form action="./managePhotosGame.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?=$idJogo?>" name="idJogo">
                    <label for="foto">
                    <input name="foto" type="file" required>
                    <button type="Submit">Adicionar Imagem</button>
                </form>
            </div>
        </div>      
    <?php require('../components/footer.php') ?>
</body>
<script src="../../js/index.js"></script>
</html>
