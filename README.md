<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
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

>>>>>>> f665eb829376caf1f42a869ebd95cfabdda729ef
