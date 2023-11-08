<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

if($_SESSION["user"] != "admin"){
    $_SESSION["mensagem"] = "Acesso negado";
    Header("Location:../store/index.php");
}

$messagem = require('../functions/message.php');

$idCategoria = $_GET["idCategoria"];
$comandoCategoria = "SELECT * FROM Categorias WHERE idCategoria = $idCategoria";
$resultadoCategoria = mysqli_query($conexao, $comandoCategoria);
$registroCategoria = mysqli_fetch_assoc($resultadoCategoria);

$comandoLista = "SELECT * FROM CategoriasJogos cj INNER JOIN Jogos j ON cj.idJogo = j.idJogo INNER JOIN FotosJogos fj ON j.idJogo = fj.idJogo WHERE idCategoria = $idCategoria";
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
<body>
    <?php require('../components/header.php') ?>
    <!-- Atualizar ou Apagar Categoria -->
    <div>
        <span><?=$registroCategoria["nome"]?></span>
        <form action="editCategoryBD.php" method="post">
            <input type="text" name="idCategoria" value="<?=$registroCategoria["idCategoria"]?>" hidden>
            <label for="nome">Novo Nome: </label>
            <input name="nome" type="text" value="<?=$registroCategoria["nome"]?>" required>
            <button type="submit">Atualizar Nome</button>
        </form>
        <a href="./editCategoryBD.php?idCategoria=<?=$registroCategoria["idCategoria"]?>">Deletar Categoria</a>
    </div>
    <!-- Lista com Jogos dessa Categoria -->
    <div>
        <span>Jogos que Pertencem a essa Categoria</span>
        <?php while($registroLista = mysqli_fetch_assoc($resultadoLista)):?>
            <div>
                <img src="<?=$registroLista["foto"]?>">
                <span><?=$registroLista["nome"]?></span>
            </div>
        <?php endwhile; ?>
    </div>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>