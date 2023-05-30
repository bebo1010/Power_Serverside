CREATE USER '{{username}}'@'localhost' IDENTIFIED WITH mysql_native_password BY '{{password}}';
ALTER USER '{{username}}'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
CREATE DATABASE IF NOT EXISTS `{{username}}`;GRANT ALL PRIVILEGES ON `{{username}}`.* TO '{{username}}'@'localhost';
FLUSH PRIVILEGES;