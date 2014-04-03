<?php 
header('Content-Type: text/html; charset=utf-8'); 

//$req="insert into creneau values(null,'été','lol',10,10)";
$req=utf8_decode($_POST['requette']);
$rep=mysql_query($req);
echo $req;
?>
