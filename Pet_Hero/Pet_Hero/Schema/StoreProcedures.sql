        /*Devolver id genero, al ingresar un string*/
DELIMITER $$
CREATE PROCEDURE p_get_gender(IN pGender varchar(50)) 
BEGIN
	SELECT id_gender  FROM gender WHERE gender=pGender;
END;
$$

/* Para llamarla: */
    /* CALL p_get_gender ('male');*/
                    /* Insertar owner*/
DELIMITER $$
CREATE PROCEDURE p_insert_owner(IN pUserName VARCHAR(50), IN pPassword nVARCHAR(50), IN pFUllName varchar(50), pAge INT, pEmail nVARCHAR(50), pId_Gender INT, pTelefono double) 
BEGIN
	INSERT INTO owner(userName,password, fullName, age,email,id_gender,telefono) VALUES
	(pUserName, pPassword, pFUllName, pAge,pEmail,pId_Gender,pTelefono);
END;
$$
/*Para llamarla*/
/*CALL p_insert_owner('FacuFerra','1234', 'FacundoFerrari', 20,'facuferra@gmail.com',1,'412111');*/

/*Devolver id tamanio, al ingresar un string*/
DELIMITER $$
CREATE PROCEDURE p_get_tamanio(IN pTamanio varchar(50)) 
BEGIN
	SELECT id_tamanio  FROM tamanio WHERE tamanio=pTamanio;
END;
$$

/*Para llamarla*/
/*CALL p_get_tamanio ('big');*/

                 /* Insertar guardian*/

DROP PROCEDURE IF EXISTS p_insert_guardian;
DELIMITER $$
CREATE PROCEDURE p_insert_guardian(IN pUserName VARCHAR(50), IN pPassword nVARCHAR(50), IN pFUllName varchar(50), pAge INT, pEmail nVARCHAR(50), pId_Gender INT, pTelefono double, pCuil double, pFotoPerfil varchar(100), pFechasDisponibles varchar(500),pId_TamanioParaCuidar int) 
BEGIN
	INSERT INTO guardian(userName,password, fullName, age,email,id_gender,telefono,cuil,fotoPerfil,fechasDisponibles,id_tamanioParaCuidar) VALUES
	(pUserName, pPassword, pFUllName, pAge,pEmail,pId_Gender,pTelefono,pCuil,pFotoPerfil,pFechasDisponibles,pId_TamanioParaCuidar);
END;
$$
    /* Para llamarla */
/* CALL p_insert_guardian('FacuFerra','1234', 'FacundoFerrari', 20,'facuferra@gmail.com',2,412111,204414,'url','2022-11-4/2022-11-5',3);*/

