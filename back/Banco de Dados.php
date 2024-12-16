CREATE DATABASE usuarios_db;

USE usuarios_db;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo_conta ENUM('fisica', 'juridica') NOT NULL
);
