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
    <!-- Resto do código de cabeçalho -->
</head>
<body>
<?php

?>

<div class="box">
    <form action="edit.php?id=<?php echo $post_id; ?>" method="post">
        <fieldset>
            <legend><b>Editar Postagem</b></legend>
            <br>

            <!-- Campos de edição da postagem com valores preenchidos a partir do banco de dados -->
            <div class="InputBox">
                <input type="text" name="titulo" id="titulo" class="InputUser" required value="<?php echo $postagem['titulo']; ?>">
                <label for="titulo" class="labelInput">Título</label>
            </div>
            <br><br>

            <!-- Campos de edição para outros atributos da postagem -->
            <div class="InputBox">
                <textarea name="conteudo" id="conteudo" class="InputUser" required><?php echo $postagem['conteudo']; ?></textarea>
                <label for="conteudo" class="labelInput">Conteúdo</label>
            </div>  
            <br><br>

            <div class="InputBox">
                <input type="text" name="assunto" id="assunto" class="InputUser" required value="<?php echo $postagem['assunto']; ?>">
                <label for="assunto" class="labelInput">Assunto</label>
            </div>
            <br><br>

            <div class="InputBox">
                <input type="text" name="slug" id="slug" class="InputUser" required value="<?php echo $postagem['slug']; ?>">
                <label for="slug" class="labelInput">Slug</label>
            </div>

            <br><br>

      <input type="submit" name="SubmitEditPost" id="SubmitEditPost"><br><br>
      <a href="http://localhost:8000/src/View/pages/home.php" class="link" style="color: #7F40B0;">Cancelar alteração</a>
      


</fieldset>
    </form>
</div>

</body>
</html>


           
