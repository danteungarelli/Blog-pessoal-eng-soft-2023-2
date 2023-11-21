

<?php
session_start();
ob_start();
require_once("../index.php");

if (!validarToken()) {
    $_SESSION['msg'] = "<p style='color: #fff;'> Erro: Necessário realizar o login para acessar a página!</p>";
    echo("<script> window.alert('Erro: Necessário realizar o login para acessar a página!')</script>");
    header("Location: login.php");
    exit();
}
require_once("../../model/UserModel.php");
$post_id = $_GET['id'];

        $comment = new User_Model();
        $comment = $comment -> comentarios($post_id);

        $dados_comments = $comment[0];
        $comment = new User_Model();
        $comments = $comment->comentarios($post_id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMENTÁRIOS</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700">
    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>

<link rel="stylesheet" href="../css/comentarios.css">
</head>
<body>
<div class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Comentários</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addPost.php">Criar Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="tela">
        
         <!-- Botão para Adicionar Comentário -->
         <a href="addComentario.php?id_post=<?php echo $post_id?>" class="adicionar-comentario-button">Adicionar Comentário</a>
        <center><h1>COMENTÁRIOS:</h1></center>

        <?php
        foreach ($comments as $comment) {
        ?>
            <div class="post_user">
            <p class="post_frase">
                  <span class="user_name"><?php echo $comment['nome_user']; ?>:</span>
                  <?php echo $comment['conteudo']; ?>
              </p>
          </div>
        <?php
        }
        ?>

    </div>
</body>
</html>
