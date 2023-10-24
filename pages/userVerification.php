<?php

if($_SESSION["user"] == "usuario"){
    $_SESSION["mensagem"] = "Acesso Negado";
    Header("Location:../index.php");
}

?>