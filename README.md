# EletroAPI (Back-end)

EletroAPI é uma API para estudos com esta arquitetura.
A API é projetada para fornecer endpoints que permitem a criação, leitura, atualização e exclusão de registros de eletrodomésticos no banco de dados.

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

6. Configure as informações de conexão com o banco de dados no arquivo `.env`:
    ```bash
   Crie o banco de dados eletroapi no MySQL ou MariaDB e o coloque na constante DB_DATABASE no .env
   ```

7. Execute as migrações do banco de dados:

   ```bash
   php artisan migrate
   ```

8. Por fim, inicie o servidor de desenvolvimento:

   ```bash
   php artisan serve
   ```

## Endpoints

A seguir estão os endpoints disponíveis na API EletroAPI:

### Devices
    
 **POST** `/api/device`
Cria um novo eletrodoméstico.

- Campos obrigatórios: brand (string), name (string), description (string), voltage (string)
- Retorno: errors (array), status (integer), msg (string)

 **PUT** `/api/device/{id}`
Atualiza os dados de um eletrodoméstico.

- Campos obrigatórios: id (integer), brand (string), name (string), description (string), voltage (string)
- Retorno: errors (array), status (integer), msg (string)

 **DELETE** `/api/device/{id}`
Remove um eletrodoméstico.

- Campos obrigatórios: id (integer)
- Retorno: errors (array), status (integer), msg (string)

 **GET** `/api/device`
Lista todos os eletrodomésticos.

- Retorno: errors (array), status (integer), devices (array)

