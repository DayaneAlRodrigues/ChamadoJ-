# Decisões de modelagem do banco de dados

Para conferir a modelagem do banco nas três formas normais foi utilizado as seguintes perguntas:

| Forma normal | Pergunta que fazemos                                                              |
| ------------ | --------------------------------------------------------------------------------- |
| **1FN**      | Cada campo possui um único valor e não existem grupos/repetições de atributos?    |
| **2FN**      | Além da 1FN, todos os atributos dependem da **chave primária inteira**?           |
| **3FN**      | Além da 2FN, os atributos não dependem de outros atributos que não sejam a chave? |

A partir disso, foi decidido as seguintes entidades da seguinte forma:

A entidade `usuarios` é responsável para armazenar os dados do usuário que é necessário para o sistema. Possui os atributos:

  * `id_usuario` integer (chave primária e incremental);
  * `nome` varchar (not null);
  * `email` varchar (not null);
  * `senha` varchar (not null).

A entidade `categorias` serve para armazenar as categorias de chamados que podem ser abertos. Possui os seguintes atributos:

  * `id_categoria` integer (chave primária e incremental);
  * `nome_categoria` varchar (not null, unique);
  * `tipo` varchar.

O nome da categoria deve ser único para que não exista mais de uma categoria com o mesmo nome e o tipo da categoria, refere a área que a categoria está relacionada. Desse modo, o atributo tipo se refere apenas a um substantivo para simplificar a categoria, não tem a necessidade de outra tabela.

A entidade `comentarios`serve para armazenar somente os comentários de um chamado, no qual um chamado pode ter N comentários. Também um usuário pode ter N comentarios. Assim a tabela possui os seguintes atributos:

  * `id_comentario` integer (chave primária e incremental);
  * `comentario` varchar;
  * `chamado_id` integer (chave estrangeira que se refere a tabela chamados);
  * `usuario_id` integer (chave estrangeira que se refere a tabela usuarios);
  * `created_at` timestamp (serve para datar quando foi feito o comentário).

A entidade `chamados` é a principal do sistema, que se relaciona com todas as outras entidades. Assim um usuario pode ter N chamados. Uma categoria pode ter N chamados. Um chamado pode ter N comentários. Um chamado pode ter N histórico de status.

Ela possui os atributos:

* `id_chamado` (chave primária e incremental);

* `titulo` varchar (campo opcional);

* `descrição` varchar (not null e deve possuir os detalhes do motivo do chamado);

* `status` (not null e pode aceitar somente os valores : 'aberto', 'em_atendimento', 'resolvido', 'fechado');

* `prioridade` (not null e pode aceitar somente os valors: 'baixa', 'media', 'alta');

* `created_at` timestamp (é inserido automaticamente pelo banco ao criar o registro);

* `updated_at` timestamp (é atualizado na medida que modifica o registro);

* `usuario_id` integer (chave estrangeira);

* `categoria_id` integer (chave estrangeira);

A entidade `historico_status` é importante para guardar toda a mudança do status de atendimento. Assim ao buscar informações de um chamado pelo historico, irá listar todas as mudanças e a data delas. Essa entidade possui os campos:

  * `id_historico` integer (chave primaria e incremental);
  * `status` varchar (not null);
  * `created_at` timestamp (serve para datar quando foi feito o comentário);
  * `chamado_id` integer (chave estrangeira que se refere a tabela chamados);
  * `usuario_id` integer (chave estrangeira que se refere a tabela usuarios);

