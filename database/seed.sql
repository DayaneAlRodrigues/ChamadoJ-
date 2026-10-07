INSERT INTO usuarios (
    nome_usuario, 
    email, 
    senha)
VALUES
    ('Ana Silva', 'ana@email.com', '123456'),
    ('Carlos Souza', 'carlos@email.com', '123456'),
    ('Maria Oliveira', 'maria@email.com', '123456'),
    ('Waldemir Santos', 'wal@email.com', '123456'),
    ('Talles Rodrigues', 'talles@email.com', '123456'),
    ('Joana Lobo', 'joana@email.com', '123456'),
    ('Cristina Diaz', 'cristina@email.com', '123456'),
    ('Dionísio Feitosa', 'dionisio@email.com', '123456'),
    ('Lucas Gael', 'lucas@email.com', '123456'),
    ('Amina Hassan', 'amina@email.com', '123456');

INSERT INTO categorias (
    nome_categoria, 
    tipo)
VALUES
    ('Computador', 'Hardware'),
    ('Sistema', 'Software'),
    ('Rede', 'Infraestrutura'),
    ('Impressora', 'Hardware'),
    ('Periféricos', 'Hardware'),
    ('Banco de Dados', 'Software'),
    ('Aplicativos', 'Software'),
    ('Segurança', 'Infraestrutura'),
    ('Acesso e Permissões', 'Suporte'),
    ('E-mail', 'Comunicação');

INSERT INTO chamados (
    titulo,
    descricao,
    status,
    prioridade,
    usuario_id,
    categoria_id
)
VALUES
    (
        'Computador não liga',
        'O computador não apresenta nenhum sinal ao pressionar o botão de ligar.',
        'aberto',
        'urgente',
        1,
        1
    ),
    (
        'Sistema apresentando erro',
        'O sistema apresenta uma mensagem de erro ao tentar realizar o login.',
        'em_atendimento',
        'media',
        2,
        2
    ),
    (
        'Problema de conexão',
        'Computador não consegue acessar a internet.',
        'fechado',
        'alta',
        3,
        3
    ),
    (
        'Impressora não funciona',
        'Impressora não está funcionando e sua conexão com os computadores está falhando',
        'aberto',
        'baixa',
        4,
        4
    ),
    (
        'Mouse e teclado não funcionam',
        'Mouse e teclado não estão respondendo ao comandos necessários',
        'aberto',
        'media',
        5,
        5
    ),
    (
        'Banco de dados está errado',
        'Os dados esperados do banco não está sendo retornado',
        'resolvido',
        'alta',
        6,
        6
    ),
    (
        'Aplicativo fora do ar',
        'Aplicativo da empresa está fora do ar',
        'em_atendimento',
        'alta',
        7,
        7
    ),
    (
        'Senha do usuario está aparecendo',
        'Senha do usuario está retornando no console',
        'resolvido',
        'media',
        8,
        8
    ),
    (
        'Preciso acessar o histórico',
        'Preciso acessar o histórico de status mais o sistema não está permitindo',
        'aberto',
        'baixa',
        9,
        9
    ),
    (
        'Email errado',
        'O email do usuario está incorreto',
        'aberto',
        'baixa',
        10,
        10
    );


INSERT INTO comentarios (
    comentario,
    chamado_id,
    usuario_id
)
VALUES
    (
        'Vou verificar o equipamento e testar a fonte de alimentação.',
        1,
        4
    ),
    (
        'O cabo de energia está conectado corretamente.',
        1,
        5
    ),
    (
        'Vou verificar os registros de erro do sistema.',
        2,
        3
    ),
    (
        'O problema ocorre somente com este usuário.',
        2,
        2
    ),
    (
        'Foi identificado um problema na configuração de rede.',
        3,
        6
    ),
    (
        'A conexão foi restabelecida após a atualização das configurações.',
        3,
        3
    ),
    (
        'Vou verificar os drivers da impressora.',
        4,
        1
    ),
    (
        'A impressora foi reconhecida novamente pelo computador.',
        4,
        4
    ),
    (
        'Vou testar o mouse e o teclado em outro computador.',
        5,
        2
    ),
    (
        'Os periféricos funcionaram normalmente em outro equipamento.',
        5,
        5
    ),
    (
        'Vou verificar as consultas utilizadas para buscar os dados.',
        6,
        7
    ),
    (
        'Foi encontrada uma inconsistência na consulta do banco.',
        6,
        6
    ),
    (
        'A consulta foi corrigida e os dados estão sendo retornados corretamente.',
        6,
        7
    ),
    (
        'Vou verificar os serviços responsáveis pelo aplicativo.',
        7,
        8
    ),
    (
        'O serviço principal apresentou uma falha durante a execução.',
        7,
        7
    ),
    (
        'O serviço foi reiniciado e o aplicativo voltou a responder.',
        7,
        8
    ),
    (
        'Vou verificar o código responsável pela exibição das informações.',
        8,
        9
    ),
    (
        'Foi identificado um log que estava exibindo informações sensíveis.',
        8,
        8
    ),
    (
        'O log foi removido e as informações não estão mais sendo exibidas.',
        8,
        9
    ),
    (
        'Vou verificar as permissões do usuário.',
        9,
        10
    ),
    (
        'O usuário não possui permissão para consultar o histórico.',
        9,
        9
    ),
    (
        'Vou verificar o cadastro do usuário no sistema.',
        10,
        1
    ),
    (
        'O endereço de e-mail cadastrado está incorreto.',
        10,
        10
    ),
    (
        'O e-mail foi corrigido no cadastro.',
        10,
        1
    );

INSERT INTO historico_status (
    status,
    chamado_id,
    usuario_id
)
VALUES
    -- Chamado 1
    ('aberto', 1, 1),
    ('em_atendimento', 1, 4),

    -- Chamado 2
    ('aberto', 2, 2),
    ('em_atendimento', 2, 3),

    -- Chamado 3
    ('aberto', 3, 3),
    ('em_atendimento', 3, 6),
    ('resolvido', 3, 6),
    ('fechado', 3, 3),

    -- Chamado 4
    ('aberto', 4, 4),

    -- Chamado 5
    ('aberto', 5, 5),
    ('em_atendimento', 5, 2),

    -- Chamado 6
    ('aberto', 6, 6),
    ('em_atendimento', 6, 7),
    ('resolvido', 6, 7),

    -- Chamado 7
    ('aberto', 7, 7),
    ('em_atendimento', 7, 8),

    -- Chamado 8
    ('aberto', 8, 8),
    ('em_atendimento', 8, 9),
    ('resolvido', 8, 9),

    -- Chamado 9
    ('aberto', 9, 9),

    -- Chamado 10
    ('aberto', 10, 10);