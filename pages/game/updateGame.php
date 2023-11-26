<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$verificacao = require('../functions/userVerification.php');
$tema = require('../functions/themeVerification.php');
$messagem = require('../functions/message.php');

$idJogo = $_GET["idJogo"];
$comandoJogo = "SELECT * FROM Jogos WHERE idJogo = $idJogo";
$resultadoJogo = mysqli_query($conexao, $comandoJogo);
$registroJogo = mysqli_fetch_assoc($resultadoJogo);

$comandoJogoPublicado = "SELECT * FROM JogosPublicados WHERE idJogo = $idJogo";
$resultadoJogoPublicado = mysqli_query($conexao, $comandoJogoPublicado);
$registroJogoPublicado = mysqli_fetch_assoc($resultadoJogoPublicado);

$comandoFotosJogo = "SELECT * FROM FotosJogos WHERE idJogo = $idJogo ORDER BY ordem";
$resultadoFotosJogo = mysqli_query($conexao, $comandoFotosJogo);

$comandoDesenvolvedora = "SELECT * FROM Desenvolvedoras";
$comandoPublicadora = "SELECT * FROM Publicadoras";
$comandoCategoriaJogo = "SELECT * FROM CategoriasJogos INNER JOIN Categorias ON Categorias.idCategoria = CategoriasJogos.idCategoria WHERE idJogo = $idJogo ORDER BY nome";
$comandoCategoria = "SELECT * FROM Categorias ORDER BY nome";

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="" href="../../imgs/StreetPlayLogo.jpeg">
    <link rel="stylesheet" href="../../css/main.css" type="text/css">
    <title>StreetPlay :: Atualizar Jogo</title>
</head>
<body class="<?=$tema?>">
    <?php require('../components/header.php') ?>
    <session class="pub-game-session edit-game-session">
        <form class="back-<?=$tema?>" action="./updateGameBD.php" method="post">
            <span class="text-emphasys-<?=$tema?>">ATUALZIAR JOGO</span>
            <input name="idJogo" type="text" value="<?=$registroJogo["idJogo"]?>" hidden>
            <label class="text-color-<?=$tema?>" for="nome">Nome: </label>
            <input class="text-color-<?=$tema?> back-emphasys-<?=$tema?>" name="nome" type="text" value="<?=$registroJogo["nome"]?>" required>
            <label class="text-color-<?=$tema?>" for="preco">Preço: </label>
            <input class="text-color-<?=$tema?> back-emphasys-<?=$tema?>" type="number" name="preco" value="<?=$registroJogo["preco"]?>" step="0.01" required>
            <label class="text-color-<?=$tema?>" for="descricao">Descrição: </label>
            <input class="text-color-<?=$tema?> back-emphasys-<?=$tema?>" type="text" name="descricao" value="<?=$registroJogo["descricao"]?>"required>
            <label class="text-color-<?=$tema?>" for="desenvolvedora">Desenvolvedora: </label>
            <select class="text-color-<?=$tema?> back-emphasys-<?=$tema?>" name="desenvolvedora">
                <?php
                while($registroDesenvolvedora = mysqli_fetch_assoc($resultadoDesenvolvedora)){
                    if($registroDesenvolvedora["idDesenvolvedora"] == $registroJogoPublicado["idDesenvolvedora"]){
                        echo "<option value='".$registroDesenvolvedora["idDesenvolvedora"]."' selected>".$registroDesenvolvedora["nomeDev"]."</option>";
                    } else {
                        echo "<option value='".$registroDesenvolvedora["idDesenvolvedora"]."'>".$registroDesenvolvedora["nomeDev"]."</option>";
                    }                
                }
                ?>
            </select>
            <label class="text-color-<?=$tema?>" for="publicadora">Publicadora: </label>
            <select class="text-color-<?=$tema?> back-emphasys-<?=$tema?>" name="publicadora">
                <?php
                while($registroPublicadora = mysqli_fetch_assoc($resultadoPublicadora)){
                    if($registroPublicadora["idPublicadora"] == $registroJogoPublicado["idPublicadora"]){
                        echo "<option value='".$registroPublicadora["idPublicadora"]."' selected>".$registroPublicadora["nomePub"]."</option>";
                    } else {
                        echo "<option value='".$registroPublicadora["idPublicadora"]."'>".$registroPublicadora["nomePub"]."</option>";
                    }
                }
                ?>
            </select>
            <!-- Gerenciar Categorias -->
            <div class="category-game-edit">
                <span class="text-color-<?=$tema?>">Categorias: </span>
                <?php
                while($registroCategoriaJogo = mysqli_fetch_assoc($resultadoCategoriaJogo)):?>
                <div class="contrast-<?=$tema?>">
                    <span class="text-color-<?=$tema?>"><?=$registroCategoriaJogo["nome"]?></span>
                    <a class="text-color-<?=$tema?>" href="../category/editCategoryGame.php?idCategoria=<?=$registroCategoriaJogo["idCategoria"]?>&acao=rem&idJogo=<?=$idJogo?>">X</a>
                </div>
                <?php endwhile;?>
                <button class="buttons-edit-game contrast-<?=$tema?> text-color-<?=$tema?> plus-category" type="button" onclick="popUpCat('open')">+</button>
                <button class="buttons-edit-game contrast-<?=$tema?> text-color-<?=$tema?> close-category" type="button" onclick="popUpCat('close')">X</button>
                <!-- Pop Up Adicionar Categoria -->
                <div class="pop-up back-<?=$tema?>">
                    <?php
                    while($registroCategoria = mysqli_fetch_assoc($resultadoCategoria)):?>
                        <div class="contrast-<?=$tema?>">
                            <span class="text-color-<?=$tema?>"><?=$registroCategoria["nome"]?></span><a class="text-color-<?=$tema?>" href="../category/editCategoryGame.php?idCategoria=<?=$registroCategoria["idCategoria"]?>&acao=add&idJogo=<?=$idJogo?>">+</a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <button class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="submit">Atualizar Jogo</button>
        </form>
        <!-- Gerenciar Imagens -->
        <div class="back-<?=$tema?> edit-img-game">
            <span class="text-emphasys-<?=$tema?>">ATUALIZAR FOTOS</span>
            <?php while($registroFotosJogo = mysqli_fetch_assoc($resultadoFotosJogo)):?>
            <div>
                <img src="<?=$registroFotosJogo["foto"]?>">
                <a class="hover-text-<?=$tema?>" href="./managePhotosGame.php?idFotoJogo=<?=$registroFotosJogo["idFotoJogo"]?>&idJogo=<?=$idJogo?>&acao=capa">Transformar na Capa</a>
                <a class="hover-text-<?=$tema?>" href="./managePhotosGame.php?idFotoJogo=<?=$registroFotosJogo["idFotoJogo"]?>&idJogo=<?=$idJogo?>&acao=rem">Remover Foto</a>
            </div>
            <?php endwhile;?>
            <div class="add-img-game">
                <form action="./managePhotosGame.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?=$idJogo?>" name="idJogo">
                    <input class="text-color-<?=$tema?>" name="foto" type="file" required>
                    <button class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="Submit">Adicionar Imagem</button>
                </form>
            </div>
        </div> 
    </session>     
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>
