/*-----------------------------------------------------Chat--------------------------------------------------------*/
/*-----------------------------------------------------Crear Chat--------------------------------------------------------*/

DROP PROCEDURE IF EXISTS p_insert_chat;
DELIMITER $$
CREATE PROCEDURE p_insert_chat(IN pId_Reserve int) 
BEGIN
	INSERT INTO chat(id_reserve) VALUES
	(pId_Reserve);
END;
$$
/*-----------------------------------------------------Para llamarla--------------------------------------------------------*/

/*-------------------------call p_insert_chat(2);*/

/*-----------------------------------------------------Crear Mensaje--------------------------------------------------------*/
DROP PROCEDURE IF EXISTS p_insert_lineaChat;
DELIMITER $$
CREATE PROCEDURE p_insert_lineaChat(IN pId_Chat int, IN pId_usertype int, IN pMensaje nvarchar(300), IN pFecha datetime) 
BEGIN
	INSERT INTO lineaChat(id_chat, user_type, mensaje, fecha) VALUES
	(pId_Chat, pId_usertype, pMensaje, pFecha);
END;
$$
/*-----------------------------------------------------Para llamarla--------------------------------------------------------*/
/*-------------------------call p_insert_lineaChat(2, 1, 'Todo bien???', now());*/
/*-----------------------------------------------------Devolver Chat Por Id Reserva--------------------------------------------------------*/
DROP PROCEDURE IF EXISTS p_get_ChatByIdReserve;
DELIMITER $$
CREATE PROCEDURE p_get_ChatByIdReserve(in pIdReserve int) 
BEGIN
	select c.id_chat
    from chat as c
    where c.id_reserve  = pIdReserve;
END;
$$
/*-----------------------------------------------------Para llamarla--------------------------------------------------------*/
/*-------------------------call p_get_ChatByIdReserve(2);*/

/*-----------------------------------------------------Devolver Todos los Mensajes Chat Por Id Reserva--------------------------------------------------------*/
DROP PROCEDURE IF EXISTS p_get_LineaChatByIdreserve;
DELIMITER $$
CREATE PROCEDURE p_get_LineaChatByIdreserve(in pId_reserve int) 
BEGIN
	select l.id_lineaChat, l.id_chat ,l.user_type, l.mensaje, l.fecha
    from lineachat as l
    inner join chat as c
    on c.id_chat = l.id_chat
    where pId_reserve = c.id_reserve;
END;
$$
/*-----------------------------------------------------Para llamarla--------------------------------------------------------*/
/*-------------------------call p_get_LineaChatByIdreserve(2);*/
