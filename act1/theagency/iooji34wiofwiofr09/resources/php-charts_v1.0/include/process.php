<?php
	$var_arr=array("type"=>"bar","dimension"=>"2d","data"=>"","series_col"=>"","group_col"=>"","value_col"=>"","bar_width"=>20,"chart_thickness"=>10,"radius"=>100,"pie_gap"=>20,"chart_width"=>"","chart_height"=>300,"bg_color"=>"ffffff","ymax_value"=>"","bar_gap"=>20,"margin"=>20,"legend_align"=>"bottom","label"=>"no","label_font_size"=>2,"title_font_size"=>5,"title"=>"","file_path"=>"","delimiter"=>",","data_type"=>"mysql","percent"=>"","increment"=>1,"username"=>"","password"=>"","database_name"=>"","output_type"=>"html","header_height"=>30,"txt_col"=>"000000","line_col"=>"000000","direction"=>"V","doughnut_width"=>20,"line_gap"=>20,"marker"=>"yes");
	$fname="";
	$url="";
	$code="";
	$error="";
	
	if($_POST['data_type']=="csv"||$_POST['data_type']=="xml")
	{
		if(!isset($_POST['file_path'])||$_POST['file_path']=="")
		{
			if(isset($_FILES["file_path1"]))
			{
				if ($_FILES["file_path1"]["size"] < 20000)
				{
					if ($_FILES["file_path1"]["error"] > 0)
					{
						if($_FILES["file_path1"]["error"]==4)
						$error="&error=Data File required";
						else
						$error="error=Return Code : ".$_FILES["file_path1"]["error"];
					}
					else
					{
						$fname=preg_replace("/\.[a-z]{3}$/i","",$_FILES["file_path1"]["name"]);
						$cnt=0;
						$fname1=$fname;
						$path="../data/";
						while(file_exists($path.$fname1.".".$_POST['data_type']))
						{
							$fname1=$fname.$cnt;
							$cnt++;
						}
						$fname=$path.$fname1.".".$_POST['data_type'];
						move_uploaded_file($_FILES["file_path1"]["tmp_name"],$fname);
					}
				}
			}
			else
				$error="&error=Data File required";
		}
	}
	if(isset($_POST['type']))
	{
		$i=0;
		foreach($_POST as $key=>$value)
		{			
			if($value!="")
			{
				if($i==0)
				$url="$key=$value";
				else
				$url.="&$key=$value";
				$i++;
			}
			else
			{
				if($key=="title")
				{
					$url.="&default_title=".$_POST['type'].' '.$_POST['dimension'].($_POST['direction']=='H'?' horizontal':'').($_POST['percent']!=""?' percent':'').($_POST['series_col']!=""?' multi-level':'');
				}
			}
		}
		if($fname!="")
			$url.="&file_path=$fname";
		$url=str_replace("#",'',$url);
	}
	else
	{
		$i=0;
		foreach($var_arr as $key=>$value)
		{
			if($value!="")
			{
				if($i==0)
				$url="$key='".$value."'";
				else
				$url.="&$key='".$value."'";
				$i++;
			}
		}
	}
	if($url!="")
		$url.=$error;	
	$url="../wizard/?$url";	
	header("location:$url");
?>