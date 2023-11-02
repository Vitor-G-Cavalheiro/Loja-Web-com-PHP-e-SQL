<?php

if(isset($_SESSION["mensagem"])){
    echo $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
}

?>