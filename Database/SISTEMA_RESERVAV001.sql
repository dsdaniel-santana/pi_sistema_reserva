---------------------------------------
-- Criação banco de dados
---------------------------------------
CREATE DATABASE sistema_reserva;
USE sistema_reserva;

---------------------------------------
-- Criação das tabelas
---------------------------------------

CREATE TABLE IF NOT EXISTS evento (
	id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    sigla VARCHAR(30) NOT NULL UNIQUE,
    oferta VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS tipo (
	id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_sala VARCHAR(150) NOT NULL
);

CREATE TABLE IF NOT EXISTS sala (
	id INT AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(10) NOT NULL,
    capacidade INT NOT NULL,
    andar INT NOT NULL,
    tipo_ID INT,
    FOREIGN KEY (tipo_ID) REFERENCES tipo(id)
);

CREATE TABLE IF NOT EXISTS reserva (
	id INT AUTO_INCREMENT PRIMARY KEY,
	docente VARCHAR(100) DEFAULT NULL,
	data_inicio DATE NOT NULL,
    data_fim DATE NOT NULL,
    horario_inicio TIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    horario_fim TIME NOT NULL,
    dias_semana VARCHAR(30) NOT NULL,
    evento_ID INT,
    sala_ID INT,
    FOREIGN KEY (evento_ID) REFERENCES evento(id),
    FOREIGN KEY (sala_ID) REFERENCES sala(id)
);

CREATE TABLE IF NOT EXISTS usuario (
	id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    senha VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    token VARCHAR(255) DEFAULT NULL
);

drop database sistema_reserva;

INSERT INTO tipo (id, tipo_sala) VALUES 
	(null, "lab. Informática"),
    (null, "Atrio");
    
INSERT INTO sala (numero, capacidade, andar, tipo_ID) VALUES 
	("18", 45, 1, 1);
    
INSERT INTO evento (titulo, sigla, oferta) VALUES 
	("Técnico em Informatica Para Internet", "TII04", "295894");

INSERT INTO reserva (docente, data_inicio, data_fim, horario_inicio, horario_fim, dias_semana, evento_ID, sala_ID) VALUES 
	("Aecio", "2024-03-06", "2024-05-24", "19:00:56", "22:30:34", "2, 3, 4, 5, 6", 1, 1);
select * from usuario;

