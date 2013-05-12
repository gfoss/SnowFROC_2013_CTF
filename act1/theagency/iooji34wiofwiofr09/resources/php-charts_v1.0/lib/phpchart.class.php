<?php
	
	class PHPChart
	{
		public $type;
		public $dimension;
		public $data;
		public $series_col;
		public $group_col;
		public $value_col;
		public $bar_width;
		public $chart_thickness;
		public $radius;
		public $pie_gap;
		public $chart_width;
		public $chart_height;
		public $bg_color;
		public $ymax_value;
		public $bar_gap;
		public $line_gap;
		public $margin;
		public $legend_align;
		public $label;
		public $label_font_size;
		public $title_font_size;
		public $title;
		public $default_title;
		public $file_path;
		public $delimiter;
		public $data_type;
		public $percent;
		public $increment;
		public $username;
		public $password;
		public $database_name;
		public $server_name;
		public $query;
		public $output_type;
		public $header_height;
		public $marker;
		public $doughnut_width;
		public $axis_width;
		public $incrementx;
		public $incrementy;
		private $type_arr;
		private $error;
		private $maxg_len;
		private $maxs_len;
		private $series_col_arr=array();
		private $dseries_col_arr=array();
		private $im;
		private $font_ht;
		private $font_wd;
		public $txt_col;
		public $line_col;
		public $direction;
		
		private $group_arr=array();
		private $series_arr=array();
		private $value_arr=array();
		private $value_sum=array();

		var $data_type_arr=array("array","mysql","postgresql","msaccess","oracle","csv","xml");
		var $var_arr=array("bar_width","radius","chart_width","chart_height","ymax_value","bar_gap","margin","increment","label_font_size","header_height","chart_thickness","incrementx","incrementy");
		var $output_type_arr=array("jpg","jpeg","png","gif","pdf","html");
			
		public function __construct($type)
		{
			$this->error="";
			$this->type_arr=array("bar"=>20,"pie"=>100,"pie_explode"=>100,"bar_mix"=>20,"doughnut"=>100,"doughnut_explode"=>100,"min_max"=>10,"line"=>10,"histogram"=>20,"xy"=>10);
			$this->type=strtolower($type);
			if(!array_key_exists($this->type,$this->type_arr))
			{
				$this->error="Invalid chart type, must be one of the following: ".$this->type_arr;
				return;
			}
			$this->bar_width=$this->type_arr[$this->type];
			$this->radius=$this->type_arr[$this->type];
			$this->bar_gap=10;
			$this->margin=10;
			$this->legend_align='bottom';
			$this->display_label=false;
			$this->title="";			
			$this->increment=1;
			$this->output_type="html";
			$this->gap=10;
			$this->server_name="localhost";
			$this->username="";
			$this->password="";
			$this->dimension="2d";
			$this->chart_thickness=10;
			$this->pie_gap=20;
			$this->label_font_size=1;
			$this->bg_color=array(255,255,255);
			$this->txt_col=array(0,0,0);
			$this->line_col=array(0,0,0);
			$this->header_height=30;
			$this->direction="";
			$this->marker=false;
			$this->line_gap=20;
			$this->doughnut_width=20;
			$this->title_font_size=5;
			$this->axis_width=2;
			$this->incrementx=5;
			$this->incrementy=5;
		}
		
		function isValidDataType()
		{
			$this->data_type=strtolower($this->data_type);
			if(is_array($this->data))
				$this->data_type="array";			
			else if(!(in_array($this->data_type,$this->data_type_arr)))
				return "data_type must be one of the following: ".implode(",",$this->data_type_arr);
			$this->dimension=strtolower($this->dimension);
			if($this->dimension!="2d"&&$this->dimension!="3d")
				return "dimension value must be one of the following: 2d or 3d";
			foreach($this->var_arr as $v)
			{
				$this->val=eval('return $this->'.$v.';');
				if(!(is_null($this->val)||is_numeric($this->val)))
					return "$v must be number";
			}
			$this->legend_align=strtolower($this->legend_align);
			if(!($this->legend_align=="bottom"||$this->legend_align=="top"||$this->legend_align=="left"||$this->legend_align=="right"))
				return "Invalid legend_align";
			if(!is_bool($this->display_label))
				return "display_label must be boolean";
			//if(!is_null($this->file_path)&&!file_exists($this->file_path))
			//	return "file not found";
			$this->output_type=strtolower($this->output_type);
			if(!in_array($this->output_type,$this->output_type_arr))
				return "output_type value must be one of the following: ".implode(",",$this->output_type_arr);
			if($this->bg_color=="")
				$this->bg_color=array(255,255,255);
			else
				if(!($this->bg_color=$this->getHex($this->bg_color)))
					$this->bg_color=array(255,255,255);
			if($this->txt_col=="")
				$this->txt_col=array(0,0,0);
			else
				if(!($this->txt_col=$this->getHex($this->txt_col)))
					$this->txt_col=array(0,0,0);
			if($this->line_col=="")
				$this->line_col=array(0,0,0);
			else
				if(!($this->line_col=$this->getHex($this->line_col)))
					$this->line_col=array(0,0,0);
			$this->direction=strtoupper($this->direction);
			if($this->direction=="V"||$this->direction=="")
				$this->direction="";
			else if($this->direction=="H")
			{
				if(strpos($this->type,"bar")===false&&$this->type!="line"&&$this->type!="min_max"&&$this->type!="histogram"&&$this->type!="xy")
					$this->direction="";
			}
			else
				return "direction must be H(Horizontal), V(Vertical)";
			if($this->type=="doughnut"||$this->type=="doughnut_explode"||$this->type=="min_max")
				$this->dimension="2d";
			if($this->dimension=="2d")
			$this->chart_thickness=0;
			if($this->direction=="H"&&!$this->chart_width)
			$this->chart_width=200;
			else if(!$this->chart_height)
			$this->chart_height=200;
			$this->font_ht=imagefontheight($this->label_font_size);
			$this->font_wd=imagefontwidth($this->label_font_size);
			$this->maxg_len=0;
			$this->maxs_len=0;
			if(!$this->line_gap)
			$this->line_gap=20;
			if(imagefontheight($this->title_font_size)>$this->header_height)
			$this->header_height=imagefontheight($this->title_font_size);
			if($this->title=="")
				$this->title=$this->default_title;
			$this->group_col=trim($this->group_col);
			$this->series_col=trim($this->series_col);
			$this->value_col=trim($this->value_col);
		}
		function getHex($col)
		{
			if(is_array($col)&&count($col)==3)
				return $col;
			$col=str_replace("#","",$col);
			if(strlen($col)==6)				
				return array(hexdec($col[0].$col[1]),hexdec($col[2].$col[3]),hexdec($col[4].$col[5]));
			else if(strlen($col)==3)
				return array(hexdec($col[0].$col[0]),hexdec($col[1].$col[1]),hexdec($col[2].$col[2]));			
			else
				return false;
		}
		function array_data()
		{
			if(strpos($this->group_col,",")>0)
			{
				$tmp_arr=explode(":",$this->group_col);
				$this->group_col=$tmp_arr[0];				
				$gp_arr=explode(",",$tmp_arr[1]);
				if($this->series_col)
				{
					$tmp_arr=explode(":",$this->series_col);
					$this->series_col=$tmp_arr[0];
					$sr_arr=explode(",",$tmp_arr[1]);
				}
				if($this->value_col)
				{
					$tmp_arr=explode(":",$this->value_col);
					$this->value_col=$tmp_arr[0];					
					$tmp_arr=explode("|",$tmp_arr[1]);					
					$val_arr=array();
					if(count($tmp_arr)>1)
					{
						for($i=0;$i<count($tmp_arr);$i++)
							$val_arr[$i]=explode(",",$tmp_arr[$i]);
					}
					else
					{
						$val_arr=explode(",",$tmp_arr[0]);
					}
				}
				$c=0;
				if(isset($this->value_col)&&$this->value_col!="")
				{
					if(isset($this->series_col)&&$this->series_col!="")
					{
						for($i=0;$i<count($gp_arr);$i++)
						{
							for($j=0;$j<count($sr_arr);$j++)
							{
								if(isset($val_arr[$i][$j])&&$val_arr[$i][$j]!="")
								{
									$this->data[$c][$this->group_col]=$gp_arr[$i];
									$this->data[$c][$this->series_col]=$sr_arr[$j];
									$this->data[$c][$this->value_col]=$val_arr[$i][$j];
									$c++;
								}
							}
						}
					}
					else
					{
						for($i=0;$i<count($gp_arr);$i++)
						{
							if(isset($val_arr[$i]))
							{
								if(is_array($val_arr[$i]))
								{
									for($j=0;$j<count($val_arr[$i]);$j++)
									{
										if($val_arr[$i][$j]!="")
										{
											$this->data[$c][$this->group_col]=$gp_arr[$i];							
											$this->data[$c][$this->value_col]=$val_arr[$i][$j];
											$c++;
										}
									}
								}
								else
								{
									if($val_arr[$i]!="")
									{
										$this->data[$c][$this->group_col]=$gp_arr[$i];							
										$this->data[$c][$this->value_col]=$val_arr[$i];
										$c++;
									}
								}
							}
						}
					}
				}
				else
				{
					if(isset($this->series_col)&&$this->series_col!="")
					{
						for($i=0;$i<count($gp_arr);$i++)
						{
							for($j=0;$j<count($sr_arr);$j++)
							{								
								$this->data[$c][$this->group_col]=$gp_arr[$i];
								$this->data[$c][$this->series_col]=$sr_arr[$j];
								$c++;
							}
						}
					}
					else
					{
						for($i=0;$i<count($gp_arr);$i++)
						{
							$this->data[$c][$this->group_col]=$gp_arr[$i];
							$c++;
						}
					}
				}
				//print_r($this->data);
			}
		}
		
		function checkCredentials()
		{
			if($this->server_name=="")
				return "database server required";
			if($this->query=="")
				return "database query required";
			if($this->database_name=="")
				return "database database name required";
		}
		
		function mysql_data()
		{
			if(($this->error=$this->checkCredentials())!="")
				return $this->data_type." ".$this->error;
			if(!($con = mysql_connect($this->server_name, $this->username, $this->password)))
			return "Connection Failure to Database";
			mysql_select_db($this->database_name, $con);
			if(!($result = mysql_query($this->query)))
				return "Query Failed";
			$i=0;
			$this->data=array();
			while ($thisrow=mysql_fetch_assoc($result)) 
			{
				$this->data[$i]=array();
				foreach($thisrow as $key=>$value)
				$this->data[$i][$key]=$value;
				$i++;
			}
			mysql_close($con);
		}
		function oracle_data()
		{
			if(($this->error=$this->checkCredentials())!="")
				return $this->data_type." ".$this->error;
			if(!($con = oci_connect($this->username, $this->password,$this->server_name."/".$this->database_name)))
			{
				$e = oci_error();
				return $e['message'];
			}
			//return "Connection Failure to Database";
			$result = oci_parse($con,$this->query);
			if(!oci_execute($result))
				return "Query Failed";
			$i=0;
			$this->data=array();
			while($thisrow=oci_fetch_assoc($result)) 
			{
				$this->data[$i]=array();
				foreach($thisrow as $key=>$value)
				$this->data[$i][$key]=$value;
				$i++;
			}
			oci_close($con);
		}
		function postgresql_data()
		{
			if(($this->error=$this->checkCredentials())!="")
				return $this->data_type." ".$this->error;
			if(!($con = pg_connect("host=".$this->server_name." dbname=".$this->database_name." user=".$this->username." password=".$this->password)))
			return "Connection Failure to Database";
			if(!($result = pg_query($con,$this->query)))
				return "Query Failed";
			$i=0;
			$this->data=array();
			while ($thisrow=pg_fetch_assoc($result)) 
			{
				$this->data[$i]=array();
				foreach($thisrow as $key=>$value)
				$this->data[$i][$key]=$value;
				$i++;
			}
			pg_close($con);
		}
		function msaccess_data()
		{
			if(($this->error=$this->checkCredentials())!="")
				return $this->error;
			if(!($con = odbc_connect("DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".$this->database_name,$this->username, $this->password)))
			return odbc_errormsg( $conn );
			if(!($res = odbc_exec($con, $this->query)))
				return "Query Failed";
			$i=0;
			$this->data=array();
			$col=odbc_num_fields($res);
			for($f=1;$f<=$col;$f++)
				$key_arr[]=odbc_field_name($res,$f);
			while( $thisrow = odbc_fetch_array($res) )
			{
				$this->data[$i]=array();
				foreach($key_arr as $key)
					$this->data[$i][$key]=$thisrow[$key];
				$i++;
			}
			odbc_close($con);
		}
		
		function mssql_data()
		{
			if(($this->error=$this->checkCredentials())!="")
				return $this->error;
			// Connect to MSSQL and select the database
			if(!($con=mssql_connect($this->server_name, $this->username, $this->password)))
			return "Connection Failure to Database";
			mssql_select_db($this->database_name,$con);
			if(!($result=mssql_query($this->query,$con)))
				return 'MSSQL error: ' . mssql_get_last_message();


			$i=0;
			$this->data=array();
			while ($thisrow=mssql_fetch_assoc($result)) 
			{
				$this->data[$i]=array();
				foreach($thisrow as $key=>$value)
				$this->data[$i][$key]=$value;
				$i++;
			}
			mssql_close($con);
		}
		function csv_data()
		{
			if(!file_exists($this->file_path))
			{
				if(file_exists("../data/".$this->file_path))
				{
					$this->file_path="../data/".$this->file_path;
				}
				else
					return "file not found";
			}
			if (($handle = fopen($this->file_path, "r")) !== FALSE)
			{
				$i = 0;
				if(($thisrow = fgetcsv($handle,$this->delimiter)) !== FALSE)
					for($f=0;$f<count($thisrow);$f++)
						$key_arr[]=$thisrow[$f];
				$this->data=array();
				while (($thisrow = fgetcsv($handle,$this->delimiter)) !== FALSE)
				{
					$this->data[$i]=array();
					$j=0;
					foreach($key_arr as $key)
					{
						$this->data[$i][$key]=$thisrow[$j];
						$j++;
					}
					$i++;
				}
				fclose($handle);
			}
			else
				return "error while opening file";
		}
		function xml_data()
		{
			if(!file_exists($this->file_path))
			{
				if(file_exists("../data/".$this->file_path))
				{
					$this->file_path="../data/".$this->file_path;
				}
				else
					return "file not found";
			}
			if(($xml = simplexml_load_file($this->file_path))!==FALSE)
			{
				$i=0;
				$this->data=array();
				foreach($xml->children() as $child)
				{
					$this->data[$i]=array();
					foreach($child->children() as $child1)
						$this->data[$i][$child1->getName()]=(string)$child1;
					$i++;
				}
			}
			else
				return "error while loading file";
		}
		function key_in_array($col,$data)
		{
			if($col=="")
				return "";
			$col=strtolower($col);
			foreach($data as $key=>$value)
			{
				if(strtolower($key)==$col)
				{
					return $key;
				}
			}
			return "";
		}
		function formatData()
		{			
			if(!is_array($this->data))
				return "Provide proper data";
				
			$ismulti_arr=false;
			$this->group_col=$this->key_in_array($this->group_col,$this->data[0]);			
			if($this->group_col=="")
				return "group column name required";
			
			$this->series_col=$this->key_in_array($this->series_col,$this->data[0]);
			$this->value_col=$this->key_in_array($this->value_col,$this->data[0]);
			foreach($this->data as $key=>$value)
			{
				if(is_array($value))
				{
					if($this->group_col)
					{
						$this->group_arr[$value[$this->group_col]]=$key;
						if($this->direction=="H")
						{
							if($this->maxg_len<strlen($value[$this->group_col]))
								$this->maxg_len=strlen($value[$this->group_col]);
						}
						if(!$this->series_col)
						{
							if($this->maxs_len<strlen($value[$this->group_col]))
								$this->maxs_len=strlen($value[$this->group_col]);
						}
					}
					if($this->series_col)
					{
						$this->series_arr[$value[$this->series_col]]=$key;
						if($this->maxs_len<strlen($value[$this->series_col]))
							$this->maxs_len=strlen($value[$this->series_col]);
						$value_key=$value[$this->group_col]."_".$value[$this->series_col];
					}
					else
					{
						$this->series_arr[$value[$this->group_col]]=$key;
						$value_key=$value[$this->group_col]."_".$value[$this->group_col];
					}
					if($this->value_col)
						$val=$value[$this->value_col];
					else
						$val=1;
						
					if(array_key_exists($value[$this->group_col],$this->value_sum))
						$this->value_sum[$value[$this->group_col]]+=$val;
					else
						$this->value_sum[$value[$this->group_col]]=$val;
					if(array_key_exists($value_key,$this->value_arr))
						$this->value_arr[$value_key]+=$val;
					else
						$this->value_arr[$value_key]=$val;
					$ismulti_arr=true;
				}
				else
				{
					if($ismulti_arr)
						return "Provide proper data";
					$this->group_arr[$value]=$key;
					$this->series_arr[$value]=$key;
					$this->value_arr[$value."_".$value]++;
				}
			}
			if(!$this->ymax_value)
			{
				if($this->type=="bar_mix")
				$this->ymax_value=max($this->value_sum);
				else
				$this->ymax_value=max($this->value_arr);
				
			}
			if(count($this->group_arr)==0||count($this->value_arr)==0||count($this->series_arr)==0)
				return "Provide proper data";
			ksort($this->group_arr);
			if($this->series_col)
				ksort($this->series_arr);
		}
		function formatData2()
		{
			if(!is_array($this->data))
				return "Provide proper data";
			
			$this->group_col=$this->key_in_array($this->group_col,$this->data[0]);			
			if($this->group_col=="")
				return "group column name required";
			
			$this->series_col=$this->key_in_array($this->series_col,$this->data[0]);
			$this->value_col=$this->key_in_array($this->value_col,$this->data[0]);
			if($this->value_col=="")
				return "value column name required";
				
			$ismulti_arr=false;
			$min_max_val=array();
			foreach($this->data as $key=>$value)
			{
				if(is_array($value))
				{
					$this->group_arr[$value[$this->group_col]]=$key;
					if($this->direction=="H")
					{
						if($this->maxg_len<strlen($value[$this->group_col]))
							$this->maxg_len=strlen($value[$this->group_col]);
					}
					if(!$this->series_col)
					{
						if($this->maxs_len<strlen($value[$this->group_col]))
							$this->maxs_len=strlen($value[$this->group_col]);
					}
					if($this->series_col=="")
					{
						$this->series_arr[$value[$this->group_col]]=$key;
						$value_key=$value[$this->group_col]."_".$value[$this->group_col];
					}
					else
					{
						$this->series_arr[$value[$this->series_col]]=$key;
						if($this->maxs_len<strlen($value[$this->series_col]))
							$this->maxs_len=strlen($value[$this->series_col]);
						$value_key=$value[$this->group_col]."_".$value[$this->series_col];
					}
					if($this->value_col!="")
					{
						$val=$value[$this->value_col];
						if(!array_key_exists($value_key,$min_max_val))
							$min_max_val[$value_key]=array();
						array_push($min_max_val[$value_key],$val);
					}
				}
			}
			$mmax=0;
			foreach($this->group_arr as $ckey=>$cvalue)
			{
				foreach($this->series_arr as $xkey=>$xvalue)
				{
					if($this->series_col)
						$key=$ckey."_".$xkey;
					else
						$key=$ckey."_".$ckey;
					if(array_key_exists($key,$min_max_val))
					{
						$min=min($min_max_val[$key]);
						$max=max($min_max_val[$key]);
						$this->value_arr[$key."_min"]=$min;
						$this->value_arr[$key."_max"]=$max;
						if($max>$mmax)
							$mmax=$max;
					}
				}
			}
			if(!$this->ymax_value)
				$this->ymax_value=$mmax;
			if(count($this->group_arr)==0||count($this->value_arr)==0||count($this->series_arr)==0)			
				return "Provide proper data";
			
			ksort($this->group_arr);
			if($this->series_col)
				ksort($this->series_arr);
		}
		
		function formatData3()
		{
			if(!is_array($this->data))
				return "Provide proper data";
			
			$i=0;
			$this->group_col=$this->key_in_array($this->group_col,$this->data[0]);			
			if($this->group_col=="")
				return "group column name required";
			
			$this->series_col=$this->key_in_array($this->series_col,$this->data[0]);
			$this->value_col=$this->key_in_array($this->value_col,$this->data[0]);
			$this->maxg_len=1;
			if($this->value_col=="")
				return "value column name required";
			foreach($this->data as $key=>$value)
			{
				if(is_array($value))
				{
					$this->series_arr[$i]=array($value[$this->group_col],$value[$this->value_col]);
					if($value[$this->group_col]>$this->maxg_len)
						$this->maxg_len=$value[$this->group_col];
					if($value[$this->value_col]>$this->ymax_value)
						$this->ymax_value=$value[$this->value_col];
					$i++;
				}
			}
			if(count($this->series_arr)==0)
				return "Provide proper data";
			array_multisort($this->series_arr);
		}
		function prepareXYDesign($ix=0,$iy=1)
		{
			$this->dimension="grid";
			if(!$this->chart_width)
			$this->chart_width=300;
			if(!$this->chart_height)
			$this->chart_height=300;
			$legend_width=$legend_height=0;
			$this->layoutData($legend_width,$legend_height);
			list($x1,$y1,$ratiox,$ratioy)=$this->drawGrid($legend_width,$legend_height);
			$fl=false;
			$i=0;
			foreach($this->series_arr as $xy)
			{
				$x=$xy[$ix];
				$y=$xy[$iy];
				if(($val=$x%$this->incrementx)<=$this->incrementx/2)
					$x-=$val;
				else
					$x+=($this->incrementx-$val);
				if(($val=$y%$this->incrementy)<=$this->incrementy/2)
					$y-=$val;
				else
					$y+=($this->incrementy-$val);
				$cx=round($x*$ratiox);
				$cy=round($y*$ratioy);
				$dots[$i]=array($x1+$cx,$y1-$cy);				
				if($fl)
				imageline($this->im,$lx,$ly,$x1+$cx,$y1-$cy,$this->xyline_col);
				$lx=$x1+$cx;
				$ly=$y1-$cy;
				$fl=true;
				$i++;
			}
			$i=0;
			foreach($dots as $dot)
			{
				imagefilledellipse($this->im,$dot[0],$dot[1],6,6,$this->xydot_col);
				if($this->label)
				{
					$str="(".$this->series_arr[$i][0].",".$this->series_arr[$i][1].")";
					imagestring($this->im,$this->label_font_size,$dot[0]-strlen($str)*$this->font_wd/2,$dot[1]-$this->font_ht-2,$str,$this->txt_col);
				}
				$i++;
			}
			$this->chartOutput();
		}
		
		function prepareHXYDesign()
		{
			$tmp=$this->ymax_value;
			$this->ymax_value=$this->maxg_len;
			$this->maxg_len=$tmp;
			$tmp=$this->incrementx;
			$this->incrementx=$this->incrementy;
			$this->incrementy=$tmp;
			$tmp=$this->group_col;
			$this->group_col=$this->value_col;
			$this->value_col=$tmp;
			$this->prepareXYDesign(1,0);		
		}
		
		function prepareMinMaxDesign()
		{
			$this->dimension="2d";
			if($this->chart_width)
			{
				$group_width=($this->chart_width-($this->margin+$this->gap)*2-$this->chart_thickness)/count($this->group_arr)-$this->line_gap;
				if($this->series_col)
				$this->bar_width=$group_width/count($this->series_arr);
				else
				$this->bar_width=$group_width;
			}
			else
			{
				if($this->series_col)
				$group_width=count($this->series_arr)*$this->bar_width;
				else
				$group_width=$this->bar_width;
				$this->chart_width=($group_width+$this->line_gap)*count($this->group_arr)+($this->margin+$this->gap)*2+$this->chart_thickness;
			}
			$this->bar_height=$this->chart_height-($this->margin+$this->gap)*2-$this->header_height-$this->chart_thickness;
			$this->dot_width=$this->bar_width;
			if($this->dot_width>7)
				$this->dot_width=7;
			list($legend_width,$legend_height,$row_cnt,$col_cnt)=$this->getLegendSize();
			$this->layoutData($legend_width,$legend_height);
			list($x,$y)=$this->drawAxis($legend_width,$legend_height);
			imagesetthickness($this->im,3);
			$ratio=$this->drawVAxisValue($x,$y);
			$c=0;
			$x1=$x+=$this->line_gap/2;
			$y1=$y;
			foreach($this->group_arr as $ckey=>$cvalue)
			{
				$y=$y1;
				imagestring( $this->im,$this->label_font_size,$x+$group_width/2-strlen($ckey)*$this->font_wd/2,$y+$this->font_ht/2,$ckey,$this->txt_col);
				imagestring( $this->im,$this->label_font_size,$x+$group_width+($this->line_gap-$this->font_wd)/2,$y-$this->font_ht/4,"|",$this->txt_col);
				$c++;
				$b=0;
				$tval=0;
				foreach($this->series_arr as $xkey=>$xvalue)
				{
					if(array_key_exists($ckey."_".$xkey."_min",$this->value_arr))
					{
						$min_val=$this->value_arr[$ckey."_".$xkey."_min"];
						$max_val=$this->value_arr[$ckey."_".$xkey."_max"];
						$min_ht = ($min_val)* $ratio;
						$max_ht = ($max_val)* $ratio;
						if($this->dimension=="3d")
						{
							$dcol=$this->dseries_col_arr[$xkey];
							$dcolor=imagecolorallocate($this->im,$dcol[0],$dcol[1],$dcol[2]);
							for($i = $this->chart_thickness; $i > 0; $i--)
							{
								imageline($this->im,$x+$this->bar_width/2+$i,$y-$min_ht-$i,$x+$this->bar_width/2+$i,($y-$max_ht-$i),$dcolor);
								imagefilledellipse($this->im,$x+$this->bar_width/2+$i,$y-$min_ht-$i,$this->dot_width,$this->dot_width,$dcolor);
								imagefilledellipse($this->im,$x+$this->bar_width/2+$i,$y-$max_ht-$i,$this->dot_width,$this->dot_width,$dcolor);
							}
						}
						$col=$this->series_col_arr[$xkey];
						$color=imagecolorallocate($this->im,$col[0],$col[1],$col[2]);
						
						imageline($this->im,$x+$this->bar_width/2,$y-$min_ht,$x+$this->bar_width/2,($y-$max_ht),$color);
						imagefilledellipse($this->im,$x+$this->bar_width/2,$y-$min_ht,$this->dot_width,$this->dot_width,$color);
						imagefilledellipse($this->im,$x+$this->bar_width/2,$y-$max_ht,$this->dot_width,$this->dot_width,$color);
						$this->drawBarLabel($min_val,$x+$this->dot_width,$y+$this->dot_width/2,$min_ht);
						$this->drawBarLabel($max_val,$x+$this->dot_width,$y+$this->dot_width/2,$max_ht);
					}
					if($this->series_col)					
						$x+=$this->bar_width;
					else
					{
						if($ckey==$xkey)
							$x+=$this->bar_width;
					}
					$b++;
				}
				$x+=$this->line_gap;
			}			
			$this->drawLegend($col_cnt,$row_cnt,$legend_width,$legend_height);
			$this->chartOutput();
		}
		function prepareHMinMaxDesign()
		{
			$this->dimension="2d";
			if($this->chart_height)
			{
				$group_width=($this->chart_height-($this->margin+$this->gap)*2-$this->header_height-$this->chart_thickness)/count($this->group_arr)-$this->line_gap;
				if($this->series_col)
				$this->bar_width=$group_width/count($this->series_arr);
				else
				$this->bar_width=$group_width;
			}
			else
			{
				if($this->series_col)
				$group_width=count($this->series_arr)*$this->bar_width;
				else
				$group_width=$this->bar_width;
				$this->chart_height=($group_width+$this->line_gap)*count($this->group_arr)+$this->line_gap+($this->margin+$this->gap)*2+$this->header_height+$this->chart_thickness;
			}
			$this->bar_height=$this->chart_width-($this->margin+$this->gap)*2-$this->maxg_len*$this->font_wd-$this->chart_thickness;
			$this->dot_width=$this->bar_width;
			if($this->dot_width>7)
				$this->dot_width=7;
			list($legend_width,$legend_height,$row_cnt,$col_cnt)=$this->getLegendSize();
			$this->layoutData($legend_width,$legend_height);
			list($x,$y)=$this->drawAxis($legend_width,$legend_height);
			imagesetthickness($this->im,3);
			$ratio=$this->drawHAxisValue($x,$y);
			$c=0;
			$x1=$x;
			$y1=$y-=$this->line_gap/2;
			foreach($this->group_arr as $ckey=>$cvalue)
			{
				$x=$x1;
				imagestringup( $this->im,$this->label_font_size,$x-$this->font_ht-$this->axis_width*2,$y-($group_width-$this->font_wd*strlen($ckey))/2,$ckey,$this->txt_col);
				imagestring( $this->im,$this->label_font_size,$x-$this->font_wd/2,$y-$group_width-($this->font_ht+$this->line_gap)/2,"-",$this->txt_col);
				$c++;
				$b=0;
				$tval=0;
				foreach($this->series_arr as $xkey=>$xvalue)
				{
					if(array_key_exists($ckey."_".$xkey."_min",$this->value_arr))
					{
						$min_val=$this->value_arr[$ckey."_".$xkey."_min"];
						$max_val=$this->value_arr[$ckey."_".$xkey."_max"];
						$min_ht = ($min_val)* $ratio;
						$max_ht = ($max_val)* $ratio;						
						if($this->dimension=="3d")
						{
							$dcol=$this->dseries_col_arr[$xkey];
							$dcolor=imagecolorallocate($this->im,$dcol[0],$dcol[1],$dcol[2]);
							for ($i = $this->chart_thickness; $i > 0; $i--)
							{								
								imageline($this->im,$x+$min_ht+$i,$y-$this->bar_width/2-$i,$x+$max_ht+$i,$y-$this->bar_width/2-$i,$dcolor);
								imagefilledellipse($this->im,$x+$min_ht+$i,$y-$this->bar_width/2-$i,$this->dot_width,$this->dot_width,$dcolor);								
								imagefilledellipse($this->im,$x+$max_ht+$i,$y-$this->bar_width/2-$i,$this->dot_width,$this->dot_width,$dcolor);
							}	
						}
						$col=$this->series_col_arr[$xkey];
						$color=imagecolorallocate($this->im,$col[0],$col[1],$col[2]);
						imageline($this->im,$x+$min_ht,$y-$this->bar_width/2,$x+$max_ht,$y-$this->bar_width/2,$color);
						imagefilledellipse($this->im,$x+$min_ht,$y-$this->bar_width/2,$this->dot_width,$this->dot_width,$color);						
						imagefilledellipse($this->im,$x+$max_ht,$y-$this->bar_width/2,$this->dot_width,$this->dot_width,$color);
						$this->drawHBarLabel($min_val,$x-$this->dot_width,$y+$this->dot_width,$min_ht);
						$this->drawHBarLabel($max_val,$x-$this->dot_width,$y+$this->dot_width,$max_ht);
					}
					if($this->series_col)					
						$y-=$this->bar_width;
					else
					{
						if($ckey==$xkey)
							$y-=$this->bar_width;
					}
					$b++;
				}
				$y-=$this->line_gap;
			}			
			$this->drawLegend($col_cnt,$row_cnt,$legend_width,$legend_height);
			$this->chartOutput();
		}
		function drawGrid($legend_width,$legend_height)
		{
			$this->xyline_col=imagecolorallocate($this->im,rand(0,255),rand(0,255),rand(0,255));
			$this->xydot_col=imagecolorallocate($this->im,rand(0,255),rand(0,255),rand(0,255));
			$x=$this->margin+$this->gap+strlen((string)$this->ymax_value)*$this->font_wd;
			$x1=$this->chart_width-$this->margin-$legend_width-$this->gap;
			$y=$this->chart_height-$this->margin-$legend_height-$this->gap-$this->font_ht;
			$y1=$this->margin+$this->gap+$this->header_height-$this->axis_width;
			if(($val=$this->maxg_len%$this->incrementx)>0)
			$this->maxg_len+=$this->incrementx-$val;
			if(($val=$this->ymax_value%$this->incrementy)>0)
			$this->ymax_value+=$this->incrementy-$val;
			$ratiox=($x1-$x)/$this->maxg_len;
			$ratioy=($y-$y1)/$this->ymax_value;
			
			for($c=$this->incrementx;$c<=$this->maxg_len;$c+=$this->incrementx)
			{
				imageline($this->im,$x+$c*$ratiox,$y+5,$x+$c*$ratiox,$y1,$this->line_col);
				imagestring($this->im,$this->label_font_size,$x+$c*$ratiox-($this->font_wd*strlen("$c"))/2,$y+$this->font_ht,"$c",$this->txt_col);
			}
			for($r=$this->incrementy;$r<=$this->ymax_value;$r+=$this->incrementy)
			{
				imageline($this->im,$x-5,$y-$r*$ratioy,$x1,$y-$r*$ratioy,$this->line_col);
				imagestring($this->im,$this->label_font_size,$x-$this->font_wd*strlen("$r "),$y-$this->font_ht/2-$r*$ratioy,"$r ",$this->txt_col);
			}
			$ay=$this->font_ht*2+$this->margin/2;
			imagestring($this->im,$this->label_font_size,$x1-($x1-$x)/2-$this->font_wd*strlen($this->group_col)/2,$y+$ay-$this->font_ht/2,$this->group_col,$this->txt_col);
			//imageline($this->im,$x1-4,$y+$ay-4,$x1,$y+$ay,$this->line_col);
			//imageline($this->im,$x1-40,$y+$ay,$x1,$y+$ay,$this->line_col);
			//imageline($this->im,$x1-4,$y+$ay+4,$x1,$y+$ay,$this->line_col);
			
			$ax=$this->font_wd*(strlen($this->ymax_value)+1)+$this->margin/2;
			imagestringup($this->im,$this->label_font_size,$x-$ax-$this->font_ht/2,$y1+($y-$y1)/2+$this->font_wd*strlen($this->value_col)/2,$this->value_col,$this->txt_col);
			//imagestringup($this->im,$this->label_font_size,$x-$ax-$this->font_ht/2,$y1+45+$this->font_wd*strlen($this->ymax_value),$this->value_col,$this->txt_col);			
			//imageline($this->im,$x-$ax,$y1,$x-$ax+4,$y1+4,$this->line_col);
			//imageline($this->im,$x-$ax,$y1+40,$x-$ax,$y1,$this->line_col);
			//imageline($this->im,$x-$ax,$y1,$x-$ax-4,$y1+4,$this->line_col);
			
			imagesetthickness($this->im, $this->axis_width);
			imageline($this->im,$x,$y,$x,$y1,$this->line_col);
			imagestring($this->im,$this->label_font_size,$x-$this->font_wd/2,$y+$this->font_ht,"0",$this->txt_col);
			imageline($this->im,$x,$y,$x1,$y,$this->line_col);
			imagestring($this->im,$this->label_font_size,$x-$this->font_wd*strlen("0 "),$y-$this->font_ht/2,"0",$this->txt_col);
			
			return array($x,$y,$ratiox,$ratioy);
		}
		
		function prepareLineDesign()
		{
			if($this->chart_width)
			{
				$group_width=($this->chart_width-($this->margin+$this->gap)*2-$this->chart_thickness)/count($this->group_arr);
			}
			else
			{
				$group_width=$this->line_gap*2;
				$this->chart_width=$group_width*count($this->group_arr)+($this->margin+$this->gap)*2+$this->chart_thickness;
			}
			$this->bar_height=$this->chart_height-($this->margin+$this->gap)*2-$this->header_height-$this->chart_thickness;
			
			list($legend_width,$legend_height,$row_cnt,$col_cnt)=$this->getLegendSize();
			
			$this->layoutData($legend_width,$legend_height);			
			if($this->series_col)
			$scount=count($this->series_arr);
			else
			$scount=1;
			list($x,$y)=$this->drawAxis($legend_width,$legend_height);
			$this->chart_thickness/=$scount;
			$ratio=$this->drawVAxisValue($x,$y);
			$c=0;
			$x1=$x+=$group_width/2;
			$y1=$y;
			foreach($this->series_arr as $xkey=>$xvalue)
			{
				$y=$y1;
				$x=$x1;
				$c++;
				$b=0;
				$tval=0;
				$dcol=$this->dseries_col_arr[$xkey];
				$dcolor=imagecolorallocate($this->im,$dcol[0],$dcol[1],$dcol[2]);
				$col=$this->series_col_arr[$xkey];
				$color=imagecolorallocate($this->im,$col[0],$col[1],$col[2]);
				foreach($this->group_arr as $ckey=>$cvalue)
				{
					if(!$this->series_col)
						$xkey=$ckey;
					if($c==1)
					{
						imagestring( $this->im,$this->label_font_size,$x,$y+$this->font_ht/2,$ckey,$this->txt_col);
						imagestring( $this->im,$this->label_font_size,$x+$group_width/2-$this->font_wd/2,$y-$this->font_ht/4,"|",$this->txt_col);
					}
					if(array_key_exists($ckey."_".$xkey,$this->value_arr))
					{
						$val=$this->value_arr[$ckey."_".$xkey];
						$y_ht = ($val)* $ratio;
						if($b==0)
						{
							$x2=$x;
							$y2=$y-$y_ht;
						}
						else
						{
							$i=0;
							if($this->dimension=="3d")
							{
								for ($i = $this->chart_thickness*($scount-($c-1)); $i > $this->chart_thickness*($scount-$c); $i--)
									imageline($this->im,$x2+$i,$y2-$i,$x+$i,($y-$y_ht)-$i,$dcolor);
							}
							//if($this->series_col)
							imageline($this->im,$x2+$i,$y2-$i,$x+$i,($y-$y_ht)-$i,$color);						
							$x2=$x;
							$y2=$y-$y_ht;
						}
						if($this->marker)
						imagefilledellipse($this->im,$x2+$this->chart_thickness*($scount-$c),$y2-$this->chart_thickness*($scount-$c),5,5,$color);
						$this->drawBarLabel($val,$x2,$y,$y_ht);
					}
					$x+=$group_width;
					$b++;
				}
				if(!$this->series_col)
					break;
			}
			if($this->series_col)
			$this->drawLegend($col_cnt,$row_cnt,$legend_width,$legend_height);
			$this->chartOutput();
		}
		function prepareHLineDesign()
		{
			if($this->chart_height)
			{
				$group_width=($this->chart_height-($this->margin+$this->gap)*2-$this->header_height-$this->chart_thickness)/count($this->group_arr);
			}
			else
			{
				$group_width=$this->line_gap*2;
				$this->chart_height=$group_width*count($this->group_arr)+($this->margin+$this->gap)*2+$this->header_height+$this->chart_thickness;
			}
			$this->bar_height=$this->chart_width-($this->margin+$this->gap)*2-$this->maxg_len*$this->font_wd-$this->chart_thickness;
			
			list($legend_width,$legend_height,$row_cnt,$col_cnt)=$this->getLegendSize();
			
			$this->layoutData($legend_width,$legend_height);			
			if($this->series_col)
			$scount=count($this->series_arr);
			else
			$scount=1;
			list($x,$y)=$this->drawAxis($legend_width,$legend_height);
			$this->chart_thickness/=$scount;
			$ratio=$this->drawHAxisValue($x,$y);
			$c=0;
			$x1=$x;
			$y1=$y-=$group_width/2;
			foreach($this->series_arr as $xkey=>$xvalue)
			{
				$y=$y1;
				$x=$x1;
				$c++;
				$b=0;
				$tval=0;
				$dcol=$this->dseries_col_arr[$xkey];
				$dcolor=imagecolorallocate($this->im,$dcol[0],$dcol[1],$dcol[2]);
				$col=$this->series_col_arr[$xkey];
				$color=imagecolorallocate($this->im,$col[0],$col[1],$col[2]);
				foreach($this->group_arr as $ckey=>$cvalue)
				{
					if(!$this->series_col)
						$xkey=$ckey;
					if($c==1)
					{
						imagestringup($this->im,$this->label_font_size,$x-$this->font_ht-$this->axis_width*2,$y+$this->font_wd*strlen($ckey)/2,$ckey,$this->txt_col);
						imagestring($this->im,$this->label_font_size,$x-$this->font_wd/2,$y-$this->font_ht/2-$group_width/2,"-",$this->txt_col);
					}
					if(array_key_exists($ckey."_".$xkey,$this->value_arr))
					{						
						$val=$this->value_arr[$ckey."_".$xkey];
						$x_ht = ($val)* $ratio;
						if($b==0)
						{
							$x2=$x+$x_ht;
							$y2=$y;
						}
						else
						{
							$i=0;
							if($this->dimension=="3d")
							{
								for ($i = $this->chart_thickness*($scount-($c-1)); $i > $this->chart_thickness*($scount-$c); $i--)
									imageline($this->im,$x2+$i,$y2-$i,$x+$x_ht+$i,$y-$i,$dcolor);
							}
							//if($this->series_col)
							imageline($this->im,$x2+$i,$y2-$i,$x+$x_ht+$i,$y-$i,$color);
						
							$x2=$x+$x_ht;
							$y2=$y;
						}
						if($this->marker)
						imagefilledellipse($this->im,$x2+$this->chart_thickness*($scount-$c),$y2-$this->chart_thickness*($scount-$c),5,5,$color);
						$this->drawBarLabel($val,$x2,$y,$x_ht);
					}					
					$y-=$group_width;
					$b++;
				}
				if(!$this->series_col)
					break;
			}
			if($this->series_col)
			$this->drawLegend($col_cnt,$row_cnt,$legend_width,$legend_height);
			$this->chartOutput();
		}
		function prepareDoughnutDesign()
		{
			if($this->type!="doughnut_explode"||$this->series_col)
			$this->pie_gap=0;
			$this->chart_width=($this->radius+$this->margin+$this->gap+$this->pie_gap)*2;
			$this->chart_height=($this->radius+$this->margin+$this->gap+$this->pie_gap)*2;
			$centerx=$this->chart_width/2;
			$centery=$this->chart_height/2;
			$this->pie_gap/=2;
			list($legend_width,$legend_height,$row_cnt,$col_cnt)=$this->getLegendSize();
			$this->layoutData($legend_width,$legend_height);
			
			if($this->legend_align=="left")
			$centerx+=$legend_width;
			if($this->legend_align=="top")
			$centery+=$legend_height;
			$tot=array_sum($this->value_arr);
			
			$e_an=0;
			$ht=$wd=$this->radius*2;
			$mx=$my=0;
			if($this->series_col)
			{				
				if(($this->doughnut_width*count($this->group_arr))>$this->radius)
					$this->doughnut_width=$this->radius/count($this->group_arr);
				foreach($this->group_arr as $ckey=>$cvalue)
				{
					$gp_sum[$ckey]=0;

					foreach($this->series_arr as $xkey=>$xvalue)
					{
						if(array_key_exists($ckey."_".$xkey,$this->value_arr))
						{
							$gp_sum[$ckey]+=$this->value_arr[$ckey."_".$xkey];
						}
					}
				}
				foreach($this->group_arr as $ckey=>$cvalue)
				{
					$e_an=0;
					foreach($this->series_arr as $xkey=>$xvalue)
					{
						if(array_key_exists($ckey."_".$xkey,$this->value_arr))
						{
							$val=$this->value_arr[$ckey."_".$xkey];
							$an=$val/$gp_sum[$ckey]*360;
							$s_an=$e_an;
							$e_an=$e_an+$an;

							/*if($this->type=="doughnut_explode")
							{
								$r_an=deg2rad(360-($s_an+$an/2));
								$mx=$this->pie_gap*cos($r_an);
								$my=$this->pie_gap*sin($r_an);
							}*/
							$col=$this->series_col_arr[$xkey];
							$this->drawArc($centerx+$mx, $centery-$my, $wd, $ht, $s_an, $e_an,$col);
							$this->drawArc($centerx+$mx, $centery-$my, $wd-$this->doughnut_width*2+2, $ht-$this->doughnut_width*2+2,$s_an-2, $e_an+2,$this->bg_color);
							
							if($this->label)
							{
								$r_an=deg2rad(360-($s_an+$an/2));
								$mx1=($wd-$this->doughnut_width+$this->pie_gap)/2*cos($r_an);
								$my1=($ht-$this->doughnut_width+$this->pie_gap)/2*sin($r_an);								
								list($mx1,$my1)=$this->align2label($mx1,$my1,$val);
								imagestring($this->im,$this->label_font_size,$centerx+$mx1,$centery+$my1,$val,$this->txt_col);
							}
						}
					}
					$wd-=$this->doughnut_width*2;
					$ht-=$this->doughnut_width*2;
				}
				$this->drawArc($centerx, $centery, $wd, $ht,0, 360,$this->bg_color);
			}
			else
			{
				$wd1=($wd-$this->doughnut_width)/2;
				$ht1=($ht-$this->doughnut_width)/2;
				foreach($this->group_arr as $ckey=>$cvalue)
				{
					$val=$this->value_arr[$ckey."_".$ckey];
					$an=$val/$tot*360;

					$s_an=$e_an;
					$e_an=$e_an+$an;
					if($this->type=="doughnut_explode")
					{
						$r_an=deg2rad(360-($s_an+$an/2));
						$mx=$this->pie_gap*cos($r_an);
						$my=$this->pie_gap*sin($r_an);
					}
					$col=$this->series_col_arr[$ckey];
					$this->drawArc($centerx+$mx, $centery+$my, $wd, $ht, $s_an, $e_an,$col);
					$this->drawArc($centerx+$mx, $centery+$my, $wd-$this->doughnut_width*2, $ht-$this->doughnut_width*2,$s_an-2, $e_an+2,$this->bg_color);
					
					if($this->label)
					{
						$r_an=deg2rad(360-($s_an+$an/2));
						$mx1=($wd1+$this->pie_gap)*cos($r_an);
						$my1=($ht1+$this->pie_gap)*sin($r_an);
						list($mx1,$my1)=$this->align2label($mx1,$my1,$val);
						imagestring( $this->im,$this->label_font_size,$centerx+$mx1,$centery+$my1,$val,$this->txt_col);
					}
				}
				$this->drawArc($centerx, $centery, $wd-$this->doughnut_width*2, $ht-$this->doughnut_width*2,0, 360,$this->bg_color);
			}
			$this->drawLegend($col_cnt,$row_cnt,$legend_width,$legend_height);
			$this->chartOutput();
		}
		
		function preparePieDesign()
		{
			if($this->type!="pie_explode")
				$this->pie_gap=0;
			$this->chart_width=($this->radius+$this->margin+$this->gap)*2+$this->pie_gap;
			$this->chart_height=($this->radius+$this->margin+$this->gap)*2+$this->pie_gap;
			$this->pie_gap/=2;
			if(imagefontheight($this->title_font_size)>$this->header_height)
			$this->chart_height+=imagefontheight($this->title_font_size);
			else
			$this->chart_height+=$this->header_height;
			
			$centerx=$this->chart_width/2;
			$centery=$this->chart_height/2;
			
			list($legend_width,$legend_height,$row_cnt,$col_cnt)=$this->getLegendSize();
			$this->layoutData($legend_width,$legend_height);
			
			if($this->legend_align=="left")
			$centerx+=$legend_width;
			if($this->legend_align=="top")
			$centery+=$legend_height;
			$tot=array_sum($this->value_arr);
			
			$e_an=0;
			$ht=$wd=$this->radius*2;
			$mx=$my=0;
			if($this->series_col)
			{
				$group_total=array();
				foreach($this->group_arr as $ckey=>$cvalue)
				{
					$group_tot[$ckey]=0;
					$r=rand(0,125);
					$g=rand(0,125);
					$b=rand(0,125);
					$dgroup_col_arr[$ckey]=array($r,$g,$b);
					$group_col_arr[$ckey]=array($r+125,$g+125,$b+125);
					foreach($this->series_arr as $xkey=>$xvalue)
					{
						if(array_key_exists($ckey."_".$xkey,$this->value_arr))
							$group_total[$ckey]+=$this->value_arr[$ckey."_".$xkey];
					}
				}
				if($this->dimension=="3d")
				{
					$ht=$this->radius;
					for ($i = $this->chart_thickness; $i > 0; $i--)
					{
						$s_an=$e_an=0;
						$gps_an=$gpe_an=0;
						foreach($this->group_arr as $ckey=>$cvalue)
						{
							$j=0;
							foreach($this->series_arr as $xkey=>$xvalue)
							{
								if(array_key_exists($ckey."_".$xkey,$this->value_arr))
								{
									$an=$this->value_arr[$ckey."_".$xkey]/$tot*360;
									$s_an=$e_an;
									$e_an=$e_an+$an;
									if($j==0&&$this->type=="pie_explode")
									{
										$gp_an=$group_total[$ckey]/$tot*360;
										$r_an=deg2rad(360-($s_an+$gp_an/2));
										$mx=$this->pie_gap*cos($r_an);
										$my=$this->pie_gap*sin($r_an);
									}
									$dcol=$this->dseries_col_arr[$xkey];
									$this->drawArc($centerx+$mx, $centery+$my+$i, $wd, $ht, $s_an, $e_an,$dcol);
									$j++;
								}
							}
							
							if($this->type=="pie_explode")
							{
								$gps_an=$gpe_an;
								$gpe_an=$gpe_an+$gp_an;
								$dgpcol=$dgroup_col_arr[$ckey];
								$this->drawArc($centerx+$mx, $centery+$my+$i, $wd/2, $ht/2, $gps_an, $gpe_an,$dgpcol);
							}
						}
					}
				}
				$s_an=$e_an=0;
				$i=0;
				$mx=$my=0;
				$wd1=5*$wd/12;
				$ht1=5*$ht/12;
				foreach($this->group_arr as $ckey=>$cvalue)
				{
					$i=0;
					foreach($this->series_arr as $xkey=>$xvalue)
					{
						if(array_key_exists($ckey."_".$xkey,$this->value_arr))
						{
							$val=$this->value_arr[$ckey."_".$xkey];
							$an=$val/$tot*360;
							$s_an=$e_an;
							$e_an=$e_an+$an;
							
							if($i==0&&$this->type=="pie_explode")
							{
								$an1=$group_total[$ckey]/$tot*360;
								$r_an=deg2rad(360-($s_an+$an1/2));
								$mx=$this->pie_gap*cos($r_an);
								$my=$this->pie_gap*sin($r_an);
							}
							$col=$this->series_col_arr[$xkey];
							$this->drawArc($centerx+$mx, $centery+$my, $wd, $ht, $s_an, $e_an,$col);
							$i++;
							if($this->label)
							{
								$r_an=deg2rad(360-($s_an+$an/2));
								$mx1=$wd1*cos($r_an);
								$my1=$ht1*sin($r_an);
								list($mx1,$my1)=$this->align2label($mx+$mx1,$my+$my1,$val);
								
								imagestring( $this->im,$this->label_font_size,$centerx+$mx1,$centery+$my1,$val,$this->txt_col);
							}
						}
					}
				}
				$e_an=0;
				$wd=$wd/2;
				$ht=$ht/2;
				$mx=$my=0;
				$i=0;
				$wd1=$wd/4;
				$ht1=$ht/4;
				foreach($this->group_arr as $ckey=>$cvalue)
				{
					$an=$group_total[$ckey]/$tot*360;
					$gpcol=$group_col_arr[$ckey];					
					$s_an=$e_an;
					$e_an=$e_an+$an;
					if($this->type=="pie_explode")
					{
						$r_an=deg2rad(360-($s_an+$an/2));
						$mx=$this->pie_gap*cos($r_an);
						$my=$this->pie_gap*sin($r_an);
					}
					$this->drawArc($centerx+$mx, $centery+$my, $wd, $ht, $s_an, $e_an,$gpcol);
					if($this->label)
					{
						$r_an=deg2rad(360-($s_an+$an/2));
						$mx1=$wd1*cos($r_an);
						$my1=$ht1*sin($r_an);
						list($mx1,$my1)=$this->align2label($mx1+$mx,$my1+$my,$ckey);
						imagestring( $this->im,$this->label_font_size,$centerx+$mx1,$centery+$my1,$ckey,$this->txt_col);
					}
				}
			}
			else
			{
				if($this->dimension=="3d")
				{
					$ht=$this->radius;
					for ($i = $this->chart_thickness; $i > 0; $i--)
					{
						$e_an=0;
						foreach($this->group_arr as $ckey=>$cvalue)
						{
							$an=$this->value_arr[$ckey."_".$ckey]/$tot*360;
							$s_an=$e_an;
							$e_an=$e_an+$an;
							if($this->type=="pie_explode")
							{
								$r_an=deg2rad(360-($s_an+$an/2));
								$mx=$this->pie_gap*cos($r_an);
								$my=$this->pie_gap*sin($r_an);
							}
							$dcol=$this->dseries_col_arr[$ckey];
							$this->drawArc($centerx+$mx, $centery+$my+$i, $wd, $ht, $s_an, $e_an,$dcol);
						}
					}
				}
				$e_an=0;
				
				foreach($this->group_arr as $ckey=>$cvalue)
				{
					$val=$this->value_arr[$ckey."_".$ckey];
					$an=$val/$tot*360;
					$col=$this->series_col_arr[$ckey];
					$s_an=$e_an;
					$e_an=$e_an+$an;
					if($this->type=="pie_explode")
					{
						$r_an=deg2rad(360-($s_an+$an/2));
						$mx=$this->pie_gap*cos($r_an);
						$my=$this->pie_gap*sin($r_an);
					}
					$this->drawArc($centerx+$mx, $centery+$my, $wd, $ht, $s_an, $e_an,$col);
				}
				if($this->label)
				{
					$wd1=$wd/3;
					$ht1=$ht/3;
					$e_an=0;
					foreach($this->group_arr as $ckey=>$cvalue)
					{
						$val=$this->value_arr[$ckey."_".$ckey];
						$an=$val/$tot*360;
						$s_an=$e_an;
						$e_an=$e_an+$an;
						$r_an=deg2rad(360-($s_an+$an/2));
						$mx=($this->pie_gap+$wd1)*cos($r_an);
						$my=($this->pie_gap+$ht1)*sin($r_an);
						list($mx,$my)=$this->align2label($mx,$my,$val);
						imagestring( $this->im,$this->label_font_size,$centerx+$mx,$centery+$my,$val,$this->txt_col);
					}
				}
			}
			$this->drawLegend($col_cnt,$row_cnt,$legend_width,$legend_height);
			$this->chartOutput();
		}
		
		function align2label($mx,$my,$str)
		{
			if($mx<0)
			$mx=$mx-strlen($str)*$this->font_wd/2;
			else
			$mx=$mx+strlen($str)*$this->font_wd/2;
			if($my<0)
			$my=$my-$this->font_ht/2;
			else
			$my=$my-$this->font_ht/2;
			return array($mx,$my);
		}
		
		function prepareBarDesign()
		{
			if($this->chart_width)
			{
				$group_width=($this->chart_width-($this->margin+$this->gap)*2-$this->chart_thickness)/count($this->group_arr)-$this->bar_gap;
				if($this->series_col&&$this->type!="bar_mix")
				$this->bar_width=$group_width/count($this->series_arr);
				else
				$this->bar_width=$group_width;
			}
			else
			{
				if($this->series_col&&$this->type!="bar_mix")
				$group_width=count($this->series_arr)*$this->bar_width;
				else
				$group_width=$this->bar_width;
				$this->chart_width=($group_width+$this->bar_gap)*count($this->group_arr)+($this->margin+$this->gap)*2+$this->chart_thickness;
			}
			if(imagefontheight($this->title_font_size)>$this->header_height)
			$this->header_height=imagefontheight($this->title_font_size);
			
			$this->bar_height=$this->chart_height-($this->margin+$this->gap)*2-$this->header_height-$this->chart_thickness;
			
			list($legend_width,$legend_height,$row_cnt,$col_cnt)=$this->getLegendSize();
			
			$this->layoutData($legend_width,$legend_height);
			
			list($x,$y)=$this->drawAxis($legend_width,$legend_height);
			$ratio=$this->drawVAxisValue($x,$y);
			
			$c=0;
			$x1=$x+=$this->bar_gap/2;
			if($this->dimension=="3d")
			$x1=$x+=$this->axis_width/2;
			$y1=$y;
			foreach($this->group_arr as $ckey=>$cvalue)
			{
				$y=$y1;
				imagestring( $this->im,$this->label_font_size,$x+$group_width/2-strlen($ckey)*$this->font_wd/2,$y+$this->axis_width*2,$ckey,$this->txt_col);
				imagestring( $this->im,$this->label_font_size,$x+$group_width+$this->bar_gap/2-$this->font_wd/2,$y+$this->axis_width-$this->font_ht/2,"|",$this->txt_col);
				$c++;
				$b=0;
				$tval=0;
				foreach($this->series_arr as $xkey=>$xvalue)
				{
					if(array_key_exists($ckey."_".$xkey,$this->value_arr))
					{
						$val=$this->value_arr[$ckey."_".$xkey];
						$y_ht = ($val)* $ratio;
						if($this->dimension=="3d")
						{
							$dcol=$this->dseries_col_arr[$xkey];
							$dcolor=imagecolorallocate($this->im,$dcol[0],$dcol[1],$dcol[2]);
							for ($i = $this->chart_thickness; $i > 0; $i--)
								imagefilledrectangle($this->im,$x+$i,$y-$i,$x+$this->bar_width-1+$i,($y-$y_ht)-$i,$dcolor);
						}
						$col=$this->series_col_arr[$xkey];
						$color=imagecolorallocate($this->im,$col[0],$col[1],$col[2]);
						imagefilledrectangle($this->im,$x,$y,$x+$this->bar_width-1,($y-$y_ht),$color);
						if($this->type=="bar_mix")
						{
							$y-=$y_ht;
							$tval+=$val;
						}
						else
							$this->drawBarLabel($val,$x,$y,$y_ht);
					}
					if($this->type!="bar_mix")
					{
						if($this->series_col)					
						$x+=$this->bar_width;
						else
						{
							if($ckey==$xkey)
							$x+=$this->bar_width;
						}
					}
					
					$b++;
				}
				if($this->type=="bar_mix")
				{
					$this->drawBarLabel($tval,$x,$y+$y_ht,$y_ht);
					$x+=$this->bar_gap+$this->bar_width;
				}
				else
				$x+=$this->bar_gap;
			}			
			$this->drawLegend($col_cnt,$row_cnt,$legend_width,$legend_height);
			$this->chartOutput();
		}
		
		function prepareHBarDesign()
		{
			if($this->chart_height)
			{
				$group_width=($this->chart_height-($this->margin+$this->gap)*2-$this->header_height-$this->chart_thickness)/count($this->group_arr)-$this->bar_gap;
				if($this->series_col&&$this->type!="bar_mix")
				$this->bar_width=$group_width/count($this->series_arr);
				else
				$this->bar_width=$group_width;
			}
			else
			{
				if($this->series_col&&$this->type!="bar_mix")
				$group_width=count($this->series_arr)*$this->bar_width;
				else
				$group_width=$this->bar_width;
				$this->chart_height=($group_width+$this->bar_gap)*count($this->group_arr)+($this->margin+$this->gap)*2+$this->header_height+$this->chart_thickness;
			}
			$this->bar_height=$this->chart_width-($this->margin+$this->gap)*2-$this->chart_thickness-$this->maxg_len*$this->font_wd;
			
			list($legend_width,$legend_height,$row_cnt,$col_cnt)=$this->getLegendSize();
			
			$this->layoutData($legend_width,$legend_height);
			
			list($x,$y)=$this->drawAxis($legend_width,$legend_height);
			$ratio=$this->drawHAxisValue($x,$y);
			
			$c=0;
			$x1=$x;
			if($this->dimension=="3d")
			$x1=$x+=$this->axis_width/2;
			$y1=$y-=$this->bar_gap/2;
			foreach($this->group_arr as $ckey=>$cvalue)
			{
				$x=$x1;
				imagestringup( $this->im,$this->label_font_size,$x-$this->font_ht-$this->axis_width*2,$y-($group_width-$this->font_wd*strlen($ckey))/2,$ckey,$this->txt_col);
				imagestring( $this->im,$this->label_font_size,$x-$this->font_wd/2,$y-$group_width-($this->font_ht+$this->bar_gap)/2,"-",$this->txt_col);
				$c++;
				$b=0;
				$tval=0;
				foreach($this->series_arr as $xkey=>$xvalue)
				{
					if(array_key_exists($ckey."_".$xkey,$this->value_arr))
					{
						$val=$this->value_arr[$ckey."_".$xkey];
						$x_ht = ($val)* $ratio;
						if($this->dimension=="3d")
						{
							$dcol=$this->dseries_col_arr[$xkey];
							$dcolor=imagecolorallocate($this->im,$dcol[0],$dcol[1],$dcol[2]);
							for ($i = $this->chart_thickness; $i > 0; $i--)
								imagefilledrectangle($this->im,$x+$i,$y-$i,$x+$x_ht+$i,$y-$this->bar_width+1-$i,$dcolor);
						}
						$col=$this->series_col_arr[$xkey];
						$color=imagecolorallocate($this->im,$col[0],$col[1],$col[2]);
						imagefilledrectangle($this->im,$x,$y,$x+$x_ht,$y-$this->bar_width+1,$color);
						if($this->type=="bar_mix")
						{
							$x+=$x_ht;
							$tval+=$val;
						}
						else
							$this->drawHBarLabel($val,$x,$y,$x_ht);
					}
					if($this->type!="bar_mix")
					{
						if($this->series_col)					
						$y-=$this->bar_width;
						else
						{
							if($ckey==$xkey)
							$y-=$this->bar_width;
						}
					}
					
					$b++;
				}
				if($this->type=="bar_mix")
				{
					$this->drawHBarLabel($tval,$x-$x_ht,$y,$x_ht);
					$y-=$this->bar_gap+$this->bar_width;
				}
				else
				$y-=$this->bar_gap;
			}			
			$this->drawLegend($col_cnt,$row_cnt,$legend_width,$legend_height);
			$this->chartOutput();
		}
		function drawHBarLabel($val,$x,$y,$x_ht)
		{
			if($this->label)
			{
				$y+=$this->axis_width/2;
				if($this->percent)
				$lb=round(($val/$this->ymax_value)*$this->percent);
				else
				$lb=$val;
				imagestring( $this->im,$this->label_font_size,$x+$x_ht+$this->chart_thickness+$this->font_wd,$y-($this->bar_width+$this->font_ht)/2-$this->chart_thickness,$lb,$this->txt_col);
			}
		}
		function drawBarLabel($val,$x,$y,$y_ht)
		{
			if($this->label)
			{
				if($this->percent)
				$lb=round(($val/$this->ymax_value)*$this->percent);
				else
				$lb=$val;
				imagestring( $this->im,$this->label_font_size,$x+$this->bar_width/2-(strlen($lb)/2*$this->font_wd)+$this->chart_thickness,($y-$y_ht-$this->font_ht-$this->chart_thickness),$lb,$this->txt_col);
			}
		}
		
		function drawArc($cx,$cy,$w,$h,$start,$stop,$color)
		{
			$start=deg2rad($start);
			$stop=deg2rad($stop);
			$fillColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],0);
			$w/=2;
			$h/=2;
			$cdx=$w*cos(M_PI/4);
			$cdy=$h*sin(M_PI/4);
			$xstart=$w*cos($start);
			$ystart=$h*sin($start);
			$xstop=$w*cos(min(M_PI,$stop));
			$ystop=$h*sin(min(M_PI,$stop));
			if($start<M_PI/2)
			{
				$yy=0;
				for($x=0;$x<=$xstart;$x+=1)
				{
					if($x<$xstop)
						$y1=$x/$xstop*$ystop;
					else
						$y1=$h*sqrt(1-pow($x,2)/pow($w,2));
					$y2=$x/$xstart*$ystart;
					$d1=$y1-floor($y1);
					$d2=$y2-floor($y2);
					$y1=floor($y1);
					$y2=floor($y2);
					imageline($this->im,$cx+$x,$cy-$y1,$cx+$x,$cy-$y2,$fillColor);
					$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],100-$d1*100);
					imagesetpixel($this->im,$cx+$x,$cy-$y1-1,$diffColor);
					$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],$d2*100);
					imagesetpixel($this->im,$cx+$x,$cy-$y2+1,$diffColor);
					for($yy;$yy<=$y1;$yy+=1)
					{
						if($yy<$ystart)
							$x1=$yy/$ystart*$xstart;
						else
							$x1=$w*sqrt(1-pow($yy,2)/pow($h,2));
						$d1=$x1-floor($x1);
						$x1=floor($x1);
						$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],100-$d1*100);
						imagesetpixel($this->im,$cx+$x1+1,$cy-$yy,$diffColor);
						if($stop<M_PI/2)
						{
							$x2=$yy/$ystop*$xstop;
							$d2=$x2-floor($x2);
							$x2=floor($x2);
							$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],$d2*100);
							imagesetpixel($this->im,$cx+$x2,$cy-$yy,$diffColor);
						}
					}
				}
			}
			if($start<M_PI && $stop>M_PI/2)
			{
				$yy=0;
				for($x=0;$x>=$xstop;$x-=1)
				{
					if($x>$xstart)
						$y1=$x/$xstart*$ystart;
					else
						$y1=$h*sqrt(1-pow($x,2)/pow($w,2));
					$y2=$x/$xstop*$ystop;
					$d1=$y1-floor($y1);
					$d2=$y2-floor($y2);
					$y1=floor($y1);
					$y2=floor($y2);
					imageline($this->im,$cx+$x,$cy-$y1,$cx+$x,$cy-$y2,$fillColor);			
					$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],100-$d1*100);
					imagesetpixel($this->im,$cx+$x,$cy-$y1-1,$diffColor);
					$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],$d2*100);
					imagesetpixel($this->im,$cx+$x,$cy-$y2+1,$diffColor);
					for($yy;$yy<=$y1;$yy+=1)
					{
						if($yy<$ystop)
							$x1=-$yy/$ystop*$xstop;
						else
							$x1=$w*sqrt(1-pow($yy,2)/pow($h,2));
						$d1=$x1-floor($x1);
						$x1=floor($x1);
						$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],100-$d1*100);
						imagesetpixel($this->im,$cx-$x1-1,$cy-$yy,$diffColor);
						if($start>M_PI/2)
						{
							$x2=$yy/$ystart*$xstart;
							$d2=$x2-floor($x2);
							$x2=floor($x2);
							$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],$d2*100);
							imagesetpixel($this->im,$cx+$x2,$cy-$yy,$diffColor);
						}
					}
				}
			}
			
			$xstart=$w*cos(max(M_PI,$start));
			$ystart=$h*sin(max(M_PI,$start));
			$xstop=$w*cos($stop);
			$ystop=$h*sin($stop);
			if($start<3*M_PI/2 && $stop>M_PI)
			{
				$yy=0;
				for($x=0;$x>=$xstart;$x-=1)
				{
					if($x>$xstop)
						$y1=$x/$xstop*$ystop;
					else
						$y1=-$h*sqrt(1-pow($x,2)/pow($w,2));
					$y2=$x/$xstart*$ystart;
					$d1=$y1-floor($y1);
					$d2=$y2-floor($y2);
					$y1=floor($y1);
					$y2=floor($y2);
					imageline($this->im,$cx+$x,$cy-$y1,$cx+$x,$cy-$y2,$fillColor);			
					$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],$d1*100);
					imagesetpixel($this->im,$cx+$x,$cy-$y1+1,$diffColor);
					$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],100-$d2*100);
					imagesetpixel($this->im,$cx+$x,$cy-$y2-1,$diffColor);
					for($yy;$yy>=$y1;$yy-=1)
					{
						if($yy>$ystart)
							$x1=-$yy/$ystart*$xstart;
						else
							$x1=$w*sqrt(1-pow($yy,2)/pow($h,2));
						$d1=$x1-floor($x1);
						$x1=floor($x1);
						$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],100-$d1*100);
						imagesetpixel($this->im,$cx-$x1-1,$cy-$yy,$diffColor);
						if($stop<3*M_PI/2)
						{
							$x2=$yy/$ystop*$xstop;
							$d2=$x2-floor($x2);
							$x2=floor($x2);
							$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],100-$d2*100);
							imagesetpixel($this->im,$cx+$x2+1,$cy-$yy,$diffColor);
						}
					}
				}
			}
			if($start<2*M_PI && $stop>3*M_PI/2)
			{
				$yy=0;
				for($x=0;$x<=$xstop;$x+=1)
				{
					if($x<$xstart)
						$y1=$x/$xstart*$ystart;
					else
						$y1=-$h*sqrt(1-pow($x,2)/pow($w,2));
					$y2=$x/$xstop*$ystop;
					$d1=$y1-floor($y1);
					$d2=$y2-floor($y2);
					$y1=floor($y1);
					$y2=floor($y2);
					imageline($this->im,$cx+$x,$cy-$y1,$cx+$x,$cy-$y2,$fillColor);			
					$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],$d1*100);
					imagesetpixel($this->im,$cx+$x,$cy-$y1+1,$diffColor);
					$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],100-$d2*100);
					imagesetpixel($this->im,$cx+$x,$cy-$y2-1,$diffColor);
					for($yy;$yy>=$y1;$yy-=1)
					{
						if($yy>$ystop)
							$x1=$yy/$ystop*$xstop;
						else
							$x1=$w*sqrt(1-pow($yy,2)/pow($h,2));
						$d1=$x1-floor($x1);
						$x1=floor($x1);
						$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],100-$d1*100);
						imagesetpixel($this->im,$cx+$x1+1,$cy-$yy,$diffColor);
						if($start>3*M_PI/2)
						{
							$x2=$yy/$ystart*$xstart;
							$d2=$x2-floor($x2);
							$x2=floor($x2);
							$diffColor=imagecolorexactalpha($this->im,$color[0],$color[1],$color[2],$d2*100);
							imagesetpixel($this->im,$cx+$x2,$cy-$yy,$diffColor);
						}
					}
				}
			}
		}
		
		function drawAxis($legend_width,$legend_height)
		{
			$x=$this->margin+$this->gap+$this->maxg_len*$this->font_wd;
			$x1=$this->chart_width-$this->margin-$legend_width-$this->gap+$this->axis_width/2-$this->chart_thickness;
			if($this->legend_align=="left")
			{
				$x+=$legend_width;
				$x1+=$legend_width;
			}
			$y=$this->chart_height-$this->margin-$legend_height-$this->gap;
			$y1=$this->margin+$this->gap-$this->axis_width+$this->header_height+$this->chart_thickness;
			if($this->legend_align=="top")
			{		
				$y+=$legend_height;
				$y1+=$legend_height;
			}
			imagesetthickness($this->im, $this->axis_width);
			if($this->dimension=="2d")
			{
				imageline($this->im, $x, $y, $x, $y1, $this->line_col);
				imageline($this->im, $x, $y, $x1, $y, $this->line_col);
			}
			else
			{
				imagefilledpolygon($this->im,array($x+$this->chart_thickness+$this->axis_width,$y-$this->chart_thickness,$x1+$this->chart_thickness,$y-$this->chart_thickness,$x1,$y,$x,$y,$x,$y1,$x+$this->chart_thickness+$this->axis_width,$y1-$this->chart_thickness-$this->axis_width),6,$this->line_col);
			}
			$y-=$this->axis_width;
			$x+=$this->axis_width/2;
			imagesetthickness($this->im, 1);			
			return array($x,$y);
		}
		
		function drawVAxisValue($x,$y)
		{
			if($this->percent)
			{
				$ratio=$this->bar_height/$this->ymax_value;
				$ratio1=$this->bar_height/$this->percent;
				if($this->increment*$ratio1<=$this->font_ht*1.5)
					$this->increment=round($this->font_ht*1.5/$ratio1);
				for($i=0;$i<=$this->percent;$i+=$this->increment)
				{
					$v=round($i*$ratio1);
					imagestring( $this->im,$this->label_font_size,$x-((strlen($i))*$this->font_wd)-$this->axis_width*(3/2),$y-$v-$this->font_ht/2,$i."-",$this->txt_col);
				}
			}
			else
			{
				if($this->ymax_value==""||$this->ymax_value==0)
				$this->ymax_value=$this->bar_height;
				$ratio=$this->bar_height/$this->ymax_value;				
				if($this->increment*$ratio<=$this->font_ht*1.5)
					$this->increment=round($this->font_ht*1.5/$ratio);
				if($this->ymax_value%$this->increment!=0)
				{				
					$this->ymax_value+=$this->increment-$this->ymax_value%$this->increment;
					$ratio=$this->bar_height/$this->ymax_value;
				}
				for($i=0;$i<=$this->ymax_value;$i+=$this->increment)
				{
					$v=round($i*$ratio);
					imagestring( $this->im,$this->label_font_size,$x-((strlen($i))*$this->font_wd)-$this->axis_width*(3/2),$y-$v-$this->font_ht/2,$i."-",$this->txt_col);
				}
			}
			return $ratio;
		}
		
		function drawHAxisValue($x,$y)
		{
			if($this->percent)
			{
				$ratio=$this->bar_height/$this->ymax_value;
				$ratio1=$this->bar_height/$this->percent;
				$max_len=$this->font_wd*(strlen($this->percent)+0.5);
				if($this->increment*$ratio1<=$max_len)
				$this->increment=round($max_len/$ratio1);
				for($i=0;$i<=$this->percent;$i+=$this->increment)
				{
					$v=round($i*$ratio1);
					imagestring( $this->im,$this->label_font_size,$x+$v-($this->font_wd-$this->axis_width)/2,$y-$this->font_ht/4,"|",$this->txt_col);
					imagestring( $this->im,$this->label_font_size,$x+$v-(strlen($i)*$this->font_wd-$this->axis_width)/2,$y+$this->font_ht,$i,$this->txt_col);
				}
			}
			else
			{
				if($this->ymax_value==""||$this->ymax_value==0)
				$this->ymax_value=$this->bar_height;
				$ratio=$this->bar_height/$this->ymax_value;
				$max_len=$this->font_wd*(strlen($this->ymax_value)+0.5);
				if($this->increment*$ratio<=$max_len)
				$this->increment=round($max_len/$ratio);
				if($this->ymax_value%$this->increment!=0)
				{				
					$this->ymax_value+=$this->increment-$this->ymax_value%$this->increment;
					$ratio=$this->bar_height/$this->ymax_value;
				}
				for($i=0;$i<=$this->ymax_value;$i+=$this->increment)
				{
					$v=round($i*$ratio);
					imagestring( $this->im,$this->label_font_size,$x+$v-($this->font_wd-$this->axis_width)/2,$y-$this->font_ht/4,"|",$this->txt_col);
					imagestring( $this->im,$this->label_font_size,$x+$v-($this->font_wd*strlen($i)-$this->axis_width)/2,$y+$this->font_ht,$i,$this->txt_col);
				}
			}
			return $ratio;
		}
		
		function layoutData($legend_width,$legend_height)
		{
			$this->chart_width+=$legend_width;
			$this->chart_height+=$legend_height;
			$this->im = imagecreatetruecolor($this->chart_width,$this->chart_height); 
			$this->txt_col = imagecolorallocate($this->im,$this->txt_col[0],$this->txt_col[1],$this->txt_col[2]);
			$this->line_col= imagecolorallocate($this->im,$this->line_col[0],$this->line_col[1],$this->line_col[2]);
			$bg_color=imagecolorallocate($this->im,$this->bg_color[0],$this->bg_color[1],$this->bg_color[2]);
			imagefilledrectangle($this->im,0,0,$this->chart_width,$this->chart_height,$bg_color);
			if($this->dimension=="2d")
			{
				foreach($this->series_arr as $xkey=>$xvalue)
					$this->series_col_arr[$xkey]=array(rand(0,255),rand(0,255),rand(0,255));
			}
			else if($this->dimension=="3d")
			{
				foreach($this->series_arr as $xkey=>$xvalue)
				{
					$r=mt_rand(0,125);
					$g=mt_rand(0,125);
					$b=mt_rand(0,125);
					$this->dseries_col_arr[$xkey]=array($r,$g,$b);
					$this->series_col_arr[$xkey]=array($r+125,$g+125,$b+125);
				}
			}
			$title_font_wd=imagefontwidth($this->title_font_size);//$this->title_font_size*3;//imagefontwidth($this->title_font_size);
			$title_len=(strlen($this->title))*$title_font_wd;
			$title=$this->title;
			if($title_len>$this->chart_width)
			{
				$title_char=strlen($this->title)-ceil(($title_len-$this->chart_width)/$title_font_wd)-3;
				$title=substr($title,0,$title_char)."...";
			}
			$font_name="fonts/CALIBRI.TTF";
			//imagettftext($this->im,$title_font_wd*2,0,($this->chart_width-(strlen($title)*$title_font_wd))/2,$title_font_wd*2,$this->txt_col,$font_name,$title);
			imagestring( $this->im,$this->title_font_size,($this->chart_width-(strlen($title)*$title_font_wd))/2,0,$title,$this->txt_col);
		}
		function drawLegend($col_cnt,$row_cnt,$legend_width,$legend_height)
		{
			$x=$this->margin;
			if($this->legend_align=="right")
				$x=$this->chart_width-$this->margin-$legend_width;
			$x1=$x;
			$y=$this->margin+$this->gap;
			if($this->legend_align=="bottom")
				$y=$this->chart_height-$legend_height-$this->margin+$this->gap;
			$r=$c=0;
			foreach($this->series_col_arr as $str=>$col)
			{
				$color=imagecolorallocate($this->im,$col[0],$col[1],$col[2]);
				imagefilledrectangle($this->im,$x,$y,$x+5,$y+5,$color);
				imagestring($this->im,$this->label_font_size,$x+$this->font_wd+$this->gap/2,$y-$this->font_ht/4,$str,$this->txt_col);
				$x+=$this->maxs_len;
				$c++;
				if($c==$col_cnt)
				{
					$c=0;
					$r++;
					$y+=$this->font_ht+$this->gap;
					$x=$x1;
					if($r==$row_cnt)
						break;
				}
			}
		}
		function getLegendSize()
		{
			$legend_height=0;
			$legend_width=0;
			if($this->legend_align=="top"||$this->legend_align=="bottom")
			{
				$tot_legend_len=count($this->series_arr)*($this->maxs_len*$this->font_wd+$this->gap*2+5);
				$row_cnt=1;
				while($tot_legend_len>($this->chart_width-$this->margin*2))
				{
					$tot_legend_len=$tot_legend_len/2;
					$row_cnt++;
				}
				$col_cnt=round(count($this->series_arr)/$row_cnt);
				$legend_height=$row_cnt*($this->font_ht+$this->gap)+$this->gap;
				
			}
			else
			{
				$tot_legend_ht=count($this->series_arr)*($this->font_ht+$this->gap);
				$col_cnt=1;
				while($tot_legend_ht>($this->chart_height-$this->margin*2))
				{
					$tot_legend_ht=$tot_legend_ht/2;
					$col_cnt++;
				}
				$row_cnt=round(count($this->series_arr)/$col_cnt);
				$legend_width=$col_cnt*($this->font_wd+$this->gap)+$this->gap;
			}
			if($col_cnt==0)
			$col_cnt=1;
			$this->maxs_len=($this->chart_width-$this->margin*2)/$col_cnt;
			return array($legend_width,$legend_height,$row_cnt,$col_cnt);
		}
		function chartOutput()
		{
			$img_name=uniqid("img_");
			$dir="../tmp/";
			switch($this->output_type)
			{
				case "jpg":
				case "jpeg":
		//		header('Content-type: image/jpeg');				
			//	imagejpeg($this->im);
				imagejpeg($this->im,"$dir$img_name.jpg");
				echo "<a href='$dir$img_name.jpg' >Chart</a>";
				break;
				case "png":
				//header('Content-type: image/png');
				//imagepng($this->im);
				imagepng($this->im,"$dir$img_name.png");				
				echo "<a href='$dir$img_name.png' >Chart</a>";
				break;
				case "gif":			
				//header('Content-type: image/gif');
				//imagegif($this->im);				
				imagegif($this->im,"$dir$img_name.gif");
				echo "<a href='$dir$img_name.gif' >Chart</a>";
				break;
				case "html":
				header('Content-type: image/png');
				imagepng($this->im);
				break;
				case "pdf":
				imagepng($this->im,"$dir$img_name.png");
				$this->createPDF("$dir$img_name");
				break;
			}
			imagedestroy($this->im);
		}
		
		public function createPDF($fname)
		{
			$pdf = pdf_new();
			pdf_open_file($pdf,'');
			$image = pdf_load_image($pdf,"png",$fname,"");
			$w = pdf_get_value($pdf, "imagewidth", $image);
			$h = pdf_get_value($pdf, "imageheight", $image);
			pdf_begin_page($pdf,$w*2,$h*2);
			pdf_place_image($pdf,$image,$w/2,$h/2,1);
			pdf_end_page($pdf); 
			pdf_close($pdf);
			$mybuf = PDF_get_buffer($pdf);
			$mylen = strlen($mybuf);
			header("Content-type: application/pdf");
			header("Content-Length: $mylen");
			header("Content-Disposition: inline; filename=chart.pdf");
			print $mybuf;
			PDF_delete($pdf);
			unlink($fname);
		}
		public function genChart()
		{			
			if($this->error!="")
			return;
			if(($this->error=$this->isValidDataType())!="")
			{
				echo $this->error;
				return;
			}	
			
			if(($this->error=call_user_func(array(&$this,$this->data_type.'_data')))!="")
			{
				echo $this->error;
				return;
			}
			if($this->type=="min_max")
			{
				if(($this->error=$this->formatData2())!="")
				{
					echo $this->error;
					return;
				}
			}
			else if($this->type=="xy")
			{
				if(($this->error=$this->formatData3())!="")
				{
					echo $this->error;
					return;
				}
			}
			else
			{
				if(($this->error=$this->formatData())!="")
				{
					echo $this->error;
					return;
				}

			}
			if(strpos($this->type,"bar")!==false)
				$chart="Bar";
			else if(strpos($this->type,"pie")!==false)
				$chart="Pie";
			else if(strpos($this->type,"doughnut")!==false)
				$chart="Doughnut";
			else if(strpos($this->type,"line")!==false)
				$chart="Line";
			else if(strpos($this->type,"histogram")!==false)
			{
				$this->bar_gap=0;
				$chart="Bar";
			}
			else if($this->type=="min_max")
				$chart="MinMax";
			else if($this->type=="xy")
				$chart="XY";
			if(($this->error=call_user_func(array(&$this,'prepare'.$this->direction.$chart.'Design')))!="")
			{
				echo $this->error;
				return;
			}	
		}
	}
?>