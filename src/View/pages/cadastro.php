<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    
    <link rel="stylesheet" href="../css/cadastro.css">

</head>
<body>
    <div class="box">
        <form action="">
            <fieldset>
                <legend> <b>Cadastre sua conta</b> </legend>
                <br>
                <div class="InputBox">
                    <input type="text" name="nome" id="nome" class="InputUser" required>
                    <label for="nome" class="labelInput">Nome Completo</label>
                </div>
                <br><br>
                <div class="InputBox">
                    <input type="text" name="nomeUser" id="nomeUser" class="InputUser" required>
                    <label for="nomeUser" class="labelInput">Nome de Usuário</label>
                </div>  
                <br><br>
                <div class="InputBox">
                    <input type="text" name="email" id="email" class="InputUser" required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <br><br>
                <div class="InputBox">
                    <input type="password" name="senha" id="senha" class="InputUser" required>
                    <label for="senha" class="labelInput">Definir Senha</label>
                </div>
                <br><br>
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
                    <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                    <br><br>
                    <input type="date" name="data_nascimento" id="data_nascimento" required>
                <br><br>
                <input type="submit" name="submit" id="submit">

            </fieldset>
        </form>
        
    </div>
</body>
</html>
