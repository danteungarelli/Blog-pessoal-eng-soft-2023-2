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


?>

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
    
    $user_id = recuperarIDToken();

    $id_user = $_GET['id_user'];
    $user = new User_Model();
    $user = $user->usuarios($id_user);
    $dados_usuario = $user[0];
    $post = new User_Model();
    $posts = $post->postagens($id_user);

    $model = new User_Model();

    // Se o formulário de salvar for enviado
    if (isset($_GET['salvar']) && isset($_GET['id'])) {
        $id_post = $_GET['id'];
        $user_model = new User_Model();
        $salvou = $user_model->salvarPost($user_id, $id_post);

        if ($salvou) {
            echo("<script> window.alert('Post salvo com sucesso!')</script>");
        } else {
            echo("<script> window.alert('Post removido dos posts salvos!')</script>");
        }
    } 
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
                        <a class="nav-link" href="postsSalvos.php">Posts Salvos</a>
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

                            <!-- Adicionando Botão de Seguir-->
                            
                            <?php
                            if ($model->verificarSeguir($id_user)) {
                                $buttonClass = "seguido";
                                $opcao = "Deixar de Seguir";
                            } else {
                                $buttonClass = "nao-seguido";
                                $opcao = "Seguir";
                            }
                            ?>

                            <?php if($id_user != recuperarIDToken()):?>    

                                <form action="seguirUsuario.php?id=<?php echo $id_user?>" method="post">
                                    <button type="submit" name="seguir" value="seguir" class="seguirUsuario <?php echo $buttonClass; ?>">
                                         <?php echo $opcao?>
                                    </button>
                                </form>

                            <?php endif;?>

                            <?php

                            $id_usuario_silenciado = $dados_usuario['id_user'];

                            var_dump($id_user, $id_usuario_silenciado);

                            if ($model->verificarSilenciado($id_user, $id_usuario_silenciado)) {
                                $buttonClassSilenciar = "silenciado";
                                $opcaoSilenciar = "Desilenciar";
                            } else {
                                $buttonClassSilenciar = "nao-silenciado";
                                $opcaoSilenciar = "Silenciar";
                            }
                            ?>

                            <?php if($id_user != recuperarIDToken()):?>
                                <form action="silenciarUsuario.php?id=<?php echo $id_user?>" method="post">
                                    <button type="submit" name="silenciar" value="silenciar" class="silenciarUsuario <?php echo $buttonClassSilenciar; ?>">
                                        <?php echo $opcaoSilenciar?>
                                    </button>
                                </form>
                            <?php endif;?>
                            
                        </h5>
                        <p class="card-text">
                            <?php echo $dados_usuario['bio']; ?>
                        </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Seguidores: <?php echo $model->contarSeguidores($id_user)?></li>
                        <li class="list-group-item">Seguindo: <?php echo $model->contarSeguindo($id_user)?></li>
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
                                    <a href="perfilDeOutro.php?id_user=<?php echo $id_user?>&salvar=true & id=<?php echo $post['id'];?>">Salvar</a>
                                    <a href="comentarios.php?id=<?php echo $post['id']?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                          <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                        </svg>
                        </a>
                                    <?php
                                   $idpost = $post['id'];
                        $idUser = recuperarIDToken();
                        $conexao = new Connection();
                        $pdo = $conexao->getConnection();
                        $query = "SELECT * FROM likes WHERE id_post = :idpost AND id_usuario = :idUser";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':idpost', $idpost, PDO::PARAM_INT);
                        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
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