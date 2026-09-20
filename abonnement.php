<?php
$cnx=mysqli_connect("localhost","root","","bdabon");
$c=$_GET["cin"];
$t=$_GET["selection"];
$d=$_GET["d"];
$d1=date(Y_m_d);
$req="select cin from abonne where '$c'='cin' ";
$res=mysqli_query($cnx,$req);
if(mysqli_num_rows($res)=0)
{
	echo("abonne inexist");
}
else{
	$req1="insert into abonnement values ('$c','$t','$d','$d1')";
	$res1=mysqli_query($cnx,$req1);
	if(mysqli_affected_rows($cnx)>0)
	{
		echo("ajout avec succee");
	}
	
}