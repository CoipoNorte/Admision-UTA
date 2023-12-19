-- Crear la base de datos
CREATE DATABASE admision;

-- Conectar a la base de datos
\c admision;

-- Crear la tabla de usuarios
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);

