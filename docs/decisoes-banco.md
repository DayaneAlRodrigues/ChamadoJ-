
A entidade `usuarios` é responsável para armazenar os dados do usuário que é necessário para o sistema. Possui os atributos:
 - id_usuario integer (chave primária e incremental);
 - nome varchar (not null);
 - email varchar (not null);
 - senha varchar (not null).

A entidade `categorias` serve para armazenar as categorias de chamados que podem ser abertos. Possui os seguintes atributos:
- id_categoria integer (chave primária e incremental);
- nome_categoria varchar (not null, unique);
- tipo.

O nome da categoria deve ser único para que não exista mais de uma categoria com o mesmo nome e o tipo da categoria, refere a área que a categoria está relacionada.

A entidade `comentarios`serve para armazenar somente os comentários de um chamado. Possui os atributos:
- id_comentario integer (chave primária e incremental);
- comentario varchar;

A entidade `chamados` é a principal do sistema, que se relaciona com todas as outras entidades. 
Ela possui os atributos:
- id_chamado (chave primária e incremental);
- titulo varchar (campo opcional);
- descrição varchar (not null e deve possuir os detalhes do motivo do chamado);
- status (not null e pode aceitar somente os valores : 'aberto', 'em_atendimento', 'resolvido', 'fechado');
- prioridade (not null e pode aceitar somente os valors: 'baixa', 'media', 'alta');
- created_at timestamp (é inserido automaticamente pelo banco ao criar o registro);
- updated_at timestamp (é atualizado na medida que modifica o registro);
- usuario_id integer (chave estrangeira);
- categoria_id integer (chave estrangeira);
- comentario_id integer (chave estrangeira). 