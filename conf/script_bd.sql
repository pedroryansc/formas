CREATE SCHEMA quadradoRecuperacao;

CREATE TABLE tabuleiro(
    idtabuleiro INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    lado INT);

CREATE TABLE quadrado(
    idquadrado INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	lado INT,
    cor varchar(45),
    tabuleiro_idtabuleiro INT,
    FOREIGN KEY (tabuleiro_idtabuleiro) references tabuleiro (idtabuleiro));

CREATE TABLE triangulo(
    idtriangulo INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    ladoA decimal(6,2),
    ladoB decimal(6,2),
    ladoC decimal(6,2),
    cor varchar(45),
    tabuleiro_idtabuleiro INT,
    FOREIGN KEY (tabuleiro_idtabuleiro) references tabuleiro (idtabuleiro));

CREATE TABLE usuario(
    idusuario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(250),
    login varchar(45),
    senha varchar(45));