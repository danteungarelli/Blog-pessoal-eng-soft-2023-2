<?php

require_once ("../../model/UserModel.php");

class UserController {
    
    function verifyLogin ($email){

        $user = new User_Model();
        $user = $user -> Login($email);

        if(isset($user[0])){


            $data = $user[0];

            if($data["email"] == $email){
                return 1;
            }
            else{
                return 0;
            }
        }
        else{
            return 0;
        }


    }


    function verifyPassword ($email, $senha){

        $user = new User_Model();
        $user = $user -> Login($email);

        if(isset($user[0])){

            $data = $user[0];
            /*echo ("banco de dados".$data["senha"]);*/
          
            if($data["senha"] == $senha){
                return 1;
            }
            else{
                return 0;
            }
    
        }
        else{
            return 0;
        }


    }

}

/*
    $user = new UserController();

    $user = $user -> verifyLogin("joaovictor@email.com");
    echo ($user);
*/
?>