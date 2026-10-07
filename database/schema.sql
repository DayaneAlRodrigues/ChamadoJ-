CREATE DATABASE chamado_ja;

CREATE TABLE usuarios (
    id_usuario SERIAL PRIMARY KEY,
    nome_usuario VARCHAR(150) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL);

CREATE TABLE categorias (
    id_categoria SERIAL PRIMARY KEY,
    nome_categoria VARCHAR(100) NOT NULL,
    tipo VARCHAR(100) NOT NULL);

CREATE TABLE chamados (
    id_chamados SERIAL PRIMARY KEY,
    titulo VARCHAR(100),
    descricao VARCHAR(500) NOT NULL,

    status VARCHAR(50) NOT NULL DEFAULT 'aberto'
    CHECK (status IN ('aberto', 'em_atendimento', 'resolvido', 'fechado')),

    prioridade VARCHAR (50) NOT NULL DEFAULT 'baixa'
    CHECK (prioridade IN ('baixa', 'media', 'alta')),

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    
    usuario_id INTEGER NOT NULL REFERENCES usuarios(id_usuario),
    categoria_id INTEGER NOT NULL REFERENCES categorias(id_categoria));

CREATE TABLE comentarios (
    id_comentario SERIAL PRIMARY KEY,
    comentario VARCHAR(500) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    chamado_id INTEGER NOT NULL REFERENCES chamados(id_chamados)  
    usuario_id INTEGER NOT NULL REFERENCES usuarios(id_usuario));

CREATE TABLE historico_status (
    id_historico SERIAL PRIMARY KEY,
    status VARCHAR(50) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    chamado_id INTEGER NOT NULL REFERENCES chamados(id_chamados),
    usuario_id INTEGER NOT NULL REFERENCES usuarios(id_usuario));

