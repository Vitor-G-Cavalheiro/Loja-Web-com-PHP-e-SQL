<?php 

function contarLimite ($modificador, $idModificador) {
    $conexao = require('../functions/connection.php');
    if ($modificador == "pesquisa"){
        $comando = "SELECT COUNT(idjogo) AS numeroJogos FROM Jogos WHERE nome LIKE '%$idModificador%'";
    } elseif ($modificador == "idCategoria"){
        $comando = "SELECT COUNT(j.idJogo) AS numeroJogos FROM Jogos j INNER JOIN CategoriasJogos cj ON j.idJogo = cj.idJogo WHERE cj.idCategoria = '$idModificador'";
    }elseif ($modificador == "idDesenvolvedora"){
        $comando = "SELECT COUNT(j.idJogo) AS numeroJogos FROM JogosPublicados jp INNER JOIN Jogos j ON jp.idJogo = j.idJogo INNER JOIN Desenvolvedoras d ON jp.idDesenvolvedora = d.idDesenvolvedora WHERE jp.idDesenvolvedora = '$idModificador'";
    }elseif ($modificador == "idPublicadora"){
        $comando = "SELECT COUNT(j.idJogo) AS numeroJogos FROM JogosPublicados jp INNER JOIN Jogos j ON jp.idJogo = j.idJogo INNER JOIN Publicadoras p ON jp.idPublicadora = p.idPublicadora WHERE jp.idPublicadora = '$idModificador'";
    }elseif ($modificador == "modificador") {
        $comando = "SELECT COUNT(idJogo) AS numeroJogos FROM Jogos";
    }
    $resultado = mysqli_query($conexao, $comando);
    $registro = mysqli_fetch_assoc($resultado);
    return $registro["numeroJogos"];
}

function verificarLimiteInicio ($inicio, $limite, $valor) {
    $final = $inicio + 16;
    if($inicio >= $limite){
        $inicio = $inicio - 16;
        $final = $limite;
    }elseif ($final > $limite){
        $final = $limite;
    }
    if($valor == "inicio"){
        return $inicio;
    }elseif ($valor == "final"){
        return $final;
    }
}

function correcaoFinalPagina ($finalPagina, $inicio) {
    if(($finalPagina - 16) != $inicio){
        $finalPagina = $inicio + 16;
    }
    return $finalPagina;
}

?>