<?php
session_start(); //Iniciar Sessão


    // Limpar o buffer de redirecionamento
    ob_start();



    require_once ("../../controller/UserController.php");

    if($_POST){

        $email = $_POST ["email"];
        $senha = $_POST ["senha"];
        $user = new UserController();
        
        $user -> verifyLogin($email, $senha);
    }


    //Verificar se a variavel global "msg" acessa o If
if(isset($_SESSION['msg'])){
    //Imprimir o valor da variavel global "msg"
    echo $_SESSION['msg'];
    //Destruir a variavel global "msg"
    unset($_SESSION['msg']);
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

    

        <form method="POST" action="">

            <?php
                $email = "";
                if(isset($dados['email'])){
                    $email = $dados['email'];
                }  
            ?>

            <label for="email">Login</label>    
            <input type="text" id="email" name="email" value="<?php echo $email; ?>">
            <br><br>

            <?php
                $senha = "";
                if(isset($dados['senha'])){
                    $senha = $dados['senha'];
                }  
            ?>

            <label for="senha">Senha</label> 
            <input type="password" id="senha" name="senha">
            <br><br>
            
            <input type="submit" value="Enviar" class="submit">
        
        </form>
        <p>Não possui uma conta? <a href="http://localhost:8000/src/view/pages/cadastro.php" class="link">Cadastre-se</a></p>
        
    </div>

   


</body>
</html>
