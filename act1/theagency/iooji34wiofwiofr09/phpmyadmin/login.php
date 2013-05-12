/* Copyright 2013, Greg Foss
*
*This program is distributed under the terms of the GNU Affero General Public
*License */

<?php

$username = $_POST["username"];
$password = $_POST["password"];
$user = "root";
$pass = "";

if ($username == $user) {
	if ($password == $pass) {
		echo "<br /><br />Success!<br />";
		echo "flag=8321f98f022860a564a44f9db5c67a12";
	} else {
		echo "<br /><br />FAIL!<br />";
		echo "return to <a href='index.php'>login page</a>";
                }
} else {
	echo "<br /><br />Invalid user<br />";
	echo "return to <a href='index.php'>login page</a>";
}
?>
