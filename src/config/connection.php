
<?php

class Connection{

    function getConnection () {
        $host = 'localhost'; // Endereço do servidor PostgreSQL
        $port = '5432';      // Porta do PostgreSQL (normalmente 5432)
        $dbname = 'Blog_Pessoal'; // Nome do banco de dados
        $user = 'postgres';          // Nome de usuário do PostgreSQL
        $password = '1234';        // Senha do PostgreSQL
        

        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);

        
        
        return $pdo;
        
    }
    
}

?>
