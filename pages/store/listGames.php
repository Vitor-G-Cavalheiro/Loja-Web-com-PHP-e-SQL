<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

$inicio = $_GET["inicio"];
if($_GET["acao"] == "mais"){
    $final = $inicio + 16;
} elseif($_GET["acao"] == "menos"){
    $final = $inicio;
    $inicio = $inicio - 16;
}

if (isset($_GET["idCategoria"])){
    $idModificador = $_GET["idCategoria"];
    $modificador = "idCategoria";
    $comando = "SELECT j.nome, fj.foto, j.preco, j.descricao, j.idJogo, fj.ordem FROM Jogos j INNER JOIN FotosJogos fj ON fj.idJogo = j.idJogo INNER JOIN CategoriasJogos cj ON j.idJogo = cj.idJogo WHERE cj.idCategoria = '$idModificador' AND fj.ordem = 1 ORDER BY j.idJogo DESC LIMIT $inicio, $final";
}elseif (isset($_GET["idDesenvolvedora"])){
    $idModificador = $_GET["idDesenvolvedora"];
    $modificador = "idDesenvolvedora";
    $comando = "SELECT j.nome, fj.foto, j.preco, j.descricao, j.idJogo, fj.ordem FROM JogosPublicados jp INNER JOIN Jogos j ON jp.idJogo = j.idJogo INNER JOIN FotosJogos fj ON fj.idJogo = j.idJogo INNER JOIN Desenvolvedoras d ON jp.idDesenvolvedora = d.idDesenvolvedora WHERE jp.idDesenvolvedora = '$idModificador' AND fj.ordem = 1 ORDER BY j.idJogo DESC LIMIT $inicio, $final";
}elseif (isset($_GET["idPublicadora"])){
    $idModificador = $_GET["idPublicadora"];
    $modificador = "idPublicadora";
    $comando = "SELECT j.nome, fj.foto, j.preco, j.descricao, j.idJogo, fj.ordem FROM JogosPublicados jp INNER JOIN Jogos j ON jp.idJogo = j.idJogo INNER JOIN FotosJogos fj ON fj.idJogo = j.idJogo INNER JOIN Publicadoras p ON jp.idPublicadora = p.idPublicadora WHERE jp.idPublicadora = '$idModificador' AND fj.ordem = 1 ORDER BY j.idJogo DESC LIMIT $inicio, $final";
}elseif (isset($_GET["modificador"])) {
    $comando = "SELECT j.nome, fj.foto, j.preco, j.descricao, j.idJogo, fj.ordem FROM Jogos j INNER JOIN FotosJogos fj ON fj.idJogo = j.idJogo AND fj.ordem = 1 ORDER BY j.idJogo DESC LIMIT $inicio, $final";
    $idModificador = "nao";
    $modificador = "modificador";
}

$resultadoJogos = mysqli_query($conexao, $comando);

//Categorias
$comandoCategorias = "SELECT * FROM Categorias ORDER BY nome LIMIT 32";
$resultadoCategorias = mysqli_query($conexao, $comandoCategorias);

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
    <title>Bem-vindo(a) ao StreetPlay</title>
</head>
<body>
    <!-- Cabeçalho -->
    <?php require('../components/header.php') ?>
    <session>
        <!-- Corpo da Página -->
        <div class="body-page">
            <div class="body-category">
                <span>Categorias</span>
                <?php while($registroCategorias = mysqli_fetch_assoc($resultadoCategorias)):?>
                    <a href="./listGames.php?inicio=0&acao=mais&idCategoria=<?=$registroCategorias["idCategoria"]?>"><?=$registroCategorias["nome"]?></a>
                <?php endwhile; ?>
            </div>
            <div class="body-games">
                <?php while($registroJogos = mysqli_fetch_assoc($resultadoJogos)):?>
                    <a class="card-game" href="./gamePage.php?idJogo=<?=$registroJogos["idJogo"]?>">
                        <img class="card-game-img" src="<?=$registroJogos["foto"]?>">
                        <div class="card-game-content">
                            <span class="card-game-text"><?=$registroJogos["nome"]?></span>
                            <span class="card-game-text"><?=$registroJogos["descricao"]?></span>
                            <span class="card-game-price"><?=$registroJogos["preco"]?></span>
                        </div>
                    </a>
                <?php endwhile;?>
                <a href="./listGames.php?inicio=<?=$inicio?>&acao=menos&<?=$modificador?>=<?=$idModificador?>">Voltar Página</a> 
                <a href="./listGames.php?inicio=<?=$final?>&acao=mais&<?=$modificador?>=<?=$idModificador?>">Próxima Página</a>
            </div>
        </div>
    </session>
    <!-- Rodapé -->
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>