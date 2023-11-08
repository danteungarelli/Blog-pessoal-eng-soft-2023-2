# Event Storming do Blog-eng-soft-2023-2| Universidade Federal do Tocantins - Palmas

O Event Storming é um workshop criado por Alberto Brandolini. Ele visa facilitar a visualização de subdomínios e bounded contexts, além de auxiliar no processo de estabelecimento da linguagem ubíqua.

Vale ressaltar que o resultado de um event storming não é um diagrama de componentes ou de modelagem de dados, como o UML por exemplo. Muito pelo contrário: ele resulta em uma representação visual totalmente voltada aos comportamentos esperados do software.

Isso permite uma validação rápida e interativa deste modelo não somente pelo time de tecnologia, mas até mesmo por times de produto e negócio.


## Levantamento dos requisitos funcionais de nosso projeto: 

## RF.01- Usuário acessou o blog e efetuou o cadastro:*

![Tela_de_Login_e_Cadastro_page-0002[1]](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/Tela_de_Login_e_Cadastro_page-0002%5B1%5D.png)

## RF.02- Usuário realizou o login:

![Tela_de_Login_e_Cadastro_page-0001[1]](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/Tela_de_Login_e_Cadastro_page-0001%5B1%5D.png)

## RF.03- Usuário acessou a home:

![Tela home_page-0001](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/Tela%20home_page-0001.png)

## RF.04- Usuário entrou na página "Meu Perfil":

![RF-04](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/RF-04.png)

## RF.05- Usuário editou  suas informações de perfil:

![RF-05](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/RF-05.png)


## RF.06- Usuário realizou o primeiro post:

![RF-06](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/RF-06.png)

## RF.10- Usuário alterou o conteúdo de seu post:

![Tela Editar Postagem](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/TelaEditarPostagem.png)

## RF.11- Usuário excluiu seu post:

![Tela Excluir Postagem](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/TelaExcluirPostagem.png)

## RF.12- Usuário realizou a busca de outros perfis:

![Tela Resultado da Pesquisa](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/TelaResultados.png)

## RF.13- Usuário realizou a visualização dos detalhes de outro perfil e os posts do outro perfil:

![Tela Perfil de outro Usuario](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/telaPerfil.png)

## RF.14- Usuário começou a seguir novo perfil:

![Tela Perfil de outro Usuario seguido](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/telaPerfilSeguido.png)

## RF.15- Usuário na home visualizou seus posts e os posts dos perfis que segue:

![Tela home na aba seguidos](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/TelaHomeSeguidos.png)


## RF.17- Usuário comentou no post de seu "amigo":

![Tela Comentario 1](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/AdicionarCometario01.png)
![Tela Comentario 2](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/AdicionarCometario02.png)

## RF.19- Usuário repostou post :

![telaPostRepostado](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/telaPostRepostado.png)

## Adicionando timeline do Event Storming:

![exemplo_pratico-Ilustração.drawio](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/exemplo_pratico-Ilustra%C3%A7%C3%A3o.drawio.png)


## User Story 01:Seguir usuário
"Como um membro ativo do blog pessoal, desejo poder seguir outros usuários para acompanhar suas atividades e atualizações durante o uso da plataforma, para me manter atualizado sobre seus conteúdos e interesses."

![seguir perfil 01](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/telaPerfil.png)
![seguir perfil 02](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/telaPerfilSeguido.png)

## User Story 02: Mostrar na página principal os próprios post e os posts dos perfis q ele segue

"Como um membro ativo do blog pessoal, desejo ter acesso às postagens dos perfis que sigo de forma fácil."

![TelaHomeSeguidos](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/TelaHomeSeguidos.png)

## User Story 03:  Fazer comentários em posts

"Como um membro ativo do blog pessoal, desejo poder comentar em publicações de outros usuários para interagir, expressar minha opinião e compartilhar meus pensamentos sobre o conteúdo.."

![telaAdicionarComentario1](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/AdicionarCometario01.png)
![telaAdicionarComentario2](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/AdicionarCometario02.png)


## User Story 04:  Repostar posts

"Como um membro ativo do blog pessoal, desejo ter a opção de repostar a publicação de outro usuário, para assim aumentar o alcance do post original.

![telaPostRepostado](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20do%20event%20storming/telaPostRepostado.png)




--------
