<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

$idUsuario = $_SESSION["profile"];

if(isset($_POST["nome"]) && $_POST["nome"] != NULL){
    $nome = $_POST["nome"];
    $atualizarNome = "UPDATE usuarios SET nome = '$nome' WHERE idUsuario = $idUsuario";
    $resultado = mysqli_query($conexao, $atualizarNome);
}
if(isset($_POST["descricao"]) && $_POST["descricao"] != NULL){
    $descricao = $_POST["descricao"];
    $atualizarDescricao = "UPDATE usuarios SET descricao = '$descricao' WHERE idUsuario = $idUsuario";
    $resultado = mysqli_query($conexao, $atualizarDescricao);
}
if(isset($_FILES['foto'])){
    $destino = '../../imgs/' . $_FILES['foto']['name'];
    $arquivo_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($arquivo_tmp, $destino);
    $atualizarFoto = "UPDATE usuarios SET foto = '$destino' WHERE idUsuario = $idUsuario";
    $resultado = mysqli_query($conexao, $atualizarFoto);
}
if(isset($_POST["senha"])){
    $senha = $_POST["senha"];
    $confSenha = $_POST["confSenha"];
    $verificarSenha = "SELECT * FROM usuarios WHERE idUsuario = $idUsuario";
    $resultadoVerificacao = mysqli_query($conexao, $verificarSenha);
    $registroVerificacao = mysqli_fetch_assoc($resultadoVerificacao);
    if($registroVerificacao["senha"] == $senha){
        $_SESSION["mensagem"] = "A Senha Não Pode Ser Igual A Antiga";
        Header("Location:./editProfileUser.php?idUsuario=$idUsuario");
        die;
    }
    if($senha != $confSenha){
        $_SESSION["mensagem"] = "As Senhas Devem Ser Iguais";
        Header("Location:./editProfileUser.php?idUsuario=$idUsuario");
        die;
    }
    $atualizarSenha = "UPDATE usuarios SET senha = '$senha' WHERE idUsuario = $idUsuario";
    $resultado = mysqli_query($conexao, $atualizarSenha);
}
if(isset($_GET["delete"])){
    $deleteBiblioteca = "DELETE FROM biblioteca WHERE idUsuario = $idUsuario";
    $deleteCarrinho = "DELETE FROM carrinho WHERE idUsuario = $idUsuario";
    $deleteColecoes = "DELETE FROM colecoes WHERE idUsuario = $idUsuario";
    $deleteFavoritos = "DELETE FROM favoritos WHERE idUsuario = $idUsuario";
    $deleteSeguindo = "DELETE FROM seguindo WHERE idUsuario = $idUsuario";
    $deleteUsuario = "DELETE FROM usuarios WHERE idUsuario = $idUsuario";

    $resultadoBiblioteca = mysqli_query($conexao, $deleteBiblioteca);
    $resultadoCarrinho = mysqli_query($conexao, $deleteCarrinho);
    $resultadoColecoes = mysqli_query($conexao, $deleteColecoes);
    $resultadoFavoritos = mysqli_query($conexao, $deleteFavoritos);
    $resultadoSeguindo = mysqli_query($conexoa, $deleteSeguindo);
    $resultadoUsuario = mysqli_query($conexao, $deleteUsuario);
    
    if($resultadoUsuario){
        $_SESSION["mensagem"] = "Perfil Apagado com Sucesso";
        Header("Location:../login&register/logOut.php");
        die;
    } else {
        $_SESSION["mensagem"] = "Falha ao Apagar Perfil";
        Header("Location:./editProfileUser.php?idUsuario=$idUsuario");
        die;
    }
}
if($resultado){
    $_SESSION["mensagem"] = "Perfil Atualizado com Sucesso";
} else {
    $_SESSION["mensagem"] = "Falha ao Atualizar Perfil";
}
Header("Location:./editProfileUser.php?idUsuario=$idUsuario");

?>