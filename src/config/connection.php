
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

/*SELECT * FROM postagens

SELECT * FROM usuario

ALTER TABLE

INSERT INTO postagens (id, titulo, conteudo, data_publicacao, autor_id, assunto, slug)
VALUES ('2','Segundo Post', 'Fall.

You are alone, Child.

There is only darkness for you, and only death for your people. These ancients are just the beginning. I will command a great and terrible army and we will sail to a billion worlds. We will sail until every light has been extinguished.

You are strong, Child, but I am beyond strength.

I am the end, and I have come for you, Finn.', '2023-09-30', '1', 'Adventure Time', 'cartoom')
*/
?>
