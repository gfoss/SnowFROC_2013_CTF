/* Copyright 2013, Greg Foss
*
*This program is distributed under the terms of the GNU Affero General Public
*License */


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Agency - registration</title>
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

/*no source 4 u*/
document.addEventListener("contextmenu", function(e){
	e.preventDefault();
	if(event.button==2) {
		alert("no source for you!");
	}
}, false);

</script>
</head>

<body>
<div style="margin:auto;width:1024px" class="main">
<table style="margin:auto;width:1024px"><tr><strong>
	<form action="../search/searcha.php" method="post" id="search">
		<td class="userpanel" id="topleft"><a href="#" class="userlink" onclick="formSubmit()">Search</a></td>
		<td><input type="textbox" name="search" class="textbox"></td>
	</form>
	<td width="60%"></td>
	<td class="userpanel" id="bottomleft"><a href="loginform.php" class="userlink">Login</a></td>
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
<h2>Register</h2>
<form action="successfulreg.php" method="post">
<input type="hidden" name="submitted" id="submitted" value="1" />
<fieldset>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" placeholder="First Name" id="firstname" name="firstname" class="textbox"><br />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" placeholder="Last Name" id="lastname" name="lastname" class="textbox"><br />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" placeholder="Email" id="email" name="email" class="textbox"><br />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" placeholder="Address" id="address" name="address" class="textbox"><br />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" placeholder="Apt" id="apt" name="apt" class="textbox"><br />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" placeholder="City" id="city" name="city" class="textbox"><br />
<div class="container">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<select name='state'>
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
	</select>
</div> 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" placeholder="Zipcode" id="zip" name="zip" class="textbox"><br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="flag" value="<?php echo str_rot13('flag=cd611bf9b5ea6f0cb444ee15749ab674'); ?>" />
<button class="userlink" value="submit" type="submit">Submit</button>
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
