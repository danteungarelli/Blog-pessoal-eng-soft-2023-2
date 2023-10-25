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
    <title>Pagina de Perfil</title>

    <link rel="stylesheet" href="../css/perfil.css">
    
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

    <div class="top_box">
        <p id="home_top"><a href="http://localhost:8000/src/View/pages/home.php" class="link" style="color: black;">Home</a></p>
        <p id="user_top">@<?php echo $dados_usuario['nome_user'];?></p>
       
        
    </div>

   

    <div class="perfil_info">
        <span>
            <svg id="icon_perfil" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg> 
            
        </span>

        
        </span>
            <div class="bio_user"> 

                <p id="user">@<?php echo $dados_usuario['nome_user'];?></p>
                
                
                
                <p id="bio"><?php echo $dados_usuario['bio']; ?></p>
            </div>
        <span>

        <span>
            <div class="seguidor">
                <p id="seg">Seguidores: 120</p>
                <p id="seg">&nbsp;Seguindo: 200&nbsp;</p>
            </div>
        </span>
            
    </div>
        
        
    <div class="perfil_box">

        
        <div id="post_box">
            <p>Posts</p>
        </div>
        <div id="comentario_box">
            <p>Realizar Logout? <a href='logout.php'>Sair</a><br></p>
        </div>
        <div id="curtida_box">
            <p>Curtidas</p>
        </div>
    </div>

    <div class="content">
                <?php
                // Loop para exibir todos os posts do usuário
                foreach ($posts as $post) {
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
         

                    </div>
                    <?php
                }
                ?>
    </div>


   


</body>
</html>

