#!/bin/bash
set -e

# Esperar a que la base de datos esté lista
echo "Esperando a que la base de datos esté lista..."
until mysql -h db -u root -pmariadb -e "SELECT 1;" &> /dev/null
do
  echo "Esperando..."
  sleep 2
done

# Exportar el backup
echo "Exportando backup.sql..."
mysqldump -h db -u mariadb -pmariadb mariadb > backup.sql
echo "Exportación completa"

# Comprimir la base de datos
echo "Comprimiendo"
zip -j -q -r backup.zip backup.sql

# Borrar sql
echo "Borrando sql"
rm -rf backup.sql
