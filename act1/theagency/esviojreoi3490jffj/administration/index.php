/* Copyright 2013, Greg Foss
*
*This program is distributed under the terms of the GNU Affero General Public
*License */



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Agency</title>
<link rel="stylesheet" type="text/css" href="../style/le-stylez.css" />
<link rel="icon" type="image/ico" href="../favicon.ico" />
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
<h1 class="right" style="color:#000"><strong>Challenge Administration</strong></h1>
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
<center><h2>Challenge Administration Panel</h2></center>
<hr width="75%" />
<!--[If IE 6]>
<p>Yay old internet explorer!</p><br />
--------------------<br />
<pre>
XDE0NlwxNTRcMTQxXDE0N1w3NVwxNDNcMTQyXDY3XDYxXDE0M1w2NFw2MFw2NVwxNDJcNjNcNzFc
NzBcMTQ2XDE0Mlw3MVw2Mlw2Nlw3MFw2NFw2NVw2NlwxNDZcNjJcNzBcNzBcNjNcNjNcNzFcMTQ1
XDcwXDE0Mlw2NQ==
</pre><br />
--------------------<br />
<![endif]-->
<!--trying to log in won't help you-->
<?php
if( $_COOKIE['PHPSESSID'] == '0069' ) {
	include 'a.php';
} else {
	echo '<br /><br />';
	echo '<center><h3>you are not authorized to view these resources...</h3></center>';
}
?>
<br /><br /><br /><br /><br />
<br /><br /><br /><br /><br />
<br /><br /><br /><br /><br />
<br /><br /><br /><br /><br />
<!--look to the session for guidance-->
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
