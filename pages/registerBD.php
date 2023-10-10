<?php

$sessao = require('session.php');
$conexao = require('connection.php');

$nome = $_POST["nome"];
$senha = $_POST["senha"];
$email = $_POST["email"];
$tipoUsuario = $_POST["tipoUsuario"];

$confirmacao = "SELECT * FROM $tipoUsuario";
if($tipoUsuario == "usuarios"){
    $comando = "INSERT INTO $tipoUsuario (nome, senha, email, administrador) VALUES('$nome', '$senha', '$email', FALSE)";
} else {
    $comando = "INSERT INTO $tipoUsuario (nome, senha, email) VALUES('$nome', '$senha', '$email')";
}


$existe = mysqli_query($conexao, $confirmacao);
while($registro = mysqli_fetch_assoc($existe)){
    if($registro["nome"] == $nome){
        $_SESSION["mensagem"] = "Nome da Conta já Existe";
        Header("Location:register.php");
        die;
    }
}
if(!$resultado = mysqli_query($conexao, $comando)){
    $_SESSION["mensagem"] = "Falha ao Registrar, Tente de Novo Mais Tarde";
    Header("Location:register.php");
} else {
    $_SESSION["mensagem"] = "Registrado com Sucesso";
    Header("Location:login.php");
}


?>