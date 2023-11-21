<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$tema = require('../functions/themeVerification.php');
$message = require('../functions/message.php');

$idUsuario = $_SESSION["profile"];
$comando = "SELECT j.nome, j.preco, j.descricao, fj.foto, j.idJogo FROM Carrinho c INNER JOIN Jogos j ON c.idJogoPublicado = j.idJogo INNER JOIN FotosJogos fj ON fj.idJogo = j.idJogo WHERE c.idUsuario = $idUsuario AND fj.ordem = 1 ORDER BY c.idCarrinho DESC";
$resultado = mysqli_query($conexao, $comando);

$preco = 0;
$desconto = "00.00";

?>

<!DOCTYPE html>
<html lang="Pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="" href="../../imgs/StreetPlayLogo.jpeg">
    <link rel="stylesheet" href="../../css/main.css">
    <title>StreetPlay :: Carrinho</title>
</head>
<body class="<?=$tema?>">
    <!-- Cabeçalho -->
    <?php require('../components/header.php') ?>
    <!-- Sub Menu da Loja -->
    <?php require('../components/headerStore.php')?>
    <span class="cart-title text-color-<?=$tema?>">SEU CARRINHO</span>
    <session class="cart-session">
        <div>
            <?php while($registro = mysqli_fetch_assoc($resultado)):
            $preco = $registro["preco"] + $preco;?>
            <div class="cart-game back-<?=$tema?>">
                <a href="../store/gamePage.php?idJogo=<?=$registro["idJogo"]?>">
                    <img src="<?=$registro["foto"]?>">
                    <span class="text-color-<?=$tema?>"><?=$registro["nome"]?></span>
                </a>
                <div>
                    <span class="text-color-<?=$tema?>"><?=$registro["preco"]?></span>
                    <a class="hover-text-<?=$tema?>" href="./editCartGame.php?idJogo=<?=$registro["idJogo"]?>&idUsuario=<?=$_SESSION["profile"]?>&comprar=nao">Remover Jogo</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="cart-buy back-<?=$tema?>">
            <div class="cart-buy-price">
                <span class="text-color-<?=$tema?>">Resumo do Pedido</span>
                <span class="text-color-<?=$tema?>">Preço Total: R$<?=$preco?></span>
            </div>
            <!-- Desconto -->
            <?php if($desconto != 0):?>
            <div class="cart-buy-discount">
                <span>Seu Desconto: R$<?=$desconto?></span>
            </div>
            <?php endif;
            $total = $preco - $desconto;?>
            <!-- Total -->
            <div class="cart-buy-total">
                <span class="text-color-<?=$tema?>">Total: <span>R$<?=$total?></span></span>
            </div>
            <a href="">Finalizar Compra</a>
            <!-- Cartões Aceitos -->
        </div>
    </session>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>