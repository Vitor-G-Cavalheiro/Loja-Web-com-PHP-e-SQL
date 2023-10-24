<?php

$sessao = require('session.php');
$conexao = require('connection.php');

$nome = $_POST["nome"];
$senha = $_POST["senha"];

$comando = "SELECT * FROM Usuarios";
$comandoDesenvolvedora = "SELECT * FROM Desenvolvedoras";
$comandoPublicadora = "SELECT * FROM Publicadoras";

$resultadoDesenvolvedora = mysqli_query($conexao, $comandoDesenvolvedora);
while($registroDesenvolvedora = mysqli_fetch_assoc($resultadoDesenvolvedora)){
    if($registroDesenvolvedora["nome"] == $nome && $registroDesenvolvedora["senha"] == $senha){
        $_SESSION["mensagem"] = "Bem vindo $nome";
        $_SESSION["user"] = "dev/pub";
        $_SESSION["idDev"] = $registroDesenvolvedora["idDesenvolvedora"];
        Header("Location:../index.php");
        die;
    }
}

$resultadoPublicadora = mysqli_query($conexao, $comandoPublicadora);
while($registroPublicadora = mysqli_fetch_assoc($resultadoPublicadora)){
    if($registroPublicadora["nome"] == $nome && $registroPublicadora["senha"] == $senha){
        $_SESSION["mensagem"] = "Bem vindo $nome";
        $_SESSION["user"] = "dev/pub";
        $_SESSION["idPub"] = $registroPublicadora["idPublicadora"];
        Header("Location:../index.php");
        die;
    }
}

$resultado = mysqli_query($conexao, $comando);
while($registro = mysqli_fetch_assoc($resultado)){
    if($registro["nome"] == $nome && $registro["senha"] == $senha && $registro["administrador"] == 1){
        $_SESSION["mensagem"] = "Bem vindo MESTRE $nome";
        $_SESSION["user"] = "admin";
        Header("Location:../index.php");
        die;
    } else if($registro["nome"] == $nome && $registro["senha"] == $senha){
        $_SESSION["mensagem"] = "Bem vindo $nome";
        $_SESSION["user"] = "usuario";
        Header("Location:../index.php");
        die;
    } else if($registro["nome"] == $nome){
        $_SESSION["mensagem"] = "Senha incorreta";
        Header("Location:login.php");
        die;
    }
}

$_SESSION["mensagem"] = "Usuário não Existe";
Header("Location:login.php");

?>