FROM postgres:12 
RUN mkdir db
RUN groupadd non-root-postgres-group
RUN useradd non-root-postgres-user --group non-root-postgres-group
RUN chown -R non-root-postgres-user:non-root-postgres-group /db
RUN chmod 777 /db
USER non-root-postgres
