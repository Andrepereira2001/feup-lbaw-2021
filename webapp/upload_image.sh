#!/bin/bash

# Stop execution if a step fails
set -e

DOCKER_USERNAME=jlopes60 # Replace by your docker hub username
IMAGE_NAME=medialib18

# Ensure that dependencies are available
docker exec lbaw_php composer install
docker exec lbaw_php php artisan clear-compiled

docker build -t $DOCKER_USERNAME/$IMAGE_NAME .
docker push $DOCKER_USERNAME/$IMAGE_NAME
