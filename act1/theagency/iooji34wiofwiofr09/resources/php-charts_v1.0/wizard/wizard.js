function changeDataType()
{
	var data_types={"array":"array","mysql":"db","PostgreSql":"db","MSAccess":"db","Oracle":"db","csv":"file","xml":"file"};
	if(last_sel!="")
	{
		if(last_sel=="array")
		{
			document.getElementById("col1_detail").style.display="none";
			document.getElementById("col2_detail").style.display="none";
			document.getElementById("col3_detail").style.display="none";
			document.wizard_frm.group_col.style.width="auto";
			document.wizard_frm.series_col.style.width="auto";
			document.wizard_frm.value_col.style.width="auto";
		}
		else
		document.getElementById(data_types[last_sel]+"_detail").style.display="none";
	}
	if(document.wizard_frm.data_type.value=="array")
	{
		document.getElementById("col1_detail").style.display="";
		document.getElementById("col2_detail").style.display="";
		document.getElementById("col3_detail").style.display="";
		document.wizard_frm.group_col.style.width="70%";
		document.wizard_frm.series_col.style.width="70%";
		document.wizard_frm.value_col.style.width="70%";
	}
	else
	document.getElementById(data_types[document.wizard_frm.data_type.value]+"_detail").style.display="";
	last_sel=document.wizard_frm.data_type.value;
}
function changeChart()
{
	var charts={"bar":"bar","pie":"pie","pie_explode":"pie","bar_mix":"bar","doughnut":"doughnut","doughnut_explode":"doughnut","line":"line","histogram":"histogram","min_max":"min_max","xy":"xy"};	
	var disp_field={"bar":["bar","bar_width","bar_gap","percent","increment","ymax_values"],"pie":["pie"],"doughnut":["pie","doughnut_width"],"line":["bar","line_gap","marker","percent","increment","ymax_values"],"histogram":["bar","bar_width","percent","increment","ymax_values"],"min_max":["bar","line_gap","percent","increment","ymax_values"],"xy":["xy","bar"]};
	if(last_sel_chart!="")
	{		
		var val_arr=disp_field[charts[last_sel_chart]];
		for(i=0;i<val_arr.length;i++)
		{
			document.getElementById(val_arr[i]).style.display="none";
		}
	}
	var val_arr=disp_field[charts[document.wizard_frm.type.value]];
	for(i=0;i<val_arr.length;i++)
	{
		document.getElementById(val_arr[i]).style.display="";
	}
	last_sel_chart=document.wizard_frm.type.value;
}
function hideBlock(header,block_id,obj)
{
	if(document.getElementById(block_id).style.display!="")
	{
		document.getElementById(block_id).style.display="";
		obj.innerHTML="- "+header;
	}
	else
	{
		document.getElementById(block_id).style.display="none";
		obj.innerHTML="+ "+header;
	}
}
function checkField()
{
	return true;
}