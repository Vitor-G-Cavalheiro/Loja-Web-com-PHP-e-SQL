<?php

if(empty($_SESSION["user"])){
    $_SESSION["user"] = "anonimo";
    $tema = "classic";
} elseif($_SESSION["user"] == "usuario" || $_SESSION["user"] == "admin"){
    $comandoTema = "SELECT * FROM Usuarios WHERE idUsuario = ".$_SESSION["profile"];
} elseif($_SESSION["user"] == "dev/pub" && isset($_SESSION["idDev"])){
    $comandoTema = "SELECT * FROM Desenvolvedoras WHERE idDesenvolvedora = ".$_SESSION["idDev"];
} elseif($_SESSION["user"] == "dev/pub" && isset($_SESSION["idPub"])){
    $comandoTema = "SELECT * FROM Publicadoras WHERE idPublicadora = ".$_SESSION["idPub"];
}

if(isset($comandoTema)){
    $resultadoTema = mysqli_query($conexao, $comandoTema);
    $registroTema = mysqli_fetch_assoc($resultadoTema);
    $tema = $registroTema["tema"];
} 
if(empty($tema)){
    $tema = "classic";
}

return $tema;

?>