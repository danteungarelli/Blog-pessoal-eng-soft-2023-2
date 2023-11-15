<?php
session_start();
ob_start();
require_once ("../index.php");

if (!validarToken()) {
    $_SESSION['msg'] = "<p style='color: #fff;'> Erro: Necessário realizar o login para acessar a página!</p>";
    echo("<script> window.alert('Erro: Necessário realizar o login para acessar a página!')</script>");
    header("Location: login.php");
    exit();
}

require_once("../../model/UserModel.php");

$id_user = recuperarIDToken();

$conexao = new Connection();
$pdo = $conexao->getConnection();
$sql = "SELECT * FROM num_notificacao WHERE user_id = :id_user";
$st = $pdo->prepare($sql);
$st->bindParam(':id_user', $id_user, PDO::PARAM_INT);
$st->execute();
$resul = $st->fetch(PDO::FETCH_ASSOC);

$post = new User_Model();
$id_posts = $post->postsSalvos($id_user);


if (isset($_GET['salvar']) && isset($_GET['id'])) {
    $id_post = $_GET['id'];
    $user_model = new User_Model();
    $salvou = $user_model->salvarPost($id_user, $id_post);

    if ($salvou) {
        echo("<script> window.alert('Post salvo com sucesso!')</script>");
    } else {
        echo("<script> window.alert('Post removido dos posts salvos!')</script>");
    }
} 




?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Salvos</title>
    
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>

<div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Posts Salvos</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="perfil.php">Meu Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addPost.php">Criar Post</a>
                </li>
                <li class="nav-item">
                    <a href="notificacao.php" class="nav-link">
                        <span class="badge badge-danger"><?php echo $resul['cont'];?></span> Notificações
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="postsSalvos.php">Posts Salvos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
    <?php
            foreach ($id_posts as $posts) {
                $postagens = new User_Model();
                // Obtém as informações detalhadas do post com base no ID
                $postsSalvos = $postagens->postagensSalvos($posts['id_post']);

                foreach ($postsSalvos as $post) {
            ?>
                    <div class="col-md-6 mb-4">
                        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-success"><?php echo $post['assunto']; ?></strong>
                                <h3 class="mb-0"><?php echo $post['titulo']; ?></h3>
                                <div class="mb-1 text-muted"><?php echo date('M d', strtotime($post['data_publicacao'])); ?></div>
                                <p class="mb-auto"><?php echo substr($post['conteudo'], 0, 150); ?>...</p>
                                <a href='verPost.php?id_post=<?php echo $post['id']; ?>'>Ler mais</a>
                                <a href="confirmarExclusao.php?id=<?php echo $post['id'] ?>">Excluir</a>
                                <a href="edit.php?id=<?php echo $post['id'] ?>">Editar</a>
                                <a href="postsSalvos.php?salvar=true & id=<?php echo $post['id'];?>">Remover dos Salvos</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>  
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
