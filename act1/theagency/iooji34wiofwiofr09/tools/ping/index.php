<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Agency</title>
<link rel="stylesheet" type="text/css" href="../../style/le-stylez.css" />
<link rel="icon" type="image/ico" href="../../favicon.ico" />
<!--[if IE]>
<script src="js/html5shiv.js"></script>
<![endif]-->
<script type="text/JavaScript">
function formSubmit() {
	document.getElementById("search").submit();
}
</script>
</head>

<body>
<div style="margin:auto;width:1024px" class="main">
<table style="margin:auto;width:1024px"><tr><strong>
	<form action="../../search/searcha.php"method="post" id="search">
		<td class="userpanel" id="topleft"><a href="#" class="userlink" onclick="formSubmit()">Search</a></td>
		<td><input type="textbox" name="search" class="textbox"></td>
	</form>
	<td width="60%"></td>
	<td class="userpanel" id="bottomleft"><a href="../../acct/loginform.php" class="userlink">Login</a></td>
	<td class="userpanel" id="topright"><a href="../../acct/register.php" class="userlink">Register</a></td>
</strong></tr></table>
<center>
<a href="../../index.php"><div class="banner" style="border:0">
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
  <td class="navbar" id="topleft"><a href="../../index.php" class="navlink">Home</td>
  <td class="navbar"><a href="../../join.php" class="navlink">Agency</td>
  <td class="navbar"><a href="../../testing.php" class="navlink">Testing</td>
  <td class="navbar"><a href="../../resources.php" class="navlink">Resources</a></td>
  <td class="navbar" id="topright"><a href="../../tools.php" class="navlink">tools</td>
</strong></tr></table>

<div style="margin:auto;width:900px" class="body" id="owasp">
<br />
<h2>Ping a host, any host!</h2>
<frameset>
<?php if (isset($_REQUEST['cmd'])){
echo '<pre>';
system('ping -c2 ' . $_REQUEST['cmd']);
echo '</pre>'; } ?>
<form action=<?php echo basename($_SERVER['PHP_SELF'])?>>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type=text name=cmd size=40 class="textbox">
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type=submit class="userlink"></form>
<p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
examples: 127.0.0.1 OR www.google.com</p>
</frameset>
<br /><br /><br /><br /><br />
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
<!--aHR0cDovL3d3dy5ncmVnZm9zcy5jb20vMHg0MjQyNDI0MmFhYWFTbm93RlIwQzIwMTMucGhw-->
</body>
</html>
