<?php
    $mysqlUser = '';
    $mysqlPassword = '';
    $mysqlHost = 'mysql:host=mysql.staszic.waw.pl; dbname='.$mysqlUser;
    $pdoAttributes = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");
?>