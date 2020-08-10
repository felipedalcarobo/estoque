## estoque


### Ambiente de Desenvolvimento

- Sistema Operacional macOS Catalina - versão 10.15.5;
- Versão do PHP 7.2.5;
- Versão do MySql 5.6.38;
- Hospedagem do banco de dados no MAMP;
- NPM;
- HomeBrew;
- Sublime Text;


### Sobre a API

Metodo: POST

Headers:
Accept - application/json |
Authorization - Bearer +chave |
Content-Type - multipart/form-data


- Para adicionar produto ao estoque: http://.../api/v1/adicionar-produtos

- - name: produto - value: 1

- - name: quantidade - value: 100


- Para retirar produto do estoque: http://.../api/v1/baixar-produtos

- - name: id_estoque - value: 1

- - name: quantidade - value: 100


### Banco de Dados

- Arquivo sql do banco com dados: estoque.sql


### Dados para acessar sistema logado

- email: fe@dal.com 
- password: 12345678





