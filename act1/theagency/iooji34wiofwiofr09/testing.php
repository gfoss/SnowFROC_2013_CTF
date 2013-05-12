/* Copyright 2013, Greg Foss
*
*This program is distributed under the terms of the GNU Affero General Public
*License */


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Agency</title>
<link rel="stylesheet" type="text/css" href="style/le-stylez.css" />
<link rel="icon" type="image/ico" href="favicon.ico" />
<!--[if IE]>
<script src="js/html5shiv.js"></script>
<![endif]-->
<script type="text/JavaScript">
function formSubmit() {
	document.getElementById("search").submit();
}
</script>

<?php

function wrap($string, $interval=80, $breakChr="<br />") {
	$splitString = explode(' ', $string);
	foreach($splitString as $key => $val) {
		if(strlen($val)>$interval) {
			$splitString[$key] = wordwrap($val, $interval, $breakChr, true);
		}
	}
	return implode(' ', $splitString); 
}

//The following code was copied from: http://www.myphpscripts.net/tutorial.php?id=9
//Thanks Scott!
function encode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($string,$i,1));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
    }
    return $hash;
}
function decode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    for ($i = 0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
    }
    return $hash;
}
//end Scott's code

$md5 = "flag=308d3bcd3b4144fcc27d48a6b8a735b5";
$key = sha1("S00p3r D00p3r S3cr3t k3333y");
setcookie("key",$key);
$rot13 = str_rot13($md5);
$base64 = base64_encode($rot13);
$strfromchar = "Char(99,51,108,117,100,68,48,122,77,68,104,120,77,50,57,119,99,84,78,118,78,68,69,48,78,72,78,119,99,68,73,51,99,84,81,52,98,106,90,118,79,71,52,51,77,122,86,118,78,81,61,61)";
$encode = encode($strfromchar,"3914adfcf6887913e3680dd11e1242f6467d213a");
?>

</head>

<body>
<div style="margin:auto;width:1024px" class="main">
<table style="margin:auto;width:1024px"><tr><strong>
	<form action="search/searcha.php"method="post" id="search">
		<td class="userpanel" id="topleft"><a href="#" class="userlink" onclick="formSubmit()">Search</a></td>
		<td><input type="textbox" name="search" class="textbox"></td>
	</form>
	<td width="60%"></td>
	<td class="userpanel" id="bottomleft"><a href="acct/loginform.php" class="userlink">Login</a></td>
	<td class="userpanel" id="topright"><a href="acct/register.php" class="userlink">Register</a></td>
</strong></tr></table>
<center>
<a href="index.php"><div class="banner" style="border:0">
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
	<td class="navbar" id="topleft"><a href="index.php" class="navlink">Home</td>
	<td class="navbar"><a href="join.php" class="navlink">Agency</td>
	<td class="navbar"><a href="testing.php" class="navlink">Testing</td>
	<td class="navbar"><a href="resources.php" class="navlink">Resources</a></td>
	<td class="navbar" id="topright"><a href="tools.php" class="navlink">Tools</td>
</strong></tr></table>

<div style="margin:auto;width:900px" class="body" id="owasp">
<center><h2>Crack this code...</h2></center>
<fieldset>
<p>Your session token contains the key. You will need to use this key to decode the flag...</p><br />
<!--wrap($encode)-->
<pre>
o4f4h5q4v3c4z2p223r2q2r2q2a4x3p2r203t2w264u2047453n2u2z2n2648484z3w2c4q2b4w2q2p2
54z204x25434m20343m2z2q2m27484k2r2u263r2f433049413n2x2z2n26474e4z3w2d4q2b4w2q2u2
e4r28443z3a4y2p243s2q2x2y2y324p2z2p263432403c4x343u2m2w2s214f4f4z3x294q2d4p2q2t2
74r2d443z344q2z2t2z2u2m2r23494k2x223t22374q29434t2w2r2n2y2c4247454r21423b4k2v2p2
d4r2b443z3b4r2p233r2q2w2r2v3
</pre>
<!--
mr. dev -
Please use the encoder script (testing/s3cr3t-3nc0d3r.txt) along with other means to protect the flag.
- mr. admin
-->

</fieldset>
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
