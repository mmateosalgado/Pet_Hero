/*.----------------------------------------Store Procedures Extras -------------------------------------------------- */
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


/*-------------------------------------------------------------Ver Estado --------------------------------*/
DELIMITER $$
CREATE PROCEDURE p_get_IdEstado(IN pEstado varchar(50)) 
BEGIN
	SELECT id_estado  FROM estado WHERE estado=pEstado;
END;
$$
/*----------------------------------------------------------------Para llamarla --------------------------------*/
/*-------------------------call p_get_IdEstado("realizada");*/

