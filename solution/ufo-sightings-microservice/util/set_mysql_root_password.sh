#! /bin/sh

is_mysql_root_password_set() {
  ! mysqladmin --user=root status > /dev/null 2>&1
}

is_mysql_command_available() {
  which mysql > /dev/null 2>&1
}

if [ "$#" -ne "1" ]; then
  echo "Expected 1 argument, got $#" >&2
  usage
  exit 2
fi

db_root_password="${1}"

if is_mysql_root_password_set; then
  echo "Database root password already set"
  exit 0
fi

mysql --user=root <<_EOF_
  UPDATE mysql.user SET Password=PASSWORD('${db_root_password}') WHERE User='root';
  DELETE FROM mysql.user WHERE User='';
  DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');
  DROP DATABASE IF EXISTS test;
  DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';
  FLUSH PRIVILEGES;
_EOF_

echo "Database root password seted successfully"
exit 0

