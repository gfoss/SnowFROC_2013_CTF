<!--
OSVDB=89334
-->
<?php
	$var_arr=array("type"=>"bar","dimension"=>"2d","data"=>"","series_col"=>"","group_col"=>"","value_col"=>"","bar_width"=>"","chart_thickness"=>"","radius"=>"","pie_gap"=>"","chart_width"=>"","chart_height"=>300,"bg_color"=>"F3F0E9","ymax_value"=>"","bar_gap"=>"","margin"=>10,"legend_align"=>"bottom","label"=>"no","label_font_size"=>1,"title_font_size"=>2,"title"=>"","file_path"=>"","data_type"=>"array","percent"=>"","increment"=>"","username"=>"","password"=>"","database_name"=>"","output_type"=>"html","header_height"=>20,"txt_col"=>"000000","line_col"=>"000000","direction"=>"V","doughnut_width"=>"","line_gap"=>"","marker"=>"yes","incrementx"=>'',"incrementy"=>'');
	$url="";
	$code="";
	$error="";
	if(isset($_GET['type']))
	{
		if(!isset($_GET['error']))
		{
			$color_var=array("txt_col","line_col","bg_color");
			$code='<?php'."\n";
			$code.="\t".'require("../lib/phpchart.class.php");'."\n";
			$code.="\t".'$chart=new PHPChart('."'".$_GET["type"]."'".');'."\n";
			$url="url.php?";		
			$i=0;
		}
		foreach($_GET as $key=>$value)
		{
			if($key=="p")
				continue;
			eval("\$$key='".$value."';");
			if(!isset($_GET['error']))
			{
				if($i==0)
				$url.="$key=$value";
				else
				$url.="&$key=$value";			
				if(in_array($key,$color_var))
					$code.="\t".'$chart->'.$key.'="#'.$value.'";'."\n";
				else if($value=="yes")
					$code.="\t".'$chart->'.$key.'=true;'."\n";
				else if($value=='no')
					$code.="\t".'$chart->'.$key.'=false;'."\n";
				else if(is_numeric($value))			
					$code.="\t".'$chart->'.$key.'='.$value.';'."\n";
				else
					$code.="\t".'$chart->'.$key."='".$value."';"."\n";
				$i++;
			}
			
		}
		if(!isset($_GET['error']))
		{
			$url="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/".$url;
			$url=str_replace("#",'',$url);
			$code.="\t".'$chart->genChart();'."\n";
			$code.='?>'."\n";
		}
	}
	else
	{
		foreach($var_arr as $key=>$value)
		{			
			eval("\$$key='".$value."';");
		}
	}
	if(isset($_GET['error'])&&$_GET['error']!="")
		$error=$_GET['error'];
?>
<html>
<head>
<title>Wizard</title>
<script type="text/javascript" >
var last_sel="<?php echo $data_type; ?>";
var last_sel_chart="<?php echo $type; ?>";
</script>
<script type="text/javascript" src="wizard.js" ></script>
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
Wizard
</td>
</tr>
<tr>
<td style="height:1px" align='center' >
<?php echo $error; ?>
</td>
</tr>
<tr>
<td style="height:1px" align='center' >
<?php
	if($url!=="")
	{
		echo "<table cellspacing='0' cellpadding='0' ><tr><td>";
		echo "click <a href='$url'>here</a> to access the generated url or copy the below url or code";
		echo "</td></tr>";
		echo "<tr><td onclick=\"hideBlock('URL','txtURL',this)\" class='header' >+ URL</td></tr>";
		echo "<tr><td id='txtURL' style='display:none' >";
		echo "<textarea readonly class='URL'  >$url</textarea>";
		echo "</td></tr>";
		echo "<tr><td onclick=\"hideBlock('Code','txtcode',this)\" class='header' >+ Code</td></tr>";
		echo "<tr><td id='txtcode' style='display:none'>";
		highlight_string($code);
		echo "</td></tr>";
		echo "<tr><td onclick=\"hideBlock('Preview','chartPreview',this)\" class='header' >+ Preview</td></tr>";
		echo "<tr><td id='chartPreview'  align='center' style='display:none'  >";
		if($output_type=="html")
		{
			$tmp_file="../tmp/".uniqid();
			$fh=fopen("$tmp_file.php","w");
			fwrite($fh,$code);
			fclose($fh);
			echo "<img src='$tmp_file.php' />";
		}
		else if($output_type=="pdf")
		{
			$fh=fopen("tmp_file.php","w");
			fwrite($fh,$code);
			fclose($fh);
			echo "<iframe src='tmp_file.php' class='preview_pane' ></iframe>";
		}
		else
		{
			$tmp_code=str_replace(array("<?php","?>"),"",$code);			
			eval($tmp_code);			
		}
		echo "</td></tr>";
		echo "</table>";
	}
?>
</td>
</tr>
<tr>
<td valign="top" align="center" >
	<form method="POST" action="../include/process.php" name="wizard_frm" enctype="multipart/form-data" onsubmit="return checkFields();" >
	<table cellspacing='0' class="tblpara" >	
	<tr>
	<td style="width:28%" >
	Chart
	</td>
	<td>
	<?php
	$charts=array("bar"=>"bar","pie"=>"pie","pie_explode"=>"pie","bar_mix"=>"bar","doughnut"=>"pie","doughnut_explode"=>"pie","line"=>"bar","histogram"=>"bar","min_max"=>"bar","xy"=>"bar");
	echo "<select name='type' onchange='changeChart()' >";
	foreach($charts as $chart=>$key)
	{
		if($chart==$type)
			echo "<option selected value='$chart' >$chart</option>";
		else
			echo "<option value='$chart' >$chart</option>";
	}
	echo "</select>";
	?>
	</td>
	</tr>
	<tr>
	<td>
	Dimension
	</td>
	<td>
	<input type='radio' value='2d' <?php echo ($dimension=="2d"?"checked":""); ?> name='dimension' class="rad_style" />2D <input type='radio' value='3d' <?php echo ($dimension=="3d"?"checked":""); ?> name='dimension' class="rad_style" />3D
	</td>
	</tr>
	<tr>
	<td>
	Data Type
	</td>
	<td>
	<?php
	$data_types=array("array"=>"array","mysql"=>"db","PostgreSql"=>"db","MSAccess"=>"db","Oracle"=>"db","csv"=>"file","xml"=>"file");
	echo "<select name='data_type' onchange='changeDataType(this)' >";
	$db_display="style='display:none'";
	$file_display="style='display:none'";
	$array_display="style='display:none'";
	$col_width="";
	foreach($data_types as $dtype=>$key)
	{
		if($dtype==$data_type)
		{
			echo "<option value='$dtype' selected >$dtype</option>";
			if($key=="db")
				$db_display="";
			if($key=="file")
				$file_display="";
			if($key=="array")
			{
				$array_display="";
				$col_width="style='width:70%;'";
			}
		}
		else
		echo "<option value='$dtype' >$dtype</option>";
	}
	echo "</select>";
	?>
	</td>
	</tr>
	<tr>
	<td colspan='2' id="db_detail" <?php echo $db_display; ?> >
		<table cellspacing='0'  >
		<tr>
		<td style="width:28%">
		Database Name*
		</td>
		<td>
		<input type="text" name="database_name" value="<?php echo $database_name; ?>" />
		</td>
		</tr>
		<tr>
		<td>
		User Name
		</td>
		<td>
		<input type="text" name="username" value="<?php echo $username; ?>" />
		</td>
		</tr>
		<tr>
		<td>
		Password
		</td>
		<td>
		<input type="password" name="password" value="<?php echo $password; ?>" />
		</td>
		</tr>
		<tr>
		<td>
		Server
		</td>
		<td>
		<input type="text" name="server_name" value="<?php echo $server_name; ?>" />
		</td>
		</tr>
		<tr>
		<td>
		Query*
		</td>
		<td>
		 <textarea name="query" class="query" ><?php echo $query; ?></textarea>
		</td>
		</tr>
		</table>
	</td>
	</tr>
	<tr id='file_detail' <?php echo $file_display; ?> >
	<td>
	Data File*
	</td>
	<td>
	<input type="file" name="file_path1" /> <input type="text" name="file_path" value="<?php echo $file_path;?>" />
	</td>
	</tr>
	<!--<tr>
	<td colspan='2' >
	Columns
	</td>
	</tr>-->
	<tr>
	<td>
	Group*
	</td>
	<td>
	<input type="text" name="group_col" value="<?php echo $group_col;?>" <?php echo $col_width; ?> /><span id="col1_detail" class="info" <?php echo $array_display; ?> >ex:  c1:a,b,c</span>
	</td>
	</tr>
	<tr>
	<td>
	Series
	</td>
	<td>
	<input type="text" name="series_col" value="<?php echo $series_col;?>" <?php echo $col_width; ?> /><span id="col2_detail" class="info" <?php echo $array_display; ?> >ex: c2:a1,b1,c1,d1</span>
	</td>
	</tr>
	<tr>
	<td>
	Value
	</td>
	<td>
	<input type="text" name="value_col" value="<?php echo $value_col;?>" <?php echo $col_width; ?> /><span id="col3_detail" class="info" <?php echo $array_display; ?> >ex: c3:1,2,3,4|8,,4,5|5,2,,6</span>
	</td>
	</tr>
	<tr>
	<td>
	Output Type
	</td>
	<td>
	<?php
	$output_types=array("html","jpg","png","gif","pdf");
	echo "<select name='output_type'>";
	foreach($output_types as $o_type)
	{
		if($o_type==$output_type)
		echo "<option selected >$o_type</option>";
		else
		echo "<option>$o_type</option>";
	}
	echo "</select>";
	?>
	</td>
	</tr>
	<tr>
	<td onclick="hideBlock('Style','chart_style',this)" colspan='2' class="header" >
	+ Style
	</td>
	</tr>
	<tr>
	<td colspan="2" id='chart_style' style="display:none" >
		<table cellspacing='0' >
		<tr>
		<td style="width:28%">
		Chart Width
		</td>
		<td>
		<input type="text" name="chart_width" size="3" maxlength="3" value="<?php echo $chart_width;?>" />
		</td>
		</tr>
		<tr>
		<td>
		Chart Height
		</td>
		<td>
		<input type="text" name="chart_height" size="3" maxlength="3" value="<?php echo $chart_height;?>" />
		</td>
		</tr>
		<tr>
		<td>
		Background Color (#)
		</td>
		<td>
		<input type="text" name="bg_color" size="7" maxlength="7" value="<?php echo $bg_color;?>" />
		</td>
		</tr>
		<tr>
		<td>
		Text Color (#)
		</td>
		<td>
		<input type="text" name="txt_col" size="7" maxlength="7" value="<?php echo $txt_col;?>" />
		</td>
		</tr>
		<tr>
		<td>
		Line Color (#)
		</td>
		<td>
		<input type="text" name="line_col" size="7" maxlength="7" value="<?php echo $line_col;?>" />
		</td>
		</tr>
		<tr>
		<td>
		Header Height
		</td>
		<td>
		<input type="text" name="header_height" size="3" maxlength="3" value="<?php echo $header_height;?>" />
		</td>
		</tr>
		<tr>
		<td>
		Margin
		</td>
		<td>
		<input type="text" name="margin" size="3" maxlength="3" value="<?php echo $margin;?>" />
		</td>
		</tr>
		<tr>
		<td>
		Thickness
		</td>
		<td>
		<input type="text" name="chart_thickness" size="3" maxlength="3" value="<?php echo $chart_thickness;?>" />
		</td>
		</tr>
		<tr>
		<td>
		Title
		</td>
		<td>
		<input type="text" name="title" value="<?php echo $title;?>" />
		</td>
		</tr>
		<tr>
		<td>
		Title Font Size
		</td>
		<td>
		<?php
		echo "<select name='title_font_size'>";
		for($i=1;$i<=10;$i++)
		{
			if($i==$title_font_size)
			echo "<option selected >$i</option>";
			else
			echo "<option>$i</option>";
		}
		echo "</select>";
		?>
		</td>
		</tr>		
		<tr>
		<td>
		Display Label
		</td>
		<td>
		<input type='radio' value='yes' <?php echo ($label=="yes"?"checked":""); ?> name='label' class="rad_style" />Yes <input type='radio' value='no' <?php echo ($label=="no"?"checked":""); ?> name='label' class="rad_style" />No
		</td>
		</tr>
		<tr>
		<td>
		Label Font Size
		</td>
		<td>
		<?php
		echo "<select name='label_font_size'>";
		for($i=1;$i<=5;$i++)
		{
			if($i==$label_font_size)
			echo "<option selected >$i</option>";
			else
			echo "<option>$i</option>";
		}
		echo "</select>";
		?>
		</td>
		</tr>
		<tr>
		<td>
		Legend Alignment
		</td>
		<td>
		<?php
		$legend_aligns=array("bottom","top","left","right");
		echo "<select name='legend_align'>";
		foreach($legend_aligns as $lg_align)
		{
			if($lg_align==$legend_align)
			echo "<option selected >$lg_align</option>";
			else			
			echo "<option>$lg_align</option>";
		}
		echo "</select>";
		?>
		</td>
		</tr>
		</table>
	</td>
	</tr>	
	<tr>
	<td  colspan="2" id="bar" <?php echo ($charts[$type]=="bar"?'':"style='display:none'"); ?> >
		<table cellspacing='0' >
		<tr>
		<td style="width:28%">
		Direction
		</td>
		<td>
		<input type='radio' value='V' <?php echo ($direction=="V"?"checked":""); ?> name='direction' class="rad_style" />Vertical <input type='radio' value='H' <?php echo ($direction=="H"?"checked":""); ?> name='direction' class="rad_style" />Horizontal
		</td>
		</tr>		
		<tr id='line_gap' <?php echo ($type=="line"||$type=="min_max"?'':"style='display:none'"); ?>>
		<td>
		Line Gap
		</td>
		<td>
		<input type="text" name="line_gap" size="3" maxlength="3" value="<?php echo $line_gap;?>" />
		</td>
		</tr>
		<tr id='marker' <?php echo ($type=="line"?'':"style='display:none'"); ?> >
		<td>
		Marker
		</td>
		<td>
		<input type='radio' value='yes' <?php echo ($marker=="yes"?"checked":""); ?> name='marker' class="rad_style" />Yes <input type='radio' value='no' <?php echo ($marker=="no"?"checked":""); ?> name='marker' class="rad_style" />No
		</td>
		</tr>
		<tr id='bar_width' <?php echo ((!in_array($type,array("line","min_max","xy")))?'':"style='display:none'"); ?> >
		<td>
		Bar Width
		</td>
		<td>
		<input type="text" name="bar_width" size="3" maxlength="3" value="<?php echo $bar_width;?>" />
		</td>
		</tr>
		<tr id='bar_gap' <?php echo ($charts[$type]=="bar"&&(!in_array($type,array("line","min_max","xy","histogram")))?'':"style='display:none'"); ?> >
		<td>
		Bar Gap
		</td>
		<td>
		<input type="text" name="bar_gap" size="3" maxlength="3" value="<?php echo $bar_gap;?>" />
		</td>
		</tr>		
		<tr id="increment" <?php echo (($type!="xy")?'':"style='display:none'"); ?> >
		<td>
		Increment
		</td>
		<td>
		<input type="text" name="increment" size="3" maxlength="3" value="<?php echo $increment;?>" />
		</td>
		</tr>
		<tr id="ymax_values" <?php echo (($type!="xy")?'':"style='display:none'"); ?> >
		<td>
		Y-Max Value
		</td>
		<td>
		<input type="text" name="ymax_value" size="3" maxlength="3" value="<?php echo $ymax_value;?>" />
		</td>
		</tr>
		<tr id="percent" <?php echo (($type!="xy")?'':"style='display:none'"); ?> >
		<td>
		Percent
		</td>
		<td>
		<input type="text" name="percent" size="3" maxlength="3" value="<?php echo $percent;?>" />
		</td>
		</tr>		
		</table>
	</td>
	</tr>
	<tr>
	<td  colspan="2" id="xy" <?php echo ($type=="xy"?'':"style='display:none'"); ?> >
		<table cellspacing='0' >
		<tr>
		<td style="width:28%" >
		Increment-X
		</td>
		<td>
		<input type="text" name="incrementx" size="3" maxlength="3" value="<?php echo $incrementx;?>" />
		</td>
		</tr>
		<tr>
		<td>
		Increment-Y
		</td>
		<td>
		<input type="text" name="incrementy" size="3" maxlength="3" value="<?php echo $incrementy;?>" />
		</td>
		</tr>
		</table>
	</td>
	</tr>
	<tr>
	<td id="pie" colspan="2" <?php echo ($charts[$type]=="pie"?'':"style='display:none'"); ?> >
		<table cellspacing='0' >
		<tr>
		<td style="width:28%">
		Radius
		</td>
		<td>
		<input type="text" name="radius" value="<?php echo $radius;?>" />
		</td>
		</tr>
		<tr>
		<td>
		Slice Gap
		</td>
		<td>
		<input type="text" name="pie_gap" value="<?php echo $pie_gap;?>" />
		</td>
		</tr>
		<tr id="doughnut_width" <?php echo (in_array($type,array("doughnut","doughnut_explode"))?'':"style='display:none'"); ?> >
		<td>
		Width
		</td>
		<td>
		<input type="text" name="doughnut_width" value="<?php echo $doughnut_width;?>" />
		</td>
		</tr>		
		</table>
	</td>
	</tr>
	<tr>
	<td colspan='2' align="right">
	<!--<input type="image" src="imgs/set_default.png" style="border:none" value="Set Default" onclick="window.location.href='?p=wizard'" /> -->
	<a href="?p=wizard" ><img src="../include/imgs/set_default.png" style="border:none" /></a>
	<a href="javascript:document.wizard_frm.submit();" ><img src="../include/imgs/generate.png" style="border:none" /></a>
<!--	<input type="image" src="imgs/generate.png" style="border:none" onclick="document.submit" />-->
	</td>
	</tr>
	</table>
	</form>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>
