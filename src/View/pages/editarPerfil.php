<?php

    session_start();
    ob_start();
    require_once ("../index.php");

    if (!validarToken()) {
        $_SESSION['msg'] = "<p style='color: #f00;'> Erro: Necessário realizar o login para acessar a edição de postagem!</p>";
        echo("<script> window.alert('Erro: Necessário realizar o login para acessar a página!')</script>");
        header("Location: login.php");
        exit();
    }
?>
    

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
</head>
<body>
    <?php
        require_once '../../model/UserModel.php';
        require_once '../../config/connection.php';

        $user_id = recuperarIDToken();
        $user = new User_Model();
        $user = $user -> usuarios($user_id);


   
     
        
       $conexao = new Connection();
       $pdo = $conexao->getConnection();
       $usuario = $conexao -> getConnection () -> query ("SELECT * FROM usuario WHERE id_user = '$user_id'");
       $usuario = $usuario -> fetchAll (PDO::FETCH_ASSOC);
     

       $sql = "SELECT * FROM usuario WHERE id_user = :user_id";
       $stmt = $pdo->prepare($sql);
       $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
       $stmt->execute();
       $dados_user = $stmt->fetch(PDO::FETCH_ASSOC);
       
        
       
        
      
       
        
      
        //nome_completo
        //nome_user
        //senha
        //sexo
        //data_nascimento
        //bio

       
        // Consulta para recuperar os dados da postagem a ser editada
        
        if (isset($_POST['SubmitEditPost'])) {
            $nome_completo = $_POST['nome_completo'];
            $nome_user = $_POST['nome_user'];
            $senha = $_POST['senha'];
            $sexo = $_POST['genero'];
            $data_nascimento = $_POST['data_nascimento'];
            $bio = $_POST['bio'];
        
            if (!empty($_GET['id_user'])){
                $user_id = $_GET['id_user'];
            }
            
            $conexao = new Connection();
            $pdo = $conexao->getConnection();

                // Consulta para atualizar os dados da postagem
            $sql = "UPDATE usuario SET nome_completo = :nome_completo, nome_user = :nome_user, senha = :senha, sexo = :sexo, data_nascimento = :data_nascimento, bio = :bio WHERE id_user = :user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome_completo', $nome_completo, PDO::PARAM_STR);
            $stmt->bindParam(':nome_user', $nome_user, PDO::PARAM_STR);
            $senha = password_hash($senha, PASSWORD_DEFAULT);
            $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
            $stmt->bindParam(':sexo', $sexo, PDO::PARAM_STR);
            $stmt->bindParam(':data_nascimento', $data_nascimento, PDO::PARAM_STR);
            $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                header("Location: perfil.php");
                $_SESSION['msg'] = "<p style='color: #008000;'>Postagem atualizada com sucesso!</p>";

            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro ao atualizar postagem.</p>";
            }
        }

        
    ?>
    
    <form action="" method="post">
            <fieldset>
                <legend> <b>Editar informações do Perfil</b> </legend>
                <br>

                <!--Nome Completo-->
                <div class="InputBox">
                    <p>Nome Completo: <?php echo $dados_user['nome_completo']?></p>
                    <input type="text" name="nome_completo" id="nome_completo" class="InputUser" required>
                    <label for="nome_completo" class="labelInput">Nome Completo</label>

                    
                </div>
                <br><br>

                <!--Nome de Usuário-->
                <div class="InputBox">
                    <p>Nome de usuario: <?php echo $dados_user['nome_user']?></p>
                    <input type="text" name="nome_user" id="nome_user" class="InputUser" required>
                    <label for="nome_user" class="labelInput">Nome de Usuário</label>
                </div>  
                <br><br>

                <!--Senha-->
                <div class="InputBox">
                    <input type="password" name="senha" id="senha" class="InputUser" required>
                    <label for="senha" class="labelInput">Definir Senha</label>
                </div>
                <br><br>

                <!--Sexo-->
                <p>Sexo: <?php echo $dados_user['sexo']?></p>
                <p>Sexo:</p>
                <input type="radio" id="feminino" name="genero" value="feminino" required>
                <label for="feminino">Feminino  </label>
                <br>
                <input type="radio" id="masculino" name="genero" value="masculino" required>
                <label for="masculino">Masculino  </label> 
                <br>
                <input type="radio" id="outro" name="genero" value="outro" required>
                <label for="outro">Outro</label> 
                <br><br>

                <!--Data de Nascimento-->
                    <p>Data de Nascimento: <?php echo $dados_user['data_nascimento']?></p>
                    <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                    <br><br>
                    <input type="date" name="data_nascimento" id="data_nascimento" required>
                <br><br>
               

                <!--bio-->
                <div class="InputBox">
                    <p>Bio: <?php echo $dados_user['bio']?></p>
                    <input type="text" name="bio" id="bio" class="InputUser" required>
                    <label for="bio" class="labelInput">Bio</label>
                </div>
                <br><br>

                <input type="submit" name="SubmitEditPost" id="SubmitEditPost"><br><br>
                <a href="http://localhost:8000/src/View/pages/perfil.php" class="link" style="color: #7F40B0;">Cancelar alteração</a>

            </fieldset>
    </form>
</body>
</html>



           





