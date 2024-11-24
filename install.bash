#!/bin/bash

# Set the right permissions
chown -R www-data:www-data ./
chmod -R 777 ./

# Install the dependencies
apt install sudo wget curl git zip unzip -y 

# Install Docker if not installed
if ! [ -x "$(command -v docker)" ]; then
    curl -sSL https://get.docker.com/ | CHANNEL=stable bash
    sudo systemctl enable --now docker
fi

# Install Docker Compose if not installed
if ! [ -x "$(command -v docker-compose)" ]; then
    apt install docker-compose -y 
fi

# Start the build process
docker-compose --env-file ./backend/storage/.env up -d --build

# Set the right permissions
chown -R www-data:www-data ./
chmod -R 777 ./

# Update dependencies
docker exec mythicalclient_backend bash -c "COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader"

# Reset the encryption key 
# Check if the installation has already been completed
INSTALL_FLAG=".installed"

if [ ! -f "$INSTALL_FLAG" ]; then
    # Run the installation steps
    touch "$INSTALL_FLAG"
    docker exec mythicalclient_backend bash -c "php mythicalclient keyRegen -force"
else
    echo "Installation already completed. Skipping..."
fi

# Migrations
# Wait for the database container to be ready
until docker exec mythicalclient_database pg_isready; do
    echo "Waiting for mythicalclient_database to be ready..."
    sleep 2
done

docker exec mythicalclient_backend bash -c "php mythicalclient migrate"