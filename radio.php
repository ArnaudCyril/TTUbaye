<?php include('menu.php');
?>


<html>
<body>
<form action="radio.php" method="post">

<?php
$nb=0;
 while($nb<5)
{
?>
<input type="hidden"  name="input<?php echo $nb ?>" value="<?php echo $nb ?>"/><!-- a remplacer par l id de la ligne hors forfait --> 
<input type="radio"  name="choix<?php echo $nb ?>" value="valider" checked /> Valider
<input type="radio"  name="choix<?php echo $nb ?>" value="supprimer" /> Supprimer 
<input type="radio"  name="choix<?php echo $nb ?>" value="report" /> Report <br>



<?php 
$nb++;
}
?>
<input type="submit" value="Calculer" name="action">
</form>
</body>
</html>
<?php
if(isset($_POST["action"])&& $_POST["action"]=="Calculer")
{
for($n=0;$n<5;$n++)// 2 => le nombre d input repetes
{

	
	if($_POST['choix'.$n]=='valider')//si le la valeur de l input du nom "choix.$n" vaut aller 
	{
	echo "La valeur : ";
	echo $_POST['input'.$n]; // la valeur de la valeur hidden correspondant
	echo " vaut : valider<br>";
	
	
	}
	if($_POST['choix'.$n]=='supprimer')
	{
	echo "La valeur : ";
	echo $_POST['input'.$n];
	echo " vaut : supprimer<br>";
	
	$req="delete from LigneFraisHorsForfait where id=$id";
	
	}
	if($_POST['choix'.$n]=='report')//si le la valeur de l input du nom "choix.$n" vaut aller 
	{
	echo "La valeur : ";
	echo $_POST['input'.$n]; // la valeur de la valeur hidden correspondant
	echo " vaut : report<br>";
	
	$req="update LigneFraisHorsForfait set mois=mois+1;
	
	}
}
}
?>