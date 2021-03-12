FROM mysql:8.0

ENV MYSQL_DATABASE=test \
  MYSQL_USER=user \
  MYSQL_PASSWORD=pass \
  MYSQL_ROOT_PASSWORD=pass \
  TZ=Asia/Tokyo

COPY ./my.cnf /etc/mysql/conf.d/my.cnf
RUN chmod 644 /etc/mysql/conf.d/my.cnf
