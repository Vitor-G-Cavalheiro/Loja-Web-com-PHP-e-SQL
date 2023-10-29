<?php

$sessao = require('../functions/session.php');

unset($_SESSION["user"]);
unset($_SESSION["idDev"]);
unset($_SESSION["idPub"]);
unset($_SESSION["profile"]);
Header("Location:./login.php");
?>