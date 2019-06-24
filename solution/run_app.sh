#!/bin/sh
#Author: Sukanto Mondal


#create the docker image
echo "Creating image for the app..."
BUILD_RESULT=$(docker build --rm -t ufoapp ufo-microservice/)

if echo $BUILD_RESULT | grep -q "Successfully tagged ufoapp:latest"; then
    echo "Successfully tagged ufoapp:latest"
else
    echo "Please run the script in the solution directory."		
fi

# run the image to make a container
echo "Runing the container..."
echo "Description: Using command 'docker run -itd --rm --name ufo -p 8888:80 ufoapp' You must need to have the port 8888 open for running the application"
id=$(docker run -itd --rm --name ufo -p 8888:80 ufoapp)
echo ${id}

# run the project installation script 
echo "Installing the project..."
sudo docker exec -it ufo /root/project_install.sh ufo-sightings
