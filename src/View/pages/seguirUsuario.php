<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../../model/UserModel.php");
$id_seguido = $_GET['id'];


$model = new User_Model();

$model -> seguirUsuario($id_seguido);


echo '<script>window.history.back();</script>';
exit;
?>