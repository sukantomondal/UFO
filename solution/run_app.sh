#!/bin/sh
#Author: Sukanto Mondal


#create the docker image
echo "Creating image for the app..."
#copy the data in docker build contex
cp ../ufo-sightings.csv ufo-sightings-microservice/util/ufo-sightings.csv
BUILD_RESULT=$(docker build --rm -t ufoapp ufo-sightings-microservice/) 

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

sleep 5

# set the root password for mysql
echo "Setting root password for mysql ..."
sudo docker exec -it ufo /root/set_mysql_root_password.sh root123

sleep 5

#make database for ufo-sighting-app
echo "Making database for ufo-sightings..."
sudo docker exec -it ufo /root/create_database_for_ufo_sightings.sh

sleep 5

# run the project installation script 
echo "Installing the project..."
sudo docker exec -it ufo /root/project_install.sh ufo_sightings_app
