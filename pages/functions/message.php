<?php

if(isset($_SESSION["mensagem"])){
    echo "<div class='pop-up-message $tema'><button class='close-pop' onclick='popUpMes()'>X</button>".$_SESSION["mensagem"]."</div>";
    unset($_SESSION["mensagem"]);
}

?>