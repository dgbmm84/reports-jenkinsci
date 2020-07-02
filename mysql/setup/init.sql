CREATE USER 'daniel'@'%' IDENTIFIED BY 'daniel';

GRANT ALL ON reports.* TO 'daniel'@'%';

flush privileges;