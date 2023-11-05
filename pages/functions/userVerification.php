<?php

if($_SESSION["user"] == "usuario" || $_SESSION["user"] == "anonimo"){
    $_SESSION["mensagem"] = "Acesso Negado";
    Header("Location:../store/index.php");
}

?>