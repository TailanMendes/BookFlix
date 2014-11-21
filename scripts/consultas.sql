USE bookflix;
SELECT * FROM genero;
SELECT * FROM autor;
SELECT * FROM booklido;
SELECT * FROM usuario;

SELECT gennome FROM genero WHERE gencodigo<4 and gennome LIKE '%a%';

DELETE FROM usuario WHERE usucodigo<10;

UPDATE usuario SET usuemail ='giovani@gmail.com', usunome = 'Giovannii' WHERE usucodigo = 3;

SELECT * FROM autor WHERE autnome LIKE '%J%';

INSERT INTO usuario VALUES (NULL,'Josiel Wirlino Vieira dos Santos','josiel@gmail.com',
						 'ecpengenharia',94017335);

INSERT INTO usuario VALUES (NULL,'Giovani','giovani@gmail.com',
						 'ecpengenharia',NULL);

DESC usuario;