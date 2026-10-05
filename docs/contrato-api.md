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
    "email": "maria@email.com"
},
{
    "id":2,
    "nome": "José Rodrigues",
    "email": "jose@email.com"
},
{
    "id" : 3,
    "nome": "Carla Fonseca",
    "email": "carla@email.com"
}
]

```

### GET  `/api/usuarios/{id}`

Objetivo: Consultar um usuário específico

##### Parâmetro da rota

| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| `id` | integer | Sim | Identificador do usuario |

**Exemplo:**

```http
GET /api/usuarios/1
```

**Response body:**
Status: 200 OK
```json
{
    "id": 1,
    "nome": "Maria Silva",
    "email": "maria@email.com"
}

```

##### Resumo das rotas de Usuários

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
    "nome_categoria": "Servidor",
    "tipo": "infraestrutura"
}
```
**Parâmetros do body:**
| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| nome_categoria | string | sim | Nome da categoria |
| tipo | string | sim | Tipo de categoria |

**Response Body:**

```json
{
    "id": 1,
    "nome_categoria": "Servidor",
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
    "nome_categoria": "Servidor",
    "tipo": "infraestrutura"
},
{
    "id": 2,
    "nome_categoria": "Sistema Operacional",
    "tipo": "software"
},
{
    "id": 3,
    "nome_categoria": "Impressora",
    "tipo": "Hardware"
}
]

```

### GET `/api/categorias/{id}`

Objetivo: Consultar uma categoria específica

##### Parâmetro da rota

| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| `id` | integer | Sim | Identificador de categorias |

**Exemplo:**

```http
GET /api/categorias/1
```

**Response Body:**

```json
{
    "id": 1,
    "nome_categoria": "Servidor",
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
    "usuario_id": 1,
    "categoria_id": 1,
    "titulo" : "Servidor com erro",
    "descricao": "Servidor parou de funcionar"
}
```
**Parâmetros do body:**
| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| usuario_id | integer | sim | Id do usuário |
| categoria_id | integer | sim | Id da categoria |
| titulo  | string | não | Titulo da categoria |
| descricao | string | sim | Descrição do chamado |


**Response Body:**

```json
{
    "id": 1,
    "usuario_id": 1,
    "categoria_id": 1,
    "titulo" : "Servidor com erro",
    "descricao": "Servidor parou de funcionar",
    "status": "Aberto",
    "created_at": "2026-09-30T10:00:00Z",
    "updated_at": "2026-09-30T13:00:00Z"
}
```
### GET  `/api/chamados`

Objetivo: Listar chamados


**Response Body:**

```json
[
    {
    "id": 1,
    "usuario_id": 1,
    "categoria_id": 1,
    "titulo" : "Servidor com erro",
    "descricao": "Servidor parou de funcionar",
    "status": "Aberto",
    "prioridade": "Urgente",
    "comentarios": "Esse chamado possui alto grau de problema em cascata",
    "created_at": "2026-09-30T10:00:00Z",
    "updated_at": "2026-09-30T13:00:00Z"

},
{
    "id": 2,
    "usuario_id": 2,
    "categoria_id": 2,
    "titulo":"SO com erro",
    "descricao": "Sistema Operacional está reiniciando o computador",
    "status": "Aberto",
    "prioridade": "Alta",
    "comentarios": "Esse chamado deve ser resolvido",
    "created_at": "2026-09-30T10:00:00Z",
    "updated_at": "2026-09-30T13:00:00Z"
    
},
{
    "id": 3,
    "usuario_id": 3,
    "categoria_id": 3,
    "titulo": "Impressora",
    "descricao": "Impressora precisa de troca de tinta",
    "status": "Fechado",
    "prioridade": "Baixa",
    "comentarios": "Esse chamado já foi resolvido",
    "created_at": "2026-09-30T10:00:00Z",
    "updated_at": "2026-09-30T13:00:00Z"
}

]
```
### GET /api/chamados/{id}

Objetivo: Consultar um chamado específico

##### Parâmetro da rota

| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| `id` | integer | Sim | Identificador do chamado |

**Exemplo:**

```http
GET /api/chamados/1
```

**Response Body:**

```json
{
    "id": 1,
    "usuario_id": 1,
    "categoria_id": 1,
    "titulo": "Servidor com erro",
    "descricao": "Servidor parou de funcionar",
    "status": "Em atendimento",
    "prioridade": "Urgente",
    "comentarios": "Esse chamado possui alto grau de problema em cascata",
    "created_at": "2026-09-30T10:00:00Z",
    "updated_at": "2026-09-30T13:00:00Z"
}
```

### PATCH `/api/chamados/{id}`

Objetivo: Atualizar dados de um chamado

##### Parâmetro da rota

| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| `id` | integer | Sim | Identificador do chamado |

**Exemplo:**

```http
PATCH /api/chamados/1
```
**Request Body:**

```json
{
    "categoria_id": 2,
    "descricao": "Servidor parou de funcionar completamente",
    "prioridade": "urgente"
}
```
**Parâmetros do body:**
| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| categoria_id | integer | sim | Id da categoria |
| descricao | string | sim | Descrição do chamado |
| prioridade | string | Prioridade para o atendimento do chamado |


**Response Body:**

```json
{
    "id": 1,
    "usuario_id": 1,
    "categoria_id": 1,
    "titulo": "Servidor com erro",
    "descricao": "Servidor parou de funcionar completamente",
    "status": "Resolvido",
    "prioridade": "Urgente",
    "comentarios": "Esse chamado possui alto grau de problema em cascata",
    "created_at": "2026-09-30T10:00:00Z",
    "updated_at": "2026-09-30T13:00:00Z"
}
```

### POST `/api/chamados/{id}/comentarios`

Objetivo: Adicionar um comentário ao chamado

##### Parâmetro da rota

| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| `id` | integer | Sim | Identificador do chamado |

**Exemplo:**

```http
POST /api/chamados/1/comentarios
```
**Request Body:**

```json
{
    "comentario": "Esse chamado possui alto grau de problema em cascata, que comprometeu outros serviços"
}
```
**Parâmetros do body:**
| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| comentario | string | Comentario do atendente do chamado |


**Response Body:**

```json
{
    "id": 1,
    "usuario_id": 1,
    "categoria_id": 1,
    "titulo":"Servidor com erro",
    "descricao": "Servidor parou de funcionar",
    "status": "Resolvido",
    "prioridade": "Urgente",
    "comentarios": "Esse chamado possui alto grau de problema em cascata, que comprometeu outros serviços",
    "created_at": "2026-09-30T10:00:00Z",
    "updated_at": "2026-09-30T13:00:00Z"
}
```

### PATCH `/api/chamados/{id}/status`

Objetivo: Alterar o status do chamado

##### Parâmetro da rota

| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| `id` | integer | Sim | Identificador do chamado |

**Exemplo:**

```http
PATCH /api/chamados/1/status
```
**Request Body:**

```json
{
    "status": "Fechado"
}
```
**Parâmetros do body:**
| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| status | string | Mudança do status do chamado |


**Response Body:**

```json
{
    "id": 1,
    "usuario_id": 1,
    "categoria_id": 1,
    "titulo": "Servidor com erro",
    "descricao": "Servidor parou de funcionar",
    "status": "Fechado",
    "prioridade": "Urgente",
    "comentarios": "Esse chamado possui alto grau de problema em cascata",
    "created_at": "2026-09-30T10:00:00Z",
    "updated_at": "2026-09-30T13:00:00Z"
}
```

### GET `/api/chamados/{id}/historico`

Objetivo: Consultar o histórico de alterações do chamado 

##### Parâmetro da rota

| Parâmetro | Tipo | Obrigatório | Descrição |
|---|---|---|---|
| `id` | integer | Sim | Identificador do chamado |

**Exemplo:**

```http
GET /api/chamados/1/historico
```

**Response Body:**

```json
[
    {
    "id": 1,
    "status": "Aberto",
    "data": "2026-09-30T13:00:00Z",
    "chamado_id": 1

},{
    "id": 1,
    "status": "Em atendimento",
    "data": "2026-10-02T13:00:00Z",
    "chamado_id": 1
},
{
    "id": 1,
    "status": "Resolvido",
    "data": "2026-10-05T13:00:00Z",
    "chamado_id": 1
},
{
    "id": 1,
    "status": "Fechado",
    "data": "2026-10-06T13:00:00Z",
    "chamado_id": 1
}
]

```
### GET `/api/chamados/resumo`

Objetivo: Consultar um resumo dos chamados cadastrados no sistema

**Response Body**

Status: `200 OK`

```json
{
    "total_chamados": 25,
    "por_status": {
        "aberto": 8,
        "em_atendimento": 7,
        "resolvido": 6,
        "fechado": 4
    },
    "por_prioridade": {
        "baixa": 5,
        "media": 10,
        "alta": 7,
        "urgente": 3
    }
}
```

#### Resumo das rotas de chamados

| Método | Rota | Objetivo |
|---|---|---|
| `POST` | `/api/chamados` | Abrir um chamado |
| `GET` | `/api/chamados` | Listar chamados |
| `GET` | `/api/chamados/{id}` | Consultar um chamado específico |
| `PATCH` | `/api/chamados/{id}` | Atualizar dados de um chamado |
| `POST` | `/api/chamados/{id}/comentarios` | Adicionar um comentário ao chamado |
| `PATCH` | `/api/chamados/{id}/status` | Alterar o status do chamado |
| `GET` | `/api/chamados/{id}/historico` | Consultar o histórico de alterações do chamado |
| `GET`| `/api/chamados/resumo` | Consultar um resumo dos chamados cadastrados no sistema |

## Filtros e Paginação

Os filtros e a paginação são realizados por meio de Query Parameters na rota de listagem de chamados.

GET /api/chamados 

#### Query Parameters

| Parâmetro | Tipo | Obrigatório | Descrição | Exemplo |
|---|---|---|---|---|
| status | string | não | filtra os chamados pelo status | `/api/chamados?status=aberto`|
| prioridade | string | não | filtra os chamados pela prioridade | `/api/chamados?prioridade=urgente`|
| categoria_id | integer | não | filtra os chamados pelo identificador de categoria | `/api/chamados?categoria_id=1` |
| page | integer | não | Número da página que será consultada | `/api/chamados?page=1` |
| per_page | integer | não | Quantidade de chamados por página | `/api/chamados?per_page=10` |

#### Utilizar paginação 
GET /api/chamados?page=2&per_page=10

O response retorna a página 2, no qual cada página tem 10 chamados.

#### Utilizar filtros e paginação juntos

GET /api/chamados?status=aberto&prioridade=urgente&categoria_id=1&page=1&per_page=10

Ao utilizar o & pode-se usar mais de um query parameter.
