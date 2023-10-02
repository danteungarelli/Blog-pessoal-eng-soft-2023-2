<?php 

session_start(); //Iniciar a sessão

//Limpar buffer de rediresionamento
ob_start();
//Fazer Conexão Com o Banco de Dados
include_once '..\..\config\connection.php';
    
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    
    <link rel="stylesheet" href="../css/cadastro.css">

</head>
<body>

<?php 
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        //Verificar se o botão foi pressionado
        if(!empty($dados['SendCadUser'])){
            //var_dump($dados);
        
            $conexao = new Connection();
            $pdo1 = $conexao -> getConnection ();
            
            $query_usuario = "INSERT INTO usuario (email, nome_completo, nome_user, senha, sexo, data_nascimento)
            VALUES(:email, :nome, :nomeUser, :senha, :genero, :data_nascimento)";
            $cad_usuario = $pdo1->prepare($query_usuario);
 

         $cad_usuario->bindParam(':email', $dados['email']);
         $cad_usuario->bindParam(':nome', $dados['nome']);
         $cad_usuario->bindParam(':nomeUser', $dados['nomeUser']);
         $senha_final = password_hash($dados['senha'], PASSWORD_DEFAULT);
         $cad_usuario->bindParam(':senha', $senha_final);
         $cad_usuario->bindParam(':genero', $dados['genero']);
         $cad_usuario->bindParam(':data_nascimento', $dados['data_nascimento']);
         
    
        
         
         $cad_usuario->execute();
         if($cad_usuario->rowCount()){
             header("Location: login.php");
             echo "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
         }
         else{
            echo "<p style='color: #f00;'>Erro: Falha ao cadastrar usuário!</p>";
             }
        }
      
        
        ?>
    <div class="box">
       


        <form action="" method="post">
            <fieldset>
                <legend> <b>Cadastre sua conta</b> </legend>
                <br>

                <!--Nome Completo-->
                <div class="InputBox">
                    <input type="text" name="nome" id="nome" class="InputUser" required>
                    <label for="nome" class="labelInput">Nome Completo</label>
                </div>
                <br><br>

                <!--Nome de Usuário-->
                <div class="InputBox">
                    <input type="text" name="nomeUser" id="nomeUser" class="InputUser" required>
                    <label for="nomeUser" class="labelInput">Nome de Usuário</label>
                </div>  
                <br><br>

                <!--Email-->
                <div class="InputBox">
                    <input type="text" name="email" id="email" class="InputUser" required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <br><br>

                <!--Senha-->
                <div class="InputBox">
                    <input type="password" name="senha" id="senha" class="InputUser" required>
                    <label for="senha" class="labelInput">Definir Senha</label>
                </div>
                <br><br>

                <!--Sexo-->
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
                    <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                    <br><br>
                    <input type="date" name="data_nascimento" id="data_nascimento" required>
                <br><br>
                <input type="submit" name="SendCadUser" id="submit"><br><br>

                <p>Já possui uma conta? <a href="http://localhost:8000/src/view/pages/login.php" class="link">Login</a></p>
                

            </fieldset>
        </form>
        
    </div>
</body>
</html>