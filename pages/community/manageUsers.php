<?php 

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$tema = require('../functions/themeVerification.php');
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
<body class="<?=$tema?>">
    <!-- Cabeçalho -->
    <?php require('../components/header.php') ?>
    <session class="community-session">
        <!-- Lista Usuários -->
        <div>
            <span class="text-color-<?=$tema?>">Usuários: </span>
            <?php while($registroUsuarios = mysqli_fetch_assoc($resultadoUsuarios)):?>
                <div class="community-list back-<?=$tema?>">
                    <a href="../user/profileUser.php?idUsuario=<?=$registroUsuarios["idUsuario"]?>">
                        <img src="<?=$registroUsuarios["foto"]?>">
                        <span class="text-color-<?=$tema?>"><?=$registroUsuarios["nome"]?></span>
                        <span class="text-color-<?=$tema?>"><?=$registroUsuarios["descricao"]?></span>
                    </a>
                    <?php if($_SESSION["user"] == "admin"):?>
                    <div>
                        <a class="hover-text-<?=$tema?>" href="../user/editProfileUser.php?idUsuario=<?=$registroUsuarios["idUsuario"]?>">Editar Perfil</a>
                        <a class="hover-text-<?=$tema?>" href="../user/editProfileUserBD.php?delete=sim&idUsuario=<?=$registroUsuarios["idUsuario"]?>">Deletar Perfil</a>
                    </div>
                    <?php endif;?>
                </div>
            <?php endwhile;?>
            <a class="hover-text-<?=$tema?>" href="./listProfiles.php?inicio=0&acao=mais&tipo=Usuarios">Ver Mais Usuários</a>
        </div>
        <!-- Lista Desenvolvedoras -->
        <div>
            <span class="text-color-<?=$tema?>">Desenvolvedoras: </span>
            <?php while($registroDesenvolvedoras = mysqli_fetch_assoc($resultadoDesenvolvedoras)):?>
                <div class="community-list back-<?=$tema?>">
                    <a href="../devPub/profileDevPub.php?idDesenvolvedora=<?=$registroDesenvolvedoras["idDesenvolvedora"]?>">
                        <img src="<?=$registroDesenvolvedoras["foto"]?>">
                        <span class="text-color-<?=$tema?>"><?=$registroDesenvolvedoras["nomeDev"]?></span>
                        <span class="text-color-<?=$tema?>"><?=$registroDesenvolvedoras["descricao"]?></span>
                    </a>
                    <?php if($_SESSION["user"] == "admin"):?>
                    <div>
                        <a class="hover-text-<?=$tema?>" href="../devPub/editProfileDevPub.php?idDesenvolvedora=<?=$registroDesenvolvedoras["idDesenvolvedora"]?>">Editar Página</a>
                        <a class="hover-text-<?=$tema?>" href="./editProfileDevPubBD.php?delete=sim&idDesenvolvedora=<?=$registroDesenvolvedoras["idDesenvolvedora"]?>">Deletar Página</a>
                    </div>
                    <?php endif;?>
                </div>
            <?php endwhile;?>
            <a class="hover-text-<?=$tema?>" href="./listProfiles.php?inicio=0&acao=mais&tipo=Desenvolvedoras">Ver Mais Desenvolvedoras</a>
        </div>
        <!-- Lista Publicadoras -->
        <div>
            <span class="text-color-<?=$tema?>">Publicadoras: </span>
            <?php while($registroPublicadoras = mysqli_fetch_assoc($resultadoPublicadoras)):?>
                <div class="community-list back-<?=$tema?>">
                    <a href="../devPub/profileDevPub.php?idPublicadora=<?=$registroPublicadoras["idPublicadora"]?>">
                        <img src="<?=$registroPublicadoras["foto"]?>">
                        <span class="text-color-<?=$tema?>"><?=$registroPublicadoras["nomePub"]?></span>
                        <span class="text-color-<?=$tema?>"><?=$registroPublicadoras["descricao"]?></span>
                    </a>
                    <?php if($_SESSION["user"] == "admin"):?>
                    <div>
                        <a class="hover-text-<?=$tema?>" href="../devPub/editProfileDevPub.php?idPublicadora=<?=$registroPublicadoras["idPublicadora"]?>">Editar Página</a>
                        <a class="hover-text-<?=$tema?>" href="./editProfileDevPubBD.php?delete=sim&idPublicadora=<?=$registroPublicadoras["idPublicadora"]?>">Deletar Página</a>
                    </div>
                    <?php endif;?>
                </div>
            <?php endwhile;?>
            <a class="hover-text-<?=$tema?>" href="./listProfiles.php?inicio=0&acao=mais&tipo=Publicadoras">Ver Mais Publicadoras</a>
        </div>
    </session>
    <!-- Rodapé -->
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>