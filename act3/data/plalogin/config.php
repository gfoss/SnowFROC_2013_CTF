<?php
$mysql_hostname = "localhost";
$mysql_user = "act3login";
$mysql_password = "@ct3Hax0rs4Lyfe!!";
$mysql_database = "act3_scene1";
$connect = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die(mysql_error());
mysql_select_db($mysql_database, $connect) or die("You fail hard");
?>
