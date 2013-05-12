<?php
include("config.php");

session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from Form

$username=$_POST['username'];
$mypassword=$_POST['password'];

$myusername = trim($username);

$sql="SELECT id FROM user WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
	if($count > 0 ){
//	$_SESSION['username']=$username;
	header("location: /fjk34kjfsdfn20i4fff/jkjvoivnwokjsdf29494ln/authenticated.html");
	echo "successful";
	} else {
	echo "Bad User Credentials";
	}
}
?>
