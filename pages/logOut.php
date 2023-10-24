<?php

$sessao = require('session.php');

unset($_SESSION["user"]);
unset($_SESSION["idDev"]);
unset($_SESSION["idPub"]);
Header("Location:./login.php");
?>