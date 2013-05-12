/* Copyright 2013, Greg Foss
*
*This program is distributed under the terms of the GNU Affero General Public
*License */

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agency</title>
<link rel="stylesheet" type="text/css" href="../style/5tyl3.css" />
<link rel="icon" type="image/ico" href="../favicon.ico" />
<!--[if IE]>
<script src="../js/html5shiv.js"></script>
<![endif]-->
</head>

<body>
<br />
<div style="margin:auto;width:1024px" class="main">

<center><a href="../administration.php">
<h1 style="font-size:60px">Agency Log Management</h1>
</a></center>

<div style="margin:auto;width:900px" class="body">
<fieldset>
<center>
<br /><h2>FAIL!</h2></br >
<p>The <i>username</i> you supplied is incorrect...  <a href="../administration.php">Try again!</a></p><br />
</center>
</fieldset>
</div>
<br /><br />
</div>
<table class="footer" style="margin:auto;width:1024px"><tr><td align="left" width="15%">
<strong>&copy; The Agency 2013</strong>
</td><td align="center"  width="70%">
<marquee><?php echo base64_encode("%u0047%u0059%u0077%u0039%u004f%u0054%u0059%u0034%u004d%u006a%u006b%u0030%u004f%u0044%u004a%u006a%u004d%u006d%u0052%u006b%u0059%u0032%u004a%u0068%u004f%u0057%u0046%u006d%u004e%u007a%u004d%u0031%u004d%u007a%u0051%u0032%u0059%u0057%u0056%u006a%u004d%u007a%u004a%u006b%u004e%u0057%u0049%u003d"); ?></marquee>
</td><td align="right"  width="15%">
<strong><?php echo date("m-d-Y");?></strong>
</td></tr></table>
</body>
</html>
