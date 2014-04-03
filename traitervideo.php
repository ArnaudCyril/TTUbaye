<?php
include "parametres.php";


		$id=$_POST['id'];
		$videoname=$_POST['name'];
		//$id=200;
		//$videoname="titre";
		$maRequette="insert into tempvideo values('$videoname',$id);";
		$resultat=mysql_query($maRequette);

?>
