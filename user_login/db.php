<?php
$config = parse_ini_file("config.ini");
$db_hostname=$config["db_hostname"];
$db_port=$config["db_port"];
$db_name=$config["db_name"];
$db_user=$config["db_user"];
$db_password=$config["db_password"];
$dbconn = pg_connect("host='".$db_hostname."' port='".$db_port."' dbname='".$db_name."' user='".$db_user."' password='".$db_password."' ") or die("Unable to connect to postgresSQL");
?>