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
    
            $conexao = new Connection();
            $pdo = $conexao->getConnection();
            $sql = "SELECT nome_user FROM usuario WHERE id_user = :usuario";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($resultado) {
                $nomeUsuario = $resultado['nome_user'];
            }

            $query = "SELECT * FROM notificacao WHERE userid = :id_user";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->execute();
            $existing_noti = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$existing_noti) {
                $numnoti = 0;
                $queryy = "INSERT INTO num_notificacao (user_id, cont) VALUES (:id_user, :numnoti)";
            $stmtt = $pdo->prepare($queryy);
            $stmtt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmtt->bindParam(':numnoti', $numnoti, PDO::PARAM_INT);
            $stmtt->execute();
            }

            $sql = "SELECT * FROM num_notificacao WHERE user_id = :id_user";
            $stm = $pdo->prepare($sql);
            $stm->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);

            $numnoti = $result['cont'];
            $numnoti++;

            $sql = "UPDATE num_notificacao SET cont = :numnoti  WHERE user_id = :id_user";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':numnoti', $numnoti, PDO::PARAM_INT);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->execute();

            $frase = " $nomeUsuario te seguiu";

            $queryy = "INSERT INTO notificacao (userid, conteudo) VALUES (:id_user, :frase)";
            $stmtt = $pdo->prepare($queryy);
            $stmtt->bindParam(':frase', $frase);
            $stmtt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmtt->execute();


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

    //mod
    function addComment($conteudo, $id_post, $user_id){

        try{
        $conexao = new Connection();
        $pdo = $conexao->getConnection();

        $sql = "SELECT nome_user FROM usuario WHERE id_user = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($resultado) {
                $nomeUsuario = $resultado['nome_user'];
            }
        $sql = "SELECT * FROM postagens WHERE id = :id_post";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(':id_post', $id_post, PDO::PARAM_INT);
         $stm->execute();
         $result = $stm->fetch(PDO::FETCH_ASSOC);
        
            if ($result) {
                $titulo = $result['titulo'];
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

            $frase = " $nomeUsuario comentou no seu post de título $titulo ";

            $queryy = "INSERT INTO notificacao (userid, conteudo) VALUES (:idAutor, :frase)";
            $stmtt = $pdo->prepare($queryy);
            $stmtt->bindParam(':frase', $frase);
            $stmtt->bindParam(':idAutor', $idAutor, PDO::PARAM_INT);
            $stmtt->execute();
        

        $sql = "INSERT INTO comentarios (conteudo, idpost, id_user, nome_user) VALUES (:conteudo, :id_post, :user_id, :nomeUsuario)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':conteudo', $conteudo, PDO::PARAM_STR);
        $stmt->bindParam(':id_post', $id_post, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        // Em caso de erro, imprime o erro e retorna false
        echo "Erro: " . $e->getMessage();
        return false;
    }
    }

    function comentarios($id){

        $connect = new Connection ();

        $sql = $connect -> getConnection () -> query ("SELECT * FROM comentarios WHERE idpost = '$id'");
        $sql = $sql -> fetchAll (PDO::FETCH_ASSOC);

        return $sql;


    }

    function contComments($id){

        $connect = new Connection ();
        $pdo = $connect->getConnection();

        $sql = "SELECT COUNT(*) AS numComments FROM comentarios WHERE idpost = :id";
         $stmt = $pdo->prepare($sql);
         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);

         return $result['numComments'];


    }

    public function perfisSeguidos($id_user) {
        $conexao = new Connection();
        $pdo = $conexao->getConnection();
    
        $sql = "SELECT id_seguido FROM seguir WHERE id_usuario = :id_user";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
    
        // Verifica se a consulta foi bem-sucedida antes de obter os resultados
        if ($stmt !== false) {
            // Retorna os IDs dos perfis seguidos
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return is_array($result) ? $result : [];
        } else {
            // Trate o caso em que a consulta falhou (retorna um array vazio ou outro valor apropriado)
            return [];
        }
    }
    function silenciarUsuario($id_usuario, $id_seguido) {
        $connect = new Connection();
    
        $sql = $connect->getConnection()->prepare("UPDATE seguir SET silenciado = TRUE WHERE id_usuario = :usuario AND id_seguido = :id_seguido");
        $sql->bindParam(':usuario', $id_usuario, PDO::PARAM_INT);
        $sql->bindParam(':id_seguido', $id_seguido, PDO::PARAM_INT);
        $sql->execute();
    }
    
    function desilenciarUsuario($id_usuario, $id_seguido) {
        $connect = new Connection();
    
        $sql = $connect->getConnection()->prepare("UPDATE seguir SET silenciado = FALSE WHERE id_usuario = :usuario AND id_seguido = :id_seguido");
        $sql->bindParam(':usuario', $id_usuario, PDO::PARAM_INT);
        $sql->bindParam(':id_seguido', $id_seguido, PDO::PARAM_INT);
        $sql->execute();
    }

    function verificarSilenciado($usuario_id, $usuario_silenciado_id) {
        $connect = new Connection();
        $usuario = recuperarIDToken();
    
        $query = "SELECT silenciado FROM seguir WHERE id_usuario = :usuario_id AND id_seguido = :usuario_silenciado_id";
        $stmt = $connect->getConnection()->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_silenciado_id', $usuario_silenciado_id, PDO::PARAM_INT);
    
        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                return (bool)$result['silenciado'];
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Erro ao executar a consulta SQL: " . $e->getMessage());
            return false;
        }
    }
    

}


/*
    $user = new User_Model();

    $user = $user -> Login ("joaovictor@email.com");

    $nome = $user [0];
    print_r ($nome ["email"]);  
*/

?>

