        /*/*------------------------------Devolver id genero, al ingresar un string/*------------------------------*/
DELIMITER $$
CREATE PROCEDURE p_get_gender(IN pGender varchar(50)) 
BEGIN
	SELECT id_gender  FROM gender WHERE gender=pGender;
END;
$$

                                /* Para llamarla: */
        /* CALL p_get_gender ('male');*/

    /*------------------------------Devolver id tamanio, al ingresar un string/*------------------------------*/
DELIMITER $$
CREATE PROCEDURE p_get_tamanio(IN pTamanio varchar(50)) 
BEGIN
	SELECT id_tamanio  FROM tamanio WHERE tamanio=pTamanio;
END;
$$

                    /*Para llamarla*/
            /*CALL p_get_tamanio ('big');*/

----------------------------------------------Owners----------------------------------------------------*/
   /*------------------------------ Insertar owner------------------------------*/
DELIMITER $$
CREATE PROCEDURE p_insert_owner(IN pUserName VARCHAR(50), IN pPassword nVARCHAR(50), IN pFUllName varchar(50), pAge INT, pEmail nVARCHAR(50), pId_Gender INT, pTelefono double) 
BEGIN
	INSERT INTO owner(userName,password, fullName, age,email,id_gender,telefono) VALUES
	(pUserName, pPassword, pFUllName, pAge,pEmail,pId_Gender,pTelefono);
END;
$$

/*-----------------------------------------------Para llamarla*/
/*CALL p_insert_owner('FacuFerra','1234', 'FacundoFerrari', 20,'facuferra@gmail.com',1,'412111');*/

/* -----------------------------------------------Devolver Owners-----------------------------------------------*/
DROP PROCEDURE IF EXISTS p_get_userNameOwner;
DELIMITER $$
CREATE PROCEDURE p_get_userNameOwner() 
BEGIN
    select o.id_owner,o.userName,o.password,o.fullName,o.age,o.email,o.telefono, g.gender
    FROM owner as o 
    inner join gender as g
    on o.id_gender = g.id_gender;
END;
$$
     /*----------------------------------------------- Para llamarla */
/*call p_get_userNameOwner();*/

/* --------------------------------------------------------Guardians----------------------------------------------------*/
      /*----------------------------------------------- Insertar guardian-----------------------------------------------*/

DROP PROCEDURE IF EXISTS p_insert_guardian;
DELIMITER $$
CREATE PROCEDURE p_insert_guardian(IN pUserName VARCHAR(50), IN pPassword nVARCHAR(50), IN pFUllName varchar(50), pAge INT, pEmail nVARCHAR(50), pId_Gender INT, pTelefono double, pCuil double, pFotoPerfil varchar(100), pFechasDisponibles varchar(500),pId_TamanioParaCuidar int, pPrecioPorHora int,pCalificacion int) 
BEGIN
	INSERT INTO guardian(userName,password, fullName, age,email,id_gender,telefono,cuil,fotoPerfil,fechasDisponibles,id_tamanioParaCuidar,PrecioPorHora,calificacion) VALUES
	(pUserName, pPassword, pFUllName, pAge,pEmail,pId_Gender,pTelefono,pCuil,pFotoPerfil,pFechasDisponibles,pId_TamanioParaCuidar,pPrecioPorHora,pCalificacion);
END;
$$
/*-----------------------------------------------Para llamarla -----------------------------------------------*/
/* CALL p_insert_guardian('FacuFerra','1234', 'FacundoFerrari', 20,'facuferra@gmail.com',2,412111,204414,'url','2022-11-4/2022-11-5',3,200,0);*/

/* -----------------------------------------------Devolver Guardians-----------------------------------------------*/

DROP PROCEDURE IF EXISTS p_get_userNameGuardian;
DELIMITER $$
CREATE PROCEDURE p_get_userNameGuardian() 
BEGIN
    select g.id_guardian,g.userName,g.password,g.fullName,g.age,g.email,g.telefono, ge.gender, t.tamanio, g.cuil,g.fotoPerfil,g.fechasDisponibles,g.precioPorHora,g.calificacion
    FROM guardian as g 
    inner join gender as ge
    on g.id_gender = ge.id_gender
    inner join tamanio as t
    on t.id_tamanio=g.id_tamanioParaCuidar;
END;
$$
/*-----------------------------------------------Para llamarla */
                /* CALL p_get_userNameGuardian();*/

/*----------------------------------------------- Borrar Gurdianes -----------------------------------------------*/
DELIMITER $$
CREATE PROCEDURE p_delete_guardian(IN pUserName VARCHAR(50)) 
BEGIN
	DELETE FROM guardian where userName= pUserName;
END;
$$


/*-----------------------------------------------Para llamarla */
    /* call p_delete_guardian("Rulito7");*/

/*----------------------------------------------- Modificar Gurdianes -----------------------------------------------*/
DROP PROCEDURE IF EXISTS p_update_guardian;
DELIMITER $$
CREATE PROCEDURE p_update_guardian(IN pUserName VARCHAR(50),in pFechas varchar(500), in pId_TamanioParaCuidar int) 
BEGIN
	update guardian set fechasDisponibles = pFechas, id_tamanioParaCuidar = pId_TamanioParaCuidar where userName= pUserName;
END;
$$

/*-----------------------------------------------Para llamarla */
        /*call p_update_guardian("Cris","2022/10/20",1)  */

/* ------------------------------ -----------------PET ----------------------------------------------------------------------------------------------------------------*/
/*-----------------------------------------------------Devolder Id Race e IdtipoAnimal--------------------------------------------------------*/

DELIMITER $$
CREATE PROCEDURE p_get_IdRace(IN pRace varchar(50)) 
BEGIN
	SELECT r.id_race, a.id_tipoAnimal
    FROM animal as a 
    inner join race as r 
    on r.id_race = a.id_race
    WHERE r.race=pRace;
END;
$$
/*-----------------------------------------------Para llamarla */
                /*call p_get_IdRace ("golden");

/*-----------------------------------------------Agregar PET ----------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS p_insert_pet;
DELIMITER $$
CREATE PROCEDURE p_insert_pet(IN pId_owner int ,IN pName VARCHAR(50), IN pId_Animal int, IN pId_Tamanio int, pDescription nVARCHAR(100),IN pAge INT, pgrXfoodPortion int, 
pWeight int, pFoto varchar(300),  pPlanVacunacion varchar(300), pVideos varchar(300)) 
BEGIN
	INSERT INTO pet(id_owner,name,id_animal, id_tamanio, description, age ,grXfoodPortion,weight,foto,planVacunacion,video) VALUES
	(pId_owner, pName, pId_Animal, pId_Tamanio,pDescription,pAge,pgrXfoodPortion,pWeight,pFoto,pPlanVacunacion,pVideos);
END;
$$
/*------------------------------ -----------------Para llamarla ------------------------------*/
/*--------------------call p_insert_pet (1,"Pepito",4,1,"Perro Bonito", 2, 100, 4, "urlFoto", "urlPlanVacunacion", "UrlVideo");/*

/*-------------------------------------------------Ver Pets --------------------------------------------------------*/
DROP PROCEDURE IF EXISTS p_get_Pet;
DELIMITER $$
CREATE PROCEDURE p_get_Pet() 
BEGIN
    select p.id_pet,p.id_owner,p.name, a.animal, r.race, t.tamanio,p.description, p.age, p.grXfoodPortion
    , p.weight,p.foto,p.planVacunacion,p.video
    from pet as p
    inner join tamanio as t
    on p.id_tamanio = t.id_tamanio
    inner join animal as a
    on a.id_tipoAnimal = p.id_animal
    inner join race as r
    on r.id_race = a.id_race;
END;
$$
/*------------------------------Para llamarla ------------------------------*/
/*------------------------------call p_get_Pet();*/

/*-------------------------------------------------------------RESERVES----------------------------------------------------*/

/*-------------------------------------------------------------Ver Estado --------------------------------*/
DELIMITER $$
CREATE PROCEDURE p_get_IdEstado(IN pEstado varchar(50)) 
BEGIN
	SELECT id_estado  FROM estado WHERE estado=pEstado;
END;
$$
/*----------------------------------------------------------------Para llamarla --------------------------------*/
/*-------------------------call p_get_IdEstado("realizada");*/

/*-------------------------------------------------------------Agregar Reserva --------------------------------*/
DROP PROCEDURE IF EXISTS p_insert_reserve;
DELIMITER $$
CREATE PROCEDURE p_insert_reserve(IN pId_guardian int ,IN id_Pet int, pFechaInicio nVARCHAR(100),pFechaFin nVARCHAR(100), IN pTotal INT, pId_Estado int) 
BEGIN
	INSERT INTO reserve(id_guardian,id_pet,fechaInicio, fechaFin, total, id_Estado) VALUES
	(pId_guardian, id_Pet, pFechaInicio,pFechaFin,pTotal,pId_Estado);
END;
$$
/*----------------------------------------------------------------Para llamarla --------------------------------*/
/*-------------------------call p_insert_reserve(1,1,"2022/01/10", "2022/01/11", 500,1);;*/

/*-------------------------------------------------------------Ver Reservas --------------------------------*/
DROP PROCEDURE IF EXISTS p_get_reserve;
DELIMITER $$
CREATE PROCEDURE p_get_reserve() 
BEGIN
	select r.id_reserve, r.id_guardian, r.id_pet, r.fechaInicio, r.fechaFin, r.total, e.estado, p.id_owner, a.animal, ra.race
    from reserve as r
    inner join estado as e
    on e.id_estado = r.id_estado
    inner join pet as p
    on p.id_pet = r.id_pet
	inner join animal as a
    on a.id_tipoAnimal = p.id_animal
    inner join race as ra
    on ra.id_race = a.id_race;
END;
$$
/*----------------------------------------------------------------Para llamarla --------------------------------*/
/*-------------------------call p_get_reserve();*/

/*-------------------------------------------------------------Borrar Reserva --------------------------------*/

DROP PROCEDURE IF EXISTS p_delete_reserve;
DELIMITER $$
CREATE PROCEDURE p_delete_reserve(IN pidReserve int) 
BEGIN
	DELETE FROM reserve where id_reserve= pidReserve;
END;
$$
/*----------------------------------------------------------------Para llamarla --------------------------------*/
/*-------------------------call p_delete_reserve(1);*/

/*-------------------------------------------------------------Modificar Reserva --------------------------------*/
DROP PROCEDURE IF EXISTS p_update_reserve;
DELIMITER $$
CREATE PROCEDURE p_update_reserve(in pId_Reserve int,IN pId_estado int,in pTotal int) 
BEGIN
	update reserve set id_estado = pId_estado, total = pTotal where id_reserve= pId_Reserve;
END;
$$
/*----------------------------------------------------------------Para llamarla --------------------------------*/

/*-------------------------call p_update_reserve(2,2,250);*/
