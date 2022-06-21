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

CREATE TABLE usuario(
    idusuario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(250),
    login varchar(45),
    senha varchar(45));