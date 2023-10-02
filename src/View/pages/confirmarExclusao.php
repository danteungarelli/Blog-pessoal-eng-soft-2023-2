<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Aviso</title>
</head>
<body>
    <?php
    $id = $_GET['id'];
    ?>
    <h1>AVISO</h1>
    
    <div>Deseja realmente excluir esta publicação?<br><br>
    <a href="http://localhost:8000/src/View/pages/deletePost.php?id=<?php echo $id;?>">Sim</a>
    <a style="color:crimson" href="http://localhost:8000/src/View/pages/home.php">Cancelar</a>
    </div>
    
</body>
</html>