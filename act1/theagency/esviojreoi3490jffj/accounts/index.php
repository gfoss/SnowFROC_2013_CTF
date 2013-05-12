/* Copyright 2013, Greg Foss
*
* This program is distributed under the terms of the GNU Affero General Public
* License */


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Agency</title>
<link rel="stylesheet" type="text/css" href="../style/le-stylez.css" />
<link rel="icon" type="image/ico" href="favicon.ico" />
<!--[if IE]>
<script src="js/html5shiv.js"></script>
<![endif]-->
<script type="text/JavaScript">
/*search*/
function formSubmit() {
	document.getElementById("search").submit();
}

/*no source 4 u*/
document.addEventListener("contextmenu", function(e){
	e.preventDefault();
	if(event.button==2) {
		alert("no source for you!");
	}
}, false);

/*navbar*/
function ohsnap() {
	alert("stahp!");
}

</script>

<?php
$value = "1234";
setcookie("PHPSESSID",$value);
?>

</head>

<body>
<div style="margin:auto;width:1024px" class="main">
<table style="margin:auto;width:1024px"><tr><strong>
	<form action="#"method="post" id="search">
		<td class="userpanel" id="topleft"><a href="#" class="userlink" onclick="ohsnap()">Search</a></td>
		<td><input type="textbox" name="search" class="textbox"></td>
	</form>
	<td width="60%"></td>
	<td class="userpanel" id="topright"><a href="#" class="userlink" onclick="ohsnap()">Administrator</a></td>
</strong></tr></table>
<center>
<a href="../index.php"><div class="banner" style="border:0">
<!--image stolen from [http://modok.deviantart.com/art/OWASP-Wallpaper-1-326712758] thanks! -->
<pre class="title" align="right"><strong>
___________.__                                
\__    ___/|  |__   ____                      
  |    |   |  |  \_/ __ \                     
  |    |   |   V  \  ___/                     
  |____|   |___|  /\___  >                    
                \/     \/                     
   _____                                      
  /  _  \    ____   ____   ____   ____ ___.__.
 /  /_\  \  / ___\_/ __ \ /    \_/ ___|   |  |
/    |    \/ /_/  |  ___/|   |  \  \___\___  |
\____|__  /\___  / \___  >___|  /\___  / ____|
        \//_____/      \/     \/     \/\/     
</strong></pre>
<br />
<h1 class="right" style="color:#000"><strong>Customer Data Portal</strong></h1>
</div></a>

</center>
<table id="center"><tr><strong>
	<td class="navbar" id="topleft"><a href="#" class="navlink" onclick="ohsnap()">Home</td>
	<td class="navbar"><a href="#" class="navlink" onclick="ohsnap()">Agency</td>
	<td class="navbar"><a href="#" class="navlink" onclick="ohsnap()">Testing</td>
	<td class="navbar"><a href="#" class="navlink" onclick="ohsnap()">Resources</a></td>
	<td class="navbar" id="topright"><a href="#" class="navlink" onclick="ohsnap()">Tools</td>
</strong></tr></table>

<div style="margin:auto;width:900px" class="body" id="owasp">
<center><h2>Sensitive Information Transfer Portal</h2></center>
<fieldset>
<p>Enter credentials to view customer sensitive data:</p>
<!--
psssttt.....
Maybe the Googles can help!
-->
<center><h3>Login</h3></center>
<form method="POST" action="user/test.php">
	<table border="0" style="margin:auto;width:20%">
	<tr><td align="center" valign="top">
	Username:
	</td><td align="left" valign="top">
	<input type="text" name="username" class="textbox" />
	</td></tr>
	<tr><td align="center">
	Password:
	</td><td align="left" valign="top">
	<input type="password" name="password" class="textbox" />
	</td></tr>
	<tr><td></td><td align="right" valign="top">
	<input type="submit" value="Test" class="button" />
	</td></tr>
	</table>
</form>
<p>Local user account administration:</p>
<center><p>
<a href="etc/passwd">Local System Accounts</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="etc/shadow">Local System Hashes</a>
</p></center>
</fieldset>

<br /><br /><br /><br /><br />
<br /><br /><br /><br /><br />
<br /><br /><br /><br /><br />
</div>

</div>
<table class="footer" style="margin:auto;width:1024px"><tr><td align="left" width="33%">
<strong>&copy; The Agency</strong>
</td><td align="center"  width="33%">
- handling tough jobs that make other agencies cry -
</td><td align="right"  width="33%">
<strong><?php echo date("m-d-Y");?></strong>
</td></tr></table>
<!--HI-->
</body>
</html>
