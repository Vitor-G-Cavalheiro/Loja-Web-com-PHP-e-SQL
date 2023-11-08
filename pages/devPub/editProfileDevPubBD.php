<?php

$sessao = require('../functions/session.php');
$conexao = require('../functions/connection.php');

if(isset($_FILES["foto"])){
    $foto = $_FILES["foto"];
}

if(isset($_POST["idDesenvolvedora"]) || isset($_GET["idDesenvolvedora"])){
    if(isset($_POST["idDesenvolvedora"])){
        $idDevPub = $_POST["idDesenvolvedora"];
    } elseif(isset($_GET["idDesenvolvedora"])){
        $idDevPub = $_GET["idDesenvolvedora"];
    }
    $idColuna = "idDesenvolvedora";
    $tabela = "Desenvolvedoras";
    $nomeColuna = "nomeDev";
} elseif (isset($_POST["idPublicadora"]) || isset($_GET["idPublicadora"])){
    if(isset($_POST["idPublicadora"])){
        $idDevPub = $_POST["idPublicadora"];
    } elseif(isset($_GET["idPublicadora"])){
        $idDevPub = $_GET["idPublicadora"];
    }
    $idColuna = "idPublicadora";
    $tabela = "Publicadoras";
    $nomeColuna = "nomePub";
}


if(isset($_POST["nome"]) && $_POST["nome"] != NULL){
    $nome = $_POST["nome"];
    $atualizarNome = "UPDATE $tabela SET $nomeColuna = '$nome' WHERE $idColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarNome);
}
if(isset($_POST["descricao"])){
    $descricao = $_POST["descricao"];
    $atualizarDescricao = "UPDATE $tabela SET descricao = '$descricao' WHERE $idColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarDescricao);
}
if(isset($foto) && $foto["error"] == NULL){
    $destino = '../../imgs/user/' . $_FILES['foto']['name'];
    $arquivo_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($arquivo_tmp, $destino);
    $atualizarFoto = "UPDATE $tabela SET foto = '$destino' WHERE $idColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarFoto);
}
if(isset($_POST["senha"])){
    $senha = $_POST["senha"];
    $confSenha = $_POST["confSenha"];
    $verificarSenha = "SELECT * FROM $tabela WHERE $idColuna = $idDevPub";
    $resultadoVerificacao = mysqli_query($conexao, $verificarSenha);
    $registroVerificacao = mysqli_fetch_assoc($resultadoVerificacao);
    if($registroVerificacao["senha"] == $senha){
        $_SESSION["mensagem"] = "A Senha Não Pode Ser Igual A Antiga";
        Header("Location:./editProfileDevPub.php?$idColuna=$idDevPub");
        die;
    }
    if($senha != $confSenha){
        $_SESSION["mensagem"] = "As Senhas Devem Ser Iguais";
        Header("Location:./editProfileDevPub.php?$idColuna=$idDevPub");
        die;
    }
    $atualizarSenha = "UPDATE $tabela SET senha = '$senha' WHERE $idColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarSenha);
}
if(isset($_POST["youtube"])){
    if(isset($_POST["delYoutube"])){
        $youtube = NULL;
    }else {
        $youtube = $_POST["youtube"];
    }
    $atualizarYoutube = "UPDATE $tabela SET youtube = '$youtube' WHERE $idColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarYoutube);
}
if(isset($_POST["twitter"])){
    if(isset($_POST["delTwitter"])){
        $twitter = NULL;
    }else {
        $twitter = $_POST["twitter"];
    }
    $atualizarTwitter = "UPDATE $tabela SET twitter = '$twitter' WHERE $idColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarTwitter);
}
if(isset($_POST["twitch"])){
    if(isset($_POST["delTwitch"])){
        $twitch = NULL;
    }else {
        $twitch = $_POST["twitch"];
    }
    $atualizarTwitch = "UPDATE $tabela SET twitch = '$twitch' WHERE $idColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarTwitch);
}
if(isset($_POST["site"])){
    if(isset($_POST["delSite"])){
        $site = NULL;
    }else {
        $site = $_POST["site"];
    }
    $atualizarSite = "UPDATE $tabela SET site = '$site' WHERE $idColuna = $idDevPub";
    $resultado = mysqli_query($conexao, $atualizarSite);
}
if(isset($_GET["delete"])){
    //Comando Jogos da Mesma Dev ou Pub
    $comandoJogosDevPub = "SELECT * FROM JogosPublicados WHERE $idColuna = $idDevPub";
    $resultadoJogosDevPub = mysqli_query($conexao, $comandoJogosDevPub);
    //Apagando Todos os Seus Jogos
    while($registroJogosDevPub = mysqli_fetch_assoc($resultadoJogosDevPub)){
        $idJogo = $registroJogosDevPub["idJogo"];

        $selecionarFotoJogo = "SELECT * FROM FotosJogos WHERE idFotoJogo = $idJogo";
        $selecionadoFotoJogo = mysqli_query($conexao, $selecionarFotoJogo);
        while($resultadoSelecionadoFotoJogo = mysqli_fetch_assoc($selecionadoFotoJogo)){
            unlink($resultadoSelecionadoFotoJogo["foto"]);
        }
        
        $comandoFotos = "DELETE FROM FotosJogos WHERE idJogo = $idJogo";
        $comandoPublicado = "DELETE FROM JogosPublicados WHERE idJogo = $idJogo";

        $verificacaoFavorito = "SELECT * FROM Favoritos WHERE idJogoPublicado = $idJogo";
        $verificandoFavorito = mysqli_query($conexao, $verificacaoFavorito);
        $verificadoFavorito = mysqli_fetch_assoc($verificandoFavorito);
        if($verificadoFavorito){
            $comandoFavorito = "DELETE FROM Favoritos WHERE idJogoPublicado = $idJogo";
            $resultadoFavorito = mysqli_query($conexao, $comandoFavorito);
        }

        $verificacaoCarrinho = "SELECT * FROM Carrinho WHERE idJogoPublicado = $idJogo";
        $verificandoCarrinho = mysqli_query($conexao, $verificacaoCarrinho);
        $verificadoCarrinho = mysqli_fetch_assoc($verificandoCarrinho);
        if($verificadoCarrinho){
            $comandoCarrinho = "DELETE FROM Carrinho WHERE idJogoPublicado = $idJogo";
            $resultadoCarrinho = mysqli_query($conexao, $comandoCarrinho);
        }

        $verificacaoBiblioteca = "SELECT * FROM Biblioteca WHERE idJogoPublicado = $idJogo";
        $verificandoBiblioteca = mysqli_query($conexao, $verificacaoBiblioteca);
        $verificadoBiblioteca = mysqli_fetch_assoc($verificandoBiblioteca);
        if($verificadoBiblioteca){
            $comandoBiblioteca = "DELETE FROM Biblioteca WHERE idJogoPublicado = $idJogo";
            $resultadoBiblioteca = mysqli_query($conexao, $comandoBiblioteca);
        }
        $comandoCategoria = "DELETE FROM CategoriasJogos WHERE idJogo = $idJogo";
        $comandoJogo = "DELETE FROM Jogos WHERE idJogo = $idJogo";

        $resultadoFotos = mysqli_query($conexao, $comandoFotos);
        $resultadoPublicado = mysqli_query($conexao, $comandoPublicado);
        $resultadoCategoria = mysqli_query($conexao, $comandoCategoria);
        $resultadoJogo = mysqli_query($conexao, $comandoJogo);
    }
    $selecionarDevPub = "SELECT * FROM $tabela WHERE $idColuna = $idDevPub";
    $selecionadoDevPub = mysqli_query($conexao, $selecionarDevPub);
    $resultadoSelecionadoDevPub = mysqli_fetch_assoc($selecionadoDevPub);
    unlink($resultadoSelecionadoDevPub["foto"]);

    $deleteJogoPublicado = "DELETE FROM JogosPublicados WHERE $idColuna = $idDevPub";
    $deleteSeguindo = "DELETE FROM Seguindo WHERE $idColuna = $idDevPub";
    /* FAZER VERIFICAÇÂO COLEÇÕES 
    $deleteColecoes = "DELETE FROM colecoes WHERE $idColuna = $idDevPub"; */
    $deleteTabela = "DELETE FROM $tabela WHERE $idColuna = $idDevPub";

    $resultadoJogosPublicados = mysqli_query($conexao, $deleteJogoPublicado);
    $resultadoSeguindo = mysqli_query($conexao, $deleteSeguindo);
    /* $resultadoColecoes = mysqli_query($conexao, $deleteColecoes); */
    $resultadoTabela = mysqli_query($conexao, $deleteTabela);
    
    if($resultadoTabela){
        $_SESSION["mensagem"] = "Perfil Apagado com Sucesso";
        Header("Location:../loginRegister/logOut.php");
        die;
    } else {
        $_SESSION["mensagem"] = "Falha ao Apagar Perfil";
        Header("Location:./editProfileDevPub.php?$idColuna=$idDevPub");
        die;
    }
}
if($resultado){
    $_SESSION["mensagem"] = "Perfil Atualizado com Sucesso";
} else {
    $_SESSION["mensagem"] = "Falha ao Atualizar Perfil";
}
Header("Location:./editProfileDevPub.php?$idColuna=$idDevPub");

?>