FROM mysql:5.7

ADD setup/init.sql /docker-entrypoint-initdb.d/
ADD mysql.cnf /etc/mysql/conf.d/mysql.cnf

RUN chown -R mysql:mysql /docker-entrypoint-initdb.d/

CMD ["mysqld", "--character-set-server=utf8mb4", "--collation-server=utf8mb4_unicode_ci", "--default-authentication-plugin=mysql_native_password"]

