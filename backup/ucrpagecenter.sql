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
    careercode VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci,
    careername VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    careergrade VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci,
    careerenclosureid INTEGER,
    careerstate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(careerid)
);

CREATE TABLE tbenclosure(
    enclosureid INTEGER,
    enclosurename VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci,
    enclosureheadquarterid INTEGER,
    enclosureuniversityid INTEGER,
    enclosurestate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(enclosureid)
);

CREATE TABLE tbprofessor(
    professorid INTEGER,
    professorlicense VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    professorname VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    professorlastname1 VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    professorlastname2 VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    professorpassword VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    professorstate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(professorid)
);

CREATE TABLE tbadministrative(
    administrativeid INTEGER,
    administrativelicense VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    administrativename VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    administrativelastname1 VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    administrativelastname2 VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    administrativearea VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    administrativepassword VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    administrativestate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(administrativeid)
);

CREATE TABLE tbactor(
    actorid INTEGER,
    actormail VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    CONSTRAINT PRIMARY KEY(actorid)
);

CREATE TABLE tbactivity(
    activityid INTEGER NOT NULL,
    createddate DATE NOT NULL,
    updatedate DATE NOT NULL,
    likecount INTEGER NOT NULL,
    commentcount INTEGER NOT NULL,
    activitytitle VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    activitydescription varchar(255) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    activityestate SMALLINT DEFAULT 1 NOT NULL,
    activityheadquarterid INTEGER NOT NULL,
    CONSTRAINT PRIMARY KEY(activityid)
);


CREATE TABLE tbevent(
    activityid INTEGER NOT NULL,
    eventplace VARCHAR(50) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    eventdate DATE NOT NULL,
    eventhour TIME NOT NULL,
    dayafter INTEGER NOT NULL,
    daybefore INTEGER NOT NULL,
    eventestate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(activityid)
);

CREATE TABLE tbpost(
    activityid INTEGER NOT NULL,
	poststate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(activityid)
);

CREATE TABLE tbcomment(
    commentid INTEGER NOT NULL,
    activityid INTEGER NOT NULL,
    commentdescription VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
    commentcreated DATE NOT NULL,
    commentactor INTEGER NOT NULL,
    commentstate SMALLINT DEFAULT 1 NOT NULL,
    CONSTRAINT PRIMARY KEY(commentid)
);

CREATE TABLE tbtag(
	tagactivityid INTEGER NOT NULL,
	tagword VARCHAR(100) CHARSET utf8 COLLATE utf8_unicode_ci NOT NULL,
	CONSTRAINT PRIMARY KEY(tagactivityid, tagword)
);
