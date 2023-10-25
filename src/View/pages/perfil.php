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
    
    $nome_user = recuperarUserToken();
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

    <link rel="stylesheet" href="../css/perfil.css">
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

    <?php

        require_once("../../model/UserModel.php");
                
        $id_user = recuperarIDToken();


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
        <div class="row">
            <!-- Card à esquerda -->
            <div class="col-md-3">
                <div class="card">
                    <img src="https://via.placeholder.com/70" class="card-img-top" alt="Profile Image">
                    <div class="card-body">
                        <h5 class="card-title">@<?php echo $dados_usuario['nome_user']; ?></h5>
                        <p><a href="../pages/editarPerfil.php">Editar Perfil</a></p>
                        <p class="card-text"><?php echo $dados_usuario['bio']; ?></p>
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
                                <h5 class="card-title"><?php echo $post['titulo']; ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $post['assunto']; ?></h6>
                                <p class="card-text"><?php echo substr($post['conteudo'], 0, 150); ?>...</p>
                                <a href='verPost.php?id_post=<?php echo $post['id']; ?>' class="card-link">Ver mais</a>
                                <a href='edit.php?id=<?php echo $post['id']; ?>' class="card-link">Editar</a>
                                <a href='confirmarExclusao.php?id=<?php echo $post['id']; ?>' class="card-link">Excluir</a>
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

