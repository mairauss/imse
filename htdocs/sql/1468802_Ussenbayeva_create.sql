
CREATE TABLE baeckerei(
bname char(15) NOT NULL,
firmanr integer UNIQUE,
PRIMARY KEY (bname) );

CREATE TABLE anschrift(
bname char(15) NOT NULL,
bezeichnung char(40),
PRIMARY KEY (bname),
FOREIGN KEY(bname) REFERENCES baeckerei ON DELETE CASCADE );

CREATE TABLE mitarbeiter(
mname char(50) NOT NULL,
gehalt double precision,
mgeburtsdatum DATE,
personalnr integer NOT NULL,
bname char(15) NOT NULL,
PRIMARY KEY (mname),
FOREIGN KEY(bname) REFERENCES baeckerei ON DELETE CASCADE );

CREATE SEQUENCE mitar_persnr
START WITH 1000
INCREMENT BY 1;

CREATE OR REPLACE trigger mitar_persnr_trg
BEFORE INSERT ON mitarbeiter
FOR EACH ROW
BEGIN
     SELECT mitar_persnr.nextval INTO :new.personalnr FROM dual;
END;
/

CREATE TABLE kuehlraum(
temp double precision DEFAULT '4' NOT NULL,
grundflaeche double precision,
regelung varchar(1000),
ausstattung varchar(80),
PRIMARY KEY (temp),
CHECK (temp<8 AND temp>=0)
);

CREATE TABLE kueche(
ausstattung varchar(80) NOT NULL,
grundflaeche double precision,
temp double precision NOT NULL,
PRIMARY KEY (ausstattung),
CHECK (temp<8 AND temp>=0),
FOREIGN KEY (temp) REFERENCES kuehlraum ON DELETE CASCADE );

CREATE TABLE kuechengehilfe(
mname char(50) NOT NULL,
betriebsmodus char(15),
einstelldatum DATE,
kkleidung char(50),
ausstattung varchar(80) NOT NULL,
PRIMARY KEY (mname),
CHECK (betriebsmodus='Vormittag' OR betriebsmodus='Nachmittag'),
FOREIGN KEY (mname) REFERENCES mitarbeiter ON DELETE CASCADE,
FOREIGN KEY (ausstattung) REFERENCES kueche ON DELETE CASCADE );

CREATE TABLE konditor(
mname char(50) NOT NULL,
berufserfahrung integer NOT NULL,
ausbildung varchar(80),
bonus double precision DEFAULT '30',
ausstattung varchar(80) NOT NULL,
PRIMARY KEY (mname),
FOREIGN KEY (mname) REFERENCES mitarbeiter ON DELETE CASCADE, 
FOREIGN KEY (ausstattung) REFERENCES kueche ON DELETE CASCADE );

CREATE TABLE kunde(
kname char(50) NOT NULL,
email char(30) UNIQUE,
kgeburtsdatum DATE,
bname char(15) NOT NULL,
PRIMARY KEY (kname),
FOREIGN KEY (bname) REFERENCES baeckerei ON DELETE CASCADE );

CREATE TABLE backwaren(
artikelnr integer NOT NULL,
gname char(30),
bpreis double precision,
bhersdatum DATE,
bhaltdauer DATE,
PRIMARY KEY (artikelnr) );

CREATE TABLE produkt(
barcode integer NOT NULL,
pname char(50) UNIQUE,
ppreis double precision,
phersdatum DATE,
phaltdauer DATE,
temp double precision NOT NULL,
PRIMARY KEY (barcode),
CHECK (temp<8 AND temp>=0),
FOREIGN KEY (temp) REFERENCES kuehlraum ON DELETE CASCADE );

CREATE TABLE kuechenzeile(
ausstattung varchar(80) NOT NULL,
bezeichnung varchar(3000),
PRIMARY KEY (ausstattung),
FOREIGN KEY (ausstattung) REFERENCES kueche ON DELETE CASCADE );

CREATE TABLE einkauf(
kname char(50) NOT NULL,
artikelnr integer NOT NULL,
PRIMARY KEY (kname, artikelnr),
FOREIGN KEY (kname) REFERENCES kunde ON DELETE CASCADE,
FOREIGN KEY (artikelnr) REFERENCES backwaren ON DELETE CASCADE );

CREATE TABLE backen(
mname char(50) NOT NULL,
artikelnr integer NOT NULL,
PRIMARY KEY (mname, artikelnr),
FOREIGN KEY (mname) REFERENCES konditor ON DELETE CASCADE,
FOREIGN KEY (artikelnr) REFERENCES backwaren ON DELETE CASCADE );

CREATE TABLE bestandteil(
artikelnr integer NOT NULL,
barcode integer NOT NULL,
PRIMARY KEY (artikelnr, barcode),
FOREIGN KEY (artikelnr) REFERENCES backwaren ON DELETE CASCADE,
FOREIGN KEY (barcode) REFERENCES produkt ON DELETE CASCADE );

CREATE TABLE poss(
bname char(15) NOT NULL,
mname char(50) NOT NULL,
kname char(50) NOT NULL,
PRIMARY KEY (bname,mname,kname),
FOREIGN KEY (bname) REFERENCES baeckerei ON DELETE CASCADE,
FOREIGN KEY (mname) REFERENCES mitarbeiter ON DELETE CASCADE,
FOREIGN KEY (kname) REFERENCES kunde ON DELETE CASCADE);


CREATE VIEW konditor_count (personalnr)
AS
SELECT personalnr
FROM mitarbeiter INNER JOIN konditor
ON mitarbeiter.mname=konditor.mname;

CREATE VIEW konditor_min_gehalt (personalnr, gehalt)
AS 
SELECT
personalnr, Min(gehalt)
FROM mitarbeiter INNER JOIN konditor
ON mitarbeiter.mname=konditor.mname
GROUP BY personalnr, gehalt
HAVING MIN(gehalt)<1000;

CREATE VIEW priseAVG(bpreis)
AS
SELECT AVG(bpreis) 
FROM backwaren;

CREATE VIEW priseSUM(bpreis)
AS
SELECT SUM(bpreis) 
FROM backwaren;

CREATE VIEW kunde_count(kname)
AS
SELECT COUNT (DISTINCT kname)
FROM kunde;