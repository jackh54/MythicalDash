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

# Migrations 
docker exec mythicalclient_backend bash -c "php mythicalclient migrate"

# Create the first user 
#docker exec mythicalclient_backend bash -c "php mythicalclient user:create"


