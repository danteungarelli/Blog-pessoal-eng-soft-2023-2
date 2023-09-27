<?php


//Função para validar o token
function validarToken(){
    //Recuperar o token do cookie
    $token = $_COOKIE['token'];
    //var_dump($token);

    //Converter token em array
    $token_array = explode('.', "$token");
    //var_dump($token_array);
    $header = $token_array[0];
    $payload = $token_array[1];
    $signature = $token_array[2];

    //Chave secreta e unica
    $chave = "anVsaWFsaW5kYQ==";

    //Usar o header e o payload e codificar com o algoritimo sha256
    $validar_assinatura = hash_hmac('sha256', "$header.$payload", $chave, true);

    //Codificar dados em base64
    $validar_assinatura = base64_encode($validar_assinatura);

    // Comparar a assinatura do token recebido com a assinatura gerada.
    // Acessa o If quando o token é valido
    if($signature == $validar_assinatura){

        // decodificar dados de base64
        $dados_token = base64_decode($payload);
        

        // Converter objeto em array
        $dados_token = json_decode($dados_token);
        //var_dump($dados_token);
        // Comparar a data de vencimento do token com a data atual
        // Acessa o If quando a data do token é maior que a data atual
        if($dados_token -> exp > time()){
            // Retorna true indicando que o token é valido
            return true;
        }
        else{
            // Acessa else quando a data do token é menor ou igual a data atual
            // Retorna false indicando que o token é invalido
            return false;
        }

        return true;
    }
    else{
        return false;
    }

    return true;
}

//Recuperar o nome salvo no token
function recuperarUserToken(){
    $token = $_COOKIE['token'];

    $token_array = explode('.', $token);

    $payload = $token_array[1];

    $dados_token = base64_decode($payload);

    $dados_token = json_decode($dados_token);
    //var_dump($dados_token -> username);

    return $dados_token -> username;
}
function recuperarIDToken(){
    $token = $_COOKIE['token'];

    $token_array = explode('.', $token);

    $payload = $token_array[1];

    $dados_token = base64_decode($payload);

    $dados_token = json_decode($dados_token);
    //var_dump($dados_token -> username);

    return $dados_token -> id_user;
}
/*'nome_user' => $data['nome_user'],--
'id' => $data['id_user'],---
'email' => $data['email'],--
'sexo' => $data['sexo'],--
'telefone' => $data['telefone'],--
'data_nascimento' => $data['data_nascimento']
*/
function recuperarEmailToken(){
    $token = $_COOKIE['token'];

    $token_array = explode('.', $token);

    $payload = $token_array[1];

    $dados_token = base64_decode($payload);

    $dados_token = json_decode($dados_token);
    //var_dump($dados_token -> username);

    return $dados_token -> email;
}
function recuperarSexoToken(){
    $token = $_COOKIE['token'];

    $token_array = explode('.', $token);

    $payload = $token_array[1];

    $dados_token = base64_decode($payload);

    $dados_token = json_decode($dados_token);
    //var_dump($dados_token -> username);

    return $dados_token -> sexo;
}
function recuperarTelefoneToken(){
    $token = $_COOKIE['token'];

    $token_array = explode('.', $token);

    $payload = $token_array[1];

    $dados_token = base64_decode($payload);

    $dados_token = json_decode($dados_token);
    //var_dump($dados_token -> username);

    return $dados_token -> telefone;
}
function recuperarNascimentoToken(){
    $token = $_COOKIE['token'];

    $token_array = explode('.', $token);

    $payload = $token_array[1];

    $dados_token = base64_decode($payload);

    $dados_token = json_decode($dados_token);
    //var_dump($dados_token -> username);

    return $dados_token -> data_nascimento;
}
function recuperarNomeToken(){
    $token = $_COOKIE['token'];

    $token_array = explode('.', $token);

    $payload = $token_array[1];

    $dados_token = base64_decode($payload);

    $dados_token = json_decode($dados_token);
    //var_dump($dados_token -> username);

    return $dados_token -> nome_completo;
}

?>