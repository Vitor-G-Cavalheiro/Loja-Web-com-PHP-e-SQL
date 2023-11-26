<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$contadorLimite = require('../functions/count.php');
$tema = require('../functions/themeVerification.php');

if(isset($_GET["inicio"])){
    $inicio = $_GET["inicio"];
} else {
    $inicio = 0;
}

if(isset($_GET["acao"])){
    $acao = $_GET["acao"];
} else {
    $acao = "mais";
}
if($acao == "mais"){
    $finalPagina = $inicio + 16;
} elseif($acao == "menos"){
    $finalPagina = $inicio;
    $inicio = $inicio - 16;
    if($inicio < 0){
        $inicio = 0;
        $finalPagina = $inicio + 16;
    }
}

if ($_GET["tipo"] == "Usuarios"){
    $tipo = "Usuarios";
    $limite = contarLimiteComunidade($tipo);
    $final = verificarLimiteInicio($inicio, $limite, "final");
    $inicio = verificarLimiteInicio($inicio, $limite, "inicio");
    $comando = "SELECT * FROM Usuarios ORDER BY nome DESC LIMIT $inicio, $final";
    $link = "../user/profileUser.php";
}elseif ($_GET["tipo"] == "Desenvolvedoras"){
    $tipo = "Desenvolvedoras";
    $limite = contarLimiteComunidade($tipo);
    $final = verificarLimiteInicio($inicio, $limite, "final");
    $inicio = verificarLimiteInicio($inicio, $limite, "inicio");
    $comando = "SELECT * FROM Desenvolvedoras ORDER BY nomeDev DESC LIMIT $inicio, $final";
    $link = "../dev&pub/profileDevPub.php";
}elseif ($_GET["tipo"] == "Publicadoras"){
    $tipo = "Publicadoras";
    $limite = contarLimiteComunidade($tipo);
    $final = verificarLimiteInicio($inicio, $limite, "final");
    $inicio = verificarLimiteInicio($inicio, $limite, "inicio");
    $comando = "SELECT * FROM Publicadoras ORDER BY nomePub DESC LIMIT $inicio, $final";
    $link = "../dev&pub/profileDevPub.php";
}

$finalPagina = correcaoFinalPagina($finalPagina, $inicio);

$resultadoProfiles = mysqli_query($conexao, $comando);

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
<body class="<?=$tema?>">
    <!-- Cabeçalho -->
    <?php require('../components/header.php') ?>
    <!-- Corpo da Página -->
    <session class="list-profiles">
        <?php while($registroProfiles = mysqli_fetch_assoc($resultadoProfiles)):
            if($tipo == "Usuarios"){
                $id = "?idUsuario=".$registroProfiles["idUsuario"];
                $nome = "nome";
            } elseif($tipo == "Desenvolvedoras"){
                $id = "?idDesenvolvedora=".$registroProfiles["idDesenvolvedora"];
                $nome = "nomeDev";
            } elseif($tipo == "Publicadoras"){
                $id = "?idPublicadora=".$registroProfiles["idPublicadora"];
                $nome = "nomePub";
            }?>
            <a class="card-game back-<?=$tema?>" href="<?=$link?><?=$id?>">
                <img class="card-game-img" src="<?=$registroProfiles["foto"]?>">
                <div class="card-game-content">
                    <span class="card-game-text"><?=$registroProfiles["$nome"]?></span>
                    <span class="card-game-text"><?=$registroProfiles["descricao"]?></span>
                </div>
            </a>
        <?php endwhile;?>
        <div class="div-link-pages">
            <a class="link-pages text-color-<?=$tema?> back-emphasys-<?=$tema?>" href="./listProfiles.php?inicio=<?=$inicio?>&acao=menos&tipo=<?=$tipo?>">Voltar Página</a> 
            <a class="link-pages text-color-<?=$tema?> back-emphasys-<?=$tema?>" href="./listProfiles.php?inicio=<?=$finalPagina?>&acao=mais&tipo=<?=$tipo?>">Próxima Página</a>
        </div>
    </session>
    <!-- Rodapé -->
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>