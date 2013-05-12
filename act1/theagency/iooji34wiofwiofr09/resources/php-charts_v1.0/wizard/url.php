<?php
	require("../lib/phpchart.class.php");
	$color_var=array("txt_col","line_col","bg_color");
	$cname=$_GET["type"];
	$chart=new PHPChart($cname);
	
	foreach($_GET as $key=>$value)
	{
		if($value!="")
		{
			if(in_array($key,$color_var))
			eval('$chart->'.$key.'="#'.$value.'";');
			else if($value=='yes')
			eval('$chart->'.$key.'=true;');
			else if($value=='no')
			eval('$chart->'.$key.'=false;');
			else if(is_numeric($value))			
			eval('$chart->'.$key.'='.$value.';');
			else
			eval('$chart->'.$key."='".$value."';");
		}
	}	
	$chart->genChart();
?>