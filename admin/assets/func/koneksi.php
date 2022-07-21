<?php
$db_host = "sql101.epizy.com";
$db_user = "epiz_26183867";
$db_pass = "CiGwayc1Qb";
$db_name = "epiz_26183867_kasuari";
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$con){
	die("Gagal terhubung dengan database: " . mysqli_connect_error());
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
}