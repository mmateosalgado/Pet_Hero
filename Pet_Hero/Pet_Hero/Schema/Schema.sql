Create database Pet_Hero;
use Pet_Hero;

create table gender(
id_gender  integer auto_increment not null,
gender varchar(30) not null,
primary key (id_gender)
)Engine=InnoDB;

create table tamanio(
id_tamanio integer auto_increment not null,
tamanio varchar(30) not null,
primary key(id_tamanio)
)Engine=InnoDB;


create table guardian(
id_guardian integer auto_increment not null,
userName varchar(30) not null unique,
password nvarchar(30) not null,
fullName varchar(30) not null,
age integer not null,
email nvarchar(64) unique not null,
id_gender integer not null,
telefono double not null,
cuil double not null unique,
fotoPerfil varchar(300) not null,
fechasDisponibles varchar(500),
id_tamanioParaCuidar integer not null,
calificacion integer not null,
precioporhora integer not null,

primary key (id_guardian),
constraint fkGenderG foreign key (id_gender) references gender(id_gender),
constraint fkTamanio foreign key (id_tamanioParaCuidar) references tamanio(id_tamanio)

)Engine=InnoDB;

create table owner(
id_owner integer auto_increment not null,
userName varchar(30) not null unique,
password nvarchar(30) not null,
fullName varchar(30) not null,
age integer not null,
email nvarchar(64) unique not null,
id_gender integer not null,
telefono double not null,
primary key (id_owner),
constraint fkGenderO foreign key (id_gender) references gender(id_gender)
)Engine=InnoDB;

create table review(
id_review integer auto_increment not null,
calificacion integer not null,
id_guardian integer not null,
description nvarchar(100) not null,
primary key (id_review),
constraint fkGuardianR foreign key (id_guardian) references guardian(id_guardian)
)Engine=InnoDB;

create table race(
id_race integer auto_increment not null,
race varchar(30) not null,
primary key (id_race)
)Engine=InnoDB;

create table animal(
id_tipoAnimal integer auto_increment not null,
animal varchar(30) not null,
id_race integer not null,
primary key (id_tipoAnimal),
constraint fkRace foreign key (id_race) references race(id_race)
)Engine=InnoDB;

create table pet(
id_pet integer auto_increment not null,
id_owner integer not null,
name varchar(30) not null,
id_animal integer not null,
id_tamanio integer not null,
description varchar(100) not null,
age integer not null,
grXfoodPortion integer not null,
weight integer not null,
foto varchar(300) not null,
planVacunacion varchar (300) not null,
video varchar(300),
primary key (id_pet),
constraint fkOwner foreign key (id_owner) references owner(id_owner),
constraint fkAnimal foreign key (id_animal) references animal(id_tipoAnimal),
constraint fkTamanioPet foreign key (id_tamanio) references tamanio(id_tamanio)
)Engine=InnoDB;

create table estado(
id_estado integer auto_increment not null,
estado varchar(30) not null,
primary key(id_estado)
)Engine=InnoDB;

create table reserve(
id_reserve integer auto_increment not null,
id_guardian integer not null,
id_pet integer not null,
fechaInicio date not null,
fechaFin date not null,
total integer not null,
id_estado integer not null,
primary key(id_reserve),
constraint fkGuardian foreign key (id_guardian) references guardian(id_guardian),
constraint fkPet foreign key (id_pet) references pet(id_pet),
constraint fkEstado foreign key (id_estado) references estado(id_estado)
)Engine=InnoDB;

insert into gender (gender) values ('female'),('male'),('other');
insert into tamanio (tamanio) values ('small'),('medium'),('big');
insert into race (race) values ('salchicha'),('caniche'),('bulldog'),('labrador'),('pitbull'),('golden'),('doberman'),('persa'),('siames'),('ragdoll'),('british'),('siberiano'),('china'),('ruso'),('campbell'),('roborowski'),('payaso'),('guppys'),('tetras'),('disco');
insert into animal (animal,id_race) values ('perro',1),('perro',2),('perro',3),('perro',4),('perro',5),('perro',6),('perro',7),('gato',8),('gato',9),('gato',10),('gato',11),('gato',12),('hamster',13),('hamster',14),('hamster',15),('hamster',16),('pez',17),('pez',18),('pez',19),('pez',20);
insert into estado (estado) values ('en espera'),('confirmada'),('rechazada'),('realizada'),('pagada');
