drop database ucrpagecenter;
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
    CONSTRAINT PRIMARY KEY(adminid)
);
