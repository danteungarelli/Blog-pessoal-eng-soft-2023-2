<?php
    session_start(); //Iniciar Sessão


   


    // Deletar cookie
    setcookie('token');
    // Criar a mensagem de sucesso e atribuir para a variavel global
    $_SESSION['msg'] = "<p style = 'color:green;'>Sucesso ao realizar o logout!</p>";
    
    header("Location: login.php");



?>