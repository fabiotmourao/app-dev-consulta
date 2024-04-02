
## App Dev Consulta

Este é um projeto Laravel para consulta. Este README fornecerá instruções sobre como configurar e executar o projeto localmente.


## Pré requisitos

- Git
- Docker

## Clonando o Repositório

- Execute o seguinte comando para clonar este repositório

  git clone git@github.com:fabiotmourao/app-dev-consulta.git

## Configuração do Ambiente
Renomeie o arquivo .env.example para .env

- Instale as dependências PHP com Composer

    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs

## Instale as dependências JavaScript com npm

npm install

## Executando o Projeto

- Inicie os contêineres Docker usando Docker Compose

    docker compose -f "docker-compose.yml" up -d --build

    ./vendor/bin/sail up -d

    ou
    
    Se preferir, inicie pelo ambiente visual do Docker.

## Compile os assets JavaScript

npm run dev

## Base de dados

- Execute as migrações do banco de dados:

    vendor/bin/sail artisan migrate

- Execute a seed para semear o banco de dados:

    vendor/bin/sail artisan db:seed

    ou 
    
    Se preferir recriar o banco de dados

    vendor/bin/sail artisan migrate:refresh --seed

 
## Por conveniência, criar um pseudónimo para Sail para facilitar o trabalho com o Sail:

alias sail="bash ./vendor/bin/sail"
