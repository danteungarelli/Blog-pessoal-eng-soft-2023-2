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
    
    $nome_user = recuperarNomeToken();
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700">
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
            <a class="navbar-brand" href="#">Perfil</a>
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
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="perfil_info">
                            <div class="d-flex">
                                <svg id="icon_perfil" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg> 
                            </div>
                            <div class="bio_user"> 
                                <p id="user">@<?php echo $dados_usuario['nome_user'];?></p>
                                <p id="editar"><a href="editarPerfil.php">Editar Perfil</a></p>
                                <p id="bio"><?php echo $dados_usuario['bio']; ?></p>
                            </div>
                            <div class="seguidor">
                                <p id="seg">Seguidores: 120</p>
                                <p id="seg">Seguindo: 200</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p>Posts</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <p>Curtidas</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="content">
                    <?php
                    // Loop para exibir todos os posts do usuário
                    foreach ($posts as $post) {
                    ?>
                <div class="mb-3">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-success"><?php echo $post['assunto']; ?></strong>
                            <h3 class="mb-0"><?php echo $post['titulo']; ?></h3>
                            <div class="mb-1 text-muted"><?php echo date('M d', strtotime($post['data_publicacao'])); ?></div>
                            <p class="mb-auto"><?php echo substr($post['conteudo'], 0, 150); ?>...</p>
                            <a href='verPost.php?id_post=<?php echo $post['id']; ?>'>Ver Detalhes</a>
                            <a href="confirmarExclusao.php?id=<?php echo $post['id']?>">Excluir</a>
                            <a href="edit.php?id=<?php echo $post['id']?>">Editar</a>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

