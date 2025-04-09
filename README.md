# Bem-vindo ao Projeto Real State 🏠

## Página Inicial
![WhatsApp Image 2025-03-19 at 09 07 04](https://github.com/user-attachments/assets/7e3248eb-16a0-4ddf-8c74-f1cf364022f7)

A página inicial do projeto simula um site de imobiliária com um design moderno e funcional, com um menu de navegação modular que eu criei e inclui em todas as páginas, facilitando o acesso às seções de cadastro de imóveis e listagem de imóveis cadastrados. A navegação foi construída com base em uma estrutura de HTML bem organizada.

---

## Cadastro de Imóveis
![WhatsApp Image 2025-03-19 at 09 10 08](https://github.com/user-attachments/assets/52750b5d-d6e8-4f71-a99d-795106981014)

Na seção "Cadastro de Imóveis", implementei um formulário funcional que permite a inserção de imóveis no banco de dados, com campos específicos para o endereço, preço e características do imóvel. Todo o processo foi realizado com PHP e SQL, armazenando as informações no banco de dados de forma eficiente.

---
## Recursos extras e experiência do usuário 🔍
![WhatsApp Image 2025-03-19 at 09 08 53](https://github.com/user-attachments/assets/f7bb9821-9216-4222-8f6f-e2ad856a866b)
![WhatsApp Image 2025-03-19 at 09 09 52](https://github.com/user-attachments/assets/e6b9229f-2d8c-4799-8717-494d06e881b9)

Neste projeto fiz questão de adicionar alguns recursos interessantes, como uma barra de pesquisa no index.php, para que os usuários se sentissem à vontade para buscar pelos imóveis que se interessarem, usando termos como endereço, nome da cidade ou CEP. Esses termos são capturados através de um fetch que realiza uma requisição via AJAX para que a página não precise ser recarregada. Após isso, o servidor retorna a resposta desta requisição em JSON e, por fim, esse resultado é exibido dinamicamente no front-end.

Esta mesma barra de pesquisa possui um texto placeholder auto digitável em looping. Implementei essa lógica através da função JS typeEffect, o que permite que o usuário tenha uma experiência melhorada no site.

Outro recurso interessante que adicionei são os botões de filtro da página que lista os imóveis cadastrados. Eles são filtros de categoria, ex: casa, apartamento, cobertura, etc. Esses botões funcionam de maneira semelhante à barra de pesquisa, onde o usuário precisa apenas interagir com eles para que exibam os imóveis que se enquadram nessas condições de filtro.

Para uma experiência de usuário mais completa, adicionei uma lógica de mensagem de saudação, que funciona a partir do momento que o usuário faz login na página. Este método consulta os dados de usuário salvos no banco de dados e exibe uma mensagem de saudação ao usuário no header da página, além de alterar a saudação de acordo com a hora do dia, como "bom dia, boa tarde e boa noite + nome do usuário".

## Cadastro de Usuários
![WhatsApp Image 2025-03-19 at 09 08 16](https://github.com/user-attachments/assets/e86320cc-8d5f-4d0d-a2d3-55302ee46dc0)

A seção de cadastro de usuários permite que os clientes criem contas para gerenciar os imóveis que estão oferecendo. A página foi desenvolvida com foco em praticidade e segurança, utilizando PHP para realizar o gerenciamento de contas e autenticação de usuários.

---

## Banco de Dados
![image](https://github.com/user-attachments/assets/2ec774a5-ffd7-444a-afe7-97339d28d956)

O banco de dados foi estruturado para armazenar os dados de imóveis e usuários, facilitando a manutenção e consulta dos dados. A integração entre o front-end e o banco de dados foi feita utilizando PHP e MySQL, garantindo um fluxo contínuo de informações.

---

## O que mudou com a atualização 0.1.1?
A principal mudança do código anterior para a versão atual, foi a adição de uma página para realizar o update das informações do usuário "dados_usuario.php", essa página não só é responsável por permitir ao usuário alterar seus dados cadastrais como e-mail, nome de usuário e senha, como também utiliza uma verificação de seção e de usuários ativos para buscar no banco de dados os imóveis vinculados a determinado usuário e então exibir eles de maneira dinâmica como pode ser visto na imagem, através das queryes de consulta nos documentos php que processam esses dados, eles podem ser alterados, excluídos ou exibidos no front end.
![image](https://github.com/user-attachments/assets/704b2862-9c63-4672-84ba-0ae11f5b3442)

![image](https://github.com/user-attachments/assets/b536d4d8-407a-45be-9d4c-132e04948aae)

![image](https://github.com/user-attachments/assets/c8acf32c-a1f7-4d9c-b5f6-515eaab192bf)

![image](https://github.com/user-attachments/assets/5eb6143f-1687-4ed8-9d04-881bb7bd5d16)

![image](https://github.com/user-attachments/assets/3dcf9db8-301c-4ff8-a4f4-e2991d498b5e)

Esse código também traz alterações no front end, mais especificamente de design do site para melhorar a usabilidade e experiência com a aplicação web, os h2 de cada carrossel foram reposicionados e centralizados com posição fixa e absoluta para melhor organização dos elementos entre as seções.

![image](https://github.com/user-attachments/assets/5b43d6c0-40a0-4169-8208-f0c971bd36cb)

![image](https://github.com/user-attachments/assets/bcf3f90b-fede-4b14-94f8-34ed7b9e3aaa)

---

## 🔧 Tecnologias Utilizadas
<div align="center">
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5">
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3">
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white" alt="GitHub">
</div>

- **PHP**: Lógica do servidor e manipulação de dados.
- **CSS**: Estilização da interface e responsividade.
- **JavaScript**: Interatividade,validações de formulários requisições AJAX, JSON, etc.
- **MySQL**: Banco de dados para armazenar informações de imóveis e usuários.

---

## Como Visualizar o Projeto
Você pode acessar o repositório e testar o projeto localmente, seguindo as instruções abaixo:

```bash
git clone https://github.com/JohnReiiss/Real_State.git
```

1. Crie um banco de dados MySQL chamado `real_state`.
2. Importe o arquivo `real_state.sql` para o seu banco de dados.
3. Configure as credenciais do banco de dados no arquivo PHP.
4. Abra o projeto em seu servidor local.

---

## Contato
Se desejar discutir o projeto ou aprender mais sobre o desenvolvimento, entre em contato:

- **E-mail:** johnatan.reiiss@icloud.com
- **LinkedIn:** [linkedin.com/in/johnatan-hayabusa](https://www.linkedin.com/in/johnatan-hayabusa)
- **GitHub:** [github.com/JohnReiiss](https://github.com/JohnReiiss)

Obrigado por explorar o projeto! 🚀

---
