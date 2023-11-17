<?php
session_start(); 

ob_start();

require_once ("../index.php");

if(!validarToken()){
    $_SESSION['msg'] = "<p style='color: #f00;'> Erro: Necessário realizar o login para acessar adicionar uma publicação!</p>";
    echo("<script> window.alert('Erro: Necessário realizar o login para acessar a página!')</script>");
    header("Location: login.php");
    exit();
}

require_once("../../model/UserModel.php");


if (isset($_POST['SubmitPost'])) {
    // Verifica se 'id_post' está presente no formulário e não está vazio
    if (!empty($_POST['id_post'])) {
        $user_id = recuperarIDToken();
        $id_post = $_POST['id_post']; // Alteração aqui, obtendo 'id_post' do formulário
        $conteudo = $_POST['conteudo'];
        $user_model = new User_Model();
        $comment = $user_model->addComment($conteudo, $id_post, $user_id);

        if ($comment) {
            echo("<script> window.alert('Comentário enviado com sucesso!'); window.history.go(-2);</script>");
  
           
        } else {
            echo("<script> window.alert('Erro ao enviar comentário!'); window.history.go(-2);</script>");
        }
    } else {
        echo 'ID do post não fornecido no formulário.';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar comentário</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700">
    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>

<div class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Adicionar comentário</a>
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


<div class="container mt-5">
    <h1 class="text-center">Adicionar comentário</h1>
    
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']); 
    }
    ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="addComentario.php" method="post">
            <input type="hidden" name="id_post" value="<?php echo $_GET['id_post'] ?? ''; ?>">
                
                <div class="form-group">
                    <label for="conteudo">Conteúdo</label>
                    <textarea name="conteudo" id="conteudo" class="form-control" required></textarea>
                </div>
                
                <div class="text-center">
                    <button type="submit" name="SubmitPost" class="btn btn-primary">Enviar</button>
                </div>
                
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
