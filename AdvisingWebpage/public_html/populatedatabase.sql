SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS suser CASCADE;
CREATE TABLE suser (
  utype      varchar(10),
  uid        int auto_increment,
  uemail     varchar(30),
  passwd       varchar(30),
  primary key(uid)
  );

DROP TABLE IF EXISTS student CASCADE;
CREATE TABLE student (
  unid        int auto_increment,
  program     varchar(5),
  gpa         double(2,1),
  formid      int,
  advisorid   int,
  applied_to_grad  int,
  yearadmitted year,
  major        varchar(10),
  primary key (unid)
);


DROP TABLE IF EXISTS course CASCADE;
CREATE TABLE course (
 courseid      varchar(8),
 title         varchar(30),
 credits       int,
 prereqone     int,
 prereqtwo     int,
 primary key (courseid)
);


DROP TABLE IF EXISTS alumni CASCADE;
CREATE TABLE alumni (
  univid     int primary key,
  yeargrad   int
);


DROP TABLE IF EXISTS transcript CASCADE;
CREATE TABLE transcript (
  univerid   int,
  crseid     varchar(8),
  semester   varchar(10),
  yeartaken  int,
  grade      varchar(2),
  chours     int,
  primary key (univerid, crseid)
);

DROP TABLE IF EXISTS personalinfo CASCADE;
CREATE TABLE personalinfo (
  universid int primary key,
  ftname  varchar(20),
  ltname  varchar(20),
  dob     date,
  address varchar(50),
  cell    bigint
);

DROP TABLE IF EXISTS formone CASCADE;
CREATE TABLE formone (
  universityid   int,
  cid            varchar(8),
  primary key(universityid, cid)
);

DROP TABLE IF EXISTS faculty CASCADE;
CREATE TABLE faculty (
  facultyid   int,
  primary key(facultyid)
);


ALTER TABLE suser
ADD foreign key (uid) references student(unid);
ALTER TABLE suser
ADD foreign key (uid) references alumni(univid);
ALTER TABLE suser
ADD foreign key (uid) references personalinfo(universid);
ALTER TABLE alumni
ADD foreign key (univid) references personalinfo(universid);
ALTER TABLE student
ADD foreign key (unid) references transcript(univerid);
ALTER TABLE student
ADD foreign key (unid) references formone(universityid);
ALTER TABLE transcript
ADD foreign key (crseid) references course(courseid);






INSERT INTO suser VALUES ( 'advisor', 90000001, 'narahari@gwu.edu', 'narahari' );
INSERT INTO personalinfo VALUES (90000001, 'Bhagirath', 'Narahari', '1966-12-12', 'Washington, DC, 22236', 2024892716);
INSERT INTO faculty VALUES ( 90000001);

INSERT INTO suser VALUES ( 'advisor', 90000002, 'parmer@gwu.edu', 'parmer' );
INSERT INTO personalinfo VALUES (90000002, 'Gabe', 'Parmer', '1980-12-12', 'Washington, DC, 22236', 2021111111);
INSERT INTO faculty VALUES ( 90000002);

INSERT INTO suser VALUES ( 'advisor', 90000003, 'wood@gwu.edu', 'wood' );
INSERT INTO personalinfo VALUES (90000003, 'Tim', 'Wood', '1970-12-12', 'Washington, DC, 22236', 2022222222);
INSERT INTO faculty VALUES ( 90000003);

INSERT INTO suser VALUES ( 'advisor', 90000004, 'heller@gwu.edu', 'heller' );
INSERT INTO personalinfo VALUES (90000004, 'Shelly', 'Heller', '1960-12-12', 'Washington, DC, 22236', 2023333333);
INSERT INTO faculty VALUES ( 90000004);

INSERT INTO suser VALUES ( 'advisor', 90000005, 'morin@gwu.edu', 'morin' );
INSERT INTO personalinfo VALUES (90000005, 'Sarah', 'Morin', '1985-12-12', 'Washington, DC, 22236', 2024444444);
INSERT INTO faculty VALUES ( 90000005);




INSERT INTO suser VALUES ( 'student', 88888888, 'billie@gwu.edu', 'billie' );
INSERT INTO student VALUES ( 88888888, 'MS', 4, null, 90000005, 0, 2018, 'CSCI');
INSERT INTO personalinfo VALUES (88888888, 'Billie', 'Holiday', '1999-04-04', 'Atlanta, GA, 22666', 2020100011);
INSERT INTO transcript VALUES (88888888, 'CSCI6261', 'Fall', 2018, 'A', 3);
INSERT INTO transcript VALUES (88888888, 'CSCI6212', 'Fall', 2018, 'A', 3);

INSERT INTO suser VALUES ( 'student', 99999999, 'diana@gwu.edu', 'diana' );
INSERT INTO student VALUES ( 99999999, 'MS', 4, null, 90000002, 0, 2019, 'CSCI');
INSERT INTO personalinfo VALUES (99999999, 'Diana', 'Krall', '1995-04-04', 'Los Angeles, CA, 90210', 2020100012);

INSERT INTO suser VALUES ( 'student', 23456789, 'ella@gwu.edu', 'ella' );
INSERT INTO student VALUES ( 23456789, 'PHD', 4, null, 90000001, 0, 2019, 'CSCI');
INSERT INTO personalinfo VALUES (23456789, 'Ella', 'Fitzgerald', '1991-04-04', 'Los Angeles, CA, 90210', 2020100013);

INSERT INTO suser VALUES ( 'student', 87654321, 'eva@gwu.edu', 'eva' );
INSERT INTO student VALUES ( 87654321, 'MS', 4, null, 90000004, 0, 2017, 'CSCI');
INSERT INTO personalinfo VALUES (87654321, 'Eva', 'Cassidy', '1992-04-04', 'Los Angeles, CA, 90210', 2020100014);
INSERT INTO transcript VALUES (87654321, 'CSCI6221', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (87654321, 'CSCI6212', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (87654321, 'CSCI6461', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (87654321, 'CSCI6232', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (87654321, 'CSCI6233', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (87654321, 'CSCI6284', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (87654321, 'CSCI6286', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (87654321, 'CSCI6241', 'Fall', 2017, 'C', 3);
INSERT INTO transcript VALUES (87654321, 'CSCI6246', 'Fall', 2017, 'C', 3);
INSERT INTO transcript VALUES (87654321, 'CSCI6262', 'Fall', 2017, 'C', 3);

INSERT INTO suser VALUES ( 'student', 45678901, 'jimi@gwu.edu', 'jimi' );
INSERT INTO student VALUES ( 45678901, 'MS', 4, null, 90000003, 0, 2017, 'CSCI');
INSERT INTO personalinfo VALUES (45678901, 'Jimi', 'Hendrix', '1970-04-04', 'Los Angeles, CA, 90210', 2020100015);
INSERT INTO transcript VALUES (45678901, 'CSCI6221', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (45678901, 'CSCI6212', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (45678901, 'CSCI6261', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (45678901, 'CSCI6232', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (45678901, 'CSCI6233', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (45678901, 'CSCI6284', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (45678901, 'CSCI6286', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (45678901, 'CSCI6241', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (45678901, 'ECE6241', 'Fall', 2017, 'B', 3);
INSERT INTO transcript VALUES (45678901, 'ECE6242', 'Fall', 2017, 'B', 2);
INSERT INTO transcript VALUES (45678901, 'MATH6210', 'Fall', 2017, 'B', 2);

INSERT INTO suser VALUES ( 'student', 1444444, 'paul@gwu.edu', 'paul' );
INSERT INTO student VALUES ( 1444444, 'MS', 4, null, 90000001, 0, 2017, 'CSCI');
INSERT INTO personalinfo VALUES (1444444, 'Paul', 'McCartney', '1999-04-04', 'Atlanta, GA, 22666', 2024892713);
INSERT INTO transcript VALUES (1444444, 'CSCI6221', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (1444444, 'CSCI6212', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (1444444, 'CSCI6261', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (1444444, 'CSCI6232', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (1444444, 'CSCI6233', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (1444444, 'CSCI6241', 'Fall', 2017, 'B', 3);
INSERT INTO transcript VALUES (1444444, 'CSCI6246', 'Fall', 2017, 'B', 3);
INSERT INTO transcript VALUES (1444444, 'CSCI6262', 'Fall', 2017, 'B', 3);
INSERT INTO transcript VALUES (1444444, 'CSCI6283', 'Fall', 2017, 'B', 3);
INSERT INTO transcript VALUES (1444444, 'CSCI6242', 'Fall', 2017, 'B', 3);

INSERT INTO suser VALUES ( 'student', 16666666, 'george@gwu.edu', 'george' );
INSERT INTO student VALUES ( 16666666, 'MS', 4, null, 90000003, 0, 2016, 'CSCI');
INSERT INTO personalinfo VALUES (16666666, 'George', 'Harrison', '1999-02-02', 'Boston, MA, 22777', 2024892714);
INSERT INTO transcript VALUES (16666666, 'ECE6242', 'Fall', 2016, 'C', 2);
INSERT INTO transcript VALUES (16666666, 'CSCI6221', 'Fall', 2016, 'B', 3);
INSERT INTO transcript VALUES (16666666, 'CSCI6261', 'Fall', 2016, 'B', 3);
INSERT INTO transcript VALUES (16666666, 'CSCI6212', 'Fall', 2016, 'B', 3);
INSERT INTO transcript VALUES (16666666, 'CSCI6232', 'Fall', 2016, 'B', 3);
INSERT INTO transcript VALUES (16666666, 'CSCI6233', 'Fall', 2016, 'B', 3);
INSERT INTO transcript VALUES (16666666, 'CSCI6241', 'Fall', 2016, 'B', 3);
INSERT INTO transcript VALUES (16666666, 'CSCI6242', 'Fall', 2016, 'B', 3);
INSERT INTO transcript VALUES (16666666, 'CSCI6283', 'Fall', 2016, 'B', 3);
INSERT INTO transcript VALUES (16666666, 'CSCI6284', 'Fall', 2016, 'B', 3);


INSERT INTO suser VALUES ( 'student', 12345678, 'stevie@gwu.edu', 'stevie' );
INSERT INTO student VALUES ( 12345678, 'PHD', 4, null, 90000005, 0, 2017, 'CSCI');
INSERT INTO personalinfo VALUES (12345678, 'Stevie', 'Nicks', '1985-04-04', 'Los Angeles, CA, 90210', 2020100016);
INSERT INTO transcript VALUES (12345678, 'CSCI6221', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (12345678, 'CSCI6212', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (12345678, 'CSCI6261', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (12345678, 'CSCI6232', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (12345678, 'CSCI6233', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (12345678, 'CSCI6284', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (12345678, 'CSCI6286', 'Fall', 2017, 'A', 3);
INSERT INTO transcript VALUES (12345678, 'CSCI6241', 'Fall', 2017, 'B', 3);
INSERT INTO transcript VALUES (12345678, 'CSCI6246', 'Fall', 2017, 'B', 3);
INSERT INTO transcript VALUES (12345678, 'CSCI6262', 'Fall', 2017, 'B', 3);
INSERT INTO transcript VALUES (12345678, 'CSCI6283', 'Fall', 2017, 'B', 3);
INSERT INTO transcript VALUES (12345678, 'CSCI6242', 'Fall', 2017, 'B', 3);

INSERT INTO suser VALUES ( 'alumni', 77777777, 'eric@gwu.edu', 'eric' );
INSERT INTO student VALUES ( 77777777, 'MS', 4, null, 90000005, 0, 2010, 'CSCI');
INSERT INTO alumni VALUES ( 77777777, 2014);
INSERT INTO personalinfo VALUES (77777777, 'Eric', 'Clapton', '1996-02-02', 'Washington, DC, 22236', 2010000000);
INSERT INTO transcript VALUES (77777777, 'CSCI6221', 'Fall', 2010, 'B', 3);
INSERT INTO transcript VALUES (77777777, 'CSCI6212', 'Fall', 2010, 'B', 3);
INSERT INTO transcript VALUES (77777777, 'CSCI6261', 'Fall', 2010, 'B', 3);
INSERT INTO transcript VALUES (77777777, 'CSCI6232', 'Fall', 2010, 'B', 3);
INSERT INTO transcript VALUES (77777777, 'CSCI6233', 'Fall', 2010, 'B', 3);
INSERT INTO transcript VALUES (77777777, 'CSCI6241', 'Fall', 2010, 'B', 3);
INSERT INTO transcript VALUES (77777777, 'CSCI6242', 'Fall', 2010, 'B', 3);
INSERT INTO transcript VALUES (77777777, 'CSCI6283', 'Fall', 2010, 'A', 3);
INSERT INTO transcript VALUES (77777777, 'CSCI6284', 'Fall', 2010, 'A', 3);
INSERT INTO transcript VALUES (77777777, 'CSCI6286', 'Fall', 2010, 'A', 3);


INSERT INTO suser VALUES ( 'alumni', 34567890, 'kurt@gwu.edu', 'kurt' );
INSERT INTO student VALUES ( 34567890, 'PHD', 4, null, 90000002, 0, 2011, 'CSCI');
INSERT INTO alumni VALUES ( 34567890, 2015);
INSERT INTO personalinfo VALUES (34567890, 'Kurt', 'Cobain', '1981-02-02', 'Washington, DC, 22236', 2011111111);
INSERT INTO transcript VALUES (34567890, 'CSCI6221', 'Fall', 2011, 'A', 3);
INSERT INTO transcript VALUES (34567890, 'CSCI6212', 'Fall', 2011, 'A', 3);
INSERT INTO transcript VALUES (34567890, 'CSCI6261', 'Fall', 2011, 'A', 3);
INSERT INTO transcript VALUES (34567890, 'CSCI6232', 'Fall', 2011, 'A', 3);
INSERT INTO transcript VALUES (34567890, 'CSCI6233', 'Fall', 2011, 'A', 3);
INSERT INTO transcript VALUES (34567890, 'CSCI6241', 'Fall', 2011, 'A', 3);
INSERT INTO transcript VALUES (34567890, 'CSCI6283', 'Fall', 2011, 'A', 3);
INSERT INTO transcript VALUES (34567890, 'CSCI6284', 'Fall', 2011, 'A', 3);
INSERT INTO transcript VALUES (34567890, 'CSCI6286', 'Fall', 2011, 'A', 3);
INSERT INTO transcript VALUES (34567890, 'CSCI6242', 'Fall', 2011, 'B', 3);
INSERT INTO transcript VALUES (34567890, 'CSCI6251', 'Fall', 2011, 'B', 3);
INSERT INTO transcript VALUES (34567890, 'CSCI6254', 'Fall', 2011, 'B', 3);


INSERT INTO suser VALUES ( 'admin', 13371337, 'brian@gwu.edu', 'brian' );
INSERT INTO personalinfo VALUES (13371337, 'Brian', 'Boltiansky', '1999-07-30', 'Los Angeles, CA, 90272', 3109624882);

INSERT INTO suser VALUES ( 'gs', 90001010, 'pless@gwu.edu', 'pless' );
INSERT INTO personalinfo VALUES (90001010, 'Robert', 'Pless', '1966-12-12', 'Washington, DC, 22236', 2024891235);
INSERT INTO faculty VALUES ( 90001010);


INSERT INTO course VALUES ( 'CSCI6221', 'SW Paradigms', 3, null, null);
INSERT INTO course VALUES ( 'CSCI6461', 'Computer Architecture', 3, null, null);
INSERT INTO course VALUES ( 'CSCI6212', 'Algorithms', 3, null, null);
INSERT INTO course VALUES ( 'CSCI6220', 'Machine Learning', 3, null, null);
INSERT INTO course VALUES ( 'CSCI6232', 'Networks 1', 3, null, null);
INSERT INTO course VALUES ( 'CSCI6233', 'Networks 2', 3, 6232, null);
INSERT INTO course VALUES ( 'CSCI6241', 'Database 1', 3, null, null);
INSERT INTO course VALUES ( 'CSCI6242', 'Database 2', 3, 6241, null);
INSERT INTO course VALUES ( 'CSCI6246', 'Compilers', 3, 6461, 6212);
INSERT INTO course VALUES ( 'CSCI6260', 'Multimedia', 3, null, null);
INSERT INTO course VALUES ( 'CSCI6251', 'Cloud Computing', 3, 6461, null);
INSERT INTO course VALUES ( 'CSCI6254', 'SW Engineering', 3, 6221, null);
INSERT INTO course VALUES ( 'CSCI6262', 'Graphics 1', 3, null, null);
INSERT INTO course VALUES ( 'CSCI6283', 'Security 1', 3, 6212, null);
INSERT INTO course VALUES ( 'CSCI6284', 'Cryptography', 3, 6212, null);
INSERT INTO course VALUES ( 'CSCI6286', 'Network Security', 3, 6283, 6232);
INSERT INTO course VALUES ( 'CSCI6325', 'Algorithms 2', 3, 6212, null);
INSERT INTO course VALUES ( 'CSCI6339', 'Embedded Systems', 3, 6461, 6212);
INSERT INTO course VALUES ( 'CSCI6384', 'Cryptography 2', 3, 6284, null);
INSERT INTO course VALUES ( 'ECE6241',  'Communication Theory', 3, null, null);
INSERT INTO course VALUES ( 'ECE6242',  'Information Theory', 2, null, null);
INSERT INTO course VALUES ( 'MATH6210', 'Logic', 2, null, null);




SET FOREIGN_KEY_CHECKS = 1;
