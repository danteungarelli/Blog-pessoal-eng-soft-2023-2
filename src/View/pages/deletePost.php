<?php
session_start(); 

ob_start();

require_once ("../index.php");

if(!validarToken()){
    $_SESSION['msg'] = "<p style='color: #f00;'> Erro: Necessário realizar o login para acessar adicionar uma publicação!</p>";
    echo("<script> window.alert('Erro: Necessário realizar o login para acessar a página!')</script>");
    header("Location: login.php");

    exit();
}

include_once '../../model/UserModel.php';
include_once '../../config/connection.php';

$id = recuperarIDToken();
$id_postagem = $_GET['id'];


$conexao = new Connection();
$pdo = $conexao->getConnection();
$postagens = $conexao -> getConnection () -> query ("SELECT * FROM postagens WHERE autor_id = '$id' AND id =$id_postagem");
$postagens = $postagens -> fetchAll (PDO::FETCH_ASSOC);

$idpost = $id_postagem;
$query = "SELECT * FROM likes WHERE id_post = :idpost";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':idpost', $idpost, PDO::PARAM_INT);
$stmt->execute();


if($postagens != NULL){
    
    $sqlDeleteLike = $conexao -> getConnection() -> query("DELETE FROM likes WHERE id_post = $idpost");
    $sqlDelete = $conexao -> getConnection() -> query("DELETE FROM postagens WHERE autor_id = '$id' AND id =$id_postagem");
    
}
else{
    $_SESSION['msg'] = "<p style='color: #f00;'> Erro: Não foi possível realizar esta ação!</p>";
}

header("Location: home.php");






//$resultado = pdo->get
?>