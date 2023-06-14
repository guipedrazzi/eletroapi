# EletroAPI

EletroAPI é uma API desenvolvida exclusivamente para o teste de Desenvolvedor FullStack (PHP) do Grupo Plan, em Laravel 10, que permite o cadastro de eletrodomésticos. Esta API utiliza a biblioteca JWT-Auth para autenticação e autorização dos usuários.

## Instalação

Siga as etapas abaixo para instalar e configurar o projeto EletroAPI:

1. Certifique-se de ter o [Composer](https://getcomposer.org/) instalado em sua máquina.

2. Clone o repositório EletroAPI:

   ```bash
   git clone https://github.com/guipedrazzi/eletroapi.git
   ```

3. Acesse o diretório do projeto:

   ```bash
   cd eletroapi
   ```

4. Instale as dependências do projeto usando o Composer:

   ```bash
   composer install
   ```

5. Crie o arquivo de ambiente `.env` a partir do arquivo `.env.example`:

   ```bash
   cp .env.example .env
   ```

6. Gere a chave de JWT, isto irá atualizar o seu arquivo .env com a constante JWT_SECRET:

   ```bash
   php artisan jwt:secret
   ```

7. Configure as informações de conexão com o banco de dados no arquivo `.env`:
    ```bash
   Crie o banco de dados eletroapi no MySQL ou MariaDB e o coloque na constante DB_DATABASE no .env
   ```

8. Execute as migrações do banco de dados:

   ```bash
   php artisan migrate
   ```

9. Por fim, inicie o servidor de desenvolvimento:

   ```bash
   php artisan serve
   ```

## Endpoints

A seguir estão os endpoints disponíveis na API EletroAPI:

### User

- **POST** `/api/user` - Cria um novo usuário.
- **PUT** `/api/user` - Atualiza os dados de um usuário.
- **POST** `/api/user/delete/{id}` - Remove um usuário.

### Authorization

- **POST** `/api/auth/login` - Realiza o login do usuário e retorna um token de autenticação.
- **POST** `/api/auth/logout` - Realiza o logout do usuário.

### Devices

- **POST** `/api/device` - Cria um novo eletrodoméstico.
- **PUT** `/api/device/{id}` - Atualiza os dados de um eletrodoméstico.
- **POST** `/api/device/{id}` - Remove um eletrodoméstico.
- **GET** `/api/device` - Lista todos os eletrodomésticos.

## Autenticação

A API EletroAPI utiliza autenticação baseada em token JWT (JSON Web Token). Para realizar chamadas aos endpoints protegidos, você precisará incluir o token de autenticação no cabeçalho `Authorization` da requisição.

Exemplo de cabeçalho de requisição com o token de autenticação:

```
Authorization: Bearer <token>
```

## Conclusão

---
