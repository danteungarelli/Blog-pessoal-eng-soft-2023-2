<?php
session_start();
include '../../config/connection.php';
include_once '../../model/UserModel.php';

ob_start();

require_once ("../index.php");

if(!validarToken()){
    $_SESSION['msg'] = "<p style='color: #f00;'> Erro: Necessário realizar o login para acessar adicionar uma publicação!</p>";
    echo("<script> window.alert('Erro: Necessário realizar o login para acessar a página!')</script>");
    header("Location: login.php");

    exit();
}

if (!empty($_GET['id'])) {
    // Recupere o ID da postagem e o ID do usuário da sessão
    $post_id = $_GET['id'];
    $user_id = recuperarIDToken();


    try {

        $conexao = new Connection();
        $pdo = $conexao->getConnection();

        // Verifique se o usuário já curtiu este post
        $query = "SELECT * FROM likes WHERE id_post = :post_id AND id_usuario = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $existing_like = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$existing_like) {
            // O usuário ainda não curtiu este post, então registre a curtida
            $query = "INSERT INTO likes (id_post, id_usuario) VALUES (:post_id, :user_id)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();


            // pegando usuario da curtida

            $sql = "SELECT nome_user FROM usuario WHERE id_user = :user_id";
            $stm = $pdo->prepare($sql);
            $stm->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stm->execute();
            $resultado = $stm->fetch(PDO::FETCH_ASSOC);
        
            if ($resultado) {
                $nomeUsuario = $resultado['nome_user'];
            }
 
            // pegando titulo da postagem

            $sql = "SELECT titulo FROM postagens WHERE id = :post_id";
            $stm = $pdo->prepare($sql);
            $stm->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
        
            if ($result) {
                $titulo = $result['titulo'];
            }

            // pegando o autor da postagem
            $sql = "SELECT autor_id FROM postagens WHERE id = :post_id";
            $stm = $pdo->prepare($sql);
            $stm->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
        
            if ($result) {
                $idAutor = $result['autor_id'];
            }
           
            $query = "SELECT * FROM notificacao WHERE userid = :idAutor";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':idAutor', $idAutor, PDO::PARAM_INT);
            $stmt->execute();
            $existing_noti = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$existing_noti) {
                $numnoti = 0;
                $queryy = "INSERT INTO num_notificacao (user_id, cont) VALUES (:idAutor, :numnoti)";
            $stmtt = $pdo->prepare($queryy);
            $stmtt->bindParam(':idAutor', $idAutor, PDO::PARAM_INT);
            $stmtt->bindParam(':numnoti', $numnoti, PDO::PARAM_INT);
            $stmtt->execute();
            }

            $sql = "SELECT * FROM num_notificacao WHERE user_id = :idAutor";
            $stm = $pdo->prepare($sql);
            $stm->bindParam(':idAutor', $idAutor, PDO::PARAM_INT);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);

            $numnoti = $result['cont'];
            $numnoti++;

            $sql = "UPDATE num_notificacao SET cont = :numnoti  WHERE user_id = :idAutor";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':numnoti', $numnoti, PDO::PARAM_INT);
            $stmt->bindParam(':idAutor', $idAutor, PDO::PARAM_INT);
            $stmt->execute();



            $frase = " (&#9829) $nomeUsuario curtiu seu post de título $titulo ";

            $queryy = "INSERT INTO notificacao (userid, conteudo) VALUES (:idAutor, :frase)";
            $stmtt = $pdo->prepare($queryy);
            $stmtt->bindParam(':frase', $frase);
            $stmtt->bindParam(':idAutor', $idAutor, PDO::PARAM_INT);
            $stmtt->execute();

        } else{
            $sqlDelete = $conexao -> getConnection() -> query("DELETE FROM likes WHERE id_post = $post_id AND id_usuario =$user_id");
        }

        // Redirecione para a página da postagem após a ação
        echo '<script>window.history.back();</script>';
        exit;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

    $conexao = null;
} else {

}
?>

<script>window.history.back();</script>
