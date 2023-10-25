<?php
session_start();
ob_start();
require_once ("../index.php");

if (!validarToken()) {
    $_SESSION['msg'] = "<p style='color: #f00;'> Erro: Necessário realizar o login para acessar a edição de postagem!</p>";
    echo("<script> window.alert('Erro: Necessário realizar o login para acessar a página!')</script>");
    header("Location: login.php");
    exit();
}

include_once '../../config/connection.php';

if (!empty($_GET['id'])) {
    $post_id = $_GET['id'];
    $conexao = new Connection();
    $pdo = $conexao->getConnection();

    // Consulta para recuperar os dados da postagem a ser editada
    $sql = "SELECT * FROM postagens WHERE id = :post_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->execute();
    $postagem = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$postagem) {
        $_SESSION['msg'] = "<p style='color: #f00;'> Postagem não encontrada!</p>";
        header("Location: home.php "); // Redirecionar para a lista de postagens
        exit();
    }
}

if (isset($_POST['SubmitEditPost'])) {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $assunto = $_POST['assunto'];
    $slug = $_POST['slug'];
    if (!empty($_GET['id'])){
        $post_id = $_GET['id'];
    }
    $conexao = new Connection();
    $pdo = $conexao->getConnection();

    // Consulta para atualizar os dados da postagem
    $sql = "UPDATE postagens SET titulo = :titulo, conteudo = :conteudo, assunto = :assunto, slug = :slug WHERE id = :post_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    $stmt->bindParam(':conteudo', $conteudo, PDO::PARAM_STR);
    $stmt->bindParam(':assunto', $assunto, PDO::PARAM_STR);
    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: home.php");
        $_SESSION['msg'] = "<p style='color: #008000;'>Postagem atualizada com sucesso!</p>";

    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro ao atualizar postagem.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Postagem</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Editar Postagem</h1>
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="edit.php?id=<?php echo $post_id; ?>" method="post">
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" required value="<?php echo $postagem['titulo']; ?>">
                </div>
                
                <div class="form-group">
                    <label for="conteudo">Conteúdo</label>
                    <textarea name="conteudo" id="conteudo" class="form-control" required><?php echo $postagem['conteudo']; ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <input type="text" name="assunto" id="assunto" class="form-control" required value="<?php echo $postagem['assunto']; ?>">
                </div>
                
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" required value="<?php echo $postagem['slug']; ?>">
                </div>
                
                <div class="text-center">
                    <button type="submit" name="SubmitEditPost" class="btn btn-primary">Salvar Alterações</button>
                    <a href="home.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
