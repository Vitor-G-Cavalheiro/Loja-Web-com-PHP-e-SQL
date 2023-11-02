<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

$idUsuario = $_GET["idUsuario"];
$comando = "SELECT * FROM Usuarios WHERE idUsuario = $idUsuario";
$resultado = mysqli_query($conexao, $comando);
$registro = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="Pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <title>StreetPlay :: Perfil de <?=$registro["nome"]?></title>
</head>
<body>
    <?php require('../components/header.php') ?>
    <session>
        <div>
            <img src="<?=$registro["foto"]?>">
            <span><?=$registro["nome"]?></span>
            <span><?=$registro["descricao"]?></span>
            <?php if($idUsuario == $_SESSION["profile"]):?>
                <a href="./editProfileUser.php?idUsuario=<?=$idUsuario?>">Editar Perfil</a>
            <?php endif;?>
        </div>
    </session>
    <?php require('../components/footer.php') ?>
</body>
</html>