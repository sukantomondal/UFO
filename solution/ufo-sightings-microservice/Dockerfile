#Author: Sukanto Mondal
#A basic centos6 server docker image

FROM centos:6
ENV container docker
COPY ufo-sightings /root/ufo-sightings
ADD util/ufo-sightings.csv /root/ufo-sightings.csv
ADD util/init_script.sh /root/init_script.sh
ADD util/project_install.sh /root/project_install.sh
ADD util/set_mysql_root_password.sh /root/set_mysql_root_password.sh
ADD util/create_database_for_ufo_sightings.sh /root/create_database_for_ufo_sightings.sh


RUN ["chmod", "+x", "/root/project_install.sh"]
RUN ["chmod", "+x", "/root/set_mysql_root_password.sh"]
RUN ["chmod", "+x", "/root/create_database_for_ufo_sightings.sh"]

RUN yum -y install wget unzip
RUN yum -y install httpd
RUN yum -y install mysql-server

#Installing php7

RUN yum -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-6.noarch.rpm
RUN yum -y install http://rpms.remirepo.net/enterprise/remi-release-6.rpm

RUN yum -y install yum-utils

RUN yum-config-manager --enable remi-php70   [Install PHP 7.0]

RUN yum -y install php php-mcrypt php-cli php-gd php-curl php-mysql php-ldap php-zip php-fileinfo 

EXPOSE 80
EXPOSE 8080

CMD sh /root/init_script.sh
