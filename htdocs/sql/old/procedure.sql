create or replace PROCEDURE kon(name CHAR)
IS
BEGIN
DELETE FROM konditor WHERE mname=name;
END kon;
/


create or replace PROCEDURE kuch(name CHAR)
IS
BEGIN
DELETE FROM kuechengehilfe WHERE mname=name;
END kuch;
/

create or replace PROCEDURE persnr(nn IN CHAR, abt OUT INTEGER) IS
BEGIN
  Select personalnr INTO abt FROM mitarbeiter
  where mname=nn;
END persnr;
/