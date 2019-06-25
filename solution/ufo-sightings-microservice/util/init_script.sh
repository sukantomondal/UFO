 #!/bin/bash
 # centos init script

 # mysql start
 /sbin/chkconfig --levels 235 mysqld on
 service mysqld start

 # Appache start
 service httpd start

 tail -f /dev/null
