INSERT INTO baeckerei VALUES ('Lecker', 123456);
INSERT INTO anschrift VALUES ('Lecker','Wehlistrasse 35, 1020 WIEN');
INSERT INTO mitarbeiter VALUES ('Elice Musterfrau', 2700.50, "1975-03-15", 1, 'Lecker');
INSERT INTO mitarbeiter VALUES ('Bill Mustermann', 700.50, "1991-05-18", 2, 'Lecker');
INSERT INTO mitarbeiter VALUES ('Marie Musterfrau', 900.50, "1988-06-05", 3, 'Lecker');
INSERT INTO mitarbeiter VALUES ('Thomas Mustermann', 1000.50, "1986-10-17",  4, 'Lecker');
INSERT INTO mitarbeiter VALUES ('Eva Musterfrau', 700.50, "1985-10-17",  5, 'Lecker');
INSERT INTO kuehlraum VALUES (777,5.3, 14.5, 'something', 'Regale x7, Kisten x40');
INSERT INTO kueche VALUES (123,'Der Ofen', 30.5, 777);
INSERT INTO konditor VALUES (1, 'Elice Musterfrau', 'Der Mann - Konditor-3Jahren', 'Kochschule',30, 123);
INSERT INTO konditor VALUES (2,'Bill Mustermann','Backwaren - Konditor-5Jahren', 'Kochschule',30,123);
INSERT INTO konditor VALUES (3, 'Marie Musterfrau', 'McCafe - Konditor-2Jahren', 'Kochkurse',20,123);
INSERT INTO kuechengehilfe VALUES (4,'Thomas Mustermann','Vormittag', '2016/08/23', 'Kasack',123);
INSERT INTO kuechengehilfe VALUES (5,'Eva Musterfrau','Nachmittag', '2016/09/02', 'Kasack',123);
INSERT INTO kunde VALUES ('Georg Mustermann', 'georg@mail.com', '1996/09/01','Lecker');
INSERT INTO kunde VALUES ('Lisa Musterfrau', 'lisa@mail.com', '1986/11/01', 'Lecker');
INSERT INTO backwaren VALUES (12345,'Semmel', 0.15, '2016/11/20', '2016/11/23');
INSERT INTO backwaren VALUES (12346,'Pizza', 1.15,'2016/11/20', '2016/11/23');
INSERT INTO backwaren VALUES (12347,'Apfelstrudel', 1.75, '2016/11/20', '2016/11/23');
INSERT INTO produkt VALUES (1425871458745,'Milch', 1.15, '2016/11/19', '2016/11/27', 777);
INSERT INTO produkt VALUES (8547871458745,'Mehl', 0.99, '2016/11/04', '2016/12/18', 777);
INSERT INTO produkt VALUES (3257481547853,'Zucker', 1.25, '2016/10/19', '2017/01/27', 777);
INSERT INTO kuechenzeile VALUES (123, 'bezeichnung');
INSERT INTO einkauf VALUES ('georg@mail.com', 12346);
INSERT INTO einkauf VALUES ('lisa@mail.com', 12347);
INSERT INTO backen VALUES (2, 12347);
INSERT INTO backen VALUES (3, 12346);
INSERT INTO backen VALUES (2, 12345);
INSERT INTO bestandteil VALUES (12345,1425871458745);
INSERT INTO bestandteil VALUES (12345,8547871458745);
INSERT INTO bestandteil VALUES (12345,3257481547853);
