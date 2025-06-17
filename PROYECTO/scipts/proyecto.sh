#!/bin/bash

if ! docker network ls | grep -q "redbridge"; then
  echo "La red 'redbridge' no existe. Creándola..."
  sudo docker network create --driver=bridge --subnet=192.168.100.0/24 redbridge
else
  echo "La red 'redbridge' ya existe."
fi

sudo docker compose up -d

# Añadir el DNS a systemd-resolved
echo "Configurando systemd-resolved para usar el contenedor DNS..."

if ! grep -q "DNS=192.168.100.2" /etc/systemd/resolved.conf; then
  sudo bash -c 'echo -e "[Resolve]\nDNS=192.168.100.2\nFallbackDNS=8.8.8.8 1.1.1.1" > /etc/systemd/resolved.conf'
  sudo systemctl restart systemd-resolved
fi

echo "Configuración completada. Comprueba el resolv.conf"

# Comprobar si rclone está instalado, si no, instalarlo
if ! command -v rclone &> /dev/null; then
  echo "rclone no está instalado. Instalando..."
  curl https://rclone.org/install.sh | sudo bash
else
  echo "rclone ya está instalado."
fi

# Crear carpeta de configuración para rclone si no existe
if [ ! -d ~/.config/rclone ]; then
  mkdir -p ~/.config/rclone
  echo "He creado la carpeta ~/.config/rclone"
else
  echo "La carpeta ~/.config/rclone ya existe"
fi

# Copiar el archivo rclone.conf directamente (mensaje éxito o fallo)
if cp -f rclone.conf ~/.config/rclone/rclone.conf 2>/dev/null; then
  echo "He copiado rclone.conf a ~/.config/rclone/"
else
  echo "No he encontrado rclone.conf aquí"
fi


# Crear la carpeta si no existeix
sudo mkdir -p /opt/scripts

# Copiar el script a la carpeta corresponent
sudo cp "backups.sh" /opt/scripts/backups.sh

# Afegir al crontab si no estava
LINEA="0 2 * * * /opt/scripts/backups.sh"
crontab -l 2>/dev/null | grep -q "backups.sh"

if [ $? != 0 ]; then
  crontab -l 2>/dev/null > mycron
  echo "$LINEA" >> mycron
  crontab mycron
  rm mycron
  echo "Tasca afegida al crontab per a cada dia a les 02:00h."
else
  echo "La tasca ja estava al crontab."
fi
