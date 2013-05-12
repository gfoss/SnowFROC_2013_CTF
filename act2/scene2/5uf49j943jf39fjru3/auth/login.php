/* Copyright 2013, Greg Foss
*
*This program is distributed under the terms of the GNU Affero General Public
*License */


<?php
$username = $_POST["username"];
$password = $_POST["password"];
$THE_USER = "admin";
$THE_PASS = "Bigfoot";

if ($username == $THE_USER) {
	if ($password == $THE_PASS) {
		echo "<script type='text/javascript'>";
		echo "window.location = '../0x41414141admin/index.php?file=main.txt'";
		echo "</script>";
		$value = "ZmxhZz1kOThjMjFlNjJjMGY3NDRhMWY5N2U2NWFlM2ExODdlZA==";
		setcookie("PHPSESSID",$value);
	} else {
		echo "<script type='text/javascript'>";
		echo "window.location = 'pwd-fail.php'";
		echo "</script>";
	}
} else {
	echo "<script type='text/javascript'>";
	echo "window.location = 'acct-fail.php'";
	echo "</script>";
}
?>
