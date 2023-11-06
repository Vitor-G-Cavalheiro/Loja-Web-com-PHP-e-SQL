<?php 

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$message = require('../functions/message.php');

$comandoUsuarios = "SELECT * FROM Usuarios LIMIT 12";
$comandoDesenvolvedoras = "SELECT * FROM Desenvolvedoras LIMIT 12";
$comandoPublicadoras = "SELECT * FROM Publicadoras LIMIT 12";

$resultadoUsuarios = mysqli_query($conexao, $comandoUsuarios);
$resultadoDesenvolvedoras = mysqli_query($conexao, $comandoDesenvolvedoras);
$resultadoPublicadoras = mysqli_query($conexao, $comandoPublicadoras);

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
    <title>Comunidade StreetPlay</title>
</head>
<body>
    <!-- Cabeçalho -->
    <?php require('../components/header.php') ?>
    <session>
        <!-- Lista Usuários -->
        <div>
            <span>Usuários: </span>
            <?php while($registroUsuarios = mysqli_fetch_assoc($resultadoUsuarios)):?>
                <a href="../user/profileUser.php?idUsuario=<?=$registroUsuarios["idUsuario"]?>">
                    <div>
                        <img src="<?=$registroUsuarios["foto"]?>">
                        <span><?=$registroUsuarios["nome"]?></span>
                        <?php if($_SESSION["user"] == "admin"):?>
                        <a href="../user/editProfileUser.php?idUsuario=<?=$registroUsuarios["idUsuario"]?>">Editar Perfil</a>
                        <a href="../user/editProfileUserBD.php?delete=sim&idUsuario=<?=$registroUsuarios["idUsuario"]?>">Deletar Perfil</a>
                        <?php endif;?>
                    </div>
                </a>
            <?php endwhile;?>
            <a href="./listProfiles.php?inicio=0&acao=mais&tipo=Usuarios">Ver Mais Usuários</a>
        </div>
        <!-- Lista Desenvolvedoras -->
        <div>
            <span>Desenvolvedoras: </span>
            <?php while($registroDesenvolvedoras = mysqli_fetch_assoc($resultadoDesenvolvedoras)):?>
                <a href="../dev&pub/profileDevPub.php?idDesenvolvedora=<?=$registroDesenvolvedoras["idDesenvolvedora"]?>">
                    <div>
                        <img src="<?=$registroDesenvolvedoras["foto"]?>">
                        <span><?=$registroDesenvolvedoras["nomeDev"]?></span>
                        <?php if($_SESSION["user"] == "admin"):?>
                        <a href="../dev&pub/editProfileDevPub.php?idDesenvolvedora=<?=$registroDesenvolvedoras["idDesenvolvedora"]?>">Editar Página</a>
                        <a href="./editProfileDevPubBD.php?delete=sim&idDesenvolvedora=<?=$registroDesenvolvedoras["idDesenvolvedora"]?>">Deletar Página</a>
                        <?php endif;?>
                    </div>
                </a>
            <?php endwhile;?>
            <a href="./listProfiles.php?inicio=0&acao=mais&tipo=Desenvolvedoras">Ver Mais Desenvolvedoras</a>
        </div>
        <!-- Lista Publicadoras -->
        <div>
            <span>Publicadoras: </span>
            <?php while($registroPublicadoras = mysqli_fetch_assoc($resultadoPublicadoras)):?>
                <a href="../dev&pub/profileDevPub.php?idPublicadora=<?=$registroPublicadoras["idPublicadora"]?>">
                    <div>
                        <img src="<?=$registroPublicadoras["foto"]?>">
                        <span><?=$registroPublicadoras["nomePub"]?></span>
                        <?php if($_SESSION["user"] == "admin"):?>
                        <a href="../dev&pub/editProfileDevPub.php?idPublicadora=<?=$registroPublicadoras["idPublicadora"]?>">Editar Página</a>
                        <a href="./editProfileDevPubBD.php?delete=sim&idPublicadora=<?=$registroPublicadoras["idPublicadora"]?>">Deletar Página</a>
                        <?php endif;?>
                    </div>
                </a>
            <?php endwhile;?>
            <a href="./listProfiles.php?inicio=0&acao=mais&tipo=Publicadoras">Ver Mais Publicadoras</a>
        </div>
    </session>
    <!-- Rodapé -->
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>