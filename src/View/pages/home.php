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
                    </div>
                    <?php
                }
                ?>
            </div>
                
            <a href="http://localhost:8000/src/View/pages/addPost.php" class="Criar_Post">Criar Post</a>
    </div>
</body>
</html>