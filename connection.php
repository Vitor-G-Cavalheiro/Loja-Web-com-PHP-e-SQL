<?php

$conexao = mysqli_connect("localhost", "root", "", "StreetPlay");
    if(!$conexao){
        die;
    } return $conexao;

?>