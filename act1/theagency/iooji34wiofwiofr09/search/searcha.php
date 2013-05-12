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
function formSubmit() {
  document.getElementById("search").submit();
}
</script>
<?php
$value = "176d7f3c46c3fcc440a4958e9a83bdd6";
setcookie("flag",$value);
?>
</head>

<body>
<div style="margin:auto;width:1024px" class="main">
<table style="margin:auto;width:1024px"><tr><strong>
  <form action="searcha.php" method="post" id="search">
    <td class="userpanel" id="topleft"><a href="#" class="userlink" onclick="formSubmit()">Search</a></td>
    <td><input type="textbox" name="search" class="textbox"></td>
  </form>
  <td width="60%"></td>
  <td class="userpanel" id="bottomleft"><a href="../acct/loginform.php" class="userlink">Login</a></td>
  <td class="userpanel" id="topright"><a href="../acct/register.php" class="userlink">Register</a></td>
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

<div style="margin:auto;width:900px" class="body" id="owasp">
<h2>Search Results:</h2><br />
<fieldset>
<?php 
echo "<br />";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo $_POST['search'];
echo "<br /><br />";
?>
<form action="searchb.php" method="post">
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Uh oh... search appears to be broken...<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
try the beta search form below:</p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="textarea" name="search" class="textbox">
<button class="userlink" type="submit">Search</button>
</form>
</fieldset>
<!--
mmm... cookies + flags r my favorite!
                _  _
              _/0\/ \_
     .-.   .-` \_/\0/ '-.
    /:::\ / ,_________,  \
   /\:::/ \  '. (:::/  `'-;
   \ `-'`\ '._ `"'"'\__    \
    `'-.  \   `)-=-=(  `,   |
     \  `-"`      `"-`   /
-->
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
