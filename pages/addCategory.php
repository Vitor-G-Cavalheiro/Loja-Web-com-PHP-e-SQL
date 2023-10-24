<?php

$sessao = require('session.php');
$conexao = require('connection.php');

if($_SESSION["user"] != "admin"){
    $_SESSION["mensagem"] = "Acesso negado";
    Header("Location:../index.php");
}

if(isset($_SESSION["mensagem"])){
    echo $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
}

$comandoCategoria = "SELECT * FROM categorias";
$resultadoCategoria = mysqli_query($conexao, $comandoCategoria);

if(isset($_POST["categoria"])){
    while($registroVerificacao = mysqli_fetch_assoc($resultadoCategoria)){
        if($registroVerificacao["nome"] == $_POST["categoria"]){
            echo "Categoria Já Existe";
            die;
        }
    }
    $comando = "INSERT INTO categorias (nome) VALUES('".$_POST["categoria"]."')";
    $resultado= mysqli_query($conexao, $comando);
    if(!$resultado){
        echo "Falha ao Adicionar Categoria";
    } else {
        echo "Categoria Adicionada com Sucesso";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Categoria</title>
</head>
<body>
    <form action="addCategory.php" method="post">
    <label for="categoria">Nome Categoria: </label>
    <input type="text" name="categoria" required>
    <button type="submit">Adicionar Categoria Nova</button>
    </form>
    <?php
     while($registroCategoria = mysqli_fetch_assoc($resultadoCategoria)){
        echo "<h3>".$registroCategoria["nome"]."</h3>";
        echo "<a href='addCategory?apagar=".$registroCategoria["idCategoria"]."'>Apagar Categoria</a>";
     }
    ?>
</body>
</html>