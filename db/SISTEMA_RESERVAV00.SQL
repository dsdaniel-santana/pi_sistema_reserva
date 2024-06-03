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
    docente VARCHAR(100) DEFAULT NULL,
    oferta VARCHAR(50) NOT NULL
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
    status_sala ENUM("Livre","Resevado","Em Manutenção"),
	data_inicio DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    data_fim DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    horario_inicio TIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    horario_fim TIME NOT NULL,
    dias_semana VARCHAR(30) NOT NULL,
    evento_ID INT,
    sala_ID INT,
    FOREIGN KEY (evento_ID) REFERENCES evento(id),
    FOREIGN KEY (sala_ID) REFERENCES sala(id)
);


