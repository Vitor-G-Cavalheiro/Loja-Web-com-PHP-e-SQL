<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

if($_SESSION["user"] != "admin"){
    $_SESSION["mensagem"] = "Acesso negado";
    Header("Location:../../index.php");
}

$messagem = require('../functions/message.php');

$comandoCategoria = "SELECT * FROM categorias";
$resultadoCategoria = mysqli_query($conexao, $comandoCategoria);

if(isset($_POST["categoria"])){
    while($registroVerificacao = mysqli_fetch_assoc($resultadoCategoria)){
        if($registroVerificacao["nome"] == $_POST["categoria"]){
            $_SESSION["mensagem"] = "Categoria Já Existe";
            unset($_POST["categoria"]);
            Header("Location:./addCategory.php");
            die;
        }
    }
    $comando = "INSERT INTO categorias (nome) VALUES('".$_POST["categoria"]."')";
    $resultado= mysqli_query($conexao, $comando);
    if(!$resultado){
        $_SESSION["mensagem"] = "Falha ao Adicionar Categoria";
    } else {
        $_SESSION["mensagem"] = "Categoria Adicionada com Sucesso";
    } 
    unset($_POST["categoria"]);
    Header("Location:./addCategory.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <title>StreetPlay :: Adicionar Categoria</title>
</head>
<body>
    <?php require('../components/header.php') ?>
    <!-- Adionar Categoria Nova -->
    <form action="addCategory.php" method="post">
        <label for="categoria">Nome Categoria: </label>
        <input type="text" name="categoria" required>
        <button type="submit">Adicionar Categoria Nova</button>
    </form>
    <!-- Lista das Categorias -->
    <?php while($registroCategoria = mysqli_fetch_assoc($resultadoCategoria)):?>
        <div>
            <span><?=$registroCategoria["nome"]?></span>
            <a href="editCategory.php?idCategoria=<?=$registroCategoria["idCategoria"]?>">Editar Categoria</a>
        </div>
    <?php endwhile; ?>
    <?php require('../components/footer.php') ?>
</body>
</html>