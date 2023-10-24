<?php

$sessao = require('session.php');
$conexao = require('connection.php');
$verificacao = require('userVerification.php');

if(isset($_SESSION["mensagem"])){
    echo $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
}

$idJogo = $_GET["idJogo"];
$comandoJogos = "SELECT * FROM jogos";
$resultadoJogos = mysqli_query($conexao, $comandoJogos);

$comandoDesenvolvedora = "SELECT * FROM Desenvolvedoras";
$comandoPublicadora = "SELECT * FROM Publicadoras";
$comandoCategoria = "SELECT * FROM Categorias";

$resultadoDesenvolvedora = mysqli_query($conexao, $comandoDesenvolvedora);
$resultadoPublicadora = mysqli_query($conexao, $comandoPublicadora);
$resultadoCategoria = mysqli_query($conexao, $comandoCategoria);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Jogo</title>
</head>
<body>
    <form action="updateGameBD.php" method="post">
    <?php
    while($registroJogos = mysqli_fetch_assoc($resultadoJogos)):
        if($registroJogos["idJogo"] == $idJogo):
            $comandoFotosJogos = "SELECT * FROM fotosJogos";
            $resultadoFotosJogos = mysqli_query($conexao, $comandoFotosJogos);
            while($registroFotosJogos = mysqli_fetch_assoc($resultadoFotosJogos)):
                if($registroFotosJogos["idJogo"] == $registroJogos["idJogo"]):?>
                    <input name="idJogo" type="text" value="<?=$registroJogos["idJogo"]?>" hidden>
                    <label for="nome">Nome: </label>
                    <input name="nome" type="text" value="<?=$registroJogos["nome"]?>" required>
                    <label for="preco">Preço: </label>
                    <input type="number" name="preco" value="<?=$registroJogos["preco"]?> required>
                    <label for="descricao">Descrição: </label>
                    <input type="text" name="descricao" value="<?=$registroJogos["descricao"]?>"required>
                    <label for="desenvolvedora">Desenvolvedora: </label>
                    <select name="desenvolvedora">
                        <?php
                        while($registroDesenvolvedora = mysqli_fetch_assoc($resultadoDesenvolvedora)){
                            echo "<option value='".$registroDesenvolvedora["idDesenvolvedora"]."'>".$registroDesenvolvedora["nome"]."</option>";
                        }
                        ?>
                    </select>
                    <label for="publicadora">Publicadora: </label>
                    <select name="publicadora">
                        <?php
                        while($registroPublicadora = mysqli_fetch_assoc($resultadoPublicadora)){
                            echo "<option value='".$registroPublicadora["idPublicadora"]."'>".$registroPublicadora["nome"]."</option>";
                        }
                        ?>
                    </select>
                    <label for="categoria">Categoria: </label>
                    <select name="categoria">
                        <?php
                        while($registroCategoria = mysqli_fetch_assoc($resultadoCategoria)){
                            echo "<option value='".$registroCategoria["idCategoria"]."'>".$registroCategoria["nome"]."</option>";
                        }
                        ?>
                    </select>
                    <label for="foto">Adicionar mais uma Foto do Jogo: </label>
                    <input type="file" name="foto">
                <?php
                endif;
            endwhile;
        endif;
    endwhile;
    ?>
    <button type="submit">Atualizar Jogo</button>
    </form>
</body>
</html>
