<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <title>Resultados</title>
</head>
<body>
    <?php
    require_once("../../model/UserModel.php");
    $dados = $_GET['search'];
    if ($dados) {
        $user = new User_Model;
        $users = $user->buscarUsuarios($dados);
        $dados_usuario = $users[0];
    }
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
    <div class="container">
        <div class="text-center mt-3">
            <h1 class="display-4">Resultados</h1>
        </div>
        <div class="box-search mx-auto input-group" style="max-width: 300px;">
            <input type="search" class="form-control" placeholder="Pesquisar Usuário" id="pesquisar">
            <button class="btn btn-primary" onclick="searchData">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </div>
        <div class="row mt-3 justify-content-center">
            <?php
            if (!$users) {
                echo '<p class="no-users text-center">Usuário não encontrado</p>';
            }
            foreach ($users as $user) {
                ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $user['nome_user']; ?></h5>
                            <p class="card-text"><?php echo $user['nome_completo']; ?></p>
                            <button class="btn btn-primary" onclick="redirectToProfile(<?php echo $user['id_user']; ?>)">Acessar Perfil do Usuário</button>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        var search = document.getElementById('pesquisar');

        search.addEventListener("keydown", function (event) {
            if (event.key == "Enter") {
                searchData();
            }
        });

        function searchData() {
            window.location = 'resultados.php?search=' + search.value;
        }

        function redirectToProfile(idUser) {
            window.location = 'perfilDeOutro.php?id_user=' + idUser;
        }
    </script>
</body>
</html>
