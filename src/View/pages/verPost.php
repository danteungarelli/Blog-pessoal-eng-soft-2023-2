<?php
session_start();
ob_start();

// Inclua o arquivo que contém a definição da variável $pdo

require_once ("../index.php");


// Verifique se o usuário está autenticado antes de permitir o acesso a esta página
if (!isset($_COOKIE['token']) || !validarToken()) {
    // Redirecionar para a página de login ou exibir uma mensagem de erro
    header("Location: login.php");
    exit; // Encerrar a execução do script
}

// Verifique se o parâmetro id_post foi fornecido na URL
if (isset($_GET['id_post'])) {
    // Recupere o ID do post da URL
    $id_post = $_GET['id_post'];

    // Conecte-se ao banco de dados
    include_once '../../config/connection.php';
    
    $conexao = new Connection();
    $pdo = $conexao->getConnection();

    // Consulta SQL para obter os detalhes do post com base no ID
    $sql = "SELECT * FROM postagens WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id_post, PDO::PARAM_INT);
    $stmt->execute();

    // Verifique se o post foi encontrado
    if ($stmt->rowCount() > 0) {
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        // Agora você pode exibir os detalhes do post
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>Id do post</td>";
        echo "<td>Título</td>";
        echo "<td>Conteúdo</td>";
        echo "<td>Data de publicação</td>";
        echo "<td>Id do autor</td>";
        echo "<td>Assunto</td>";
        echo "<td>Slug</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>{$post['id']}</td>";
        echo "<td>{$post['titulo']}</td>";
        echo "<td>{$post['conteudo']}</td>";
        echo "<td>{$post['data_publicacao']}</td>";
        echo "<td>{$post['autor_id']}</td>";
        echo "<td>{$post['assunto']}</td>";
        echo "<td>{$post['slug']}</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "Post não encontrado";
    }
} else {
    echo "ID do post não especificado na URL";
}
?>
    





