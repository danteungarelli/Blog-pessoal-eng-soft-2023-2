<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/View/index.php';
require_once __DIR__ . '/../../src/controller/PostController.php';

class AddPostTest extends TestCase {
    public function testAddPostSuccess() {
        $_POST = [
            'titulo' => 'Teste de Título',
            'conteudo' => 'Conteúdo de teste',
            'assunto' => 'Teste Assunto',
            'slug' => 'teste-slug',
            'SubmitPost' => true,
        ];

        $_SESSION = [];

        PostController::addPost();
        
        $successMessage = "Postagem adicionada com sucesso!";
        $this->assertEquals($successMessage, $_SESSION['msg']);
    }
}