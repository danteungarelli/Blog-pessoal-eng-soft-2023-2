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

if (!empty($_GET['search'])) {
    $dados = $_GET['search'];
    echo $dados;
    $urlResultado = "resultados.php?search=$dados";
    header("Location: $urlResultado");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
<?php
    
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
    $post = $post -> postagens($id_user);
    $user = new User_Model();
    $user = $user -> usuarios($id_user);

    $dados_post = $post[0];
    $dados_usuario = $user[0];
    
    //echo "Bem vindo " . recuperarNomeToken() . "<br>";

    //Acessar pagina de perfil
    //echo"<a href='perfil.php'>Meu Perfil</a><br>";

    // Recuperar todos os posts do usuário
    $post = new User_Model();
    $posts = $post->postagens($id_user);
?>

    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Home</a>
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
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="home.php">Ver Todos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="home.php?assunto=Futebol">Futebol</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="home.php?assunto=Notícia">Notícias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="home.php?assunto=Carros">Carros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="home.php?assunto=Música">Música</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="home.php?assunto=Filmes e Series">Filmes e Séries</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="home.php?assunto=Política">Politica</a>
            </li>
        </ul>
    </div>

    <div class="box-search mx-auto input-group" style="max-width: 300px;">
    <input type="search" class="form-control" placeholder="Pesquisar Usuário" id="pesquisar">
    <button class="btn btn-primary" onclick="searchData">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
    </button>
    </div>




    <div class="container mt-5">
        <div class="row justify-content-center">
                <?php

                    $assuntoSelecionado = isset($_GET['assunto'])? $_GET['assunto']:null;

                    if ($assuntoSelecionado) {
                        $sql = " WHERE assunto == '$assuntoSelecionado'";
                        echo "<h2>Filtrando por Assunto: $assuntoSelecionado</h2>";
                    }else {
                        echo "<h2>Ver Todos os Posts</h2>";
                    }

                    // Loop para exibir todos os posts do usuário
                    foreach ($posts as $post) {
                        if (!$assuntoSelecionado || $post['assunto'] === $assuntoSelecionado) {
                ?>
            <div class="col-md-6 mb-4">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-success"><?php echo $post['assunto']; ?></strong>
                        <h3 class="mb-0"><?php echo $post['titulo']; ?></h3>
                        <div class="mb-1 text-muted"><?php echo date('M d', strtotime($post['data_publicacao'])); ?></div>
                        <p class="mb-auto"><?php echo substr($post['conteudo'], 0, 150); ?>...</p>
                        <a href='verPost.php?id_post=<?php echo $post['id']; ?>'>Ler mais</a>
                        <a href="confirmarExclusao.php?id=<?php echo $post['id']?>">Excluir</a>
                        <a href="edit.php?id=<?php echo $post['id']?>">Editar</a>
                        <!-- Adicione a seção de curtir a seguir -->
                        <!-- Verificando se o post já foi curtido e o número de curtidas -->
                        <?php
                        $idpost = $post['id'];
                        $conexao = new Connection();
                        $pdo = $conexao->getConnection();
                        $query = "SELECT * FROM likes WHERE id_post = :idpost AND id_usuario = :id_user";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':idpost', $idpost, PDO::PARAM_INT);
                        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                        $stmt->execute();
                        $existing_like = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($existing_like) {
                            $buttonClass = "liked";
                        } else {
                            $buttonClass = "not-liked";
                        }

                        $sql = "SELECT COUNT(*) AS numlikes FROM likes WHERE id_post = :idpost";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':idpost', $idpost, PDO::PARAM_INT);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($result) {
                            // O número de curtidas está armazenado em $resultado['numlikes']
                            $numlikes = $result['numlikes'];
                        }
                        ?>
                        <form action="curtirPost.php?id=<?php echo $post['id'] ?>" method="post">
                            <button type="submit" name="like" value="like" class="like-button <?php echo $buttonClass; ?>">
                                <i class="fas fa-heart"></i>
                                <?php echo "$numlikes &#9829"; ?>
                            </button>
                        </form>
                        <!-- Fim da seção de curtir -->
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
<!-- Funções Barra de Pesquisa -->
<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key == "Enter") {
            searchData();
        }
    });

    function searchData() {
        window.location = 'home.php?search=' + search.value;
    }
</script>
</html>
