<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// connection to database

// we created a database on the ip-address '51.15.100.196'
// thats because we had trouble importing the php-Myadmin database
define ( 'MYSQL_HOST', 'aquaweb-db:3306' );

// username = aquaweb
//password = webaqua123
define ( 'MYSQL_BENUTZER', 'root');
define ( 'MYSQL_KENNWORT', 'webaqua123');

//the database aquaweb
define ( 'MYSQL_DATENBANK', 'aquaweb' );

// variable with all sql-connection paramters for use on different sides
$db_connect= mysqli_connect (MYSQL_HOST, MYSQL_BENUTZER,  MYSQL_KENNWORT,  MYSQL_DATENBANK);

?>
