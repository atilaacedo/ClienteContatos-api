# ClienteContatos API

API RESTful desenvolvida em Laravel para gerenciamento de clientes e seus contatos associados, implementada como parte do desafio técnico fullstack.

## 📋 Sobre o Projeto

Esta API permite o cadastro completo de clientes com seus respectivos contatos, suportando múltiplos e-mails e telefones para cada registro. O sistema utiliza relacionamentos polimórficos para gerenciar emails e telefones de forma flexível e reutilizável.

## 🚀 Tecnologias Utilizadas

- **PHP** 8.2
- **Laravel** 12.0
- **SQLite** (Desenvolvimento)
- **Composer** 2.8.8

## 📦 Estrutura do Banco de Dados

### Tabelas Principais

#### `clientes`
- `id` - UUID (Primary Key)
- `nome_completo` - String
- `created_at` - Timestamp (data de registro)
- `updated_at` - Timestamp

#### `contatos`
- `id` - UUID (Primary Key)
- `nome_completo` - String
- `cliente_id` - UUID (Foreign Key)
- `created_at` - Timestamp
- `updated_at` - Timestamp

#### `emails` (Polimórfica)
- `id` - UUID (Primary Key)
- `email` - String
- `emailable_type` - String (App\Models\Cliente ou App\Models\Contato)
- `emailable_id` - UUID
- `created_at` - Timestamp
- `updated_at` - Timestamp

#### `telefones` (Polimórfica)
- `id` - UUID (Primary Key)
- `numero` - String
- `telefonable_type` - String (App\Models\Cliente ou App\Models\Contato)
- `telefonable_id` - UUID
- `created_at` - Timestamp
- `updated_at` - Timestamp

## 🔧 Instalação e Configuração

### Pré-requisitos

- PHP 8.2 ou superior
- Composer
- SQLite (ou outro banco de sua preferência)

### Passo a Passo

1. **Clone o repositório**
```bash
git clone https://github.com/atilaacedo/ClienteContatos-api.git
cd ClienteContatos-api
```

2. **Instale as dependências**
```bash
composer install
```

3. **Configure o ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure o banco de dados**

No arquivo `.env`, configure a conexão com SQLite:
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Crie o arquivo do banco de dados:
```bash
New-Item -Path database/database.sqlite 
```

5. **Execute as migrations**
```bash
php artisan migrate
```

6. **Inicie o servidor de desenvolvimento**
```bash
php artisan serve
```

A API estará disponível em: `http://localhost:8000`

## 📚 Documentação da API

### Base URL
```
http://localhost:8000/api
```

### Endpoints - Clientes

#### Listar todos os clientes
```http
GET /clientes
```

**Resposta de Sucesso (200):**
```json
{
  "data": [
    {
      "id": "019a6bdb-ee4d-714b-a918-9d0e9523202d",
      "nome_completo": "João Silva",
      "emails": ["joao@email.com", "joao.silva@empresa.com"],
      "telefones": ["11987654321", "1133334444"],
      "created_at": "2025-11-10 03:42:46"
    }
  ]
}
```

#### Buscar cliente por ID
```http
GET /clientes/{id}
```

#### Criar novo cliente
```http
POST /clientes
Content-Type: application/json

{
  "nome_completo": "Maria Silva",
  "emails": ["maria@email.com"],
  "telefones": ["11987654321"]
}
```

**Validações:**
- `nome_completo`: obrigatório, string
- `emails`: obrigatório, array de emails válidos
- `telefones`: obrigatório, array de strings

#### Atualizar cliente
```http
PUT /clientes/{id}
Content-Type: application/json

{
  "nome_completo": "Maria Silva Santos",
  "telefones": ["11987654321", "11988887777"]
}
```

#### Deletar cliente
```http
DELETE /clientes/{id}
```

**Nota:** Ao deletar um cliente, todos os seus contatos, emails e telefones associados são removidos em cascata.

### Endpoints - Contatos

#### Listar todos os contatos
```http
GET /contatos
```

#### Buscar contato por ID
```http
GET /contatos/{id}
```

#### Criar novo contato
```http
POST /contatos
Content-Type: application/json

{
  "cliente_id": "019a6bdb-ee4d-714b-a918-9d0e9523202d",
  "nome_completo": "Pedro Santos",
  "emails": ["pedro@email.com"],
  "telefones": ["11999998888"]
}
```

**Validações:**
- `cliente_id`: obrigatório, UUID válido
- `nome_completo`: obrigatório, string
- `emails`: obrigatório, array de emails válidos
- `telefones`: obrigatório, array de strings

#### Atualizar contato
```http
PUT /contatos/{id}
Content-Type: application/json

{
  "nome_completo": "Pedro Santos Silva",
  "emails": ["pedro.novo@email.com"]
}
```

#### Deletar contato
```http
DELETE /contatos/{id}
```

### Endpoints - Emails

#### Adicionar emails a um cliente
```http
POST /clientes/{id}/emails
Content-Type: application/json

{
  "emails": ["novo@email.com", "outro@email.com"]
}
```

**Nota:** Os mesmos endpoints existem para contatos, substituindo `/clientes/` por `/contatos/`.

### Endpoints - Telefones

#### Adicionar telefones a um cliente
```http
POST /clientes/{id}/telefones
Content-Type: application/json

{
  "telefones": ["11988887777", "11977776666"]
}
```


### Endpoints - Relatórios

#### Relatório completo de clientes com contatos
```http
GET /reports/clientes-with-contatos?page=1&per_page=10
```

**Query Parameters:**
- `page` (opcional): número da página (padrão: 1)
- `per_page` (opcional): itens por página (padrão: 15)

**Resposta de Sucesso (200):**
```json
{
  "data": [
    {
      "id": "019a6bdb-ee4d-714b-a918-9d0e9523202d",
      "nome_completo": "João Silva",
      "emails": ["joao@email.com"],
      "telefones": ["11987654321"],
      "data_registro": "2025-11-10 03:42:46",
      "contatos": [
        {
          "id": "019a6eee-71f7-7043-b195-3671d09e2a2c",
          "nome_completo": "Pedro Santos",
          "emails": ["pedro@email.com"],
          "telefones": ["11999998888"]
        }
      ]
    }
  ],
  "meta": {
    "current_page": 1,
    "per_page": 10,
    "total": 25,
    "last_page": 3
  },
  "links": {
    "first": "http://localhost:8000/api/reports/clientes-with-contatos?page=1",
    "last": "http://localhost:8000/api/reports/clientes-with-contatos?page=3",
    "prev": null,
    "next": "http://localhost:8000/api/reports/clientes-with-contatos?page=2"
  }
}
```

## 🔒 CORS

A API está configurada para aceitar requisições de qualquer origem durante o desenvolvimento.

## ⚠️ Tratamento de Erros

A API retorna respostas HTTP padronizadas:

- **200 OK**: Requisição bem-sucedida
- **201 Created**: Recurso criado com sucesso
- **204 No Content**: Recurso deletado com sucesso
- **400 Bad Request**: Dados inválidos
- **404 Not Found**: Recurso não encontrado
- **422 Unprocessable Entity**: Erros de validação
- **500 Internal Server Error**: Erro no servidor

Exemplo de resposta de erro de validação:
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "nome_completo": ["O campo nome completo é obrigatório."],
    "emails": ["O campo emails é obrigatório."]
  }
}
```


## 📝 Notas de Desenvolvimento

### Relacionamentos Polimórficos

O projeto utiliza relacionamentos polimórficos para emails e telefones, permitindo que ambos os modelos (Cliente e Contato) compartilhem as mesmas tabelas de emails e telefones. Isso proporciona:

- Reutilização de código
- Consistência na estrutura de dados
- Facilidade de manutenção
- Flexibilidade para adicionar novos tipos de entidades no futuro

### Soft Deletes

O projeto pode ser facilmente adaptado para usar soft deletes, mantendo um histórico de registros deletados.


## 📄 Licença

Este projeto foi desenvolvido como parte de um desafio técnico.

## 👨‍💻 Autor

**Átila Macedo**
- GitHub: [@atilaacedo](https://github.com/atilaacedo)

## 🔗 Links Relacionados

- [Frontend da Aplicação](https://github.com/atilaacedo/ClienteContatos-frontend)
- [Desafio Original](https://github.com/Casa-de-Apostas-Tecnologia/fullstack-challenge)