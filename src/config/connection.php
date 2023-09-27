
<?php

class Connection{

    function getConnection () {
        $host = 'es2023.c2ilbkbfxdr2.us-east-1.rds.amazonaws.com'; // Endereço do servidor PostgreSQL
        $port = '5432';      // Porta do PostgreSQL (normalmente 5432)
        $dbname = 'postgres'; // Nome do banco de dados
        $user = 'root';          // Nome de usuário do PostgreSQL
        $password = 'password';        // Senha do PostgreSQL
        

        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);

        
        
        return $pdo;
        
    }
    
}

?>
