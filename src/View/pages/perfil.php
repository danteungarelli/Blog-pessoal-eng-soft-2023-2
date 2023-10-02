<?php
session_start(); //Iniciar Sessão


// Limpar o buffer de redirecionamento
ob_start();
    require_once ("../index.php");

    // Chamar função validar o token, se for false -> token é invalido e acessa o If
    if(!validarToken()){
        //Criar mensagem de erro e atribuir para a variavel global
        $_SESSION['msg'] = "<p style='color: #fff;'> Erro: Necessário realizar o login para acessar a página!</p>";
        
        //Redirecionar usuario para a pagina de login
        header("Location: login.php");

        //Parar o processamento da página
        exit();
    }
    
    $nome_user = recuperarNomeToken();
    $id = recuperarIDToken();
    $email = recuperarEmailToken();
    $nome_completo = recuperarNomeToken();
    $nascimento = recuperarNascimentoToken();
    //$telefone = recuperarTelefoneToken();
    $sexo = recuperarSexoToken();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Perfil</title>

    <link rel="stylesheet" href="../css/login.css">
    
</head>
<body>
    <div class="tela-perfil">
    <center><h1>Perfil</h1></center>
        <p>Nome de Usuário: <?php echo $nome_user; ?></p>
        <p>ID: <?php echo $id; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <p>Nome Completo: <?php echo $nome_completo; ?></p>
        <p>Data de Nascimento: <?php echo $nascimento; ?></p>
        <p>Sexo: <?php echo $sexo; ?></p>
        <p>Realizar Logout? <a href='logout.php'>Sair</a><br></p>
        
        
    </div>

   


</body>
</html>

