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

DROP PROCEDURE IF EXISTS p_get_Guardian;
DELIMITER $$
CREATE PROCEDURE p_get_Guardian() 
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
                /* CALL p_get_Guardian();*/

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

/*----------------------------------------------- Devolver Gurdian Por Username -----------------------------------------------*/
DROP PROCEDURE IF EXISTS p_get_ByuserNameGuardian;
DELIMITER $$
CREATE PROCEDURE p_get_ByuserNameGuardian(in pUsername varchar(30)) 
BEGIN
    select g.id_guardian,g.userName,g.password,g.fullName,g.age,g.email,g.telefono, ge.gender, t.tamanio, g.cuil,g.fotoPerfil,g.fechasDisponibles,g.precioPorHora,g.calificacion
    FROM guardian as g 
    inner join gender as ge
    on g.id_gender = ge.id_gender
    inner join tamanio as t
    on t.id_tamanio=g.id_tamanioParaCuidar
    where pUsername = g.userName;
END;
$$
/*-----------------------------------------------Para llamarla */
        /*call p_get_ByuserNameGuardian("Cris","2022/10/20",1)  */
/*----------------------------------------------- Devolver Gurdian por Email-----------------------------------------------*/
DROP PROCEDURE IF EXISTS p_get_EmailGuardian;
DELIMITER $$
CREATE PROCEDURE p_get_ByEmailGuardian(in pEmail nvarchar(50)) 
BEGIN
    select g.id_guardian,g.userName,g.password,g.fullName,g.age,g.email,g.telefono, ge.gender, t.tamanio, g.cuil,g.fotoPerfil,g.fechasDisponibles,g.precioPorHora,g.calificacion
    FROM guardian as g 
    inner join gender as ge
    on g.id_gender = ge.id_gender
    inner join tamanio as t
    on t.id_tamanio=g.id_tamanioParaCuidar
    where pEmail = g.email;
END;
$$

/*-----------------------------------------------Para llamarla */
        /*CALL p_get_ByEmailGuardian("cris@martinez.com");  */
/*----------------------------------------------- Devolver Gurdian por Id-----------------------------------------------*/
DROP PROCEDURE IF EXISTS p_get_ByIdGuardian;
DELIMITER $$
CREATE PROCEDURE p_get_ByIdGuardian(in pId int) 
BEGIN
    select g.id_guardian,g.userName,g.password,g.fullName,g.age,g.email,g.telefono, ge.gender, t.tamanio, g.cuil,g.fotoPerfil,g.fechasDisponibles,g.precioPorHora,g.calificacion
    FROM guardian as g 
    inner join gender as ge
    on g.id_gender = ge.id_gender
    inner join tamanio as t
    on t.id_tamanio=g.id_tamanioParaCuidar
    where pId = g.id_guardian;
END;
$$

/*-----------------------------------------------Para llamarla */
        /*CALL p_get_ByIdGuardian(1);  */
/*----------------------------------------------- Devolver Gurdianes por Size-----------------------------------------------*/   
DROP PROCEDURE IF EXISTS p_get_BySizeeGuardian;
DELIMITER $$
CREATE PROCEDURE p_get_BySizeeGuardian(in pidSize int) 
BEGIN
    select g.id_guardian,g.userName,g.password,g.fullName,g.age,g.email,g.telefono, ge.gender, t.tamanio, g.cuil,g.fotoPerfil,g.fechasDisponibles,g.precioPorHora,g.calificacion
    FROM guardian as g 
    inner join gender as ge
    on g.id_gender = ge.id_gender
    inner join tamanio as t
    on t.id_tamanio=g.id_tamanioParaCuidar
    where pidSize = g.id_tamanioParaCuidar;
END;
$$
/*-----------------------------------------------Para llamarla */
        /*call p_get_BySizeeGuardian(3);  */
