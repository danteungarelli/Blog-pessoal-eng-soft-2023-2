<?php
session_start();
ob_start();

require_once("../index.php");

if (!isset($_COOKIE['token']) || !validarToken()) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id_post'])) {
    $id_post = $_GET['id_post'];

    include_once '../../config/connection.php';
    
    $conexao = new Connection();
    $pdo = $conexao->getConnection();
    

    $sql = "SELECT * FROM postagens WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id_post, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Post</title>
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
            <a class="navbar-brand" href="#">Ver Detalhes</a>
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
        <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $post['titulo']; ?></h2>
            <p class="blog-post-meta"><?php echo $post['data_publicacao']; ?> by <?php echo $post['autor_id']; ?></p>
            <p><?php echo $post['conteudo']; ?></p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    } else {
        echo "Post não encontrado";
    }
} else {
    echo "ID do post não especificado na URL";
}
?>
