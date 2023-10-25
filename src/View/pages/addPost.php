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

include_once '../../config/connection.php';

if (isset($_POST['SubmitPost'])) {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $autor_id = $user_id;
    $assunto = $_POST['assunto'];
    $slug = $_POST['slug'];

    $user_id = recuperarIDToken();

    $conexao = new Connection();
    $pdo = $conexao->getConnection();

    $autor_id = $user_id; // para pegar o id automaticamente

    $sql = "INSERT INTO postagens (titulo, conteudo, autor_id, assunto, slug) VALUES (:titulo, :conteudo, :autor_id, :assunto, :slug)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':conteudo', $conteudo);
    $stmt->bindParam(':autor_id', $autor_id);
    $stmt->bindParam(':assunto', $assunto);
    $stmt->bindParam(':slug', $slug);
    
    if ($stmt->execute()) {
        $_SESSION['msg'] = "<p style='color: #008000;'>Postagem adicionada com sucesso!</p>";
        echo "<script>window.location.href = 'home.php';</script>";
        exit();
    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro ao adicionar postagem.</p>";
    }
    
    header("Location: addPost.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Postagem</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Adicionar Post</a>
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
    <h1 class="text-center">Adicionar Nova Postagem</h1>
    
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']); 
    }
    ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="addPost.php" method="post">
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="conteudo">Conteúdo</label>
                    <textarea name="conteudo" id="conteudo" class="form-control" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <input type="text" name="assunto" id="assunto" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" required>
                </div>
                
                <div class="text-center">
                    <button type="submit" name="SubmitPost" class="btn btn-primary">Adicionar Postagem</button>
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
