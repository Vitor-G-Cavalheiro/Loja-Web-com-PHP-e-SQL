<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

if(isset($_GET["idUsuario"])){
    $idUsuario = $_GET["idUsuario"];
} elseif(isset($_POST["idUsuario"])){
    $idUsuario = $_POST["idUsuario"];
}

if(isset($_FILES["foto"])){
    $foto = $_FILES["foto"];
}

if(isset($_POST["nome"]) && $_POST["nome"] != NULL){
    $nome = $_POST["nome"];

    $atualizarNome = "UPDATE Usuarios SET nome = '$nome' WHERE idUsuario = $idUsuario";
    $resultado = mysqli_query($conexao, $atualizarNome);
}
if(isset($_POST["descricao"])){
    $descricao = $_POST["descricao"];
    $atualizarDescricao = "UPDATE Usuarios SET descricao = '$descricao' WHERE idUsuario = $idUsuario";
    $resultado = mysqli_query($conexao, $atualizarDescricao);
}
if(isset($foto) && $foto["error"] == NULL){
    $destino = '../../imgs/user/' . $_FILES['foto']['name'];
    $arquivo_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($arquivo_tmp, $destino);
    $atualizarFoto = "UPDATE Usuarios SET foto = '$destino' WHERE idUsuario = $idUsuario";
    $resultado = mysqli_query($conexao, $atualizarFoto);
}
if(isset($_POST["senha"])){
    $senha = $_POST["senha"];
    $confSenha = $_POST["confSenha"];
    $verificarSenha = "SELECT * FROM Usuarios WHERE idUsuario = $idUsuario";
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
    $atualizarSenha = "UPDATE Usuarios SET senha = '$senha' WHERE idUsuario = $idUsuario";
    $resultado = mysqli_query($conexao, $atualizarSenha);
}
if(isset($_GET["delete"])){
    $selecionarUsuario = "SELECT * FROM Usuarios WHERE idUsuario = $idUsuario";
    $selecionadoUsuario = mysqli_query($conexao, $selecionarUsuario);
    $resultadoSelecionadoUsuario = mysqli_fetch_assoc($selecionadoUsuario);
    unlink($resultadoSelecionadoUsuario["foto"]);

    $deleteBiblioteca = "DELETE FROM Biblioteca WHERE idUsuario = $idUsuario";
    $deleteCarrinho = "DELETE FROM Carrinho WHERE idUsuario = $idUsuario";
    $deleteColecoes = "DELETE FROM Colecoes WHERE idUsuario = $idUsuario";
    $deleteFavoritos = "DELETE FROM Favoritos WHERE idUsuario = $idUsuario";
    $deleteSeguindo = "DELETE FROM Seguindo WHERE idUsuario = $idUsuario";
    $deleteUsuario = "DELETE FROM Usuarios WHERE idUsuario = $idUsuario";

    $resultadoBiblioteca = mysqli_query($conexao, $deleteBiblioteca);
    $resultadoCarrinho = mysqli_query($conexao, $deleteCarrinho);
    $resultadoColecoes = mysqli_query($conexao, $deleteColecoes);
    $resultadoFavoritos = mysqli_query($conexao, $deleteFavoritos);
    $resultadoSeguindo = mysqli_query($conexao, $deleteSeguindo);
    $resultadoUsuario = mysqli_query($conexao, $deleteUsuario);
    
    if($resultadoUsuario){
        $_SESSION["mensagem"] = "Perfil Apagado com Sucesso";
        Header("Location:../loginRegister/logOut.php");
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