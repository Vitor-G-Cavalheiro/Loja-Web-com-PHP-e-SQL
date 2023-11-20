<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$tema = require('../functions/themeVerification.php');

$inicio = $_GET["inicio"];
if($_GET["acao"] == "mais"){
    $final = $inicio + 16;
} elseif($_GET["acao"] == "menos"){
    $final = $inicio;
    $inicio = $inicio - 16;
    if($inicio < 0){
        $inicio = 0;
        $final = $inicio + 16;
    }
}

if ($_GET["tipo"] == "Usuarios"){
    $tipo = "Usuarios";
    $comando = "SELECT * FROM Usuarios ORDER BY nome DESC LIMIT $inicio, $final";
    $link = "../user/profileUser.php";
}elseif ($_GET["tipo"] == "Desenvolvedoras"){
    $tipo = "Desenvolvedoras";
    $comando = "SELECT * FROM Desenvolvedoras ORDER BY nomeDev DESC LIMIT $inicio, $final";
    $link = "../dev&pub/profileDevPub.php";
}elseif ($_GET["tipo"] == "Publicadoras"){
    $tipo = "Publicadoras";
    $comando = "SELECT * FROM Publicadoras ORDER BY nomePub DESC LIMIT $inicio, $final";
    $link = "../dev&pub/profileDevPub.php";
}

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
    <session>
        <!-- Corpo da Página -->
        <div>
            <div>
                <?php while($registroProfiles = mysqli_fetch_assoc($resultadoProfiles)):
                    if($tipo == "Usuarios"){
                        $id = "?idUsuario=".$registroProfiles["idUsuario"];
                        $nome = "nome";
                    } elseif($tipo == "desenvolvedoras"){
                        $id = "?idDesenvolvedora=".$registroProfiles["idDesenvolvedora"];
                        $nome = "nomeDev";
                    } elseif($tipo == "publicadoras"){
                        $id = "?idPublicadora=".$registroProfiles["idPublicadora"];
                        $nome = "nomePub";
                    }?>
                    <a class="card-game" href="<?=$link?><?=$id?>">
                        <img class="card-game-img" src="<?=$registroProfiles["foto"]?>">
                        <div class="card-game-content">
                            <span class="card-game-text"><?=$registroProfiles["$nome"]?></span>
                            <span class="card-game-text"><?=$registroProfiles["descricao"]?></span>
                        </div>
                    </a>
                <?php endwhile;?>
                <a href="./listProfiles.php?inicio=<?=$inicio?>&acao=menos&tipo=<?=$tipo?>">Voltar Página</a> 
                <a href="./listProfiles.php?inicio=<?=$final?>&acao=mais&tipo=<?=$tipo?>">Próxima Página</a>
            </div>
        </div>
    </session>
    <!-- Rodapé -->
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>