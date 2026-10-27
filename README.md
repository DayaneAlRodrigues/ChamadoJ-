# ChamadoJá

## 1. O que é?

O projeto **ChamadoJá** é uma API para auxiliar o serviço de suporte técnico. Nessa API, os clientes poderão abrir chamados com os dados de:  nome do chamado, categoria, descrição. Os funcionários poderão ter acesso aos dados dos clientes, aos dados dos chamados, classificar o nível de prioridade, alterar o status do atendimento e adicionar comentários. Além disso, o funcionário poderá filtrar os chamados por prioridades e status.

Desse modo será possível:

- cadastrar e consultar usuários;
- cadastrar e consultar categorias;
- registrar chamados de suporte;
- acompanhar o andamento dos chamados;
- atualizar informações dos chamados;
- filtrar e paginar chamados;
- adicionar comentários;
- alterar o status dos chamados;
- consultar o histórico de alterações de status;
- consultar um resumo dos chamados.

---

## 1.1 Autor do Projeto
**Dayane Rodrigues**

## 1.2 Instruções iniciais

Esse projeto será desenvolvido por sprints de desenvolvimento. 
A primeira semana (28/09/26 - 04/10/26) foi destinada para o Planejamento do Projeto. 
Os artefatos da primeira semana são:
- docs/requisitos.md
- docs/casos-de-uso.md
- docs/diario.md
- docs/contrato-api.md


A segunda semana (05/10/26 - 10/11/26) teve como foco a modelagem do banco relacional em Postegresql e as consultas. 
Nesta semana os artefatos produzidos foram:
- docs/modelo-er.md
- docs/modelo-er.png
- docs/decisoes-banco.md
- database/schema.sql
- database/seed.sql
- docs/consultas.sql

A terceira semana (12/10/26 - 17/10/26) foi desenvolvido o início da aplicação com os seguintes artefatos:
- Models= Usuario, Categoria, Chamado, Comentario, HistoricoStatus
- Migrations
- Factories
- Seeders
- Instruçoes de instalação e configuração no Readme.

A quarta semana  (19/10/26 - 24/10/26) - API principal de usuários, categorias e chamados
Durante a quarta semana, foi desenvolvido o CRUD principal de chamados e implementadas as principais rotas da API REST, incluindo operações de consulta e cadastro de usuários e categorias.
As principais entregas foram:

- Organização e configuração das rotas da API;
- Implementação de respostas padronizadas em JSON por meio de API Resources;
- Validação dos dados recebidos utilizando Form Requests;
- Tratamento de dados inválidos e de referências a usuários e categorias inexistentes;
- Definição do status inicial dos chamados como `aberto`;
- Utilização de códigos HTTP adequados para representar os resultados das requisições;
- Realização de testes manuais dos endpoints;
- Documentação de exemplos de uso das rotas e das requisições no `README.md`.

## 2 Instalação e configuração

### 2.1. Pré-requisitos

Antes de iniciar, certifique-se de que possui as seguintes ferramentas instaladas:

- PHP em uma versão compatível com o projeto;
- Composer;
- PostgreSQL;
- Git.

### 2.2. Clonar o repositório

Clone o repositório e acesse a pasta do projeto:

```bash
git clone URL_DO_REPOSITORIO
cd ChamadoJa
```

Substitua `URL_DO_REPOSITORIO` pela URL real do repositório no GitHub e ajuste o nome da pasta, se necessário.

### 2.3. Instalar as dependências

Execute o comando:

```bash
composer install
```

### 2.4. Configurar as variáveis de ambiente

Crie o arquivo `.env` a partir do arquivo de exemplo:

```bash
cp .env.example .env
```

### 2.5. Configurar o banco de dados

Crie um banco de dados PostgreSQL para o projeto.

Em seguida, configure as variáveis de conexão no arquivo `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=chamado_ja
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

Substitua os valores de usuário, senha, porta e nome do banco conforme a configuração do seu ambiente.

### 2.6. Executar as migrations

Crie as tabelas do banco de dados:

```bash
php artisan migrate
```

Execute seeders para inserir dados iniciais ou fictícios:

```bash
php artisan db:seed
```

### 2.7. Iniciar o servidor

Execute:

```bash
php artisan serve
```

Por padrão, a aplicação ficará disponível em:

`http://127.0.0.1:8000`

### 2.8. Consultar a API

Com o servidor em execução, utilize uma ferramenta como Postman ou Insomnia para enviar requisições HTTP à API.

Consulte a documentação do projeto para conhecer os endpoints disponíveis, os parâmetros aceitos e os formatos das requisições e respostas.

## 3 Testes 
Esses testes foi utilizando o curl via terminal e também pode ser usado outro programa como Postman, Insonia.

### 3.1 Inicie a API Laravel
php artisan serve

Confirme se o curl está instalado:
curl --version

Confira também as rotas da API:
php artisan route:list --path=api

### 3.2 Teste 1 — Criar um chamado válido
Enviar uma requisição POST com os dados de um chamado.

curl -i -X POST http://127.0.0.1:8000/api/chamados \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "titulo": "Computador não liga",
    "descricao": "O computador não liga após pressionar o botão de energia.",
    "prioridade": "alta",
    "usuario_id": 1,
    "categoria_id": 1
  }'
  
 Resultado:
 HTTP/1.1 201 Created
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.4.24
Cache-Control: no-cache, private
Date: Tue, 27 Oct 2026 18:23:02 GMT
Content-Type: application/json
Access-Control-Allow-Origin: *

{"data":{"id":11,"titulo":"Computador n\u00e3o liga","descricao":"O computador n\u00e3o liga ap\u00f3s pressionar o bot\u00e3o de energia.","status":"aberto","prioridade":"alta","created_at":"2026-10-27T18:23:02.000000Z","updated_at":"2026-10-27T18:23:02.000000Z"}}
 
### 3.3 Teste 2 — Criar um chamado sem título
Verificar se a API rejeita um chamado sem o campo obrigatório titulo

curl -i -X POST http://127.0.0.1:8000/api/chamados \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "descricao": "O computador não liga.",
    "prioridade": "alta",
    "usuario_id": 1,
    "categoria_id": 1
  }'

Resultado:
HTTP/1.1 422 Unprocessable Content
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.4.24
Cache-Control: no-cache, private
Date: Tue, 27 Oct 2026 18:23:59 GMT
Content-Type: application/json
Access-Control-Allow-Origin: *

{"message":"The titulo field is required.","errors":{"titulo":["The titulo field is required."]}}

### 3.4 Teste 3 — Criar um chamado com categoria inexistente
Informar um categoria_id que não existe no banco de dados.

curl -i -X POST http://127.0.0.1:8000/api/chamados \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "titulo": "Problema de conexão",
    "descricao": "O computador não consegue acessar a rede.",
    "prioridade": "média",
    "usuario_id": 1,
    "categoria_id": 999999
  }'
  
  Resposta:
  HTTP/1.1 422 Unprocessable Content
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.4.24
Cache-Control: no-cache, private
Date: Tue, 27 Oct 2026 18:24:45 GMT
Content-Type: application/json
Access-Control-Allow-Origin: *

{"message":"The selected prioridade is invalid. (and 1 more error)","errors":{"prioridade":["The selected prioridade is invalid."],"categoria_id":["The selected categoria id is invalid."]}}

### 3.5 Teste 5 — Consultar um chamado inexistente
Consultar um ID que não existe.

curl -i http://127.0.0.1:8000/api/chamados/999999 \
  -H "Accept: application/json"

Resultado:
 HTTP/1.1 404 Not Found
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.4.24
Cache-Control: no-cache, private
Date: Tue, 27 Oct 2026 18:26:15 GMT
Content-Type: application/json
Access-Control-Allow-Origin: *

{"message":"Chamado n\u00e3o encontrado."}

### 3.6 Teste 6 — Atualizar os dados de um chamado com PATCH
Atualizar o título e a prioridade do chamado criado anteriormente.

curl -i -X PATCH "http://127.0.0.1:8000/api/chamados/11" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "titulo": "Computador não liga após atualização",
    "prioridade": "alta"
  }'

Resultado:

HTTP/1.1 200 OK
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.4.24
Cache-Control: no-cache, private
Date: Tue, 27 Oct 2026 18:39:08 GMT
Content-Type: application/json
Access-Control-Allow-Origin: *

{"data":{"id":11,"titulo":"Computador n\u00e3o liga ap\u00f3s atualiza\u00e7\u00e3o","descricao":"O computador n\u00e3o liga ap\u00f3s pressionar o bot\u00e3o de energia.","status":"aberto","prioridade":"alta","created_at":"2026-10-27T18:23:02.000000Z","updated_at":"2026-10-27T18:39:08.000000Z"}}

### 3.7 Teste 7 — Cadastrar um usuário com e-mail repetido
Esse teste para regra de unicidade para o e-mail.

Primeira requisição:

curl -i -X POST http://127.0.0.1:8000/api/usuarios \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "nome_usuario": "Usuario Teste",
    "email": "teste.chamadoja@example.com",
    "senha": "SenhaSegura123!"
  }'
  
Resposta:
HTTP/1.1 201 Created
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.4.24
Cache-Control: no-cache, private
Date: Tue, 27 Oct 2026 18:31:20 GMT
Content-Type: application/json
Access-Control-Allow-Origin: *

{"data":{"id":11,"nome":"Usuario Teste","email":"teste.chamadoja@example.com"}}


Segunda requisição com o mesmo comando.
Resultado:
HTTP/1.1 422 Unprocessable Content
Host: 127.0.0.1:8000
Connection: close
X-Powered-By: PHP/8.4.24
Cache-Control: no-cache, private
Date: Tue, 27 Oct 2026 18:32:08 GMT
Content-Type: application/json
Access-Control-Allow-Origin: *

{"message":"The email has already been taken.","errors":{"email":["The email has already been taken."]}}

