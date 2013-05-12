/* Copyright 2013, Greg Foss
*
*This program is distributed under the terms of the GNU Affero General Public
*License */


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Agency</title>
<link rel="stylesheet" type="text/css" href="../../style/le-stylez.css" />
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
<hr width="75%" />
<h3>Customer Sensitive Data:</h3>
<fieldset>
<?php
$username = $_POST["username"];
$password = $_POST["password"];

$USER1 = "admin";
$PASS1 = "SN0W_FR0C";
$USER2 = "n00b";
$PASS2 = "P@ssword";
$USER3 = "gary";
$PASS3 = "mary";
$USER4 = "larry";
$PASS4 = "changeme";
$USER5 = "mary";
$PASS5 = "christmas";
$USER6 = "jerry";
$PASS6 = "curl";
$USER7 = "hairy";
$PASS7 = "beast";
$USER8 = "fairy";
$PASS8 = "123456";
$USER9 = "kate_libby";
$PASS9 = "acidburn";

if ($username == $USER1) {
	if ($password == $PASS1) {
		echo "<br /><br />";
		echo "Correct!<br /><br />";
		echo "flag=abeb6b81360dfabb3b87bcbfe89015d9<br /><br />";
                echo "user's recent e-mail history:<br /><br />";
                echo "----------<br />";
                echo "N/A<br />";
                echo "----------<br /><br />";
		echo "<center><a href='../index.php'>return home</a></center>";
	} else {
		echo "<br /><br />";
		echo "FAIL<br />";
		echo "<a href='../index.php'>Try again</a>";
		echo "</br ><br />";
	}
} elseif ($username == $USER2) {
        if ($password == $PASS2) {
                echo "<br /><br />";
                echo "Correct!<br /><br />";
                echo "flag=2b06abdaae86b986d6bfb1b1aadb0fbf<br />";
                echo "user's recent e-mail history:<br /><br />";
                echo "----------<br />";
                echo "N/A<br />";
                echo "----------<br /><br />";
                echo "<center><a href='../index.php'>return home</a></center>";
        } else {
                echo "<br /><br />";
                echo "FAIL<br />";
                echo "<a href='../index.php'>Try again</a>";
                echo "</br ><br />";
	}
} elseif ($username == $USER3) {
        if ($password == $PASS3) {
                echo "<br /><br />";
                echo "Correct!<br /><br />";
                echo "flag=26c13cf5d4e9a4b18ddc574e1612e300<br /><br />";
                echo "user's recent e-mail history:<br /><br />";
                echo "----------<br />";
                echo "From: Gary@theagency.owasp<br />";
                echo "To: Mary@theagency.owasp<br />";
                echo "Date: March 21st, 2013<br />";
                echo "Subject: Sup<br />";
                echo "----------<br /><br />";
                echo "Hey... What's going on? Doing anything Saturday??<br /><br />";
		echo "----------<br /><br />";
                echo "<center><a href='../index.php'>return home</a></center>";
        } else {
                echo "<br /><br />";
                echo "FAIL<br />";
                echo "<a href='../index.php'>Try again</a>";
                echo "</br ><br />";
	}
} elseif ($username == $USER4) {
        if ($password == $PASS4) {
                echo "<br /><br />";
                echo "Correct!<br /><br />";
                echo "flag=0a4cd42a0ea10743c87aaaa3fcca2797<br /><br />";
                echo "user's recent e-mail history:<br /><br />";
                echo "----------<br />";
                echo "N/A<br />";
                echo "----------<br /><br />";
                echo "<center><a href='../index.php'>return home</a></center>";
        } else {
                echo "<br /><br />";
                echo "FAIL<br />";
                echo "<a href='../index.php'>Try again</a>";
                echo "</br ><br />";
	}
} elseif ($username == $USER5) {
        if ($password == $PASS5) {
                echo "<br /><br />";
                echo "Correct!<br /><br />";
                echo "flag=423740bd41c247f416cf3c587b0abc03<br /><br />";
                echo "user's recent e-mail history:<br /><br />";
                echo "----------<br />";
                echo "From: HumanResources@theagency.owasp<br />";
                echo "To: Mary@theagency.owasp<br />";
                echo "Date: March 27th, 2013<br />";
                echo "Subject: Stalking and overall creepiness<br />";
                echo "----------<br /><br />";
                echo "We have received your HR report on Gary and are meeting with him this afternoon to discuss 'inappropriate behavior'.<br />";
		echo "Thank you,<br />";
		echo "Agency, Human Resources<br />";
                echo "----------<br /><br />";
                echo "<center><a href='../index.php'>return home</a></center>";
        } else {
                echo "<br /><br />";
                echo "FAIL<br />";
                echo "<a href='../index.php'>Try again</a>";
                echo "</br ><br />";
	}
} elseif ($username == $USER6) {
        if ($password == $PASS6) {
                echo "<br /><br />";
                echo "Correct!<br /><br />";
                echo "flag=ee64227d800ba8e44cf61d30231c8f38<br /><br />";
                echo "user's recent e-mail history:<br /><br />";
                echo "----------<br />";
                echo "N/A<br />";
                echo "----------<br /><br />";
                echo "<center><a href='../index.php'>return home</a></center>";
        } else {
                echo "<br /><br />";
                echo "FAIL<br />";
                echo "<a href='../index.php'>Try again</a>";
                echo "</br ><br />";
	}
} elseif ($username == $USER7) {
        if ($password == $PASS7) {
                echo "<br /><br />";
                echo "Correct!<br /><br />";
                echo "flag=b7b9c5e50ccc157f58a622f24ab604a2<br /><br />";
                echo "user's recent e-mail history:<br /><br />";
                echo "----------<br />";
                echo "N/A<br />";
                echo "----------<br /><br />";
                echo "<center><a href='../index.php'>return home</a></center>";
        } else {
                echo "<br /><br />";
                echo "FAIL<br />";
                echo "<a href='../index.php'>Try again</a>";
                echo "</br ><br />";
	}
} elseif ($username == $USER8) {
        if ($password == $PASS8) {
                echo "<br /><br />";
                echo "Correct!<br /><br />";
                echo "flag=4b8943cb9cb83423fa3f9aef730ad4a3<br /><br />";
		echo "user's recent e-mail history:<br /><br />";
                echo "----------<br />";
                echo "N/A<br />";
                echo "----------<br /><br />";
		echo "<center><a href='../index.php'>return home</a></center>";
        } else {
                echo "<br /><br />";
                echo "FAIL<br />";
                echo "<a href='../index.php'>Try again</a>";
                echo "</br ><br />";
	}
} elseif ($username == $USER9) {
        if ($password == $PASS9) {
                echo "<br /><br />";
                echo "flag=0f4f1d0a9e5a05b9e17e249fb9720919<br /><br />";
		echo "user's recent e-mail history:<br /><br />";
		echo "----------<br />";
		echo "From: Kate.Libby@theagency.owasp <chunkych1mp><br />";
		echo "To: LazyLangur@shadowcorp.owasp<br />";
		echo "CC: ChunkyCh1mp@shadowcorp.owasp<br />";
		echo "Date: March 23rd, 2013<br />";
		echo "Subject: Operation Beast Master<br />";
		echo "----------<br /><br />";
		echo "The plan is on course, move forward as expected...<br /><br />";
                echo "----------<br /><br />";
		echo "<center><a href='../index.php'>return home</a></center>";
        } else {
                echo "<br /><br />";
                echo "FAIL<br />";
                echo "<a href='../index.php'>Try again</a>";
                echo "</br ><br />";
        }
} else {
        echo "<br /><br />";
        echo "That's not even a user!<br />";
        echo "<a href='../index.php'>Try again</a>";
        echo "</br ><br />";
}
?>
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
