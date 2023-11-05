<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

if(isset($_SESSION["idDev"])){
    $idDevPub = $_SESSION["idDev"];
    $nomeColuna = "idDesenvolvedora";
    $tabela = "Desenvolvedoras";
} elseif (isset($_SESSION["idPub"])){
    $idDevPub = $_SESSION["idPub"];
    $nomeColuna = "idPublicadora";
    $tabela = "Publicadoras";
}

if(isset($_POST["nome"]) && $_POST["nome"] != NULL){
    $nome = $_POST["nome"];
    $atualizarNome = "UPDATE $tabela SET nome = '$nome' WHERE $nomeColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarNome);
}
if(isset($_POST["descricao"]) && $_POST["descricao"] != NULL){
    $descricao = $_POST["descricao"];
    $atualizarDescricao = "UPDATE $tabela SET descricao = '$descricao' WHERE $nomeColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarDescricao);
}
if(isset($_FILES['foto'])){
    $destino = '../../imgs/' . $_FILES['foto']['name'];
    $arquivo_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($arquivo_tmp, $destino);
    $atualizarFoto = "UPDATE $tabela SET foto = '$destino' WHERE $nomeColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarFoto);
}
if(isset($_POST["senha"])){
    $senha = $_POST["senha"];
    $confSenha = $_POST["confSenha"];
    $verificarSenha = "SELECT * FROM $tabela WHERE $nomeColuna = $idDevPub";
    $resultadoVerificacao = mysqli_query($conexao, $verificarSenha);
    $registroVerificacao = mysqli_fetch_assoc($resultadoVerificacao);
    if($registroVerificacao["senha"] == $senha){
        $_SESSION["mensagem"] = "A Senha Não Pode Ser Igual A Antiga";
        Header("Location:./editProfileDevPub.php?$nomeColuna=$idDevPub");
        die;
    }
    if($senha != $confSenha){
        $_SESSION["mensagem"] = "As Senhas Devem Ser Iguais";
        Header("Location:./editProfileDevPub.php?$nomeColuna=$idDevPub");
        die;
    }
    $atualizarSenha = "UPDATE $tabela SET senha = '$senha' WHERE $nomeColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarSenha);
}
if(isset($_POST["youtube"])){
    if(isset($_POST["delYoutube"])){
        $youtube = NULL;
    }else {
        $youtube = $_POST["youtube"];
    }
    $atualizarYoutube = "UPDATE $tabela SET youtube = '$youtube' WHERE $nomeColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarYoutube);
}
if(isset($_POST["twitter"])){
    if(isset($_POST["delTwitter"])){
        $twitter = NULL;
    }else {
        $twitter = $_POST["twitter"];
    }
    $atualizarTwitter = "UPDATE $tabela SET twitter = '$twitter' WHERE $nomeColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarTwitter);
}
if(isset($_POST["twitch"])){
    if(isset($_POST["delTwitch"])){
        $twitch = NULL;
    }else {
        $twitch = $_POST["twitch"];
    }
    $atualizarTwitch = "UPDATE $tabela SET twitch = '$twitch' WHERE $nomeColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarTwitch);
}
if(isset($_POST["site"])){
    if(isset($_POST["delSite"])){
        $site = NULL;
    }else {
        $site = $_POST["site"];
    }
    $atualizarSite = "UPDATE $tabela SET site = '$site' WHERE $nomeColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarSite);
}
if(isset($_GET["delete"])){
    $deleteJogoPublicado = "DELETE FROM jogosPublicados WHERE $nomeColuna = $idDevPub";
    $deleteSeguindo = "DELETE FROM seguindo WHERE $nomeColuna = $idDevPub";
    $deleteColecoes = "DELETE FROM colecoes WHERE $nomeColuna = $idDevPub";
    $deleteTabela = "DELETE FROM $tabela WHERE $nomeColuna = $idDevPub";

    $resultadoJogosPublicados = mysqli_query($conexao, $deleteJogoPublicado);
    $resultadoSeguindo = mysqli_query($conexao, $deleteSeguindo);
    $resultadoColecoes = mysqli_query($conexao, $deleteColecoes);
    $resultadoTabela = mysqli_query($conexao, $deleteTabela);
    
    if($resultadoTabela){
        $_SESSION["mensagem"] = "Perfil Apagado com Sucesso";
        Header("Location:../login&register/logOut.php");
        die;
    } else {
        $_SESSION["mensagem"] = "Falha ao Apagar Perfil";
        Header("Location:./editProfileDevPub.php?$nomeColuna=$idDevPub");
        die;
    }
}
if($resultado){
    $_SESSION["mensagem"] = "Perfil Atualizado com Sucesso";
} else {
    $_SESSION["mensagem"] = "Falha ao Atualizar Perfil";
}
Header("Location:./editProfileDevPub.php?$nomeColuna=$idDevPub");

?>