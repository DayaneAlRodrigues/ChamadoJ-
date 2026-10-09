-- listar chamados abertos ou em atendimento;
SELECT * 
FROM chamados 
WHERE status='aberto' 
    OR status='em_atendimento';

-- ordenar chamados por prioridade;
SELECT *
FROM chamados
ORDER BY CASE prioridade
    WHEN 'baixa' THEN 1
    WHEN 'media' THEN 2
    WHEN 'alta' THEN 3
END;
-- consultar chamados com nome do solicitante e da categoria;
SELECT
c.id_chamado,
c.titulo,
c.descricao,
c.status,
c.prioridade,
c.created_at,
c.updated_at,
u.nome_usuario,
cat.nome_categoria
FROM chamados AS c

INNER JOIN usuarios AS u
ON c.usuario_id = u.id_usuario,

INNER JOIN categorias AS cat
ON c.categoria_id = cat.id_categoria,

ORDER BY c.titulo ASC;

-- contar chamados por status;
SELECT 
status,
COUNT(*) AS quantidade,
FROM chamados
GROUP BY status
ORDER BY quantidade DESC;

-- contar chamados por categoria;
SELECT
c.categoria_id AS id,
cat.nome_categoria AS nome,
COUNT(*) AS quantidade,

FROM chamados AS c
INNER JOIN categorias AS cat
ON c.categoria_id = cat.id_categoria,
GROUP BY 
c.categoria_id,
cat.nome_categoria
ORDER BY quantidade DESC;

-- filtrar chamados por período;
SELECT
created_at,
updated_at
id_chamado,
titulo,
FROM chamados
GROUP BY 
    created_at,
    updated_at;

-- consultar os comentários de um chamado;
SELECT 
c.*
FROM comentarios AS c
WHERE c.chamado_id = 1
ORDER BY c.created_at ASC;

-- consultar o histórico de status de um chamado.
SELECT
h.*
FROM historico_status AS h
WHERE chamado_id = 1
ORDER BY h.created_at ASC;
