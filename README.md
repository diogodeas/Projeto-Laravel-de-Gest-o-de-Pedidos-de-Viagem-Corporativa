# Projeto Laravel de Gestão de Pedidos de Viagem Corporativa

Este projeto é um microsserviço em Laravel para gerenciar pedidos de viagem corporativa. Ele oferece uma API REST para operações de CRUD e autenticação JWT para segurança.

## Pré-requisitos

Certifique-se de ter o [Docker](https://www.docker.com/) e o [Docker Compose](https://docs.docker.com/compose/) instalados em seu sistema para facilitar o desenvolvimento e execução do projeto.

## Instruções de Instalação

1. Clone o repositório em seu ambiente local:
    ```bash
    git clone <URL_DO_REPOSITORIO>
    cd <NOME_DO_DIRETORIO>
    ```

2. Crie o arquivo `.env` a partir do `.env.example` e configure as variáveis de ambiente:
    ```bash
    cp .env.example .env
    ```

3. No arquivo `.env`, configure as variáveis do banco de dados para `docker`, `user`, `password`, como já definido:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=docker
    DB_USERNAME=docker
    DB_PASSWORD=docker
    JWT_SECRET=<SECRET_KEY>
    ```

4. No arquivo `.env.testing`, utilize as mesmas configurações para que o ambiente de teste use o banco de dados em container.

## Dependências

Para instalar as dependências do Laravel, execute:

```bash
docker-compose exec laravel-docker composer install
 ```
## Executando o Serviço Localmente com Docker

Para subir os containers, execute:

```bash
docker-compose up -d
 ```
## Rodando as Migrações do Banco de Dados

Após os containers estarem ativos, execute as migrações:

```bash
docker-compose exec laravel-docker php artisan migrate
 ```
Caso utilize o ambiente de testes, execute as migrações com:

```bash
docker-compose exec laravel-docker php artisan migrate --env=testing
 ```
## Executando Testes Automatizados

Para executar os testes automatizados (incluindo os testes com autenticação JWT), utilize o comando:

```bash
docker-compose exec laravel-docker php artisan test
 ```
Esse comando irá executar todos os testes definidos no diretório tests, validando as operações de CRUD e a autenticação da API.

## Estrutura do Projeto

### Containers:

- **laravel-docker**: Container onde o Laravel e o servidor Nginx estão configurados.
- **db**: Container com o banco de dados MySQL.

### Principais Rotas da API:

- `POST /api/register`: Criação de usuário.
- `POST /api/login`: Autenticação e geração de token JWT.
- `POST /api/travel-requests`: Criação de um pedido de viagem.
- `GET /api/travel-requests`: Listagem dos pedidos, com opção de filtro por status.
- `GET /api/travel-requests/{id}`: Consulta um pedido específico.
- `PUT /api/travel-requests/{id}`: Atualiza o status de um pedido.

## Informações Adicionais

### Autenticação JWT:

- Este projeto utiliza o pacote `tymon/jwt-auth` para gerenciamento de autenticação JWT.
- A chave do JWT é definida na variável `JWT_SECRET` no arquivo `.env`.

### Variáveis de Ambiente para o Ambiente de Testes:

- O arquivo `.env.testing` está configurado para o uso do banco de dados MySQL em Docker. Isso permite a execução dos testes automatizados utilizando o mesmo banco de dados.

### Erros Comuns:

- Caso ocorra o erro `Auth guard [api] is not defined`, verifique se o arquivo `config/auth.php` contém a configuração de guardas para `api`.
- Verifique se o token JWT está sendo enviado no cabeçalho `Authorization: Bearer <token>` nas requisições que exigem autenticação.

