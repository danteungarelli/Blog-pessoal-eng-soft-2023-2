<?php

$url = $_SERVER['REQUEST_URI'];

switch ($url) {
    case '/':
        echo("home");
        break;
    case '/login':
        include ("pages\login.php");
        break;
    case '/cadastro':
        include ("pages\cadastro.php");
        break;
    default:
        echo 'Rota não encontrada';
        break;

}


?>