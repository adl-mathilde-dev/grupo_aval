#!/bin/bash
set -e

#Creación de enlaces simbolicos
ln -sf /workspaces/web/ /var/www/html/aval
sudo ln -sf /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.conf
chown -R www-data:www-data /var/www/html
#chown -R www-data:www-data /workspaces/web

# Iniciar la app (ajusta esto si no es Django)
echo "Iniciando aplicación..."
apache2ctl -D FOREGROUND
