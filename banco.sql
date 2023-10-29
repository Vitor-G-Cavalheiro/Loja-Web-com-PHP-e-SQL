CREATE SCHEMA StreetPlay;
USE StreetPlay;
CREATE TABLE StreetPlay.usuarios (
idUsuario INT(11) NOT NULL AUTO_INCREMENT,
nome VARCHAR(150) NOT NULL,
senha VARCHAR(8) NOT NULL,
email VARCHAR(255) NOT NULL,
foto BLOB NULL,
descricao VARCHAR(255) NULL,
administrador BOOLEAN NOT NULL,
PRIMARY KEY (idUsuario)
);
CREATE TABLE StreetPlay.Categorias (
idCategoria INT(11) NOT NULL AUTO_INCREMENT,
nome VARCHAR(150) NOT NULL,
PRIMARY KEY (idCategoria)
);
CREATE TABLE StreetPlay.Desenvolvedoras (
idDesenvolvedora INT(11) NOT NULL AUTO_INCREMENT,
nome VARCHAR(150) NOT NULL,
senha VARCHAR(8) NOT NULL,
email VARCHAR(255) NOT NULL,
descricao VARCHAR(255) NULL,
foto BLOB NULL,
PRIMARY KEY (idDesenvolvedora)
);
CREATE TABLE StreetPlay.Publicadoras (
idPublicadora INT(11) NOT NULL AUTO_INCREMENT,
nome VARCHAR(150) NOT NULL,
senha VARCHAR(8) NOT NULL,
email VARCHAR(255) NOT NULL,
descricao VARCHAR(255) NULL,
foto BLOB NULL,
PRIMARY KEY (idPublicadora)
);
CREATE TABLE StreetPlay.Jogos (
idJogo INT(11) NOT NULL AUTO_INCREMENT,
nome VARCHAR(150) NOT NULL,
preco DECIMAL(11) NOT NULL,
descricao VARCHAR(255) NULL,
PRIMARY KEY (idJogo)
);
CREATE TABLE StreetPlay.JogosPublicados (
idJogoPublicado INT(11) NOT NULL AUTO_INCREMENT,
idDesenvolvedora INT(11) NOT NULL,
idPublicadora INT(11) NOT NULL,
idJogo INT(11) NOT NULL,
PRIMARY KEY (idJogoPublicado),
CONSTRAINT fk_desenvolvedora_jogopublicado
FOREIGN KEY (idDesenvolvedora)
REFERENCES StreetPlay.Desenvolvedoras (idDesenvolvedora),
CONSTRAINT fk_publicadora_jogopublicado
FOREIGN KEY (idPublicadora)
REFERENCES StreetPlay.Publicadoras (idPublicadora),
CONSTRAINT fk_jogo_jogopublicado
FOREIGN KEY (idJogo)
REFERENCES StreetPlay.Jogos (idJogo)
);
CREATE TABLE StreetPlay.Carrinho (
idCarrinho INT(11) NOT NULL AUTO_INCREMENT,
idJogoPublicado INT(11) NOT NULL,
idUsuario INT(11) NOT NULL,
PRIMARY KEY (idCarrinho),
CONSTRAINT fk_jogopublicado_carrinho
FOREIGN KEY (idJogoPublicado)
REFERENCES StreetPlay.JogosPublicados (idJogoPublicado),
CONSTRAINT fk_usuario_carrinho
FOREIGN KEY (idUsuario)
REFERENCES StreetPlay.Usuarios (idUsuario)
);
CREATE TABLE StreetPlay.Colecoes (
idColecao INT(11) NOT NULL AUTO_INCREMENT,
nome VARCHAR(150) NOT NULL,
privada BOOLEAN NOT NULL,
idUsuario INT(11) NULL,
idDesenvolvedora INT(11) NULL,
idPublicadora INT(11) NULL,
idJogoPublicado INT(11) NULL,
PRIMARY KEY (idColecao),
CONSTRAINT fk_usuario_colecao
FOREIGN KEY (idUsuario)
REFERENCES StreetPlay.Usuarios (idUsuario),
CONSTRAINT fk_desenvolvedora_colecao
FOREIGN KEY (idDesenvolvedora)
REFERENCES StreetPlay.Desenvolvedoras (idDesenvolvedora),
CONSTRAINT fk_publicadora_colecao
FOREIGN KEY (idPublicadora)
REFERENCES StreetPlay.Publicadoras (idPublicadora),
CONSTRAINT fk_jogopublicado_colecao
FOREIGN KEY (idJogoPublicado)
REFERENCES StreetPlay.JogosPublicados (idJogoPublicado)
);
CREATE TABLE StreetPlay.Biblioteca (
idBiblioteca INT(11) NOT NULL AUTO_INCREMENT,
idUsuario INT(11) NOT NULL,
idJogoPublicado INT(11) NULL,
idColecao INT(11) NULL,
PRIMARY KEY (idBiblioteca),
CONSTRAINT fk_usuario_biblioteca
FOREIGN KEY (idUsuario)
REFERENCES StreetPlay.Usuarios (idUsuario),
CONSTRAINT fk_jogopublicado_biblioteca
FOREIGN KEY (idJogoPublicado)
REFERENCES StreetPlay.JogosPublicados (idJogoPublicado),
CONSTRAINT fk_colecao_biblioteca
FOREIGN KEY (idColecao)
REFERENCES StreetPlay.Colecoes (idColecao)
);
CREATE TABLE StreetPlay.CategoriasJogos (
idCategoriaJogo INT(11) NOT NULL AUTO_INCREMENT,
idJogo INT(11) NOT NULL,
idCategoria INT(11) NOT NULL,
PRIMARY KEY (idCategoriaJogo),
CONSTRAINT fk_jogo_cateogirajogo
FOREIGN KEY (idJogo)
REFERENCES StreetPlay.Jogos (idJogo),
CONSTRAINT fk_categoria_categoriajogo
FOREIGN KEY (idCategoria)
REFERENCES StreetPlay.Categorias (idCategoria)
);
CREATE TABLE StreetPlay.FotosJogos (
idFotoJogo INT(11) NOT NULL AUTO_INCREMENT,
idJogo INT(11) NOT NULL,
foto BLOB NOT NULL,
PRIMARY KEY (idFotoJogo),
CONSTRAINT fk_jogo_fotojogo
FOREIGN KEY (idJogo)
REFERENCES StreetPlay.Jogos (idJogo)
);
CREATE TABLE StreetPlay.Favoritos (
idFavorito INT(11) NOT NULL AUTO_INCREMENT,
idJogoPublicado INT(11) NOT NULL,
idUsuario INT(11) NOT NULL,
PRIMARY KEY (idFavorito),
CONSTRAINT fk_jogopublicado_favorito
FOREIGN KEY (idJogoPublicado)
REFERENCES StreetPlay.JogosPublicados (idJogoPublicado),
CONSTRAINT fk_usuario_favorito
FOREIGN KEY (idUsuario)
REFERENCES StreetPlay.Usuarios (idUsuario)
);

INSERT INTO Usuarios (nome, senha, email, administrador) values ('Admin', '2005', 'vitor.cavalheiro@aluno.ifsp.edu.br', TRUE);
