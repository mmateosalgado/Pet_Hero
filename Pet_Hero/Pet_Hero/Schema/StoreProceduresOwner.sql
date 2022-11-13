
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
DROP PROCEDURE IF EXISTS p_get_Owner;
DELIMITER $$
CREATE PROCEDURE p_get_Owner() 
BEGIN
    select o.id_owner,o.userName,o.password,o.fullName,o.age,o.email,o.telefono, g.gender
    FROM owner as o 
    inner join gender as g
    on o.id_gender = g.id_gender;
END;
$$
/*Para llamarla */
/* call p_get_Owner*/
/* -----------------------------------------------Devolver Owners Por UserName-----------------------------------------------*/
DROP PROCEDURE IF EXISTS p_get_ByuserNameOwner;
DELIMITER $$
CREATE PROCEDURE p_get_ByuserNameOwner(in pUsername varchar(30)) 
BEGIN
    select o.id_owner,o.userName,o.password,o.fullName,o.age,o.email,o.telefono, g.gender
    FROM owner as o 
    inner join gender as g
    on o.id_gender = g.id_gender
    where pUsername= o.userName;
END;
$$
     /*----------------------------------------------- Para llamarla */
 /*call p_get_ByuserNameOwner("Juan");*/
 /* -----------------------------------------------Devolver Owners Por Email-----------------------------------------------*/

DROP PROCEDURE IF EXISTS p_get_ByEmailOwner;
DELIMITER $$
CREATE PROCEDURE p_get_ByEmailOwner(in pEmail nvarchar(30)) 
BEGIN
    select o.id_owner,o.userName,o.password,o.fullName,o.age,o.email,o.telefono, g.gender
    FROM owner as o 
    inner join gender as g
    on o.id_gender = g.id_gender
    where pEmail= o.email;
END;
$$
     /*----------------------------------------------- Para llamarla */
 /*call p_get_ByEmailOwner("Juan@gmail.com");*/
 /* -----------------------------------------------Devolver Owners Por Id-----------------------------------------------*/

DROP PROCEDURE IF EXISTS p_get_ByIdOwner;
DELIMITER $$
CREATE PROCEDURE p_get_ByIdOwner(in pId int) 
BEGIN
    select o.id_owner,o.userName,o.password,o.fullName,o.age,o.email,o.telefono, g.gender
    FROM owner as o 
    inner join gender as g
    on o.id_gender = g.id_gender
    where pId= o.id_owner;
END;
$$
     /*----------------------------------------------- Para llamarla */
 /*call p_get_ByIdOwner(1);*/
