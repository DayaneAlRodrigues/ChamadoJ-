# Documento de Especificação de Requisitos (DRE)

## 1. Introdução

O **ChamadoJá** é uma API de suporte técnico destinada ao gerenciamento de chamados de uma empresa.

A solução permitirá que clientes e funcionários registrem e acompanhem solicitações de suporte. Através da API, será possível abrir chamados, consultar seu andamento, adicionar comentários, alterar seus status e consultar o histórico de alterações realizadas durante o atendimento.

O sistema tem como objetivo centralizar as informações relacionadas aos chamados, facilitando o acompanhamento e o gerenciamento das solicitações de suporte.

---

## 1.1 Objetivo

O objetivo do **ChamadoJá** é substituir o controle de chamados realizado por meio de mensagens e planilhas, que pode dificultar o acompanhamento, a organização e a consulta das solicitações.

Com a implementação da API, será possível centralizar os dados dos chamados e disponibilizar recursos para:

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

Dessa forma, a solução busca proporcionar maior organização e facilitar o gerenciamento do atendimento de suporte.

---

## 1.2 Escopo

O produto de software a ser desenvolvido será uma **API REST denominada ChamadoJá**, responsável pela implementação da lógica de negócio e das funcionalidades de back-end do sistema de suporte.

Nesta primeira versão, o projeto terá como foco exclusivamente o desenvolvimento da API, não sendo contemplada a criação de uma interface gráfica ou aplicação front-end.

A API poderá futuramente ser consumida por diferentes aplicações, como sistemas web, aplicações mobile ou outros serviços.

Durante o desenvolvimento e os testes da primeira versão, os endpoints poderão ser acessados utilizando ferramentas como:

- Postman;
- cURL;
- outras ferramentas capazes de realizar requisições HTTP.

### Fora do escopo da primeira versão

Não fazem parte do escopo inicial:

- desenvolvimento de interface web;
- desenvolvimento de aplicativo mobile;
- criação de sistema de autenticação completo;
- hospedagem da aplicação em ambiente de produção.

---

# 2. Descrição Geral

O **ChamadoJá** será desenvolvido como uma API REST para gerenciamento de solicitações de suporte técnico.

O sistema deverá permitir o gerenciamento de usuários, categorias e chamados, além do acompanhamento do histórico e das interações realizadas durante o atendimento.

---

## 2.1 Requisitos Funcionais

Os requisitos funcionais representam as funcionalidades que o sistema deverá disponibilizar.

| ID | Requisito |
|---|---|
| **RF01** | O sistema deve permitir o cadastro de usuários. |
| **RF02** | O sistema deve permitir a consulta de usuários. |
| **RF03** | O sistema deve permitir o cadastro de categorias de chamados. |
| **RF04** | O sistema deve permitir a consulta de categorias. |
| **RF05** | O sistema deve permitir a abertura de chamados. |
| **RF06** | O sistema deve permitir a consulta de um chamado específico. |
| **RF07** | O sistema deve permitir a listagem de chamados. |
| **RF08** | O sistema deve permitir a atualização dos dados de um chamado. |
| **RF09** | O sistema deve permitir a filtragem de chamados de acordo com critérios definidos. |
| **RF10** | O sistema deve permitir a paginação da listagem de chamados. |
| **RF11** | O sistema deve permitir a adição de comentários em um chamado. |
| **RF12** | O sistema deve permitir a alteração do status de um chamado. |
| **RF13** | O sistema deve permitir a consulta do histórico de alterações de status de um chamado. |
| **RF14** | O sistema deve permitir a consulta de um resumo dos chamados. |

---

## 2.2 Requisitos Não Funcionais

Os requisitos não funcionais representam as características técnicas, restrições e condições de funcionamento do sistema.

| ID | Requisito |
|---|---|
| **RNF01** | A API deve ser desenvolvida utilizando o framework Laravel. |
| **RNF02** | O sistema deve utilizar PostgreSQL como banco de dados. |
| **RNF03** | O código-fonte deve ser versionado utilizando Git e disponibilizado em um repositório. |
| **RNF04** | A API deve disponibilizar seus recursos por meio de endpoints HTTP seguindo os princípios de uma API REST. |
| **RNF05** | O projeto deve possuir testes automatizados básicos para validação das principais funcionalidades. |
| **RNF06** | O projeto deve possuir um arquivo `README.md` contendo as instruções de instalação, configuração e execução. |
| **RNF07** | O projeto deve permitir que outro desenvolvedor configure e execute a aplicação seguindo as instruções disponibilizadas no `README.md`. |


## 3 Regras iniciais de prioridade e status

### 3.1 Prioridade

Todo chamado deverá possuir uma prioridade, utilizada para indicar seu nível de urgência.

Inicialmente, serão consideradas as seguintes prioridades:

| Prioridade | Descrição |
|---|---|
| Baixa | Chamados de baixo impacto que podem ser atendidos posteriormente. |
| Média | Chamados que apresentam impacto moderado para o usuário. |
| Alta | Chamados que apresentam impacto significativo e devem receber atendimento prioritário. |
| Urgente | Chamados críticos que impedem o funcionamento de um serviço ou atividade importante. |

A prioridade deverá ser definida no momento da abertura do chamado e poderá ser alterada posteriormente conforme as regras de acesso definidas para os usuários.

### 3.2 Status

Todo chamado deverá possuir um status que represente sua situação atual no processo de atendimento.

Inicialmente, serão considerados os seguintes status:

| Status | Descrição |
|---|---|
| Aberto | Chamado criado e aguardando atendimento. |
| Em atendimento | Chamado que está sendo analisado ou tratado por um funcionário. |
| Resolvido | Problema solucionado, aguardando finalização do atendimento. |
| Fechado | Atendimento finalizado. |

Regras iniciais:

- Todo chamado deverá ser criado com o status `Aberto`.
- A alteração de status deverá ser registrada no histórico do chamado.
- O histórico deverá registrar, no mínimo, o status anterior, o novo status, a data da alteração e o usuário responsável.
- Um chamado `Fechado` não poderá ser alterado, exceto caso seja definida posteriormente uma regra de reabertura.

## 4 Dúvidas e hipóteses

### 4.1 Dúvidas

- Um chamado fechado poderá ser reaberto?
- Quem poderá alterar a prioridade de um chamado?
- Clientes poderão alterar a prioridade?
- Um chamado resolvido será automaticamente fechado ou dependerá da confirmação do cliente?
- Quais usuários poderão alterar o status?
- Um chamado poderá possuir mais de uma categoria?

### 4.2 Hipóteses

- Inicialmente, será considerado que apenas funcionários poderão alterar o status dos chamados.
- Inicialmente, será considerado que clientes poderão visualizar seus próprios chamados e respectivos comentários.
- Inicialmente, será considerado que o status inicial de todo chamado será `Aberto`.