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