<?php

$sessao = require('session.php');
$conexao = require('connection.php');

$nome = $_POST["nome"];
$senha = $_POST["senha"];

$comando = "SELECT * FROM Usuarios";

$resultado = mysqli_query($conexao, $comando);
while($registro = mysqli_fetch_assoc($resultado)){
    if($registro["nome"] == $nome && $registro["senha"] == $senha){
        $_SESSION["mensagem"] = "Bem vindo $nome";
        Header("Location:../index.php");
        die;
    } else if($registro["nome"] == $nome){
        $_SESSION["mensagem"] = "Senha incorreta";
        Header("Location:login.php");
        die;
    }
}

$_SESSION["mensagem"] = "Tu não existe parceiro";
Header("Location:login.php");

?>