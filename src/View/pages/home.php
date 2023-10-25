<?php
session_start(); //Iniciar Sessão


    // Limpar o buffer de redirecionamento
    ob_start();

    //Incluir arquivo para validar e recuperar token

    require_once ("../index.php");
    
    // Chamar função validar o token, se for false -> token é invalido e acessa o If
    if(!validarToken()){
        //Criar mensagem de erro e atribuir para a variavel global
        $_SESSION['msg'] = "<p style='color: #fff;'> Erro: Necessário realizar o login para acessar a página!</p>";
        echo("<script> window.alert('Erro: Necessário realizar o login para acessar a página!')</script>");
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
    $post = new User_Model();
    $post = $post -> postagens($id_user);
    $user = new User_Model();
    $user = $user -> usuarios($id_user);
    $dados_post = $post[0];
    $dados_usuario = $user[0];
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
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container mt-5">
    <div class="row justify-content-center">
        <?php foreach ($posts as $post) { ?>
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
                    </div>
                </div>

        </div>
        <?php } ?>
    </div>
</div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>