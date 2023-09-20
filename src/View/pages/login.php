<?php

require_once ("../../controller/UserController.php");

if($_POST){

    $email = $_POST ["email"];
    $senha = $_POST ["senha"];
    $user = new UserController();

    if($user -> verifyLogin ($email)){
       if($user -> verifyPassword($email, $senha)){
        
        echo("<script>window.location.href='home.php' </script>");
       } 
       else{
        
        echo("<script> window.alert('Senha inválida.')</script>");
       }


    }
    else{
        echo ("<script> window.alert('Usuário não encontrado.'); </script>");
    }

}




?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login</title>

    <link rel="stylesheet" href="../css/login.css">
    
</head>
<body>
    <div class="tela-login">
        <center><h1>Login</h1></center>

        <form method="POST">
            <label for="email">Login</label>    
            <input type="text" id="email" name="email">
            <br><br>

            <label for="senha">Senha</label> 
            <input type="password" id="senha" name="senha">
            <br><br>

            <input type="submit" value="Enviar" class="submit">

        </form>
        <p>Não possui uma conta? <a href="http://localhost:8000/src/view/pages/cadastro.php" class="link">Cadastre-se</a></p>
        
    </div>

   


</body>
</html>
