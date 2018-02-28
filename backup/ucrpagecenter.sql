DROP DATABASE ucrpagecenter;
CREATE DATABASE ucrpagecenter;
USE ucrpagecenter;


CREATE TABLE tbuniversity(
    universityid INTEGER,
    universityname VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    universitytype SMALLINT DEFAULT 1 NOT NULL,
    universitystate SMALLINT DEFAULT 1 NOT NULL,
    universityhadheadquarter SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(universityid)
);

CREATE TABLE tbheadquarter(
    headquarterid INTEGER,
    headquartername VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    headquarteruniversityid INTEGER,
    CONSTRAINT PRIMARY KEY(headquarterid)
);

CREATE TABLE tbenclosure(
    enclosureid INTEGER,
    enclosurename VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci,
    enclosureheadquarterid INTEGER,
    enclosureuniversityid INTEGER,
    enclosurestate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(enclosureid)
);

CREATE TABLE tbcareer(
    careerid INTEGER,
    careercode VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci,
    careername VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    careergrade VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci,
    careerenclosureid INTEGER,
    careerstate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(careerid)
);

CREATE TABLE tbactor(
    actorid INTEGER,
    actormail VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    actorchangedpassword SMALLINT DEFAULT 0 NOT NULL,
    CONSTRAINT PRIMARY KEY(actorid)
);

CREATE TABLE tbstudent(
    studentid INTEGER,
    studentlicense VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    studentname VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    studentlastname1 VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    studentlastname2 VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    studentcareer1 INTEGER NOT NULL,
    studentcareer2 INTEGER,
    studentpassword VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL CHECK(studentpassword > 7),
    studentstate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(studentid)
);

CREATE TABLE tbprofessor(
    professorid INTEGER,
    professorlicense VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    professorname VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    professorlastname1 VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    professorlastname2 VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    professorpassword VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    professorstate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(professorid)
);

CREATE TABLE tbadministrative(
    administrativeid INTEGER,
    administrativelicense VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    administrativename VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    administrativelastname1 VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    administrativelastname2 VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    administrativearea VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    administrativepassword VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    administrativestate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(administrativeid)
);

CREATE TABLE tbactivity(
    activityid INTEGER NOT NULL,
    activitycreateddate DATE NOT NULL,
    activityupdatedate DATE NOT NULL,
    activitylikecount INTEGER NOT NULL,
    activitycommentcount INTEGER NOT NULL,
    activitytitle VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    activitydescription varchar(500) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    activitystate SMALLINT DEFAULT 1 NOT NULL,
    activityenclosureid INTEGER NOT NULL,
    CONSTRAINT PRIMARY KEY(activityid)
);

CREATE TABLE tbevent(
    eventid INTEGER NOT NULL,
    eventplace VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    eventdate DATE NOT NULL,
    eventhour TIME NOT NULL,
    eventdayafter INTEGER NOT NULL,
    eventdaybefore INTEGER NOT NULL,
    eventestate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(eventid)
);

CREATE TABLE tbpost(
    postid INTEGER NOT NULL,
    poststate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(postid)
);


CREATE TABLE tbcomment(
    commentid INTEGER NOT NULL,
    commentactivityid INTEGER NOT NULL,
    commentdescription VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    commentcreated DATE NOT NULL,
    commentactor INTEGER NOT NULL,
    commentcoincidence FLOAT NOT NULL,
    commenttype VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    commentstate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(commentid)
);

CREATE TABLE tbtag(
    tagactivityid INTEGER NOT NULL,
    tagword VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    tagrelation VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    CONSTRAINT PRIMARY KEY(tagactivityid, tagword)
);

CREATE TABLE tbadmin(
    adminid INTEGER,
    adminpassword VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    adminstate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(adminid)
);

INSERT INTO tbactor VALUES(1,'pruebasproyectos.u@gmail.com',1);
INSERT INTO tbadmin VALUES(1,'pruebasu',1);

INSERT INTO `tbuniversity` VALUES 
(1,'Universidad de Costa Rica',1,1,1),
(2,'Tecnologico de Costa Rica',1,1,1),
(3,'Universidad Nacional',1,1,0);

INSERT INTO `tbheadquarter` VALUES 
(1,'Sede del Atlantico',1),
(2,'Sede del Caribe',1),
(3,'Sede de Occidente',1),
(4,'Sede Central',2),
(5,'Sede San Carlos',2);

INSERT INTO `tbenclosure` VALUES 
(1,'Turrialba',1,1,1),
(2,'Guapiles',1,1,1),
(3,'Paraiso',1,1,1),
(4,'Alajuela',3,1,1),
(5,'Tarrazu',3,1,1),
(6,'Limon',2,1,1),
(7,'Cartago',4,2,1),
(8,'Ciudad Quesada',5,2,1),
(9,'Sarapiqui',0,3,1);

INSERT INTO `tbcareer` VALUES 
(1,'111111','Informatica Emplesarial','Bachillerato',1,1),
(2,'111112','Informatica Emplesarial','Bachillerato',3,1),
(3,'111113','Informatica Emplesarial','Bachillerato',2,1),
(4,'22221','Ingenieria Civil','Licenciatura',4,1),
(5,'111114','Informatica Emplesarial','Bachillerato',5,1),
(6,'22222','Ingenieria Aduanera','Bachillerato',6,1),
(7,'22223','Ingenieria Electronica','Bachillerato',7,1),
(8,'111111','Ingenieria en Computacion','Licenciatura',8,1),
(9,'33333','Ingenieria en Sistemas','Bachillerato',9,1);

