<?php


require_once ("../../config/connection.php");


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

    function notificacoes($id){

        $connect = new Connection ();

        $sql = $connect -> getConnection () -> query ("SELECT * FROM notificacao WHERE userid = '$id'");
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

