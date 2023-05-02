select * from usuarios;

create database tcc;
use tcc;

create table usuarios (
	cod_usuario int not null auto_increment,
	nome varchar(70),
	email varchar(50) UNIQUE,
	senha varchar (50),
	descricao_perfil varchar (200),
	foto_perfil blob, 
	conquistas int,
	primary key (cod_usuario)
);
alter table usuarios add column is_admin boolean default false;

create table conteudo (
	cod_conteudo int NOT NULL auto_increment,
    enunciado varchar(200) NOT NULL,
    midia varchar(50),
    primary key (cod_conteudo)
    );

CREATE TABLE questao (
    cod_questao int NOT NULL auto_increment,
    enunciado varchar(200) NOT NULL,
    midia varchar(50),
	alt1 varchar(100) NOT NULL,
	alt2 varchar(100) NOT NULL,
    alt3 varchar(100) NOT NULL,
    alt4 varchar(100) NOT NULL,
    alt5 varchar(100) NOT NULL,
    alt_correta int NOT NULL,
	cod_conteudo int,
    foreign key (cod_conteudo) references conteudo (cod_conteudo),
    PRIMARY KEY (cod_questao)
);
alter table questao modify column enunciado longtext not null;
CREATE TABLE perguntas (
    cod_pergunta int not null auto_increment,
    texto_pergunta varchar(200) not null,
    cod_usuario int not null,
    primary key (cod_pergunta),
    foreign key (cod_usuario) references usuarios(cod_usuario)
);
CREATE TABLE respostas (
    cod_resposta int not null auto_increment,
    texto_resposta varchar(200) not null,
    cod_pergunta int not null,
    cod_usuario int not null,
    primary key (cod_resposta),
    foreign key (cod_pergunta) references perguntas(cod_pergunta),
    foreign key (cod_usuario) references usuarios(cod_usuario)
);

create table tem (
	cod_pergunta int,
    cod_resposta int,
    FOREIGN KEY (cod_pergunta) REFERENCES perguntas (cod_pergunta),
    FOREIGN KEY (cod_resposta) REFERENCES respostas (cod_resposta)
);

create table conteudos_usuarios(
	cod_usuario int not null,
    cod_conteudo int not null,
	FOREIGN KEY (cod_usuario) REFERENCES usuarios (cod_usuario) on delete cascade,
	FOREIGN KEY (cod_conteudo) REFERENCES conteudo (cod_conteudo) on delete cascade,
    primary key (cod_conteudo, cod_usuario)
);
alter table conteudos_usuarios add column acertos int not null;




