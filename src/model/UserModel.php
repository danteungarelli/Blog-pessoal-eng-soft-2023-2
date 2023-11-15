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


}


/*
    $user = new User_Model();

    $user = $user -> Login ("joaovictor@email.com");

    $nome = $user [0];
    print_r ($nome ["email"]);  
*/

?>

