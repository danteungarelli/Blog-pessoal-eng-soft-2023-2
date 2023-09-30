<?php
session_start(); //Iniciar Sessão


// Limpar o buffer de redirecionamento
ob_start();

require_once ("../../model/UserModel.php");

class UserController {
    
    function verifyLogin ($email, $senha) {

        $user = new User_Model();
        $user = $user -> Login($email);

        if(isset($user[0])){
            $data = $user[0];
    

            if($data["email"] == $email){
                //echo($data['nome_completo']);
                //echo($data['nome_user']);
                //echo($data['senha']);
                //echo password_hash('54321', PASSWORD_DEFAULT);
                //$senha = base64_encode($senha);
                //echo $senha;
                //echo (base64_decode("NTQzMjE="));
                

                if(password_verify($senha, $data['senha'])){
                    //Implementação - JWT é dividido em 3 partes separadas por um "." : um header, um payload e uma signature
                    //o header indica o tipo do token do jwt. e o algoritimo utilizado "HS256"
                    echo "senha correta";
                    $header = [
                        'alg' => 'HS256',
                        'typ' => 'JWT'
                    ];
                    //var_dump($header);
                    //Converter array em objeto
                    $header = json_encode($header);
                    //var_dump($header);

                    //Codificar para base64
                    $header = base64_encode($header);
                    //Imprimir o header
                    //var_dump($header);

                    // O Payload é o corpo do JWT, recebe as informações que precisa armazenar
                    // iss - o dominio de aplicação que gera o token
                    // aud - Define o dominio que pode usar o token
                    // exp - Data de vencimento do token 
                    //5 segundos de duração
                    //$duracao = time() + (5);

                    // 7 days; 24 hours; 60 mins; 60 secs
                    $duracao = time() + (7 * 24 * 60 * 60);


                    $payload = [
                        'iss' => 'localhost',
                        'aud' => 'localhost',
                        'exp' => $duracao,
                        'nome_user' => $data['nome_user'],
                        'id_user' => $data['id_user'],
                        'email' => $data['email'],
                        'sexo' => $data['sexo'],
                        'telefone' => $data['telefone'],
                        'data_nascimento' => $data['data_nascimento'],
                        'nome_completo' => $data['nome_completo']
                    ];
                    //converter array em obj
                    $payload = json_encode($payload);
                    var_dump($payload);
                    //Codificar para base64
                    $payload = base64_encode($payload);
                    //Imprimir payload
                    var_dump($payload);

                    //O signature é a assinatura
                    //Chave secreta e unica
                    $chave = "anVsaWFsaW5kYQ==";

                    //Pegar o header e o payload e codificar o algoritimo sha256 junto com a chave
                    $signature = hash_hmac('sha256', "$header.$payload", $chave, true);

                    //codificar para base64
                    $signature = base64_encode($signature);
                    //imprimir signature
                    var_dump($signature);

                    //imprimir o token
                    echo "Token: $header.$payload.$signature <br>";

                    // Salvar o token no cookie
                    //Criar p cookie com duração de 7 dias
                    setcookie('token', "$header.$payload.$signature", (time() + (7 * 24 * 60 * 60)));

                    //redirecionar usuario para a pagina deshboard
                    header("Location: ../pages/home.php");
                }
                else{
                    //Criar mensagem de erro e atribuir para variável global "msg"
                    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou Senha Inválidos!</p>";
                    echo("<script> window.alert('Erro: Usuário ou Senha Inválidos!')</script>");
                }
            }
            else{
                //Criar mensagem de erro e atribuir para variável global "msg"
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou Senha Inválidos!</p>";
                echo("<script> window.alert('Erro: Usuário ou Senha Inválidos!')</script>");
                echo("aaaaaaaaaaaaaaa");
            }
        }

        

    }


    
}

/*
    $user = new UserController();

    $user = $user -> verifyLogin("joaovictor@email.com");
    echo ($user);
*/
?>