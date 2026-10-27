# Diário de Desenvolvimento

Este arquivo tem como objetivo registrar as atividades realizadas durante o desenvolvimento do projeto, incluindo dúvidas, decisões tomadas e fontes utilizadas para pesquisa.

## Semana 1 — Desenvolvimento do Projeto (28/09/26 - 04/10/26)

Durante a primeira parte da semana, foram realizadas as seguintes atividades:

- Criação do repositório do projeto no GitHub;
- Elicitação dos requisitos do sistema;
- Criação das histórias de usuário;
- Criação e organização do diário de desenvolvimento.

Para realizar essas atividades, foi utilizado o **PDF de orientação do Projeto Integrador**, disponibilizado como material de referência para o desenvolvimento do projeto.

Durante a segunda parte da semana, foi realizado o contrato da api. Esse contrato descreve:
- as rotas que serão disponibilizadas pela API;
- divisão de rotas de usuários, categorias e chamados;
- parâmetros de rotas;
- exemplos de parâmetros de request body; 
- exemplos de responses;
- query parameters para utilização de filtros e paginação em chamados.

## Semana 2 - Modelo relacional e consultas PostgreSQL (05/10/26 - 10/11/26)

Na primeira parte da semana desenvolvi a modelagem do banco, criando o Diagrama Entidade Relacionamento (DER), onde foi possível:

- identificar entidades, atributos e relacionamentos;
- representar cardinalidades;
- definir chaves primárias e estrangeiras;
- aplicar restrições de integridade;

Também foi desenvolvido um arquivo para explicar as decisões da modelagem e o enquadramento nas três formas normais de um banco relacional.

A segunda parte da semana, desenvolvi o schema para implementação do banco. O seed, que são os dados para testar a aplicação no banco e as consultas baseadas nas que foram requisitadas na instrução do exercício. 
Foi utilizado IA para gerar seeder de inserção de dados para comentários de chamadose e histórico de status.

## Semana 3 - Base Laravel e persistência (12/10/26 - 17/10/26)

Na primeira parte da semana foi criado a base do Laravel, instalação do laravel e migrations. Contendo:
- projeto Laravel inicializado;
- arquivo .env.example sem credenciais pessoais;
- instruções de instalação no README.md ;
- conexão com PostgreSQL;
- migrations para usuários, categorias, chamados, comentários e histórico;
- chaves estrangeiras e índices;
- rota GET /api/saude retornando JSON.

Na segunda parte da semana foi desenvolvido:
- models;
- relacionamentos;
- factories;
- seeders.

### Semana 4 — Desenvolvimento da API principal de usuários, categorias e chamados

Durante o primeiro encontro, foram desenvolvidos os principais endpoints da API REST do ChamadoJá, permitindo realizar operações de consulta e cadastro de usuários e categorias, além da listagem, abertura, consulta e atualização de chamados.

**Endpoints implementados:**

- `GET /api/usuarios` — Listar usuários.
- `POST /api/usuarios` — Cadastrar usuário.
- `GET /api/categorias` — Listar categorias.
- `POST /api/categorias` — Cadastrar categoria.
- `GET /api/chamados` — Listar chamados.
- `POST /api/chamados` — Abrir chamado.
- `GET /api/chamados/{id}` — Consultar um chamado específico.
- `PATCH /api/chamados/{id}` — Atualizar parcialmente os dados de um chamado.

Também foram utilizados **Form Requests** para centralizar as regras de validação dos dados recebidos pela API, contribuindo para a organização do código e a consistência das informações.

No segundo encontro, foi concluído o desenvolvimento das principais operações do CRUD de chamados, incluindo a exclusão de registros. Também foram implementados **API Resources** para padronizar a estrutura das respostas em JSON.

Por fim, foram realizados testes manuais dos endpoints para verificar seu funcionamento, validar as respostas HTTP e identificar possíveis ajustes. Os testes e seus resultados foram documentados no `README.md` do projeto.





