
# Blog-pessoal-eng-soft-2023-2| Universidade Federal do Tocantins - Palmas
## Introdução

Este projeto tem como objetivo principal a criação de um espaço online onde pessoas de diversas origens e interesses possam criar, compartilhar e interagir por meio de posts sobre qualquer tema de sua escolha. Com a crescente demanda por espaços digitais que valorizem a diversidade de opiniões e experiências, nosso blog pessoal proporcionará uma plataforma inclusiva e acessível para que os usuários expressem suas paixões, conhecimentos e perspectivas únicas.

O projeto desenvolvido na disciplina Engenharia de Software do semestre 2023.2 é dividido em etapas. Primeiramente, os integrantes descrevem os casos expandidos de uso e user stories dos requisitos funcionais do sistema. Foi combinado a utilização da plataforma GitHub para gerenciar e controlar as versões do projeto. Todo o trabalho será desenvolvido no formato MarkDown. A turma foi dividida em 6 grupos, onde cada grupo possui um líder que deve representar e reportar toda a produtividade de seu respectivo grupo.

### Definindo os requisitos e seus responsáveis.

---

#### Iteração 1: De 30/08/23 a 13/09/23

- [x] RF01 - Efetuar Login.  [Saulo Ferraz](https://github.com/SauloFerrazTC) Revisador por @joaovictorwg

- [x] RF02 - Cadastrar Usuario [Dante Gallindo Ungarelli](https://github.com/danteungarelli) Revisado por @Daniel-Noleto

- [x] RF03 - Visualizar tela home do usuario. [Daniel Nolêto](https://github.com/Daniel-Noleto) Revisado por @RafaelSoares12

- [x] RF04 - Criar publicação - [Breno Borges](https://github.com/Brenoborgesbr) Revisado por @danteungarelli

- [x] RF05 - Visualizar tela específica da publicação. - [Rafael Soares](https://github.com/RafaelSoares12) Revisado por @Brenoborgesbr
- [x] RF06 - Visualizar Tela de Perfil. - [João Victor Walcacer](https://github.com/joaovictorwg) Revisado por @SauloFerrazTC


---

## *RF01* - Efetuar Login

---

### Autor: [SauloFerrazTC](https://github.com/SauloFerrazTC) - Saulo Ferraz Tenório Cavalcanti
### Revisor: [joaovictorwg](https://github.com/joaovictorwg) - João Victor Walcácer Giani

---

| Item             | Descrição                                                              |
| ---------------  | ---------------------------------------------------------------------- |
| Caso de uso  | RF01- Efetuar Login.                                           |
| Descrição Sucinta| Após o usuário ter aberto o endereço de login ao site, ele pode fazer o login de sua conta, através do preenchimento dos campos e-mail e senha . Mas caso o usuário não tenha uma conta , ele pode apertar na opção de se cadastrar.| 
| Ator principal   | Usuário - Efetua o Login no site.                                             |                                                                                             |
| Pré-condição     | O usuário deve ter acessado o site através de um endereço/link.                 |
| Pós-condição     | O usuário tem acesso a sua conta do site e a sua tela principal.                               |

---

#### Opções de Usuário
| Opções                              | Descrição                                                                                 |
|-------------------------------------|-------------------------------------------------------------------------------------------|
|Entrar na conta      | Ao apertar no botão "Entrar", o usuário terá acesso a sua conta caso os campos preenchidos estejam válidos.|
|Direcionar a tela de cadastro                       | Ao apertar no botão "cadastra-se", o usuário será direcionado a tela de cadastro. 

---

## Fluxos:

|Fluxo Principal                                             |
| ---------------------------------------------------------- |
|1- O usuário acessa o site através de um link/endereço e aperta em login                     |
|2- O usuário deve ter uma conta válida                      |
|3- O usuário digita no campo de "Email" seu email da conta e no campo "senha" a senha de sua conta|
|4- O usuário aperta no botão "Entrar"                       |


|Fluxo Alternativo                                                             |
| ------------------------------------------------------------------------- |
|1- Usuário não possui uma conta válida no site ou digitou o email ou senha errado                                               |
|2- Aparece um pequeno texto avisando que a conta é inválida  |

---

## Campos do Login:

| Campo    | Obrigatório? | Editável? | Formato      |
| -------- | ------------ | --------- | ------------ |
| Email    | Sim          | Sim       | Texto        |
| Senha    | Sim          | Sim       | Texto        |
  
---

## US01 - User Story(Tela Login):

####  Efetuar Login

Eu, usuário, desejo acessar minha conta registrada no site para poder usufruir das funcionalidades dele.

---

## Protótipo:

![tela1](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/RF01/tela%20login%20principal.png)
![tela2](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/RF01/tela%20login%20alternativa.png)

---

## *RF02 - Efetuar Cadastro do Usuário*.

---

### Autor: [danteungarelli](https://github.com/danteungarelli) - Dante Gallindo Ungarelli
### Revisor: [Daniel-Noleto](https://github.com/Daniel-Noleto) - Daniel Nolêto

---
## Caso de Uso

| Item            | Descrição                                                              |
| --------------- | ---------------------------------------------------------------------- |
| Caso de uso     | RF02 - Efetuar Cadastro de Usuário.                                    |
| Resumo          | Este caso de uso descreve o processo pelo qual um usuário não registrado pode criar uma conta no blog pessoal, fornecendo as informações necessárias.|
| Ator principal  | Usuário não registrado                                                                                                        |
| Pré-condição| O usuário acessa a página inicial do blog pessoal e  usuário seleciona a opção de registro de conta.|
|Pós-condições| O usuário acessa a página inicial do blog pessoal e  usuário seleciona a opção de registro de conta.
|

#### Campos do formulário.

| Campo    | Obrigatório? | Editável? | Formato      |
| -------- | ------------ | --------- | ------------ |
| Nome     | Sim          | Sim       | Texto        |
| Email    | Sim          | Sim       | Texto        |
| Senha    | Sim          | Sim       | Texto        |
| CPF      | Sim          | Sim       | Alfanumérico |
| Endereço | Não          | Sim       | Texto        |
| Contato  | Sim          | Sim       | Numérico     |
| Gênero   | Sim          | Sim       | Checkbox     |
| Receber Novidades   | Não          | Sim       | Checkbox     |

---

## Fluxos
                                
#### Fluxo principal

| Passos  | Descrição                                                                                                       |
| ------- | --------------------------------------------------------------------------------------------------------------- |
| Passo 1 | O ator ao tentar fazer uma publicação, seguir um amigo, comentar em uma publicação ou curtir uma publicação, o mesmo apresenta ao ator a tela de Login;                     |
| Passo 2 | Nesse momento é exibido um botão com título “Cadastre-se” que redireciona o usuário à tela de Cadastro; |
| Passo 3 | A aplicação dispõe ao autor um formulário para ser preenchido com seus respectivos dados;                       |
| Passo 4 | Ao preencher os campos o autor confirma os dados no botão de “criar conta”;                                     |
| Passo 5 | Em seguida o ator passa para um processo de verificação a fim de confirmar sua conta recém criada.              |

                                
#### Fluxo alternativo

| Se o sistema detectar que as informações fornecidas são inválidas ou já existem em outra conta, ele notificará o usuário e solicitará que ele corrija os campos relevantes. |

---


## US02 - User Story(Cadastro de Novo Usuário): 

*Título:* Cadastro de Novo Usuário

*Descrição:* Como um usuário em potencial do blog pessoal, desejo poder criar uma conta facilmente para acessar todos os recursos do blog e compartilhar minhas paixões e perspectivas exclusivas.

---

## Protótipo da Tela

![Tela 1](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20tela%20de%20cadastro/Tela%201.png)
![Tela 2](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20tela%20de%20cadastro/Tela%202.png)
![Tela 3](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20tela%20de%20cadastro/Tela%203.png)

---



## **RF03** - Visualizar Tela Home

---

### Autor: [Daniel-Noleto](https://github.com/Daniel-Noleto) - Daniel Nolêto Maciel Luz
### Revisor: [Rafael Soares](https://github.com/RafaelSoares12) - Rafael Soares Lopes de Souza

---
## Caso de Uso 
| Item             | Descrição                                                              |
| ---------------  | ---------------------------------------------------------------------- |
| Caso de uso      | RF03 - Visualizar Tela Home.                                           |
| Descrição Sucinta| Após o usuário ter realizado o login com sucesso, ele pode acessar a tela inicial, na qual está habilitado a criar novas publicações, realizar buscas e visualizar as publicações existentes.| 
| Ator principal   | Usuário - Visualiza a tela principal da aplicação.                                             |
| Ator secundário  | -                                                                                              |
| Pré-condição     | O usuário deve ter acessado a aplicação e ter feito login em uma conta válida.                 |
| Pós-condição     | O usuário tem acesso as principais funcionalidades da aplicação.                               |


#### Opções de Usuário
| Opções                              | Descrição                                                                                 |
|-------------------------------------|-------------------------------------------------------------------------------------------|
|Acessar a página de seu perfil       | Ao clicar no ícone referente ao perfil do usuário, a tela do perfil do usuário será aberta.|
|Realizar busca                       | Ao clicar na barra de busca, o usuário pode procurar por publicações que contenham o termo digitado em seu nome.|
|Visualizar publicações recomendadas  | Ao estar na tela home, o usuário pode visualizar publicações relevantes.       |
|Acessar barra lateral                | Ao clicar no ícone referente a barra lateral, o usuário pode entre as opções oferecidas por ela, como acessar a aba de criação de publicações. |

#### Campos da Tela Home
|Campos           | Obrigatório? | Editável? | Formato |
|-----------------|--------------|-----------|---------|
|Barra de Pesquisa| Não          | Sim       | Texto   |



---

## Fluxos

|Fluxo Principal                                             |
| ---------------------------------------------------------- |
|1- O usuário deve acessar a aplicação                       |
|2- O usuário deve ter uma conta válida                      |
|3- O usuário deve realizar login                            |
|4- O usuário terá acesso a tela home                        |


|Fluxo Auxiliar                                                             |
| ------------------------------------------------------------------------- |
|1- Usuário deve estar logado                                               |
|2- Ao clicar na logo da aplicação, o usuário será redirecionado a tela home|

---

## **US03** - User Story(Tela Home)


Eu enquanto usuário, com uma conta válida, da plataforma quero poder ter acesso a sua página principal e suas funcionalidades.

---

## Protótipo da Tela
![prototipo](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/RF03-TelaHome/TelaHome1.png)

![prototipo2](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/RF03-TelaHome/TelaHome2.png)

---

## **RF04** - Criar publicação

---
### Autor: [Breno Borges](https://github.com/Brenoborgesbr) - Breno Borges
### Revisor: [danteungarelli](https://github.com/danteungarelli) - Dante Gallindo Ungarelli
---

## Caso de Uso

|Item	        |Descrição                                                           |
| ------------- | ------------------------------------------------------------------ |
|Caso de uso    | RF04 - Criar publicação. |
|Resumo         | Este caso de uso descreve o processo pelo qual um usuário registrado pode criar uma publicação no blog pessoal, incluindo título, arquivos, imagens e formatação de texto. |
|Ator principal | Usuário registrado. |
|Pré-condição   | O usuário acessa a tela home do blog pessoal e usuário seleciona a opção de criar publicação.|
|Pós-condições  | O usuário acessa a página criar publicação e tem acesso a todas as opções possíveis. | 

---

#### Campos da tela publicação

|Campos           | Obrigatório? | Editável? | Formato |
|-----------------|--------------|-----------|---------|
|Título da Publicação| Sim          | Sim       | Texto   |
|Conteúdo da Publicação| Sim        | Sim       | Texto   |
|Imagens	       |Não         | Sim	|Imagem   |
|Salvar Rascunho       |Sim         | Não	|checkbox |
|Publicar              |Sim         | Não	|checkbox |
|Cancelar              |Sim         | Não	|checkbox |

---

## Fluxos
                                
#### Fluxo principal

| Passos  | Descrição                                                                                                       |
| ------- | --------------------------------------------------------------------------------------------------------------- |
| Passo 1 | A página de criação de publicação deve ser facilmente acessível a todos os usuários, independentemente de suas habilidades físicas ou cognitivas, cumprindo as diretrizes de acessibilidade da Web.  |
| Passo 2 | Deve haver um botão de criação de nova publicação claramente visível na página inicial do blog. |
| Passo 3 | Ao clicar no botão de criação de nova publicação, os usuários devem ser levados a uma página de criação intuitiva, com um formulário de entrada de texto claramente identificado. | 
| Passo 4 | O formulário de criação de publicação deve incluir campos para título, conteúdo da publicação, imagens (com suporte para descrições alternativas) e categorias. |
| Passo 5 | Deve ser possível salvar rascunhos de publicações em andamento e retomá-los mais tarde. |
| Passo 6 | Os usuários devem ter a opção de visualizar a publicação antes de publicá-la. |
| Passo 7 | Deve haver um botão de publicação claramente identificado que permita aos usuários publicar sua criação no blog. |
| Passo 8 | A página de criação de publicação deve ser responsiva e funcionar bem em dispositivos móveis e desktop. |
| Passo 9 | Um sistema de gerenciamento de conteúdo deve ser implementado para rastrear as publicações dos usuários, permitindo edições futuras e o gerenciamento de conteúdo. |                 

                                
#### Fluxo alternativo

| Usuário clica na tela criar publicação, o sistema verifica se ele está logado, e caso não esteja é direcionado a tela de login. |

---

## **US04** - User Story(Tela de Criar Publicação)

Eu, enquanto usuário com uma conta válida, quero acessar uma página de criação de publicação que seja inclusiva e acessível, para que eu possa expressar minhas paixões, conhecimentos e perspectivas únicas de forma fácil e sem barreiras.

---

## Protótipo da Tela
![prototipo](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/RF%2004.png)

---

## *RF05 - Visualizar tela específica de publicação*.

---

### Autor: [RafaelSoares12](https://github.com/RafaelSoares12) - Rafael Soares L. de Souza
### Revisor: [danteungarelli](https://github.com/danteungarelli) - Dante Gallindo Ungarelli
---
## Caso de Uso

| Item            | Descrição                                                              |
| --------------- | ---------------------------------------------------------------------- |
| Caso de uso     | RF05 - Visualizar tela específica de publicação.                                    |
| Resumo          | Após o usuário logado clicar em alguma publicação, ele poderá ver as informações detalhadas de cada públicação, como texto principal, imagens, etc.|
| Ator principal  | Usuário - Visualiza a tela da publicação.                                                                                                        |
| Pré-condição | O usuário deve ter acessado a aplicação, ter feito login em uma conta válida e clicar em alguma publicação.|
| Pós-condições| O usuário acessa a página inicial do blog pessoal e  usuário seleciona a opção de registro de conta.
|

---

## Fluxos
                                
#### Fluxo principal

| Passos  | Descrição                                                                                                       |
| ------- | --------------------------------------------------------------------------------------------------------------- |
| Passo 1 | Usuário faz login.                    |
| Passo 2 | Usuário visualiza algum post de seu interesse e clica nele. |
| Passo 3 | Usuário visualiza a tela com informações detalhadas.                   

                                
#### Fluxo alternativo

| Usuário recebe a url direta e acessa, o sistema verifica se ele está logado, e então mostra a página. |

## **US05** - User Story(Tela Específica de Publicação)


Eu enquanto usuário, com uma conta válida, da plataforma quero poder ter acesso ao texto completo, imagens e autor da publicação que tenho interesse.

---

## Protótipo da Tela
![prototipo](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Captura%20de%20tela%202023-09-12%20220316.png)

---
## *RF06 - Visualizar Tela de Perfil*.

### Autor: [joaovictorwg](https://github.com/joaovictorwg) - João Victor Walcacer Giani

### Revisor: [SauloFerrazTC](https://github.com/SauloFerrazTC) - Saulo Ferraz
---


## Caso de Uso

| Item            | Descrição                                                              |
| --------------- | ---------------------------------------------------------------------- |
| Caso de uso     | RF06 - Visualizar Tela de Perfil.                                    |
| Resumo          | Após o Usuário acessar a tela de perfil por meio da tela inicial, ele terá acesso a sua foto de perfil, nome de usuário, descrição do perfil, botão para editar o perfil, posts do usuário, comentários feitos pelo usuário, posts curtidos pelo usuário, quantidade de seguidores e perfis que o usuário está seguindo.|
| Ator principal  | Usuário - Visualiza a tela de Perfil                                                                                                       |
| Pré-condição| O usuário deve ter acessado a aplicação com uma conta válida e estar visualizando a tela principal.|
|Pós-condições| O usuário tem acesso a página do seu perfil, tal como informações, opções de edição e posts relacionados a este usuário.
|
                    

                                
#### Opções de Usuário
| Opções                              | Descrição                                                                                 |
|-------------------------------------|-------------------------------------------------------------------------------------------|
|Foto de Perfil do Usuário       | Ao clicar no ícone da foto de Perfil, o usuário tem acesso a uma tela com a foto em tamanho maior.|
|Nome de Usuário                       | O usuário pode visualizar o nome de usuário.|
|Descrição do Perfil  | O usuário pode visualizar a descrição de seu perfil.       |
|Botão para Editar Perfil                | Ao clicar no botão, o usuário é levado a uma página onde ele tem as opções de editar a foto de perfil, o nome de usuário e a descrição do perfil. |
|Posts do Usuário                | Ao clicar no botão e descer a tela, o usuário terá acesso aos seus próprios posts, onde poderá clicar nos posts e acessar a tela de post. |
|Comentários do Usuário                | Ao clicar no botão e descer a tela, o usuário terá acesso aos seus comentários em outros posts, onde poderá clicar no comentário para abrir a tela de comentário. |
|Posts curtidos pelos usuários               | Ao clicar no botão e descer a tela, o usuário terá acesso a suas curtidas em outros posts e poderá clicar no post para acessar a tela de posts. |
|Seguidores e Seguindo                | O usuário podera visualizar a quantidade de seguidores e perfis que ele está seguindo, ao clicar, ele tera acesso a tela de Seguidores e Perfis seguidos. |

---
## Fluxos 
#### Fluxo principal

| Passos  | Descrição                                                                                                       |
| ------- | --------------------------------------------------------------------------------------------------------------- |
| Passo 1 | Usuário deve acessar aplicação com uma conta válida;                     |
| Passo 2 | Usuário deverá acessar Tela Home; |
| Passo 3 | Usuário deverá clicar no ícone referente ao Perfil de Usuário;                       |
| Passo 4 | Usuário terá acesso a Tela de Perfil;                                     |


                                
#### Fluxo alternativo

| Usuário está logado e já se encontra na Tela Home, apenas deverá clicar no Ícone de Perfil. |

---

## US06 - User Story(Tela de Perfil do Usuário): 

*Título:* Tela de Perfil do Usuário

*Descrição:* Como um usuário, tendo acessado a aplicação com uma conta válida, quero clicar no ícone do meu perfil, onde poderei acessar uma tela com as informações do meu perfil, tais como foto de perfil, nome de perfil, descrição do perfil, posts, seguidores e perfis seguidos, posts curtidos, comentários, e quero poder editar meu perfil e minhas informações.


---

## Protótipo da Tela de Perfil

![prototipo](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/RF06%20-%20Tela%20Perfil/Captura%20de%20tela%202023-09-13%20001227.png)

---


