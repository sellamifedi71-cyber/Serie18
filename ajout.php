<?php
$cnx=mysqli_connect("localhost","root","","bdabon");
$c=$_GET["cin"];
$n=$_GET["nom"];
$p=$_GET["prenom"];
$a=$_GET["adresse"];
$e=$_GET["email"];
$req="select cin from abonne where '$c'='cin' ";
$res=mysqli_query($cnx,$req);
	if(mysqli_num_rows($res)>0)
	{
		echo("abonne deja existant");
	}
else
{$req1="insert into abonne values('$c','$n','$p','$a','$e')";
$res2=mysqli_query($cnx,$req1);
	if(mysqli_affected_rows($cnx)>0)
	{echo("ajout avec succes");}
}

	
?>