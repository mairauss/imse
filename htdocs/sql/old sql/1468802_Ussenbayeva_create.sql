
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
PRIMARY KEY (personalnr),
FOREIGN KEY(bname) REFERENCES baeckerei ON DELETE CASCADE );

/*CREATE SEQUENCE mitar_persnr
START WITH 1000
INCREMENT BY 1;

CREATE OR REPLACE trigger mitar_persnr_trg
BEFORE INSERT ON mitarbeiter
FOR EACH ROW
BEGIN
     SELECT mitar_persnr.nextval INTO :new.personalnr FROM dual;
END;
*/

CREATE TABLE kuehlraum(
kuehlraumNr integer NOT NULL,
temp double precision DEFAULT '4' NOT NULL,
grundflaeche double precision,
regelung varchar(1000),
ausstattung varchar(80),
PRIMARY KEY (kuehraulNr),
CHECK (temp<8 AND temp>=0)
);

CREATE TABLE kueche(
kuecheNr integer NOT NULL,
ausstattung varchar(80) NOT NULL,
grundflaeche double precision,
kuehlraumNr integer NOT NULL,
PRIMARY KEY (kuecheNr),
FOREIGN KEY (kuehraumNr) REFERENCES kuehlraum ON DELETE CASCADE );

CREATE TABLE kuechengehilfe(
personalnr integer NOT NULL,
mname char(50) NOT NULL,
betriebsmodus char(15),
einstelldatum DATE,
kkleidung char(50),
kuecheNr integer NOT NULL,
PRIMARY KEY (personalNr),
CHECK (betriebsmodus='Vormittag' OR betriebsmodus='Nachmittag'),
FOREIGN KEY (personalNr) REFERENCES mitarbeiter ON DELETE CASCADE,
FOREIGN KEY (kuecheNr) REFERENCES kueche ON DELETE CASCADE );

CREATE TABLE konditor(
personalnr integer NOT NULL,
mname char(50) NOT NULL,
berufserfahrung integer NOT NULL,
ausbildung varchar(80),
bonus double precision DEFAULT '30',
kuecheNr integer NOT NULL,
PRIMARY KEY (personalnr),
FOREIGN KEY (personalnr) REFERENCES mitarbeiter ON DELETE CASCADE,
FOREIGN KEY (kuecheNr) REFERENCES kueche ON DELETE CASCADE );

CREATE TABLE kunde(
kname char(50) NOT NULL,
email char(30) NOT NULL,
kgeburtsdatum DATE,
bname char(15) NOT NULL,
PRIMARY KEY (email),
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
kuehlraumNr integer NOT NULL,
PRIMARY KEY (barcode),
FOREIGN KEY (kuehlraumNr) REFERENCES kuehlraum ON DELETE CASCADE );

CREATE TABLE kuechenzeile(
kuecheNr integer NOT NULL,
bezeichnung varchar(3000),
PRIMARY KEY (kuecheNr),
FOREIGN KEY (kuecheNr) REFERENCES kueche ON DELETE CASCADE );

CREATE TABLE einkauf(
email char(30) NOT NULL,
artikelnr integer NOT NULL,
PRIMARY KEY (email, artikelnr),
FOREIGN KEY (email) REFERENCES kunde ON DELETE CASCADE,
FOREIGN KEY (artikelnr) REFERENCES backwaren ON DELETE CASCADE );

CREATE TABLE backen(
personalnr integer NOT NULL,
artikelnr integer NOT NULL,
PRIMARY KEY (personalNr, artikelnr),
FOREIGN KEY (personalNr) REFERENCES konditor ON DELETE CASCADE,
FOREIGN KEY (artikelnr) REFERENCES backwaren ON DELETE CASCADE );

CREATE TABLE bestandteil(
artikelnr integer NOT NULL,
barcode integer NOT NULL,
PRIMARY KEY (artikelnr, barcode),
FOREIGN KEY (artikelnr) REFERENCES backwaren ON DELETE CASCADE,
FOREIGN KEY (barcode) REFERENCES produkt ON DELETE CASCADE );

CREATE TABLE poss(
bname char(15) NOT NULL,
personalnr integer NOT NULL,
email char(30) NOT NULL,
PRIMARY KEY (bname,personalNr,email),
FOREIGN KEY (bname) REFERENCES baeckerei ON DELETE CASCADE,
FOREIGN KEY (personalNr) REFERENCES mitarbeiter ON DELETE CASCADE,
FOREIGN KEY (email) REFERENCES kunde ON DELETE CASCADE);


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
