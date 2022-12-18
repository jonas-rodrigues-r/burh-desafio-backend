# DESAFIO BURH 

## SOBRE O SISTEMA

Trata-se de uma API, para cadastro de empresas, usuários, vagas e candidatura de usuários, possibilitando o fluxo básico de uma plataforma de vagas.

Para o desenvolvimento dessa API, foi utilizada a linguagem PHP na versão 8.0 com o Laravel, um framework rápido, robusto e completo, que agiliza e otimiza o processo de desenvolvimeto. 

Como banco de dados, foi utilizado o MySQL, um dos mais populares bancos de dados, que possui uma ampla gama de documentação e é compatível em diversos sistemas operacionais. E também, como cache, foi utilizado o Redis (banco noSQL), para tornar as consultas mais rápidas, utilizada para suprir o sistema de busca de vagas, empresas, planos e usuários. Ele foi instalado via composer, com a biblioteca Predis, um cliente Redis escrito em PHP que não requer nenhuma extensão adicional para funcionar.

Para traduzir as mensagens do Laravel Validation, que por padrão vem em Inglês, foi utilizada a biblioteca "lucascudo/laravel-pt-br-localization" na versão "1.2".

Para facilitar a criação e gerenciamento do ambiente, foi utilizado o Docker.

<hr>

## REQUISITOS PARA O FUNCIONAMENTO NO AMBIENTE

* PHP 8;
* Laravel 9.44.0;
* MySQL 5.7.40;
* Redis 7.0;
* predis/predis 2.0;
* Docker;
* Docker compose;
* Composer;
* lucascudo/laravel-pt-br-localization 1.2;


<hr>

## INSTRUÇÕES PARA CONFIGURAÇÃO DO AMBIENTE

* Baixe o repositório contendo os arquivos do projeto:

        $ git clone https://github.com/jonas-rodrigues-r/burh-desafio-backend

* Na raiz do projeto, execute os comandos:

        $ cd burh-desafio-backend

        $ cp .env.example .env
    
        $ composer install

* No arquivo .env, para utilizar o Redis e o Banco de Dados MySQL via Docker, devem estar configurados da seguinte forma:

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=teste_burh
        DB_USERNAME=root
        DB_PASSWORD=secret

        BROADCAST_DRIVER=log
        CACHE_DRIVER=redis
        FILESYSTEM_DISK=local
        QUEUE_CONNECTION=sync
        SESSION_DRIVER=redis
        SESSION_LIFETIME=120

* Para subir o ambiente Docker, execute o seguinte comando:

        $ docker-compose up -d --build

* Para criar as tabelas que serão utilizadas, na raiz do projeto, execute o seguinte comando:

        $ php artisan migrate

* Para inciar o servidor Laravel e poder navegar pela API, execute o seguinte comando:

        $ php artisan serve

