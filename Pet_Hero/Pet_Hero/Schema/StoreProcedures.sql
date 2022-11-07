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
CREATE PROCEDURE p_update_guardian(IN pUserName VARCHAR(50),in pFechas varchar(500)) 
BEGIN
	update guardian set fechasDisponibles = pFechas where userName= pUserName;
END;
$$

/*-----------------------------------------------Para llamarla */
/*call p_update_guardian("Cris","2022/10/20");  */