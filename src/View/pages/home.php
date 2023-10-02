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
    <title>Pagina de Perfil</title>

    <link rel="stylesheet" href="../css/home.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
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

    <div class="Tela_Home">

        <div class="top_box">
            <div class="menu-button" onclick="toggleSidebar()">
                <div class="container" onclick="myFunction(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
                <script>
                    function myFunction(x) {
                    x.classList.toggle("change");
                    }
                </script>
                        
                <div class="sidebar">
                            <!-- Conteúdo da barra lateral, como links -->
                    <a href="http://localhost:8000/src/View/pages/perfil.php" class="link">Meu Perfil</a>
                    <a href="http://localhost:8000/src/View/pages/addPost.php" class="Criar_Post">Criar Post</a>
                    <a href='logout.php'>Sair</a><br></p>
                </div>

                        <!-- Seu JavaScript para controlar o menu -->
                <script>
                    function toggleSidebar() {
                            var sidebar = document.querySelector(".sidebar");
                            var content = document.querySelector(".content");
                            var top_box = document.querySelector(".top_box")
                        sidebar.classList.toggle("show");
                        content.classList.toggle("adjusted");
                        top_box.classList.toggle("adjusted")
                    }
                </script>
            </div>
            
            <p><h1 class="title">Home</h1></p>
        </div> 

            <div class="content">
                <?php
                // Loop para exibir todos os posts do usuário
                foreach ($posts as $post) {
                ?>
                    <div class="post_user">
                        <p class="post_title"><?php echo $post['titulo']; ?></p>
                        <p class="post_autor"><?php echo $dados_usuario['nome_user']; ?></p>
                    </div>  
                    
                    <div class="post_box">
                        <p><?php echo $post['conteudo']; ?></p>

                        <!-- Ícone da Lixeira -->
                        <a href="http://localhost:8000/src/View/pages/confirmarExclusao.php?id=<?php echo $post['id']?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>

                        </a>

                        <!-- Ícone de editar -->
                        <a href="http://localhost:8000/src/View/pages/edit.php?id=<?php echo $post['id']?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                           <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>

                        </a>

                    </div>
                    <?php
                }
                ?>
            </div>
                
            
    </div>
</body>
</html>