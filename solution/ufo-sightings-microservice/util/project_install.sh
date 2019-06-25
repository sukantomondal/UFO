#!/bin/sh

if [ -z "$1" ]; then
    PROJECT_NAME="slim-project"
else
    PROJECT_NAME="$1"
fi

PROJECT_DIR=$(pwd)

cd ${PROJECT_DIR}

mkdir -p ${PROJECT_DIR}/${PROJECT_NAME}

#copy project source file
cp /root/ufo-sightings/src ${PROJECT_DIR}/${PROJECT_NAME}/src -r

cat <<EOF >> /etc/httpd/conf/httpd.conf
<Directory "${PROJECT_DIR}/${PROJECT_NAME}/src/public">
   Options Indexes MultiViews FollowSymLinks
   AllowOverride All
   Order allow,deny
   Allow from all
</Directory>

<VirtualHost *:80>
      DocumentRoot ${PROJECT_DIR}/${PROJECT_NAME}/src/public
</VirtualHost>
EOF
# restart apache
service httpd restart
