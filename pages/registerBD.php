<?php

$sessao = require('session.php');
$conexao = require('connection.php');

$nome = $_POST["nome"];
$senha = $_POST["senha"];
$email = $_POST["email"];

$comando = "INSERT INTO Usuarios (nome, senha, email, administrador) VALUES('$nome', '$senha', '$email', FALSE)";

if(!$resultado = mysqli_query($conexao, $comando)){
    echo "Registro fudeu";
} else {
    $_SESSION["mensagem"] = "Registrado com Sucesso";
    Header("Location:login.php");
}

?>