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
	CONSTRAINT PRIMARY KEY(careerid)
);

CREATE TABLE tbenclosure(
	enclosureid INTEGER,
	enclosurename VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci,
    enclosureheadquarterid INTEGER,
    enclosureuniversityid INTEGER,
	CONSTRAINT PRIMARY KEY(enclosureid)
);



-- SE CAMBIO LA TABLA UNIVERSIDAD(SE AGREGO STATE) Y CARRERA(SE AGREGO GRADO)