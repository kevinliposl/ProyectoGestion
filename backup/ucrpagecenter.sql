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
	studentstate BIT DEFAULT 1 NOT NULL,
	CONSTRAINT PRIMARY KEY(studentid)
);

CREATE TABLE tbuniversity(
	universityid INTEGER,
	universitycode INTEGER,
	universityname VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	universitytype BIT DEFAULT 1 NOT NULL,
	CONSTRAINT PRIMARY KEY(universityid)
);

CREATE TABLE tbheadquarter(
	headquarterid INTEGER,
	headquartercode INTEGER,
	headquartername VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	headquarterlocation VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	headquarteruniversityid INTEGER,
	CONSTRAINT PRIMARY KEY(headquarterid)
);

CREATE TABLE tbcareer(
	careerid INTEGER,
	careercode INTEGER,
	careername VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	CONSTRAINT PRIMARY KEY(careerid)
);
