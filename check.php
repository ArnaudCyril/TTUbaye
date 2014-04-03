<?php include("menu.php");?>
<form action="check.php" method="post">
  lISTE :
  <?php $nb=0;
 while($nb<3)
{ ?>
    <input type="checkbox" name="leNom<?php echo $nb ?>" value="Choix <?php echo $nb ?>" />Choix <?php echo $nb ?>
   
<?php $nb++;
}
?>
 <input type="submit" name="formSubmit" value="Submit" />
</form>
<?php
 for($n=0;$n<3;$n++)
{
if(isset($_POST['leNom'.$n])) 
{
	echo "choix no ".$n." = ";
    echo "On a choisi le choix".$n;
	echo "<br>";
}    
 }
?>