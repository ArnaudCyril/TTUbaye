<?php 
include("menu.php");
?>
<html>
<head>
	<title>Membres - Tennis de table Ubaye</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
	
</head>
<body>
<div id="container">
	<center><img src="./images/icones/membre.png" id="imgDebutPage"/><span id="titre"> Membres(site)</span><br><br>
        <div id="hide_mobile"><a href="membres.php" id="optionNav">Vue du site</a>
                <a href="membres2.php" id="optionNav">Vue FFTT</a></div>
		<br><br><br><br>
	</center>
	<div id="ranger">
	<form name="ranger" action="membres.php#membre" method="POST">
Ranger par : 
<select name="ranger2" id="dropdown">
<option value="nom" <?php if(isset($_POST["ranger2"]) and $_POST["ranger2"]=="nom") { ?> selected="selected" <?php } ?> >Nom</option>
<option value="ptEnCours" <?php if(isset($_POST["ranger2"]) and $_POST["ranger2"]=="ptEnCours") { ?> selected="selected" <?php } ?> >Points licence</option>
<option value="ptsActuels" <?php if(isset($_POST["ranger2"]) and $_POST["ranger2"]=="ptsActuels") { ?> selected="selected" <?php } ?>  >Points mensuels</option>

</select>
<input type="submit" name="ranger" value="Envoyer"/ id="submitButton"> 
<?php if(isset($_SESSION['root']) and $_SESSION['root']=="cyril")
{ ?>
<a href="misaj.php" id="submitButton">Mise a jour<a/>
<?php } ?>
</div>
<center>
	<table id="membre" border="1" CELLPADDING="4" CELLSPACING="2" width=80% height=60 style="border-color:#ddd;color:#222">

		<thead>	
			<tr><!-- ligne des titres de colonnes-->
				<th bgcolor='#b9c9fe'>Nom</th>
				<th bgcolor='#b9c9fe'>Prenom</th>
				<th bgcolor='#b9c9fe'>N° Licence</th>
				<th bgcolor='#b9c9fe'>Classement</th>
				<th bgcolor='#b9c9fe'>Points licence(1)</th>
				<th bgcolor='#b9c9fe'>Point mensuels(2)</th>
				<th bgcolor='#b9c9fe'>Categorie</th>
			</tr>
		</thead>
		<tbody>
<?php
// affichage des couleurs qui existent dans la table

$choix="nom";
if(isset($_POST["ranger2"]))
{
$choix=$_POST["ranger2"];
}
	$nb=0;
	if($choix=="nom" or $choix=="categorie" or $choix=="licence")
	{
	$requete="select * from membres order by $choix,prenom;";
	}
	else
	{
	$requete="select * from membres order by $choix desc , ptEnCours desc;";
	}
	
// execution de la requette
	$resultat=mysql_query($requete);
//tt que on peut tirer une ligne du résultat
	while($maLigne=mysql_fetch_array($resultat))
	{
		//maLigne est un tableau associatif correspond a 1 couleur
		$nom=$maLigne['nom'];
		$prenom=$maLigne['prenom'];
		$licence=$maLigne['licence'];
		$class=$maLigne['classement'];
		$ptsc=$maLigne['ptEnCours'];
		$ptsa=$maLigne['ptsActuels'];
		$cate=$maLigne['categorie'];
		//remplir le tableau avec la ligne correspondat a la couleur
	?>
		<tr>
			<th height=45 <?php if($nb%2==0):?>bgcolor='#d3ddff'<?php else:?>bgcolor='#d3ddff'<?php endif?>><?php echo $nom?></th>
			<th <?php if($nb%2==0):?>bgcolor='#d3ddff'<?php else:?>bgcolor='#d3ddff'<?php endif?>><?php echo $prenom?></th>
			<th <?php if($nb%2==0):?>bgcolor='#d3ddff'<?php else:?>bgcolor='#d3ddff'<?php endif?>><?php echo $licence?></th>
			<th <?php if($nb%2==0):?>bgcolor='#d3ddff'<?php else:?>bgcolor='#d3ddff'<?php endif?>><?php echo $class?></th>
			<th <?php if($nb%2==0):?>bgcolor='#d3ddff'<?php else:?>bgcolor='#d3ddff'<?php endif?>><?php echo $ptsc?></th>
			<th <?php if($nb%2==0):?>bgcolor='#d3ddff'<?php else:?>bgcolor='#d3ddff'<?php endif?>><?php echo $ptsa?></th>
			<th <?php if($nb%2==0):?>bgcolor='#d3ddff'<?php else:?>bgcolor='#d3ddff'<?php endif?>><?php echo $cate?></th>
			<?php $nb++; ?>
		</tr>
	<?php
	}
?>
</tbody>
</table>
<p>(1) : Les points licence sont les points qui figurent actuellement sur votre licence</p>
	<p>(2) : Les points mensuels sont les points virtuels que vous avez selon la mise a jour mensuelle</p>
	
	</center>
	</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
	</body>
</html>
<?php ob_end_flush(); ?>