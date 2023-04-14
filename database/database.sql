CREATE DATABASE senati;
USE senati;

CREATE TABLE cursos(
	idcurso		INT 		AUTO_INCREMENT PRIMARY KEY,
	nombrecurso	VARCHAR(50)	NOT NULL,
	especialidad	VARCHAR(70)	NOT NULL,
	complejidad 	CHAR(1)		NOT NULL DEFAULT 'B',
	fechainicio	DATE 		NOT NULL,
	precio 		DECIMAL(7,2)	NOT NULL,
	fechacreacion 	DATETIME 	NOT NULL DEFAULT NOW(),
	fechaupdate	DATETIME	NULL,
	estado 		CHAR(1)		NOT NULL DEFAULT '1'
)ENGINE = INNODB;

INSERT INTO cursos (nombrecurso, especialidad, complejidad, fechainicio, precio) VALUES
	('Java','ETI','M','2023-05-10',180),
	('Desarrollo Web','ETI','B','2023-04-20',190),
	('Excel Financiero','Adminsitración','A','2023-05-14',250),
	('ERP SAP','Administración','A','2023-05-11',400),
	('Inventor','Mecánica','M','2023-04-29',380);

SELECT * FROM cursos;
UPDATE cursos SET estado='1';

-- STORE PROCEDURE
-- Un procedimiento almacenado es un PROGRAMA que se ejecuta desde el motor de BD
-- y que permite recibir valor de entrada, realizar diferentes tipos de cálculos y 
-- entregar una salida.

-- ------------------
-- LISTAR LOS CURSOS
-- ------------------
DELIMITER $$
CREATE PROCEDURE spu_curso_listar()
BEGIN
	SELECT 	idcurso,
		nombrecurso,
		especialidad,
		complejidad,
		fechainicio,
		precio
	FROM cursos
	WHERE estado = '1'
	ORDER BY idcurso DESC;
END $$
CALL spu_curso_listar();

-- ----------------------------------------------
-- PROCEDIMIENTO ALMACENADO PARA REGISTRAR CURSOS
-- ----------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_registrar_cursos(
IN nombrecurso_ 	VARCHAR(40),
IN especialidad_	VARCHAR(70),
IN complejidad_	CHAR(1),
IN fechainicio_	DATE,
IN precio_			DECIMAL(7,2)
)
BEGIN
	INSERT INTO cursos(nombrecurso, especialidad, fechainicio, complejidad, precio) 
	VALUES (nombrecurso_, especialidad_, fechainicio_, complejidad_, precio_);
END $$
CALL spu_registrar_cursos('Python','ETI','B','2023-05-10',120);
CALL spu_registrar_cursos('C# para la Web','ETI','A','2023-05-11',320);
CALL spu_curso_listar();

-- ------------------------------------------------------------
-- PROCEDIMIENTO ALMACENADO PARA ELIMINAR CURSOS (INHABILITARA)
-- ------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_cursos_eliminar(IN idcurso_ INT)
BEGIN
	UPDATE cursos SET estado = '0' 
	WHERE idcurso = idcurso_;
END $$

CALL spu_cursos_eliminar(4);
SELECT * FROM cursos;


-- Lunes 10 abril 2023
DELIMITER $$
CREATE PROCEDURE spu_cursos_recuperar_id(IN idcurso_ INT)
BEGIN
	SELECT * FROM cursos WHERE idcurso = idcurso_;
END $$

CALL spu_cursos_recuperar_id(3);

-- CURSOS ACTUALIZAR
DELIMITER $$
CREATE PROCEDURE spu_cursos_actualizar(
	IN idcurso_			INT,
	IN nombrecurso_ 	VARCHAR(50),
	IN especialidad_	VARCHAR(70),
	IN complejidad_	CHAR(1),
	IN fechainicio_	DATE,
	IN precio_			DECIMAL(7,2)
)
BEGIN
	UPDATE cursos SET
	nombrecurso		= nombrecurso_,
	especialidad 	= especialidad_,
	complejidad		= complejidad_,
	fechainicio 	= fechainicio_,
	precio			= precio_,
	fechaupdate		= NOW()
	WHERE idcurso 	= idcurso_;
END $$

CALL spu_cursos_actualizar(3,'Excel para Gestión','Administración','A','2023-07-13',320);
SELECT * FROM cursos;


CREATE TABLE usuarios(
	idusuario			INT AUTO_INCREMENT 	PRIMARY KEY,
	nombreusuario		VARCHAR(30) 			NOT NULL,
	claveacceso			VARCHAR(90) 			NOT NULL,
	apellidos 			VARCHAR(30) 			NOT NULL,
	nombres				VARCHAR(30) 			NOT NULL,
	nivelacceso			CHAR(1) 					NOT NULL DEFAULT 'A',
	estado 				CHAR(1) 					NOT NULL DEFAULT '1',
	fecharegistro		DATETIME 				NOT NULL DEFAULT NOW(),
	fechaupdate 		DATETIME 				NULL,
	CONSTRAINT uk_nombreusuario_usa UNIQUE(nombreusuario)
)ENGINE = INNODB;

INSERT INTO usuarios	(nombreusuario, claveacceso, apellidos, nombres) VALUES
	('ADRIANA', 'SENATI', 'Durand Buenamarca', 'Adriana Arlet'),
	('DANIEL', 'SENATI', 'Durand Buenamarca', 'Lucio Daniel');
	
SELECT * FROM usuarios;

-- ACTUALIZANDO POR CLAVE ENCRIPTADA
-- Defecto : SENATI
UPDATE usuarios SET
	claveacceso = '$2y$10$UVumvYTP8aTab4XdFzj.GuSrFri19FfM7pGw3SEh6m1uOeoWwsne6'
	WHERE idusuario = 1;

UPDATE usuarios SET
	claveacceso = '$2y$10$fLjA/RlV5oZfaT0XyOoeGOjHfd5wbgG1oT9QiKCXWBMD/9JqSy53a'
	WHERE idusuario = 2;
SELECT * FROM usuarios;


DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN nombreusuario_ VARCHAR(30))
BEGIN
	SELECT 	idusuario, nombreusuario, claveacceso,
				apellidos, nombres, nivelacceso
	FROM usuarios
	WHERE nombreusuario = nombreusuario_ AND estado = '1';
END $$
CALL spu_usuarios_login('ADRIANA');




-- ------------------
-- LISTAR LOS USUARIOS
-- ------------------
DELIMITER $$
CREATE PROCEDURE spu_usuarios_listar()
BEGIN
	SELECT 	idusuario,
				nombreusuario,
				apellidos,
				nombres,
				nivelacceso,
				fecharegistro
	FROM usuarios
	WHERE estado = '1'
	ORDER BY idusuario DESC;
END $$
CALL spu_usuarios_listar();

-- ----------------------------------------------
-- PROCEDIMIENTO ALMACENADO PARA REGISTRAR CURSOS
-- ----------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_registrar_usuarios(
IN nombreusuario_ 	VARCHAR(30),
IN claveacceso_ 		VARCHAR(90),
IN apellidos_			VARCHAR(30),
IN nombres_				VARCHAR(30),
IN nivelacceso_		CHAR(1)

)
BEGIN
	INSERT INTO usuarios(nombreusuario, claveacceso, apellidos, nombres, nivelacceso) 
	VALUES (nombreusuario_, claveacceso_, apellidos_, nombres_, nivelacceso_);
END $$
CALL spu_registrar_usuarios('ALEX','123456','Rojas Almeyda','Alex','A');
CALL spu_usuarios_listar();

-- Actualizando clave encriptada
UPDATE usuarios SET 
	claveacceso = '$2y$10$N0uA6HK2NR8it5efPsdA1ON9hEc74O4NnuwhqD79D.mfK9DBzXvAu'
WHERE idusuario = 3;

-- ------------------------------------------------------------
-- PROCEDIMIENTO ALMACENADO PARA ELIMINAR CURSOS (INHABILITARA)
-- ------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_usuarios_eliminar(IN idusuario_ INT)
BEGIN
	UPDATE usuarios SET estado = '0' 
	WHERE idusuario = idusuario_;
END $$
CALL spu_usuarios_eliminar(2)
SELECT * FROM usuarios;

-- RECUPERAR USUARIOS
DELIMITER $$
CREATE PROCEDURE spu_usuarios_recuperar_id(IN idusuario_ INT)
BEGIN
	SELECT * FROM usuarios WHERE idusuario = idusuario_;
END $$

CALL spu_usuarios_recuperar_id(1);

-- USUARIOS ACTUALIZAR
DELIMITER $$
CREATE PROCEDURE spu_usuarios_actualizar(
	IN idusuario_				INT,
	IN nombreusuario_ 		VARCHAR(30),
	IN claveacceso_			VARCHAR(90),
	IN apellidos_				VARCHAR(30),
	IN nombres_					VARCHAR(30),
	IN nivelacceso_			CHAR(1)
)
BEGIN
	UPDATE usuarios SET
	nombreusuario		= nombreusuario_,
	claveacceso 	= claveacceso_,
	apellidos		= apellidos_,
	nombres 			= nombres_,
	nivelacceso		= nivelacceso_,
	fechaupdate		= NOW()
	WHERE idusuario 	= idusuario_;
END $$

CALL spu_usuarios_actualizar(3,'Jhon123','$2y$10$N0uA6HK2NR8it5efPsdA1ON9hEc74O4NnuwhqD79D.mfK9DBzXvAu','Francia Minaya','Jhon Edwar','A');
SELECT * FROM usuarios;



