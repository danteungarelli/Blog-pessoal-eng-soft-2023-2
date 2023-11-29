<?php

require_once __DIR__ . '/../config/connection.php';

class PostController {
    public static function addPost(): void {
        if (isset($_POST['SubmitPost'])) {
            $titulo = $_POST['titulo'];
            $conteudo = $_POST['conteudo'];
            $assunto = $_POST['assunto'];
            $slug = $_POST['slug'];

            $conexao = new Connection();
            $pdo = $conexao->getConnection();

            $user_id = recuperarIDToken();

            $autor_id = $user_id;

            $sql = "INSERT INTO postagens (titulo, conteudo, autor_id, assunto, slug) VALUES (:titulo, :conteudo, :autor_id, :assunto, :slug)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':conteudo', $conteudo);
            $stmt->bindParam(':autor_id', $autor_id);
            $stmt->bindParam(':assunto', $assunto);
            $stmt->bindParam(':slug', $slug);

            if ($stmt->execute()) {
                $_SESSION['msg'] = "Postagem adicionada com sucesso!";
            } else {
                $_SESSION['msg'] = "Erro ao adicionar postagem.";
            }
        }
    }
}