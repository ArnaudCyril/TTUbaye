<?php include("menu.php");
$nb=0;

if(isset($_POST["action"])&& $_POST["action"]=="Modifier")
        {
		
		//recup des varaibles 
        $cate=$_POST['inputCate'];
		$prix=$_POST['inputPrix'];
		$old=$_POST['inputOldcate'];
		


		$req10="update prixl set libelle='$cate' , prix='$prix' where libelle='$old';";

		$resultat10=mysql_query($req10);
		
        
        

		
        }

?>
<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
<title>Tarifs - Tennis de table Ubaye</title>
</head>
<body>
<div id="container">
<center><img src="./images/icones/tarif.png"  id="imgDebutPage"/><span id="titre"> Les Tarifs</span>

<br><h3>Liste des prix d'une licence Loisir</h3></center></br></br>
<div id="infoPrix">
<p style="font-weight:bold">Pour toute inscription fournir : </p>
<p>-Un certiicat médical</p>
<p>-Une photo</p>
<p>-Le règlement à l'ordre du TTUbaye</p>
</div><center>
<table id="membre" border="1" CELLPADDING="4" CELLSPACING="2" width=80% height=200>
<thead>
<tr>
		<th height=45 <?php if($nb%2==0):?>bgcolor='#b9c9fe'<?php else:?>bgcolor='#d3ddff'<?php endif?>>Catégorie</th>
		<th height=45 <?php if($nb%2==0):?>bgcolor='#b9c9fe'<?php else:?>bgcolor='#d3ddff'<?php endif?>>Prix</th>
		<?php $nb++; ?>
</tr>
</thead>
<tbody>
<?php 
if(isset($_SESSION['root']))
{ 
$req="select * from prixl order by rang;";
$res=mysql_query($req);
while($ligne=mysql_fetch_array($res))
{
	$categorie=$ligne['libelle'];
	$prix=$ligne['prix'];

?>
<tr>
		<form name="Modif" action="tarifL.php" method="POST">
		<input type="hidden" name="inputOldcate" value="<?php echo $categorie?>"/>
		<th height=45 <?php if($nb%2==0):?>bgcolor='#EBEBEB'<?php else:?>bgcolor='#D2E9FF'<?php endif?>><?php echo $categorie?></th>
		<th height=45 <?php if($nb%2==0):?>bgcolor='#EBEBEB'<?php else:?>bgcolor='#D2E9FF'<?php endif?>><input type="text" name="inputPrix" value="<?php echo $prix?>">€</th>
		<td height=45 <?php if($nb%2==0):?>bgcolor='#EBEBEB'<?php else:?>bgcolor='#D2E9FF'<?php endif?>><input type="submit" name="action" value="Modifier"/></td>
		<?php $nb++; ?>
		</form>
</tr>
<?php }

} 
else
{

$req="select * from prixl order by rang;";
$res=mysql_query($req);
while($ligne=mysql_fetch_array($res))
{
	$categorie=$ligne['libelle'];
	$prix=$ligne['prix'];
		$rang=$ligne['rang'];
	$txt=" : né en ";
	$date=date('Y');
	$mois=date('m'); if($mois>=8) { $date++; }
	
	switch ($rang) {
    case 1:
        $txt.=$date-9;
		$txt.=" et aprés";
        break;
    case 2:
        $txt.=$date-11; $txt.=" - " ; $txt.=$date-10;
        break;
    case 3:
	$txt.=$date-13; $txt.=" - " ; $txt.=$date-12;
		break;
	case 4:
         $txt.=$date-15; $txt.=" - " ; $txt.=$date-14;
        break; 
	case 5:
         $txt.=$date-18; $txt.=" - " ;$txt.=$date-17; $txt.=" - " ; $txt.=$date-16;
        break;   
	case 6:
         $txt=" né de ";$txt.=$date-40; $txt.=" - " ; $txt.=$date-19;
        break;  
	case 7:
         $txt.=$date-41;$txt.=" et avant";
        break;
}

?>
<tr>
		
		<th height=45 <?php if($nb%2==0):?>bgcolor='#d3ddff'<?php else:?>bgcolor='#d3ddff'<?php endif?>><?php echo $categorie.$txt?></th>
		<th height=45 <?php if($nb%2==0):?>bgcolor='#d3ddff'<?php else:?>bgcolor='#d3ddff'<?php endif?>><?php echo $prix?>€</th>

		<?php $nb++; ?>
		
</tr>
<?php }


}?>
</tbody>
</table>
<p>Pour tout renseignement : Mme Trens Sabine</p>
<p>Domicile : 04.92.81.29.32</p>
<p>Portable : 06.10.21.33.48</p>
</center>
		</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
		</body>
		</html>