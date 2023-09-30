<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Postagem</title>
</head>
<body>
    <h1>Adicionar Nova Postagem</h1>

    <form method="POST" action="../../controller/PostController.php">
    <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>
        <br><br>

        <label for="conteudo">Conteúdo:</label>
        <textarea id="conteudo" name="conteudo" required></textarea>
        <br><br>

        <label for="autor_id">ID do Autor:</label>
        <input type="number" id="autor_id" name="autor_id" required>
        <br><br>

        <label for="assunto">Assunto:</label>
        <input type="text" id="assunto" name="assunto" required>
        <br><br>

        <label for="slug">Slug:</label>
        <input type="text" id="slug" name="slug" required>
        <br><br>

        <input type="submit" value="Adicionar Postagem">
    </form>
</body>
</html>
