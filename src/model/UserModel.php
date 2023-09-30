<?php


require_once ("../../config/connection.php");


class User_Model {

    function Login($email){

        $connect = new Connection ();

        $sql = $connect -> getConnection () -> query ("SELECT * FROM usuario WHERE email = '$email'");
        $sql = $sql -> fetchAll (PDO::FETCH_ASSOC);

        return $sql;


    }
}

?>

