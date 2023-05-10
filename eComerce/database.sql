create table producto(
    codpro int not null auto_increment,
    nompro varchar (50) null,
    despro varchar(150) null,
    prepro numeric (6,2) null,
    estado int null,
    constraint pk_producto
    primary key (codpro)
);
alter table producto add imgpro varchar(100) null;

insert into producto (nompro,despro,prepro,estado,imgpro)
values ('Optimum Nutrition', 'Gold Standard 100% whey 5lb','1099.99',1,'goldstandard.jpg'),
('musclemeds', 'carnivor proteína 100% de carne','999.99',1,'musclemeds-carnivor-4lb.jpg');

CREATE TABLE USUARIO(
	codusu int not null AUTO_INCREMENT,
	nomusu varchar(50) ,
	apeusu varchar(50) ,
	emausu varchar(50) not null,
	pasusu varchar(20) not null,
	estado int not null,
	CONSTRAINT pk_usuario
	PRIMARY KEY (codusu)
);

INSERT INTO USUARIO (nomusu,apeusu,emausu,pasusu,estado)
VALUES ('Usuario','Demo','correo@example.com','123456',1);

create table PEDIDO(
	codped int not null AUTO_INCREMENT,
	codusu int not null,
	codpro int not null,
	fecped datetime not null,
	estado int not null,
	dirusuped varchar(50) not null,
	telusuped varchar(12) not null,
	PRIMARY KEY (codped)
);
