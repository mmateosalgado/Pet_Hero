
    /*-------------------------------------------------------------RESERVES----------------------------------------------------*/

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
    /*-------------------------------------------------------------Ver Reservas Por Id Guardian--------------------------------*/
    DROP PROCEDURE IF EXISTS p_get_ByIdGuardianReserve;
    DELIMITER $$
    CREATE PROCEDURE p_get_ByIdGuardianReserve(in pIdGuardian int) 
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
        on ra.id_race = a.id_race
        where pIdGuardian = r.id_guardian;
    END;
    $$
    /*----------------------------------------------------------------Para llamarla --------------------------------*/
    /*-------------------------call p_get_ByIdGuardianReserve(1);*/
    /*-------------------------------------------------------------Ver Reservas Confirmadas o Pagadas Por Id Guardian--------------------------------*/

    DROP PROCEDURE IF EXISTS p_get_ByIdGuardianReserveConfirmadas;
    DELIMITER $$
    CREATE PROCEDURE p_get_ByIdGuardianReserveConfirmadas(in pIdGuardian int) 
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
        on ra.id_race = a.id_race
        where pIdGuardian = r.id_guardian and (e.id_estado=2 or e.id_estado=5);
    END;
    $$
    /*----------------------------------------------------------------Para llamarla --------------------------------*/
    /*-------------------------call p_get_ByIdGuardianReserveConfirmadas(1);*/
    /*-------------------------------------------------------------Ver Reservas Por Id Owner--------------------------------*/
    DROP PROCEDURE IF EXISTS p_get_ByIdOwnerReserve;
    DELIMITER $$
    CREATE PROCEDURE p_get_ByIdOwnerReserve(in pIdOwner int) 
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
        on ra.id_race = a.id_race
        where pIdOwner = p.id_owner;
    END;
    $$
    /*----------------------------------------------------------------Para llamarla --------------------------------*/
    /*-------------------------call p_get_ByIdOwnerReserve(1);*/
    /*-------------------------------------------------------------Ver Reservas Por Id Reserve--------------------------------*/
    DROP PROCEDURE IF EXISTS p_get_ByIdReserve;
    DELIMITER $$
    CREATE PROCEDURE p_get_ByIdReserve(in pIdReserve int) 
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
        on ra.id_race = a.id_race
        where pIdReserve = r.id_reserve;
    END;
    $$
    /*----------------------------------------------------------------Para llamarla --------------------------------*/
    /*-------------------------call p_get_ByIdReserve(1);*/
        /*-------------------------------------------------------------Ver Reservas Por Id Pet--------------------------------*/
DROP PROCEDURE IF EXISTS p_get_ByIdPetReserve;
DELIMITER $$
CREATE PROCEDURE p_get_ByIdPetReserve(in pIdPet int) 
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
    on ra.id_race = a.id_race
    where pIdPet = p.id_pet and (e.id_estado=2 or e.id_estado=5);
END;
$$
    /*----------------------------------------------------------------Para llamarla --------------------------------*/
    /*-------------------------call p_get_ByIdPetReserve(1);*/

/*-------------------------------------------------------------Ver Reservas Por Id Pet e Id Guardian--------------------------------*/
DROP PROCEDURE IF EXISTS p_get_ByIdGuardianAndPet;
DELIMITER $$
CREATE PROCEDURE p_get_ByIdGuardianAndPet(in pIdGuardian int, in pIdPet int) 
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
    on ra.id_race = a.id_race
    where pIdGuardian = r.id_guardian and r.id_pet = pIdPet and (e.id_estado=2 or e.id_estado=5);
END;
$$

    /*----------------------------------------------------------------Para llamarla --------------------------------*/
    /*-------------------------call p_get_ByIdGuardianAndPet(1);*/
    /*-------------------------------------------------------------Cambiar Estado a finalizadas--------------------------------*/
            DROP PROCEDURE IF EXISTS p_get_ControlarFechas;
        DELIMITER $$
        CREATE PROCEDURE p_get_ControlarFechas(in pFechaActual varchar(50)) 
        BEGIN
            update reserve set id_estado = 4 where (fechaFin < pFechaActual and id_estado=5);
        END;
        $$
    /*----------------------------------------------------------------Para llamarla --------------------------------*/
    /*-------------------------call p_get_ControlarFechas(now());*/

        /*-------------------------------------------------------------Devolver reservas en espera con id guardian--------------------------------*/
        DELIMITER $$
        CREATE PROCEDURE p_get_ByIdGuardianEnEsperaReserve(in pIdGuardian int) 
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
            on ra.id_race = a.id_race
            where pIdGuardian = r.id_guardian and r.id_estado =1;
        END;
        $$
    /*----------------------------------------------------------------Para llamarla --------------------------------*/
    /*-------------------------call p_get_ByIdGuardianEnEsperaReserve(now());*/
/*-------------------------------------------------------------Devolver nombre del owner mediante id reserva--------------------------------*/
    /*----------------------------------------------------------------Para llamarla --------------------------------*/
                DROP PROCEDURE IF EXISTS p_get_usernameOwner;
                DELIMITER $$
                CREATE PROCEDURE p_get_usernameOwner(in pId_reserve int) 
                BEGIN
                    select o.userName
                    from owner as o
                    inner join pet as p
                    on p.id_owner = o.id_owner
                    inner join reserve as r
                    on r.id_pet = p.id_pet
                    where pId_reserve = r.id_reserve;
                END;
                $$
/*-------------------------call p_get_usernameOwner(2);*/
/*-------------------------------------------------------------Devolver nombre del guardian mediante id reserva--------------------------------*/

        DROP PROCEDURE IF EXISTS p_get_usernameGuardian;
        DELIMITER $$
        CREATE PROCEDURE p_get_usernameGuardian(in pId_reserve int) 
        BEGIN
            select g.userName
            from guardian as g
            inner join reserve as r
            on r.id_guardian = g.id_guardian
            where pId_reserve = r.id_reserve;
        END;
        $$
/*----------------------------------------------------------------Para llamarla --------------------------------*/
/*-------------------------  call p_get_usernameGuardian(2);*/


