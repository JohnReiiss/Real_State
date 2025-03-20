# Bem-vindo ao Projeto Real State 🏠

## Página Inicial
![WhatsApp Image 2025-03-19 at 09 07 04](https://github.com/user-attachments/assets/7e3248eb-16a0-4ddf-8c74-f1cf364022f7)

A página inicial do projeto simula um site de imobiliária com um design moderno e funcional, com um menu de navegação modular que eu criei e inclui em todas as páginas, facilitando o acesso às seções de cadastro de imóveis e listagem de imóveis cadastrados. A navegação foi construída com base em uma estrutura de HTML bem organizada.

---

## Cadastro de Imóveis
<img width="950" alt="Cadastro de Imóveis" src="https://github.com/JohnReiiss/Real_State/assets/4a4ce8be-0a87-49d1-a0e6-ffb36933e8c1" />

Na seção "Cadastro de Imóveis", implementei um formulário funcional que permite a inserção de imóveis no banco de dados, com campos específicos para o endereço, preço e características do imóvel. Todo o processo foi realizado com PHP e SQL, armazenando as informações no banco de dados de forma eficiente.

---
## Recursos extras e experiência do usuário 🔍

Neste projeto fiz questão de adicionar alguns recursos interessantes, como uma barra de pesquisa no index.php, para que os usuários se sentissem à vontade para buscar pelos imóveis que se interessarem, usando termos como endereço, nome da cidade ou CEP. Esses termos são capturados através de um fetch que realiza uma requisição via AJAX para que a página não precise ser recarregada. Após isso, o servidor retorna a resposta desta requisição em JSON e, por fim, esse resultado é exibido dinamicamente no front-end.

Esta mesma barra de pesquisa possui um texto placeholder auto digitável em looping. Implementei essa lógica através da função JS typeEffect, o que permite que o usuário tenha uma experiência melhorada no site.

Outro recurso interessante que adicionei são os botões de filtro da página que lista os imóveis cadastrados. Eles são filtros de categoria, ex: casa, apartamento, cobertura, etc. Esses botões funcionam de maneira semelhante à barra de pesquisa, onde o usuário precisa apenas interagir com eles para que exibam os imóveis que se enquadram nessas condições de filtro.

Para uma experiência de usuário mais completa, adicionei uma lógica de mensagem de saudação, que funciona a partir do momento que o usuário faz login na página. Este método consulta os dados de usuário salvos no banco de dados e exibe uma mensagem de saudação ao usuário no header da página, além de alterar a saudação de acordo com a hora do dia, como "bom dia, boa tarde e boa noite + nome do usuário".

## Cadastro de Usuários
<img width="950" alt="Cadastro de Usuários" src="https://github.com/JohnReiiss/Real_State/assets/00862824-93b8-4725-8983-bfd477cb9b67" />

A seção de cadastro de usuários permite que os clientes criem contas para gerenciar os imóveis que estão oferecendo. A página foi desenvolvida com foco em praticidade e segurança, utilizando PHP para realizar o gerenciamento de contas e autenticação de usuários.

---

## Banco de Dados
<img width="950" alt="Banco de Dados" src="https://github.com/JohnReiiss/Real_State/assets/f5b13f77-67fb-413d-a405-4ce0e5fcc09f" />

O banco de dados foi estruturado para armazenar os dados de imóveis e usuários, facilitando a manutenção e consulta dos dados. A integração entre o front-end e o banco de dados foi feita utilizando PHP e MySQL, garantindo um fluxo contínuo de informações.

---

## Tecnologias Utilizadas
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
