<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/resultados.css">
    <title>Resultados</title>
</head>
<body>

<?php
    
        require_once("../../model/UserModel.php");
        
        $dados = $_GET['search'];
        if($dados){
            $user = new User_Model;
            $users = $user -> buscarUsuarios($dados);
            $dados_usuario = $users[0];

        }
        

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
    
    <p><h1 class="title" onclick="voltarParaHome()">Resultados</h1></p>
    
<!--BARRA DE PESQUISA-->    
</div> 
    <br><br>
    <div class="box-search">
        <input type="search" class="form-control" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
    <br>
<!--BARRA DE PESQUISA-->  
    



<!-- Listar Usuarios-->
<div class="content">
                <?php

                if(!$users){
                    echo '<p class="no-users">Usuário não encontrado</p>';
                }
                // Loop para exibir todos os posts do usuário
                foreach ($users as $user) {
                    ?>
                    <div class="post_user">
                        <p class="post_title"><?php echo $user['nome_user']; ?></p>
                        <p class="post_autor"><?php echo $user['nome_completo']; ?></p>
                    </div>  
                    <div class="post_box">
                        <button onclick="redirectToProfile(<?php echo $user['id_user']; ?>)">Acessar Perfil do Usuário</button>
                    </div>
                    <?php
                }
                ?>
            </div>





        
    
</div>
</body>

<!--FUNÇÕES-->  
<script>

var search = document.getElementById('pesquisar');

search.addEventListener("keydown", function(event){
if(event.key == "Enter"){
    searchData();
}
});

function searchData(){
window.location = 'resultados.php?search='+search.value;
}

function voltarParaHome(){
    window.location.href="home.php"
    exit;
}

function redirectToProfile(idUser) {
        // Redireciona para a página perfilDeOutro.php com o parâmetro "id_user" via GET
        window.location = 'perfilDeOutro.php?id_user=' + idUser;
    }
</script>
<!--FUNÇÕES-->  
</html>