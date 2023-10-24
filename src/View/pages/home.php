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
                    <a href="http://localhost:8000/src/View/pages/notificacao.php" class="Notificacao"><?php echo $resul['cont']; ?> Notificações</a>
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
            <div class="filtro-bar">
                <link rel="stylesheet" href="../css/filtro.css">
                <a href="home.php">Ver Todos</a>
                <a href="home.php?assunto=Futebol">Futebol</a>
                <a href="home.php?assunto=Notícia">Notícias</a>
                <a href="home.php?assunto=Carros">Carros</a>
                <a href="home.php?assunto=Música">Música</a>
                <a href="home.php?assunto=Filmes e Series">Filmes e Séries</a>
                <a href="home.php?assunto=Política">Politica</a>
                <!-- Adicione mais links para os outros assuntos -->
            
            </div>

            <div class="content">
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
                    <svg id="icon" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg> 
                    <div class="post_user">
                        <p class="post_autor"><?php echo $dados_usuario['nome_user']; ?></p>
                        <p class="post_title"><?php echo $post['titulo']; ?></p>
                    </div>  
                    
                    <div class="post_box">
                        <p class="conteudo"><?php echo $post['conteudo']; ?></p>
                        
                        <!-- Botão/link "Ver Detalhes" que leva para verPost.php com o ID do post como parâmetro -->
                         <a href='verPost.php?id_post=<?php echo $post['id']; ?>'>Ver Detalhes</a>


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

                        <!--botão de curtir post -->
                        <form action="http://localhost:8000/src/View/pages/curtirPost.php?id=<?php echo $post['id']?>" method="post">
                           <button type="submit" name="like" value="like" class="like-button <?php echo $buttonClass; ?>">
                          <i class="fas fa-heart"></i>
                          <?php  echo "$numlikes &#9829"; ?>
                            </button>
                        </form>

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
                }
                ?>
            </div>
                
            
    </div>
</body>
</html>