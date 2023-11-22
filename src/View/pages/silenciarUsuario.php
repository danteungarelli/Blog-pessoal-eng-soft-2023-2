<?php
require_once("../../model/UserModel.php"); 
session_start();

$id_user = recuperarIDToken();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $usuario_silenciado_id = intval($_GET['id']); 

        $model = new User_Model();
        $silenciado = $model->verificarSilenciado($id_user, $usuario_silenciado_id);

        if ($silenciado) {
            $model->desilenciarUsuario($id_user, $usuario_silenciado_id);
        } else {
            $model->silenciarUsuario($id_user, $usuario_silenciado_id);
        }

        header("Location: perfilDeOutro.php?id_user=$usuario_silenciado_id");
        exit();
    }
}

header("Location: home.php");
exit();
?>
