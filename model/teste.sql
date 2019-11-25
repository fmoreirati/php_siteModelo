
BEGIN

DECLARE exit handler for sqlexception
  BEGIN
  ROLLBACK;
END;

DECLARE exit handler for sqlwarning
 BEGIN
 ROLLBACK;
END;

START TRANSACTION;
SELECT * FROM `phpsitemodelo`.`usuario` LIMIT 1000;
alter table usuario modify email varchar(100) unique;
C;
END