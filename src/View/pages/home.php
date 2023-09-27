<?php
session_start(); //Iniciar Sessão


    // Limpar o buffer de redirecionamento
    ob_start();

    //Incluir arquivo para validar e recuperar token

    require_once ("../index.php");
    
    // Chamar função validar o token, se for false -> token é invalido e acessa o If
    if(!validarToken()){
        //Criar mensagem de erro e atribuir para a variavel global
        $_SESSION['msg'] = "<p style='color: #f00;'> Erro: Necessário realizar o login para acessar a página!</p>";
        echo("<script> window.alert('Erro: Necessário realizar o login para acessar a página!')</script>");
        //Redirecionar usuario para a pagina de login
        header("Location: login.php");

        //Parar o processamento da página
        exit();
    }
    

    echo "Bem vindo " . recuperarNomeToken() . "<br>";

    //Acessar pagina de perfil
    echo"<a href='perfil.php'>Meu Perfil</a><br>";

    

?>