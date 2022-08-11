FROM mariadb:10.4.13

COPY ./config/mariadb.cnf /etc/mysql/my.cnf
COPY ./testing/testing.sql /docker-entrypoint-initdb.d/testing.sql