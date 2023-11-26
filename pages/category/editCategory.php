<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$tema = require('../functions/themeVerification.php');

if($_SESSION["user"] != "admin"){
    $_SESSION["mensagem"] = "Acesso negado";
    Header("Location:../store/index.php");
}

$messagem = require('../functions/message.php');

$idCategoria = $_GET["idCategoria"];
$comandoCategoria = "SELECT * FROM Categorias WHERE idCategoria = $idCategoria";
$resultadoCategoria = mysqli_query($conexao, $comandoCategoria);
$registroCategoria = mysqli_fetch_assoc($resultadoCategoria);

$comandoLista = "SELECT * FROM CategoriasJogos cj INNER JOIN Jogos j ON cj.idJogo = j.idJogo INNER JOIN FotosJogos fj ON j.idJogo = fj.idJogo WHERE idCategoria = $idCategoria AND fj.ordem = 1 ORDER BY RAND() LIMIT 8";
$resultadoLista = mysqli_query($conexao, $comandoLista);

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
    <link rel="stylesheet" href="../../css/main.css">
    <title>StreetPlay :: Editar Categoria</title>
</head>
<body class="<?=$tema?>">
    <?php require('../components/header.php') ?>
    <session class="category-session-edit">
        <!-- Atualizar ou Apagar Categoria -->
        <div>
            <span class="text-color-<?=$tema?>"><?=$registroCategoria["nome"]?></span>
            <form class="category-form-edit" action="editCategoryBD.php" method="post">
                <input type="text" name="idCategoria" value="<?=$registroCategoria["idCategoria"]?>" hidden>
                <label class="text-color-<?=$tema?>" for="nome">Novo Nome: </label>
                <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" name="nome" type="text" value="<?=$registroCategoria["nome"]?>" required>
                <button class="back-search-<?=$tema?> standard-<?=$tema?> text-color-<?=$tema?>" type="submit">Atualizar Nome</button>
            </form>
            <a class="hover-text-<?=$tema?>" href="./editCategoryBD.php?idCategoria=<?=$registroCategoria["idCategoria"]?>">Deletar Categoria</a>
        </div>
        <!-- Lista com Jogos dessa Categoria -->
        <div>
            <span class="text-color-<?=$tema?>">Jogos que Pertencem a essa Categoria: </span>
            <div class="category-card-game">
                <?php while($registroLista = mysqli_fetch_assoc($resultadoLista)):?>
                <div class="back-<?=$tema?>">
                    <img src="<?=$registroLista["foto"]?>">
                    <span class="text-color-<?=$tema?>"><?=$registroLista["nome"]?></span>
                    <span class="text-color-<?=$tema?>"><?=$registroLista["descricao"]?></span>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </session>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>