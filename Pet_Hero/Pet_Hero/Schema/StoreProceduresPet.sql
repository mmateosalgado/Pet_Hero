
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

/*-------------------------------------------------------------Borrar Pets --------------------------------*/
DROP PROCEDURE IF EXISTS p_delete_pet;
DELIMITER $$
CREATE PROCEDURE p_delete_pet(IN pId_pet int) 
BEGIN
	DELETE FROM pet where pId_pet= id_pet;
END;
$$
$$
/*----------------------------------------------------------------Para llamarla --------------------------------*/
/*-------------------------call p_delete_pet(1);*/

/*-------------------------------------------------------------Modificar Pet --------------------------------*/
DROP PROCEDURE IF EXISTS p_update_pet;
DELIMITER $$
CREATE PROCEDURE p_update_pet(in pId_pet int,IN pId_tamanio int,in pWeight int, in pgrXfoodPortion int) 
BEGIN
	update pet set  id_tamanio= pId_tamanio,  weight= pWeight, grXfoodPortion= pgrXfoodPortion where id_pet= pId_pet;
END;
$$
/*----------------------------------------------------------------Para llamarla --------------------------------*/
/*-------------------------call p_update_pet(1,1,5,250);*/

/*-------------------------------------------------Devolver Pets por Id Owner --------------------------------------------------------*/
DROP PROCEDURE IF EXISTS p_get_PetByOwnerId;
DELIMITER $$
CREATE PROCEDURE p_get_PetByOwnerId(in pIdOwner int) 
BEGIN
    select p.id_pet,p.id_owner,p.name, a.animal, r.race, t.tamanio,p.description, p.age, p.grXfoodPortion
    , p.weight,p.foto,p.planVacunacion,p.video
    from pet as p
    inner join tamanio as t
    on p.id_tamanio = t.id_tamanio
    inner join animal as a
    on a.id_tipoAnimal = p.id_animal
    inner join race as r
    on r.id_race = a.id_race
    where pIdOwner=p.id_owner;
END;
$$
/*------------------------------Para llamarla ------------------------------*/
/*------------------------------call p_get_PetByOwnerId(3);*/

/*-------------------------------------------------Devolver Pets por Id--------------------------------------------------------*/
DROP PROCEDURE IF EXISTS p_get_PetById;
DELIMITER $$
CREATE PROCEDURE p_get_PetById(in pId int) 
BEGIN
    select p.id_pet,p.id_owner,p.name, a.animal, r.race, t.tamanio,p.description, p.age, p.grXfoodPortion
    , p.weight,p.foto,p.planVacunacion,p.video
    from pet as p
    inner join tamanio as t
    on p.id_tamanio = t.id_tamanio
    inner join animal as a
    on a.id_tipoAnimal = p.id_animal
    inner join race as r
    on r.id_race = a.id_race
    where pId=p.id_pet;
END;
$$
/*------------------------------Para llamarla ------------------------------*/
/*------------------------------call p_get_PetById(1);*/