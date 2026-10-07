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

-- contar chamados por status;

-- contar chamados por categoria;

-- filtrar chamados por período;

-- consultar os comentários de um chamado;

-- consultar o histórico de status de um chamado.