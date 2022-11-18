
/*-----------------------------------------------------Review--------------------------------------------------------*/
/*-----------------------------------------------------Insertar Review--------------------------------------------------------*/
DROP PROCEDURE IF EXISTS p_insert_review;
DELIMITER $$
CREATE PROCEDURE p_insert_review(IN pId_Reserve int, IN pCalificacion int, pDescription nVARCHAR(100)) 
BEGIN
	INSERT INTO review(id_reserve,calificacion, description) VALUES
	(pId_Reserve, pCalificacion,pDescription);
END;
$$
/*----------------------------------------------------Para llamarla--------------------------------------------------------*/
/*call p_insert_review(1,4,"Muy buen servicio");*/
/*-----------------------------------------------------Devolver Reviews--------------------------------------------------------*/
DROP PROCEDURE IF EXISTS p_get_Review;
DELIMITER $$
CREATE PROCEDURE p_get_Review() 
BEGIN
	select r.id_review, r.calificacion, r.id_reserve, r.description,re.idGuardian
    from review as r
    inner join reserve as re
    on re.id_reserve = r.id_reserve;
END;
$$
/*----------------------------------------------------Para llamarla--------------------------------------------------------*/
/*call p_get_Review();*/
/*-----------------------------------------------------Devolver Review por Id Reserve--------------------------------------------------------*/
DROP PROCEDURE IF EXISTS p_get_ByIdReserveReview;
DELIMITER $$
CREATE PROCEDURE p_get_ByIdReserveReview(in pIdReserve int) 
BEGIN
	select r.id_review, r.calificacion, r.id_reserve, r.description,re.id_Guardian
    from review as r
    inner join reserve as re
    on re.id_reserve = r.id_reserve
    where pIdReserve = r.id_reserve;
END;
$$
/*call p_get_ByIdReserveReview();*/
/*-----------------------------------------------------Devolver Review por Id Guardian--------------------------------------------------------*/

DROP PROCEDURE IF EXISTS p_get_ByIGuardianReview;
DELIMITER $$
CREATE PROCEDURE p_get_ByIGuardianReview(in pIdGuardian int) 
BEGIN
	select r.id_review, r.calificacion, r.id_reserve, r.description, re.id_guardian
    from review as r
    inner join reserve as re
    on re.id_reserve = r.id_reserve
    where pIdGuardian = re.id_guardian;
END;
$$
/*call p_get_ByIGuardianReview();*/
/*-----------------------------------------------------Devolver Review por Id Review--------------------------------------------------------*/
DROP PROCEDURE IF EXISTS p_get_ByIdReview;
DELIMITER $$
CREATE PROCEDURE p_get_ByIdReview(in pReview int) 
BEGIN
	select r.id_review, r.calificacion, r.id_reserve, r.description,re.id_guardian
    from review as r
    inner join reserve as re
    on re.id_reserve = r.id_reserve
    where pReview = r.id_review;
END;
$$
/*call p_get_ByIdReview();*/