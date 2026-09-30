# Documento de Contrato da API

Este documento descreve as principais rotas disponibilizadas pela API
ChamadoJá, seus métodos HTTP e a finalidade de cada endpoint.

## Rotas de Usuários

### POST `/api/usuarios`

Objetivo: Cadastra um novo usuário.

**Request Body:**

```json
{
    "nome": "Maria Silva",
    "email": "maria@email.com",
    "senha": "Senha@123"
}
```
**Parâmetros do body:**
| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| nome | string | sim | Nome do Usuário |
| email | string | sim | Email do usuário |
| senha | string | sim | Senha do usuário |

**Response Body:**

```json
{
    "id": 1,
    "nome": "Maria Silva",
    "email": "maria@email.com",
    "senha": "Senha@123"
}
```

### GET  `/api/usuarios`

Objetivo: Listar usuários

**Response body:**

```json
[
{
    "id": 1,
    "nome": "Maria Silva",
    "email": "maria@email.com",
    "senha": "Senha@123"
},
{
    "id":2,
    "nome": "José Rodrigues",
    "email": "jose@email.com",
    "senha": "Senha@456"
},
{
    "id" : 3,
    "nome": "Carla Fonseca",
    "email": "carla@email.com",
    "senha": "Senha@789"
}
]

```

### GET  `/api/usuarios/{id}`

Objetivo: Consultar um usuário específico

**Request Body:**

```json
{
    "id": 1
}
```
**Parâmetros do body:**
| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| id | integer | sim | Id do Usuário |


**Response body:**

```json
{
    "id": 1,
    "nome": "Maria Silva",
    "email": "maria@email.com",
    "senha": "Senha@123"
}

```

#### Resumo das rotas de Usuários

| Método | Rota | Objetivo |
|---|---|---|
| `POST` | `/api/usuarios` | Cadastrar um usuário |
| `GET` | `/api/usuarios` | Listar usuários |
| `GET` | `/api/usuarios/{id}` | Consultar um usuário específico |

## Rotas de Categorias

### POST `/api/categorias`

Objetivo: Cadastrar uma categoria

**Request Body:**

```json
{
    "nomeCategoria": "Servidor",
    "tipo": "infraestrutura"
}
```
**Parâmetros do body:**
| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| nomeCategoria | string | sim | Nome da categoria |
| tipo | string | sim | Tipo de categoria |

**Response Body:**

```json
{
    "id": 1,
    "nomeCategoria": "Servidor",
    "tipo": "infraestrutura"
}
```

### GET `/api/categorias`

Objetivo: Listar categorias

**Response Body:**

```json
[
    {
    "id": 1,
    "nomeCategoria": "Servidor",
    "tipo": "infraestrutura"
},
{
    "id": 2,
    "nomeCategoria": "Sistema Operacional",
    "tipo": "software"
},
{
    "id": 3,
    "nomeCategoria": "Impressora",
    "tipo": "Hardware"
}
]

```

### GET `/api/categorias/{id}`

Objetivo: Consultar uma categoria específica

**Request Body:**

```json
{
    "id": "1"
}
```
**Parâmetros do body:**
| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| id | integer | sim | Id da categoria |

**Response Body:**

```json
{
    "id": 1,
    "nomeCategoria": "Servidor",
    "tipo": "infraestrutura"
}
```
#### Resumo das rotas de categorias

| Método | Rota | Objetivo |
|---|---|---|
| `POST` | `/api/categorias` | Cadastrar uma categoria |
| `GET` | `/api/categorias` | Listar categorias |
| `GET` | `/api/categorias/{id}` | Consultar uma categoria específica |

## Rotas de Chamados

### POST `/api/chamados`

Objetivo: Abrir um chamado

**Request Body:**

```json
{
    "id_usuario": 1,
    "id_categoria": 1,
    "descricao": "Servidor parou de funcionar"
}
```
**Parâmetros do body:**
| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| id_usuario | integer | sim | Id do usuário |
| id_categoria | integer | sim | Id da categoria |
| descricao | string | sim | Descrição do chamado |


**Response Body:**

```json
{
    "id": 1,
    "id_usuario": 1,
    "id_categoria": 1,
    "descricao": "Servidor parou de funcionar",
    "status": "Aberto"
}
```
### GET  `/api/chamados`

Objetivo: Listar chamados


**Response Body:**

```json
[
    {
    "id": 1,
    "id_usuario": 1,
    "id_categoria": 1,
    "descricao": "Servidor parou de funcionar",
    "status": "Em atendimento",
    "prioridade": "Urgente",
    "comentarios": "Esse chamado possui alto grau de problema em cascata"

},
{
    "id": 2,
    "id_usuario": 2,
    "id_categoria": 2,
    "descricao": "Sistema Operacional está reiniciando o computador",
    "status": "Aberto",
    "prioridade": "Alta",
    "comentarios": "Esse chamado deve ser resolvido"
},
{
    "id": 3,
    "id_usuario": 3,
    "id_categoria": 3,
    "descricao": "Impressora precisa de troca de tinta",
    "status": "Fechado",
    "prioridade": "Baixa",
    "comentarios": "Esse chamado já foi resolvido"
}

]
```
### GET /api/chamados/{id}

Objetivo: Consultar um chamado específico

**Request Body:**

```json
{
    "id": 1
}
```
**Parâmetros do body:**
| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| id | integer | sim | Id do chamado |


**Response Body:**

```json
{
    "id": 1,
    "id_usuario": 1,
    "id_categoria": 1,
    "descricao": "Servidor parou de funcionar",
    "status": "Em atendimento",
    "prioridade": "Urgente",
    "comentarios": "Esse chamado possui alto grau de problema em cascata"
}
```

### PATCH `/api/chamados/{id}`

Objetivo: Atualizar dados de um chamado

#### Parâmetro da rota

| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| `id` | integer | Sim | Identificador do chamado |

**Exemplo:**

```http
PATCH /api/chamados/1

**Request Body:**

```json
{
    "id_categoria": 2,
    "descricao": "Servidor parou de funcionar completamente",
    "prioridade": "urgente"
}
```
**Parâmetros do body:**
| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| id_categoria | integer | sim | Id da categoria |
| descricao | string | sim | Descrição do chamado |
| prioridade | string | Prioridade para o atendimento do chamado |


**Response Body:**

```json
{
    "id": 1,
    "id_usuario": 1,
    "id_categoria": 1,
    "descricao": "Servidor parou de funcionar",
    "status": "Resolvido",
    "prioridade": "Urgente",
    "comentarios": "Esse chamado possui alto grau de problema em cascata"
}
```


| Método | Rota | Objetivo |
|---|---|---|
| `POST` | `/api/chamados` | Abrir um chamado |
| `GET` | `/api/chamados` | Listar chamados |
| `GET` | `/api/chamados/{id}` | Consultar um chamado específico |
| `PATCH` | `/api/chamados/{id}` | Atualizar dados de um chamado |
| `POST` | `/api/chamados/{id}/comentarios` | Adicionar um comentário ao chamado |
| `PATCH` | `/api/chamados/{id}/status` | Alterar o status do chamado |
| `GET` | `/api/chamados/{id}/historico` | Consultar o histórico de alterações do chamado |

## Filtros e Paginação

A listagem de chamados deverá permitir filtros e paginação por meio de
parâmetros de consulta (`query parameters`).

### Filtrar por status

```http
GET /api/chamados?status=aberto