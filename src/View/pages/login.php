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
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: linear-gradient(45deg, #C8ACDD, #7F40B0);
            background-color: #C8ACDD;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            background-color: rgba(0, 0, 0, 0.6);
            color: #fff;
            max-width: 400px; 
        }
        .tela-login {
            padding: 20px;
        }

        .botao {
            background-color: #7F40B0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card tela-login mx-auto">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Login</h1>

                        <form method="POST" action="">
                            <?php
                                $email = "";
                                if(isset($dados['email'])){
                                    $email = $dados['email'];
                                }
                            ?>
                            <div class="form-group">
                                <label for "email">Login</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                            </div>
                            <?php
                                $senha = "";
                                if(isset($dados['senha'])){
                                    $senha = $dados['senha'];
                                }
                            ?>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha">
                            </div>
                            <button type="submit" class="botao btn btn-block">Enviar</button>
                        </form>
                        <p class="mt-3">Não possui uma conta? <a href="cadastro.php" class="link">Cadastre-se</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
