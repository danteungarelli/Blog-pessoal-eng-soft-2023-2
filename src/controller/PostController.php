<?php

session_start();
ob_start();

echo getcwd();

require_once ("../../model/PublicacaoModel.php");


class PostController {
    function addPost($titulo, $conteudo, $autor_id, $assunto, $slug) {
        $post_model = new PublicacaoModel();
        
        if ($post_model->addPost($titulo, $conteudo, $autor_id, $assunto, $slug)) {
            $_SESSION['msg'] = "<p style='color: #008000;'>Postagem adicionada com sucesso!</p>";
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro ao adicionar postagem.</p>";
        }

        header("Location: ../pages/addPost.php"); 
        exit();
    }
}
?>
