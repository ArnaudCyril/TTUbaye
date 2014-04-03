<?php
ob_start();
include ("menu.php");
if(isset($_SESSION['modif']))
{
unset($_SESSION['modif']);
}
if(isset($_SESSION['loginM']))
{
unset($_SESSION['loginM']);
}
if(isset($_SESSION['modif2']))
{
unset($_SESSION['modif2']);
}
if(isset($_SESSION['root']))
{
unset($_SESSION['root']);
}
if(empty($_SESSION['modif2']) and (empty($_SESSION['modif'])) and (empty($_SESSION['loginM'])) and (empty($_SESSION['modif2'])))
{
	?>
	<br><br><center><h2>Vous etes déconnecté</h2><?php
	header("location:".$_SERVER['HTTP_REFERER']);
	
}
ob_end_flush();
?>