<html>
<head>
<title>Gallery</title>
<link rel="stylesheet" type="text/css" href="../include/style.css" />
</head>
<body>
<table>
<tr>
<td align="center" valign="top" >
<table cellspacing='0' cellpadding='0' class="main_tbl" >
<tr>
<td>
<table>
<tr>
<td class="site_name" >
	php<img src='../include/imgs/pie3d.png' />Charts 
</td>
<td align="right" >
	<a href="../gallery">Gallery</a> | <a href="../wizard">Wizard</a> | <a href="../docs">Document</a>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="page_header" >
Gallery
</td>
</tr>
<tr>
<td>
<?php
	$fh=fopen("url.txt","r");
	if($fh)
	{
		echo "<table style='text-align:center;' cellspacing='0' ><tr>";
		$c=1;
		$fl=false;
		while(!feof($fh))
		{
			$right_bdr="";
			$bottom_bdr="";
			$line=fgets($fh);
			if($line!="")
			{
				if($c==4)
				{
					echo "</tr><tr>";
					$c=1;
					$fl=true;
				}
				
				if($c<3)
					$right_bdr="border-right:dashed #808DBB 1px;";
				if($fl)
				$top_bdr="border-top:dashed #808DBB 1px;";
				echo "<td valign='top' align='center' style='$top_bdr"."$right_bdr' >";
				echo "<a href='../wizard/?$line' ><img src='../wizard/url.php?$line' border='0' /></a>";
				echo "</td>";
				
				$c++;
			}
		}		
		echo "</tr></table>";
	}
	fclose($fh);
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>