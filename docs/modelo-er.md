# Modelo Entidade-Relacionamento - ER

## Entidade: `usuarios`

| Campo          | Tipo    | Restrições                |
| -------------- | ------- | ------------------------- |
| `id_usuario`   | integer | PK, incremento automático |
| `nome_usuario` | varchar | NOT NULL                  |
| `email`        | varchar | NOT NULL                  |
| `senha`        | varchar | NOT NULL                  |

---

## Entidade: `categorias`

| Campo            | Tipo    | Restrições                |
| ---------------- | ------- | ------------------------- |
| `id_categoria`   | integer | PK, incremento automático |
| `nome_categoria` | varchar | NOT NULL, UNIQUE          |
| `tipo`           | varchar | NOT NULL                  |

---

## Entidade: `comentarios`

| Campo           | Tipo    | Restrições                |
| --------------- | ------- | ------------------------- |
| `id_comentario` | integer | PK, incremento automático |
| `comentario`    | varchar | NOT NULL                  |

---

## Entidade: `chamados`

| Campo           | Tipo      | Restrições                                 |
| --------------- | --------- | ------------------------------------------ |
| `id_chamado`    | integer   | PK, incremento automático                  |
| `titulo`        | varchar   |                                            |
| `descricao`     | varchar   | NOT NULL                                   |
| `status`        | varchar   | NOT NULL                                   |
| `prioridade`    | varchar   | —                                          |
| `created_at`    | timestamp | —                                          |
| `updated_at`    | timestamp | —                                          |
| `usuario_id`    | integer   | FK → `usuarios.id_usuario`, NOT NULL       |
| `categoria_id`  | integer   | FK → `categorias.id_categoria`, NOT NULL   |
| `comentario_id` | integer   | FK → `comentarios.id_comentario`, NOT NULL |

---

## Entidade: `historico_status`

| Campo          | Tipo      | Restrições                           |
| -------------- | --------- | ------------------------------------ |
| `id_historico` | integer   | PK, incremento automático            |
| `status`       | varchar   | NOT NULL                             |
| `data`         | timestamp | —                                    |
| `chamado_id`   | integer   | FK → `chamados.id_chamado`, NOT NULL |

---

## Relacionamentos

* `usuarios` **1:N** `chamados`
* `categorias` **1:N** `chamados`
* `comentarios` **N:1** `chamados`
* `chamados` **1:N** `historico_status`
