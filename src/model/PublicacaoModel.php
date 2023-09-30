<?php


require_once ("../../config/connection.php");

class PublicacaoModel {
    function addPost($titulo, $conteudo, $autor_id, $assunto, $slug) {

        try {
            $connect = new Connection();
            $connection = $connect->getConnection();
            
            $data_publicacao = date("Y-m-d H:i:s"); 

            $sql = "INSERT INTO postagens (titulo, conteudo, data_publicacao, autor_id, assunto, slug) VALUES (:titulo, :conteudo, :data_publicacao, :autor_id, :assunto, :slug)";
            
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':conteudo', $conteudo);
            $stmt->bindParam(':data_publicacao', $data_publicacao);
            $stmt->bindParam(':autor_id', $autor_id);
            $stmt->bindParam(':assunto', $assunto);
            $stmt->bindParam(':slug', $slug);
            
            $stmt->execute();
            
            return true; 
        } catch (PDOException $e) {
            // tratamento de erros aq
            return false; 
        }
    }
}
?>