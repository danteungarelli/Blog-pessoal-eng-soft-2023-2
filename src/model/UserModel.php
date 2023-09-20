<?php


require_once ("../../config/connection.php");


class User_Model {

    function Login($email){

        $connect = new Connection ();

        $sql = $connect -> getConnection () -> query ("SELECT * FROM usuarios WHERE email = '$email'");
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

