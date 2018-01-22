CREATE DATABASE ucrpagecenter;
USE ucrpagecenter;


CREATE TABLE tbstudent(
	studentid INTEGER,
	studentlicense VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	studentname VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	studentlastname1 VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	studentlastname2 VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	studentcareer1 INTEGER NOT NULL,
	studentcareer2 INTEGER,
	studentpassword VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL CHECK(studentpassword > 7),
	studentstate SMALLINT DEFAULT 1 NOT NULL,
	CONSTRAINT PRIMARY KEY(studentid)
);

CREATE TABLE tbuniversity(
	universityid INTEGER,
	universityname VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	universitytype SMALLINT DEFAULT 1 NOT NULL,
	universitystate SMALLINT DEFAULT 1 NOT NULL,
	universityhadheadquarter SMALLINT DEFAULT 1 NOT NULL,
	CONSTRAINT PRIMARY KEY(universityid)
);

CREATE TABLE tbheadquarter(
	headquarterid INTEGER,
	headquartername VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	headquarteruniversityid INTEGER,
	CONSTRAINT PRIMARY KEY(headquarterid)
);

CREATE TABLE tbcareer(
	careerid INTEGER,
	careercode INTEGER,
	careername VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
        careergrade VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci,
        careerenclosureid INTEGER,
	CONSTRAINT PRIMARY KEY(careerid)
);


CREATE TABLE tbenclosure(
	enclosureid INTEGER,
	enclosurename VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci,
        enclosureheadquarterid INTEGER,
        enclosureuniversityid INTEGER,
	CONSTRAINT PRIMARY KEY(enclosureid)
);




-- DATOS DE PRUEBA

INSERT INTO tbcareer VALUES(1,110101,'ARTES DRAMATICAS','BACH. Y LIC.', 1);
INSERT INTO tbcareer VALUES(2,110202,'HISTORIA DEL ARTE','BACH. Y LIC.', 2);
INSERT INTO tbcareer VALUES(3,110213,'DISEÃ‘O PLASTICO CON Ã‰NFASIS DISEÃ‘O PICTÃ“RICO','BACH. Y LIC.', 3);
INSERT INTO tbcareer VALUES(4,110214,'DISEÃ‘O GRAFICO','BACH. Y LIC.', 4);
INSERT INTO tbcareer VALUES(5,110106,'ARTES PLASTICAS','BACH. Y LIC.', 1);
INSERT INTO tbcareer VALUES(9,110106,'ARTES PLASTICAS','BACH. Y LIC.', 2);
INSERT INTO tbcareer VALUES(6,110207,'HISTORIA DE LA MUSICA','BACH. Y LIC.', 2);
INSERT INTO tbcareer VALUES(7,110218,'DISEÃ‘O INTERIORES','BACH. Y LIC.', 3);
INSERT INTO tbcareer VALUES(8,110219,'MODELADO GRAFICO','BACH. Y LIC.', 4);

INSERT INTO tbenclosure VALUES(1, 'San Pedro', 1, 1);
INSERT INTO tbenclosure VALUES(2, 'La Sabana', 1, 1);
INSERT INTO tbenclosure VALUES(3, 'Paraíso', 2, 2);
INSERT INTO tbenclosure VALUES(4, 'Turrialba', 2, 2);

INSERT INTO tbheadquarter VALUES(1, 'San Jose', 1);
INSERT INTO tbheadquarter VALUES(2, 'Cartago', 2);

INSERT INTO tbuniversity VALUES(1, 'UCR', 1, 1, 1);
INSERT INTO tbuniversity VALUES(2, 'UNA', 1, 1, 1);
