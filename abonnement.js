// JavaScript Document
function verif()
{
	c=document.getElementById("c").value
	s=document.selectedIndex("s")
	ds=document.getElementById("d").value
	a=ds.substring(0,4)
	m=ds.substring(5,8)
	j=ds.substring(8,ds.length)
	if(c.length!=8 ||c[0]!="0" ||c[0]!="1")
		{alert("cin incorrect")
			return false
		}
	if(s==0)
		{alert("selecter un choix")
			return false}
	if (!(ds[4]=="-" || ds[8]=="-" || ds.length==10))
		{alert("date incorrect") 
		 return false
		}
	else{return true}
								   
	
	
	
	
}