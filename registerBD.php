<?php

$sessao = require('session.php');
$conexao = require('connection.php');

$nome = $_POST["nome"];
$senha = $_POST["senha"];
$email = $_POST["email"];

$confirmacao = "SELECT * FROM Usuarios WHERE nome = '$nome'";
$comando = "INSERT INTO Usuarios (nome, senha, email, administrador) VALUES('$nome', '$senha', '$email', FALSE)";

if($existe = mysqli_query($conexao, $confirmacao)){
    $_SESSION["mensagem"] = "Nome de Usuário já existe";
    Header("Location:register.php");
} else {
    if(!$resultado = mysqli_query($conexao, $comando)){
        echo "Registro fudeu";
    } else {
        $_SESSION["mensagem"] = "Registrado com Sucesso";
        Header("Location:login.php");
    }
}
?>