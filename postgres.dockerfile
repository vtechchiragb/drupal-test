FROM postgres:latest
RUN mkdir db
RUN mkdir dump
RUN groupadd non-root-postgres-group
RUN useradd non-root-postgres-user --group non-root-postgres-group
RUN chown -R non-root-postgres-user:non-root-postgres-group /db
RUN chmod 777 /db
RUN chmod 777 /dump

COPY cas-dump-20240506.sql /dump/cas-dump-20240506.sql
USER non-root-postgres
