<?php


require_once ("../../config/connection.php");

require_once ("../../View/index.php");

class User_Model {

    function Login($email){

        $connect = new Connection ();

        $sql = $connect -> getConnection () -> query ("SELECT * FROM usuario WHERE email = '$email'");
        $sql = $sql -> fetchAll (PDO::FETCH_ASSOC);

        return $sql;


    }

    function postagens($id){
        $connect = new Connection();

        $sql = $connect -> getConnection () -> query ("SELECT * FROM postagens WHERE autor_id = '$id'");
        $sql = $sql -> fetchAll (PDO::FETCH_ASSOC);

        return $sql;
    }

    function usuarios($id){

        $connect = new Connection ();

        $sql = $connect -> getConnection () -> query ("SELECT * FROM usuario WHERE id_user = '$id'");
        $sql = $sql -> fetchAll (PDO::FETCH_ASSOC);

        return $sql;


    }

    function buscarUsuarios($parametro){

        $connect = new Connection ();

        $sql = $connect -> getConnection () -> query (
            "SELECT * FROM usuario WHERE nome_user Like'%$parametro%' or nome_completo LIKE'%$parametro%' ORDER BY id_user"
        );
        $sql = $sql -> fetchAll (PDO::FETCH_ASSOC);

        return $sql;


    }

    function notificacoes($id){

        $connect = new Connection ();

        $sql = $connect -> getConnection () -> query ("SELECT * FROM notificacao WHERE userid = '$id'");
        $sql = $sql -> fetchAll (PDO::FETCH_ASSOC);

        return $sql;


    }

    function verificarSeguir($id_user){
        $connect = new Connection ();

        $usuario = recuperarIDToken();

        $sql = $connect -> getConnection () -> prepare ("SELECT * FROM seguir WHERE id_usuario = '$usuario' and id_seguido ='$id_user'");
        $sql -> execute();

        if ($sql !== false) {
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    
            if(count($result) > 0){
                return true;
            } 
            else {
                return false;
            }
        } 
    }


    function seguirUsuario($id_user){
        $connect = new Connection ();

        $usuario = recuperarIDToken();

        
        if($this->verificarSeguir($id_user)){
            $sql = $connect->getConnection()->prepare("DELETE FROM seguir WHERE id_usuario = :usuario and id_seguido = :id_user");
            $sql->bindParam(':usuario', $usuario, PDO::PARAM_INT);
            $sql->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $sql->execute();
            

        }
        else{

            $sql = $connect->getConnection()->prepare("INSERT INTO seguir (id_usuario, id_seguido) VALUES (:usuario, :id_user)");
            $sql->bindParam(':usuario', $usuario, PDO::PARAM_INT);
            $sql->bindParam(':id_user', $id_user, PDO::PARAM_INT);

            $sql -> execute();

            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    

        }
    }


    function contarSeguidores($id_user){
        $connect = new Connection ();

        $sql = $connect -> getConnection () -> prepare ("SELECT COUNT(*) AS num_seguidores FROM seguir WHERE id_seguido = :id_user");
        $sql->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $sql -> execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result['num_seguidores'];


    }
    

    function contarSeguindo($id_user){
        $connect = new Connection ();

        $sql = $connect -> getConnection () -> prepare ("SELECT COUNT(*) AS num_seguindo FROM seguir WHERE id_usuario = :id_user");
        $sql->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $sql -> execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result['num_seguindo'];


    }

     function salvarPost($id_user, $id_post) {
        $conexao = new Connection();
        $pdo = $conexao->getConnection();

        // Verifica se o post já está salvo pelo usuário
        $query = "SELECT * FROM posts_salvos WHERE id_usuario = :id_usuario AND id_post = :id_post";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_usuario', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_post', $id_post, PDO::PARAM_INT);
        $stmt->execute();
        $existing_save = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_save) {
            // Se já estiver salvo, remove o salvamento
            $query = "DELETE FROM posts_salvos WHERE id_usuario = :id_usuario AND id_post = :id_post";
        } else {
            // Se não estiver salvo, adiciona o salvamento
            $query = "INSERT INTO posts_salvos (id_usuario, id_post) VALUES (:id_usuario, :id_post)";
        }

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_usuario', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_post', $id_post, PDO::PARAM_INT);
        $stmt->execute();

        // Retorna o status (salvou ou desfez o salvamento)
        return !$existing_save;
    }

    function postsSalvos($id_user){
        $conexao = new Connection();
        $pdo = $conexao->getConnection();

        // Consulta SQL para obter todos os IDs dos posts salvos pelo usuário
        $query = "SELECT id_post FROM posts_salvos WHERE id_usuario = :id_usuario";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_usuario', $id_user, PDO::PARAM_INT);
        $stmt->execute();

        // Retorna os IDs dos posts salvos
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function postagensSalvos($id_post){
        $connect = new Connection();

        $sql = $connect -> getConnection () -> query ("SELECT * FROM postagens WHERE id = '$id_post'");
        $sql = $sql -> fetchAll (PDO::FETCH_ASSOC);

        return $sql;
    }

}


/*
    $user = new User_Model();

    $user = $user -> Login ("joaovictor@email.com");

    $nome = $user [0];
    print_r ($nome ["email"]);  
*/

?>

