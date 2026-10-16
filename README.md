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
