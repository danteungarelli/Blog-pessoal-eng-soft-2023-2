<?php 

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/View/index.php';
require_once __DIR__ . '/../../src/model/UserModel.php';

class ContarSeguidoresTest extends TestCase{


    
    public function testSeeIFReturnsInt(){
        

        $user_model = new User_Model;
        $retorno = $user_model -> contarSeguidores(100000);


        //verifica se o retorno é do tipo inteiro
        $this->assertEquals(gettype($retorno), gettype(42));
        
    }
}


?>