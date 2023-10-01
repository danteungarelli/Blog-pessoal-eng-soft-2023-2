<?php
session_start(); //Iniciar Sessão


// Limpar o buffer de redirecionamento
ob_start();

//Incluir arquivo para validar e recuperar token

require_once ("../index.php");

// Chamar função validar o token, se for false -> token é invalido e acessa o If
if(!validarToken()){
    //Criar mensagem de erro e atribuir para a variavel global
    $_SESSION['msg'] = "<p style='color: #f00;'> Erro: Necessário realizar o login para acessar adicionar uma publicação!</p>";
    echo("<script> window.alert('Erro: Necessário realizar o login para acessar a página!')</script>");
    //Redirecionar usuario para a pagina de login
    header("Location: login.php");

    //Parar o processamento da página
    exit();
}


// Fazer conexão com o banco de dados
include_once '../../config/connection.php';

// Verificar se o formulário foi enviado
if (isset($_POST['SubmitPost'])) {
    // Obtém os dados do formulário
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $autor_id = $user_id;
    $assunto = $_POST['assunto'];
    $slug = $_POST['slug'];

    $user_id = recuperarIDToken();

    $conexao = new Connection();
    $pdo = $conexao->getConnection();

    $autor_id = $user_id; // para pegar o id automaticamente

    // Prepare e execute a inserção no banco de dados
    $sql = "INSERT INTO postagens (titulo, conteudo, autor_id, assunto, slug) VALUES (:titulo, :conteudo, :autor_id, :assunto, :slug)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':conteudo', $conteudo);
    $stmt->bindParam(':autor_id', $autor_id);
    $stmt->bindParam(':assunto', $assunto);
    $stmt->bindParam(':slug', $slug);
    
    if ($stmt->execute()) {
        $_SESSION['msg'] = "<p style='color: #008000;'>Postagem adicionada com sucesso!</p>";
    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro ao adicionar postagem.</p>";
    }
    
    // Redirecione de volta à página de adição de postagem
    header("Location: addPost.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Postagem</title>
    
    <link rel="stylesheet" href="../css/addPost.css">

</head>
<body>

<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']); // Limpa a mensagem após exibi-la
}
?>

<div class="box">
    <form action="addPost.php" method="post">
        <fieldset>
            <legend><b>Adicionar Nova Postagem</b></legend>
            <br>

            <!-- Título -->
            <div class="InputBox">
                <input type="text" name="titulo" id="titulo" class="InputUser" required>
                <label for="titulo" class="labelInput">Título</label>
            </div>
            <br><br>

            <!-- Conteúdo -->
            <div class="InputBox">
                <textarea name="conteudo" id="conteudo" class="InputUser" required></textarea>
                <label for="conteudo" class="labelInput">Conteúdo</label>
            </div>  
            <br><br>
            
            <!-- Assunto -->
            <div class="InputBox">
                <input type="text" name="assunto" id="assunto" class="InputUser" required>
                <label for="assunto" class="labelInput">Assunto</label>
            </div>
            <br><br>

            <!-- Slug -->
            <div class="InputBox">
                <input type="text" name="slug" id="slug" class="InputUser" required>
                <label for="slug" class="labelInput">Slug</label>
            </div>
            <br><br>

            <input type="submit" name="SubmitPost" id="SubmitPost"><br><br>
        </fieldset>
    </form>
</div>

</body>
</html>
