#! /bin/sh

is_mysql_root_password_set() {
  ! mysqladmin --user=root status > /dev/null 2>&1
}
USER="devufo"
PASSWD="devufo"
MAINDB="ufo_sightings"
TABLENAME="ufo_sightings_bookeeper"

#Creating database user

if is_mysql_root_password_set; then
mysql -u root -proot123  << EOF
CREATE DATABASE ${MAINDB} /*\!40100 DEFAULT CHARACTER SET utf8 */;
CREATE USER ${USER}@localhost IDENTIFIED BY '${PASSWD}';
GRANT ALL PRIVILEGES ON ${MAINDB}.* TO '${USER}'@'localhost';
FLUSH PRIVILEGES;
EOF
else
  echo "Database root password is not set"
  exit 0
fi

#creating DB TABLE

mysql -u ${USER} -p${PASSWD}  << EOF
USE ${MAINDB};
CREATE TABLE ${TABLENAME} (
        id int(6) PRIMARY KEY,
        occurred_at datetime,
        city varchar(255) default null,
        state varchar(255) default null,
        country varchar(255) default null,
        shape varchar(255) default null,
        duration_seconds int(6) default null,
        duration_text varchar(255) default null,
        description text default null,
        reported_on datetime default null,
        latitude float default null,
        longitude float default null
);
EOF

#importing csv data in the table

mysql -u ${USER} -p${PASSWD}  << EOF
LOAD DATA LOCAL INFILE '/root/ufo-sightings.csv' REPLACE INTO TABLE ${MAINDB}.${TABLENAME}
FIELDS OPTIONALLY ENCLOSED BY '"' TERMINATED BY ',' LINES TERMINATED BY '\n'
IGNORE 1 LINES
(@id, @occurred_at, @city, @state, @country, @shape, @duration_seconds, @duration_text, @description, @reported_on, @latitude, @longitude)
SET
id = CAST(@id AS UNSIGNED),
occurred_at = STR_TO_DATE(@occurred_at, "%c/%e/%Y %k:%i"),
city = @city,
state = @state,
country = @country,
shape = @shape,
duration_seconds = CAST(@duration_seconds AS UNSIGNED),
duration_text = @duration_text,
description = @description,
reported_on = STR_TO_DATE(@reported_on, "%c/%e/%Y"),
latitude = @latitude,
longitude = @longitude;
EOF
