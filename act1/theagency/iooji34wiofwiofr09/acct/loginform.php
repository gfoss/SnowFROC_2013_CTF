/* Copyright 2013, Greg Foss
*
*This program is distributed under the terms of the GNU Affero General Public
*License */


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Agency - login</title>
<link rel="stylesheet" type="text/css" href="../style/le-stylez.css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-dropdown.js"></script>
<link rel="icon" type="image/ico" href="../favicon.ico" />
<!--[if IE]>
<script src="../js/html5shiv.js"></script>
<![endif]-->
<script type="text/JavaScript">

/*search*/
function formSubmit() {
	document.getElementById("search").submit();
}

/*no-source-4-u*/
document.addEventListener("contextmenu", function(e){
	e.preventDefault();
	if(event.button==2) {
		alert("no source for you!");
	}
}, false);

/*login*/
var count = 2;
function validate() {
    document.getElementById("login").submit();
    var un = document.login.username.value;
    var pw = document.login.password.value;
    var valid = false;
    var unArray = ["Phil", "George", "Sarah", "Michael"];
    var pwArray = ["likes-turtlez", "P@ssword1", "monk3yz", "0JI(UXHu0h)H)U*@"];
    for (var i=0; i <unArray.length; i++) {
    	if ((un == unArray[i]) && (pw == pwArray[i])) {
	valid = true;
	break;
	}
    }
    if (valid) {
    	alert ("Success!\n\nflag=e84f3f77e921b6dc22733eac2070287a");
	return false;
    }
    var t = " tries";
    if (count == 1) {t = " try"}
    if (count >= 1) {
	alert ("FAIL!");
	document.login.username.value = "";
	document.login.pword.value = "";
	setTimeout("document.login.username.focus()", 25);
	setTimeout("document.login.username.select()", 25);
	count --;
    }
    else {
	alert ("FAIL! No more tries for you...");
	document.login.username.value = "No more tries allowed!";
	document.login.password.value = "";
	document.login.username.disabled = true;
	document.login.password.disabled = true;
	return false;
    }
}
</script>

</head>

<body ontextmenu="return false">
<div style="margin:auto;width:1024px" class="main">
<table style="margin:auto;width:1024px"><tr><strong>
	<form action="../search/searcha.php" method="post" id="search">
		<td class="userpanel" id="topleft"><a href="#" class="userlink" onclick="formSubmit()">Search</a></td>
		<td><input type="textbox" name="search" class="textbox"></td>
	</form>
	<td width="60%"></td>
	<td class="userpanel" id="bottomleft"><a href="login.php" class="userlink">Login</a></td>
	<td class="userpanel" id="topright"><a href="register.php" class="userlink">Register</a></td>
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
<h1 class="right" style="color:#000"><strong>Proving Grounds</strong></h1>
</div></a>

</center>
<table id="center"><tr><strong>
  <td class="navbar" id="topleft"><a href="../index.php" class="navlink">Home</td>
  <td class="navbar"><a href="../join.php" class="navlink">Agency</td>
  <td class="navbar"><a href="../testing.php" class="navlink">Testing</td>
  <td class="navbar"><a href="../resources.php" class="navlink">Resources</a></td>
  <td class="navbar" id="topright"><a href="../tools.php" class="navlink">tools</td>
</strong></tr></table>

<div style="margin:auto;width:900px" class="body">
<h2>Login</h2><br />
<form action="#" method="post" id="login" name="login">
<input type="hidden" name="submitted" id="submitted" value="1" />
<fieldset>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" placeholder="Username" id="username" name="username" class="textbox"><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="password" placeholder="Password" id="password" name="password" class="textbox"><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button class="userlink" value="login" type="submit" onclick="validate()">Sign in</button>
</fieldset>
</form>
<br /><br />
</div>

</div>
<table class="footer" style="margin:auto;width:1024px"><tr><td align="left" width="33%">
<strong>&copy; The Agency</strong>
</td><td align="center"  width="33%">
- handling tough jobs that make other agencies cry -
</td><td align="right"  width="33%">
<strong><?php echo date("m-d-Y");?></strong>
</td></tr></table>
<!--aHR0cDovL3d3dy5ncmVnZm9zcy5jb20vMHg0MjQyNDI0MmFhYWFTbm93RlIwQzIwMTMucGhw-->
</body>
</html>

