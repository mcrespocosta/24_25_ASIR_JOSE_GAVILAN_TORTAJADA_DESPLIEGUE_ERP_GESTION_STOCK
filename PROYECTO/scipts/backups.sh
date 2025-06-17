#!/bin/bash

EMAIL_EMPRESA="proyecto_videogames"

VOLUMEN="mysql_data"
RUTA_VOLUM=$(sudo docker volume inspect "$VOLUMEN" -f '{{ .Mountpoint }}')

FECHA=$(date +%F-%H-%M)
NOMBRE_ZIP="backup-$FECHA.zip"

RUTA_LOCAL="/opt/backups"
sudo mkdir -p "$RUTA_LOCAL"
RUTA_ZIP="$RUTA_LOCAL/$NOMBRE_ZIP"

CARPETA_DROPBOX="/backups/$EMAIL_EMPRESA"

# Comprimir el volum (no cal sudo si el Mountpoint ja es accessible per l’usuari)
sudo zip -r "$RUTA_ZIP" "$RUTA_VOLUM"

# Pujar a Dropbox (normalment no cal sudo si rclone està configurat per l’usuari)
rclone copy "$RUTA_ZIP" "dropbox:$CARPETA_DROPBOX"
