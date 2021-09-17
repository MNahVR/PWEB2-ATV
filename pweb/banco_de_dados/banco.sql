CREATE TABLE usuario(
    id integer primary key auto_increment,
    nome varchar(100),
    nomeu varchar(100) unique,
    email varchar(50) unique,
    senha varchar(30)
)