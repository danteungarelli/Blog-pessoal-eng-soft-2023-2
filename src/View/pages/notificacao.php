<?php
session_start(); //Iniciar Sessão


// Limpar o buffer de redirecionamento
ob_start();
    require_once ("../index.php");
    include_once '../../model/UserModel.php';
    include_once '../../config/connection.php';

    // Chamar função validar o token, se for false -> token é invalido e acessa o If
    if(!validarToken()){
        //Criar mensagem de erro e atribuir para a variavel global
        $_SESSION['msg'] = "<p style='color: #fff;'> Erro: Necessário realizar o login para acessar a página!</p>";
        
        //Redirecionar usuario para a pagina de login
        header("Location: login.php");

        //Parar o processamento da página
        exit();
    }
    
    $id = recuperarIDToken();

    $conexao = new Connection();
        $pdo = $conexao->getConnection();
        $numnoti = 0;
        $sql = "UPDATE num_notificacao SET cont = :numnoti  WHERE user_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':numnoti', $numnoti, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();




    $notificacao = new User_Model();
        $notificacao = $notificacao -> notificacoes($id);

        $dados_notificacao = $notificacao[0];
        $notificacao = new User_Model();
        $notificacoes = $notificacao->notificacoes($id);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Notificações</title>

    <link rel="stylesheet" href="../css/login.css">
    
</head>
<body>
    <div class="tela-perfil">
    <a href="http://localhost:8000/src/View/pages/home.php" class="link" style="color: #7F40B0;">Home</a>
    <center><h1>NOTIFICAÇÕES</h1></center>
    <?php
    $notificacoes = array_reverse($notificacoes);
    foreach ($notificacoes as $notificacao){
                ?>
                    <div class="notificacao_user">
                        <p class="notificacao_frase"><?php echo $notificacao['conteudo']; ?></p>
                    </div>  
                    
                    <div class="notificacao_box">
                        <?php
                }
                ?>
        
        
    </div>