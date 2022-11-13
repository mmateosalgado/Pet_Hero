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





