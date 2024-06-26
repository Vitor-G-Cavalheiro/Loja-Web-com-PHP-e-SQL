<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

$nome = $_POST["nome"];
$senha = $_POST["senha"];

$comando = "SELECT * FROM Usuarios";
$comandoDesenvolvedora = "SELECT * FROM Desenvolvedoras";
$comandoPublicadora = "SELECT * FROM Publicadoras";

$resultadoDesenvolvedora = mysqli_query($conexao, $comandoDesenvolvedora);
while($registroDesenvolvedora = mysqli_fetch_assoc($resultadoDesenvolvedora)){
    if($registroDesenvolvedora["nomeDev"] == $nome && $registroDesenvolvedora["senha"] == $senha){
        $_SESSION["mensagem"] = "Bem vindo $nome";
        $_SESSION["user"] = "dev/pub";
        $_SESSION["idDev"] = $registroDesenvolvedora["idDesenvolvedora"];
        Header("Location:../store/index.php");
        die;
    }
}

$resultadoPublicadora = mysqli_query($conexao, $comandoPublicadora);
while($registroPublicadora = mysqli_fetch_assoc($resultadoPublicadora)){
    if($registroPublicadora["nomePub"] == $nome && $registroPublicadora["senha"] == $senha){
        $_SESSION["mensagem"] = "Bem vindo $nome";
        $_SESSION["user"] = "dev/pub";
        $_SESSION["idPub"] = $registroPublicadora["idPublicadora"];
        Header("Location:../store/index.php");
        die;
    }
}

$resultado = mysqli_query($conexao, $comando);
while($registro = mysqli_fetch_assoc($resultado)){
    if($registro["nome"] == $nome && $registro["senha"] == $senha && $registro["administrador"] == 1){
        $_SESSION["mensagem"] = "Bem vindo MESTRE $nome";
        $_SESSION["user"] = "admin";
        $_SESSION["profile"] = $registro["idUsuario"];
        Header("Location:../store/index.php");
        die;
    } elseif($registro["nome"] == $nome && $registro["senha"] == $senha){
        $_SESSION["mensagem"] = "Bem vindo $nome";
        $_SESSION["user"] = "usuario";
        $_SESSION["profile"] = $registro["idUsuario"];
        Header("Location:../store/index.php");
        die;
    } elseif($registro["nome"] == $nome){
        $_SESSION["mensagem"] = "Senha incorreta";
        Header("Location:./login.php");
        die;
    }
}

$_SESSION["mensagem"] = "Usuário não Existe";
Header("Location:./login.php");

?>