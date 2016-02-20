CREATE TABLE Dept(
-- Attributes --
Deptid serial,
DeptName text,
SubDeptid integer,
 PRIMARY KEY (Deptid));

CREATE TABLE Userinfo(
-- Attributes --
Userid serial,
Name text,
Deptid integer,
EmployDate date,
Duty text,
 PRIMARY KEY (Userid),
 FOREIGN KEY (Deptid) REFERENCES Dept (Deptid));

CREATE TABLE Checkinout(
-- Attributes --
Logid serial,
Userid integer,
CheckTime datetime,
CheckType varchar(1),
 PRIMARY KEY (Logid),
 FOREIGN KEY (Userid) REFERENCES Userinfo (Userid));

CREATE TABLE tipo_horario(
-- Attributes --
id serial,
nombre text,
 PRIMARY KEY (id));

CREATE TABLE banda(
-- Attributes --
id serial,
hora_entrada text,
hora_salida text,
tipo_horario_id integer,
 PRIMARY KEY (id),
 FOREIGN KEY (tipo_horario_id) REFERENCES tipo_horario (id));

CREATE TABLE tipo_hora(
-- Attributes --
id serial,
nombre text,
factor_hora numeric(3,2),
 PRIMARY KEY (id));

CREATE TABLE rango_banda(
-- Attributes --
id serial,
banda_id integer,
hora_desde text,
hora_hasta text,
tipo_hora_id integer,
 PRIMARY KEY (id),
 FOREIGN KEY (banda_id) REFERENCES rango (id),
 FOREIGN KEY (tipo_hora_id) REFERENCES tipo_hora (id));

CREATE TABLE horario_personal(
-- Attributes --
id serial,
user_id integer,
banda_id integer,
 PRIMARY KEY (id),
 FOREIGN KEY (user_id) REFERENCES Userinfo (Userid),
 FOREIGN KEY (banda_id) REFERENCES banda (id));

CREATE TABLE feriado(
-- Attributes --
id serial,
fecha date,
 PRIMARY KEY (id));

CREATE TABLE horario_excepcion(
-- Attributes --
id serial,
user_id integer,
desde date,
hasta date,
banda_id integer,
 PRIMARY KEY (id),
 FOREIGN KEY (user_id) REFERENCES Userinfo (Userid),
 FOREIGN KEY (banda_id) REFERENCES banda (id));

CREATE TABLE refrescamiento(
-- Attributes --
id serial,
fecha datetime,
tabla text,
 PRIMARY KEY (id));

