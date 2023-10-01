<?php

$sessao = require('session.php');
$conexao = require('connection.php');

$nome = $_POST["nome"];
$senha = $_POST["senha"];

$comando = "SELECT * FROM Usuarios";

$resultado = mysqli_query($conexao, $comando);
while($registro = mysqli_fetch_assoc($resultado)){
    if($registro["nome"] == $nome && $registro["senha"] == $senha){
        echo "Te achei";
        die;
    }
}

echo "Tu não existe parceiro";

?>