<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <title>Pagina de Perfil</title>
</head>

<body>

    <?php
    require_once("../../model/UserModel.php");

    $id_user = $_GET['id_user'];
    $user = new User_Model();
    $user = $user->usuarios($id_user);
    $dados_usuario = $user[0];
    $post = new User_Model();
    $posts = $post->postagens($id_user);
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                            <span class="badge badge-danger">
                                <?php echo $resul['cont']; ?>
                            </span> Notificações
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img src="https://via.placeholder.com/70" class="card-img-top" alt="Profile Image">
                    <div class="card-body">
                        <h5 class="card-title">@
                            <?php echo $dados_usuario['nome_user']; ?>
                        </h5>
                        <p class="card-text">
                            <?php echo $dados_usuario['bio']; ?>
                        </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Seguidores: 120</li>
                        <li class="list-group-item">Seguindo: 200</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                <h1>Minhas Publicações</h1>
                <div class="row">
                    <?php
                    foreach ($posts as $post) {
                        ?>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $post['titulo']; ?>
                                    </h5>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        <?php echo $post['assunto']; ?>
                                    </h6>
                                    <p class="card-text">
                                        <?php echo substr($post['conteudo'], 0, 150); ?>...
                                    </p>
                                    <a href='verPost.php?id_post=<?php echo $post['id']; ?>' class="card-link">Ver mais</a>
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
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>