# Documentação dos Endpoints (disponível apenas após o setup do projeto):
http://localhost/api/documentation/

#### Se você preferir, pode usar o arquivo (ApiOrders.postman_collection.json) presente na raiz do projeto, para testar a aplicação via POSTMAN. Para isso, basta abrir o postman, e importar essa coleção.

# Requisitos:
* Docker

# Configurando o ambiente de desenvolvimento no Linux ou WSL (windows):
### Clone o repositório:
```
git clone git@github.com:DevAlysonh/orders.git
```

### Configure os arquivos:
Copie o arquivo .env.example para o .env:
```
cp .env.example .env
```
Altere as credenciais de acesso ao banco, conforme o exemplo:
```
DB_CONNECTION=mysql
DB_HOST=orders-db
DB_PORT=3306
DB_DATABASE=orders
DB_USERNAME=root
DB_PASSWORD=rootsecret
```

### Depois de tudo configurado, basta subir os containers:
```
docker-compose -f docker-compose.dev.yml up -d
```

### Se nenhum erro aconteceu, tudo deve estar pronto, agora:
Instale as dependências do projeto:
```
docker exec -it orders-app composer install
```
Gere a chave da aplicação executando o comando:
```
docker exec -it orders-app php artisan key:generate
```

### Agora deve ser possivel acessar a aplicaçao em: http://localhost

## Criando o banco de dados:

Para criar as tabelas, basta executar o comando:
```
docker exec -it orders-app php artisan migrate
```

## Criando o banco de dados de teste:

Cpoie o .env.example para o .env.testing:
```
cp .env.example .env.testing
```

Altere as variáveis de ambiente no seu .env.testing, conforme o exemplo:
```
APP_ENV=testing

DB_CONNECTION=mysql
DB_HOST=orders-db
DB_PORT=3306
DB_DATABASE=orders_test
DB_USERNAME=root
DB_PASSWORD=rootsecret
```

Agora execute as migrations, usando o .env.testing:
```
docker exec -it orders-app php artisan migrate --env=testing
```
Se você ainda não tiver o banco de testes, o laravel vai perguntar se deseja cria-lo, basta dizer que sim, e apertar enter.

Então, execute os testes da aplicação:
```
docker exec -it orders-app composer pest
```
