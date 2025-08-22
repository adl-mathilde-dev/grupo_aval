#!/bin/bash
set -e

# Esperar a que la base de datos esté lista
echo "Esperando a que la base de datos esté lista..."
until mysql -h db -u root -pmariadb -e "SELECT 1;" &> /dev/null
do
  echo "Esperando..."
  sleep 2
done

# Descomprimir la base de datos
unzip -o backup.zip -d /tmp

# Importar el backup
echo "Importando backup.sql..."
mysql -h db -u root -pmariadb mariadb < /tmp/backup.sql

echo "Backup completado..."
