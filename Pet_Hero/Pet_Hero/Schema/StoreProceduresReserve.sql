
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
        where pIdPet = p.id_pet;
    END;
    $$
    /*----------------------------------------------------------------Para llamarla --------------------------------*/
    /*-------------------------call p_get_ByIdPetReserve(1);*/