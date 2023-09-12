# Blog-pessoal-eng-soft-2023-2| Universidade Federal do Tocantins - Palmas
## Introdução

Este projeto tem como objetivo principal a criação de um espaço online onde pessoas de diversas origens e interesses possam criar, compartilhar e interagir por meio de posts sobre qualquer tema de sua escolha. Com a crescente demanda por espaços digitais que valorizem a diversidade de opiniões e experiências, nosso blog pessoal proporcionará uma plataforma inclusiva e acessível para que os usuários expressem suas paixões, conhecimentos e perspectivas únicas.

O projeto desenvolvido na disciplina Engenharia de Software do semestre 2023.2 é dividido em etapas. Primeiramente, os integrantes descrevem os casos expandidos de uso e user stories dos requisitos funcionais do sistema. Foi combinado a utilização da plataforma GitHub para gerenciar e controlar as versões do projeto. Todo o trabalho será desenvolvido no formato MarkDown. A turma foi dividida em 6 grupos, onde cada grupo possui um líder que deve representar e reportar toda a produtividade de seu respectivo grupo.

### Definindo os requisitos e seus responsáveis.

---

#### Iteração 1

- [x] RF01 - Efetuar Login.  [Saulo Ferraz](https://github.com/SauloFerrazTC) Revisador por @joaovictorwg

- [x] RF02 - Cadastrar Usuario [Dante Gallindo Ungarelli](https://github.com/danteungarelli) Revisado por @Daniel-Noleto

- [x] RF03 - Visualizar tela home do usuario. [Daniel Nolêto](https://github.com/Daniel-Noleto) Revisado por @RafaelSoares12

- [x] RF04 - Criar publicação - [Breno Borges](https://github.com/Brenoborgesbr) Revisado por @danteungarelli

- [x] RF05 - Visualizar tela específica da publicação. - [Rafael Soares](https://github.com/RafaelSoares12) Revisado por @Brenoborgesbr
- [x] RF06 - Criar tela de perfil. - [João Victor Walcacer](https://github.com/joaovictorwg) Revisado por @SauloFerrazTC

---
## *RF02 - Efetuar Cadastro do Usuário*.

#### Autor: @danteungarelli-Dante Gallindo Ungarelli

---

### Revisor: @Daniel-Noleto- Daniel Nolêto

| Item            | Descrição                                                              |
| --------------- | ---------------------------------------------------------------------- |
| Caso de uso     | RF02 - Efetuar Cadastro de Usuário.                                    |
| Resumo          | Este caso de uso descreve o processo pelo qual um usuário não registrado pode criar uma conta no blog pessoal, fornecendo as informações necessárias.|
| Ator principal  | Usuário não registrado                                                                                                        |
| Pré-condição| O usuário acessa a página inicial do blog pessoal e  usuário seleciona a opção de registro de conta.|
|Pós-condições| O usuário acessa a página inicial do blog pessoal e  usuário seleciona a opção de registro de conta.
|
                                
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


#### User Story: 

*Título:* Cadastro de Novo Usuário

*Descrição:* Como um usuário em potencial do blog pessoal, desejo poder criar uma conta facilmente para acessar todos os recursos do blog e compartilhar minhas paixões e perspectivas exclusivas.

![Tela 1](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20tela%20de%20cadastro/Tela%201.png)
![Tela 2](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20tela%20de%20cadastro/Tela%202.png)
![Tela 3](https://github.com/Daniel-Noleto/IMGs-BlogPessoal/blob/main/Imagens%20tela%20de%20cadastro/Tela%203.png)
