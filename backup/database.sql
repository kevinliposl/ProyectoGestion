CREATE DATABASE gestion2018;
USE gestion2018;

CREATE TABLE tbstudent(
	studentid INTEGER,
	studentcarnet VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	studentname VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	studentlastname1 VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	studentlastname2 VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	studentcareer1 INTEGER NOT NULL,
	studentcareer2 INTEGER,
	studentheadquarters INTEGER NOT NULL,
	studentpassword VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL CHECK(studentpassword > 7),
	state BIT DEFAULT 1 NOT NULL,
	CONSTRAINT PRIMARY KEY(studentid)
);