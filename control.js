// JavaScript Document
function verif()
{c=document.getElementById("c").value
 n=document.getElementById("n").value
 p=document.getElementById("p").value
 e=document.getElementById("e").value
 p=e.indexOf("@")
 p1=e.lastIndexOf("@")
 p2=e.indexOf(".")
 if(!len(c)==8)
	 {alert("erruer cin")
		 return false}
 else if(n=="" || p=="" || alpha(n.toUpperCase())==false || alpha(p.toUpperCase())==false )
	 {return false
	}
 else if(!(p==p1) || p>p2)
	 {return false}
 else
 {return true}
}
function alpha(ch)
{ 
ok=true
for(i=0;i<ch.length;i++)
	{
		if(!(ch[i]>="A" && ch[i]<="Z"))
			{ok=false}
	}
	return ok
}
