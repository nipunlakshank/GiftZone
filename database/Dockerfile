FROM mysql:8.0

# Bake the seed into the image instead of bind-mounting it. Coolify does not
# reliably deliver relative bind mounts of repo files into containers, so the
# bind-mount approach left the db with an empty schema (user + database created,
# but no tables). Files baked into the image are always present at init.
#
# MySQL runs every .sql here on FIRST boot of an empty data dir, piping it into
# $MYSQL_DATABASE (the dump has no CREATE DATABASE/USE of its own).
COPY giftzone_db.sql /docker-entrypoint-initdb.d/giftzone_db.sql
