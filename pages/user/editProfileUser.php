<?php 

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');
$tema = require('../functions/themeVerification.php');
$messagem = require('../functions/message.php');

$idUsuario = $_GET["idUsuario"];
$comando = "SELECT * FROM Usuarios WHERE idUsuario = $idUsuario";
$resultado = mysqli_query($conexao, $comando);
$registro = mysqli_fetch_assoc($resultado);

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
    <title>StreetPlay :: Editar Perfil de Usuário</title>
</head>
<body class="<?=$tema?>">
    <?php require('../components/header.php') ?>
    <session class="profile-edit-session">
        <!-- Menu Lateral -->
        <div class="profile-menu">
            <input class="text-color-<?=$tema?>" type="radio" name="menu-edit-user" onclick="divEditActive(0)" value="perfil" checked>
            <label class="text-color-<?=$tema?>" for="perfil">Perfil Público</label>
            <input class="text-color-<?=$tema?>" type="radio" name="menu-edit-user" onclick="divEditActive(1)" value="senha">
            <label class="text-color-<?=$tema?>" for="senha">Alterar Senha</label>
            <input class="text-color-<?=$tema?>" type="radio" name="menu-edit-user" onclick="divEditActive(2)" value="email">
            <label class="text-color-<?=$tema?>" for="email">Verificar Email</label>
            <input class="text-color-<?=$tema?>" type="radio" name="menu-edit-user" onclick="divEditActive(3)" value="aparencia">
            <label class="text-color-<?=$tema?>" for="email">Configurar Aparência</label>
            <input class="text-color-<?=$tema?>" type="radio" name="menu-edit-user" onclick="divEditActive(4)" value="apagar">
            <label class="text-color-<?=$tema?>" for="email">Apagar Conta</label>
        </div>
        <!-- Perfil Público -->
        <div class="div-edit-user back-<?=$tema?>">
            <span class="text-emphasys-<?=$tema?>">Atualizar Perfil Público</span>
            <form action="./editProfileUserBD.php" method="post" enctype="multipart/form-data">
                <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="text" name="idUsuario" value="<?=$idUsuario?>" hidden>
                <label class="text-color-<?=$tema?>" for="nome">Nome: </label>
                <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" name="nome" type="text" value="<?=$registro["nome"]?>" required>
                <label class="text-color-<?=$tema?>" for="descricao">Descrição: </label>
                <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" name="descricao" type="text" value="<?=$registro["descricao"]?>">
                <label class="text-color-<?=$tema?>" for="foto">Foto de Perfil: </label>
                <input class="text-color-<?=$tema?>" type="file" name="foto">
                <button class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="submit">Salvar Alterações</button>
            </form>
        </div>
        <!-- Atualizar Senha -->
        <div class="div-edit-user back-<?=$tema?> invisible">
            <span class="text-emphasys-<?=$tema?>">Atualizar Senha</span>
            <form action="./editProfileUserBD.php" method="post">
                <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="text" name="idUsuario" value="<?=$idUsuario?>" hidden>
                <label class="text-color-<?=$tema?>" for="senha">Senha: </label>
                <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" name="senha" type="password" maxlength="8" required>
                <label class="text-color-<?=$tema?>" for="confSenha">Confirme sua Senha: </label>
                <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" name="confSenha" type="password" maxlength="8" required>
                <button class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="submit">Salvar Alterações</button>
            </form>
        </div>
        <!-- Verificar Email -->
        <div class="div-edit-user back-<?=$tema?> invisible">
            <span class="text-emphasys-<?=$tema?>">Verificação de Email - EM BREVE</span>
        </div>
        <!-- Configurações da Conta -->
        <div class="div-edit-user back-<?=$tema?> invisible">
            <span class="text-emphasys-<?=$tema?>">Cor Tema:</span>
            <form action="./editProfileUserBD.php" method="post">
                <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="text" name="idUsuario" value="<?=$idUsuario?>" hidden>
                <div class="edit-themes">
                    <label class="text-color-<?=$tema?>" for="classic">Clássico: </label>
                    <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="radio" name="tema" value="classic">
                </div>
                <div class="edit-themes">   
                    <label class="text-color-<?=$tema?>" for="dark">Escuro: </label>
                    <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="radio" name="tema" value="dark">
                </div>
                <div class="edit-themes">
                    <label class="text-color-<?=$tema?>" for="light">Claro: </label>
                    <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="radio" name="tema" value="light">
                </div>
                <button class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="submit">Salvar Alterações</button>
            </form>
        </div>
        <!-- Excluir Conta -->
        <div class="div-edit-user back-<?=$tema?> invisible">
            <span class="text-emphasys-<?=$tema?>">Apagar Conta</span>
            <button class="delete-profile back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="button" onclick="popUpGen('open')">Excluir Conta</button>
            <div class="pop-up delete-pop-up back-emphasys-<?=$tema?> text-color-<?=$tema?>">
                <span>Tem Certeza Que Deseja Excluir Sua Conta?</span>
                <div>
                    <a class="hover-text-<?=$tema?>" href="./editProfileUserBD.php?delete=sim&idUsuario=<?=$idUsuario?>">Sim</a>
                    <button class="back-emphasys-<?=$tema?> hover-text-<?=$tema?>" type="button" onclick="popUpGen('close')">Não</button>
                </div>
            </div>
        </div>
    </session>
    <?php require('../components/footer.php') ?>
    <script src="../../js/index.js"></script>
</body>
</html>