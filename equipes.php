<?php include("menu.php");
?>
<html>
<head>
<title>Les Equipes - Tennis de table Ubaye</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
</head>
	<body>
	<div id="container">
	<center><img src="./images/icones/equipe.png"  id="imgDebutPage"/>
	<span id="titre"> Les Equipes</span>
	<br><br><br><br>
	<h3 id="news">Le TTUBAYE comporte 4 équipes : deux régionale 2 , une départementale 1 et une departementale 3.Il dispose aussi d'une section jeune. </h3><br>

	<h3><a href="resultatsR2.php">La regionale 2 - Equipe 1</a></h3>

	
	<table id="membre" border="1" CELLPADDING="4" CELLSPACING="2" width=80% height=60 style="border-color:#999">
	<thead>
	<tr>
		<th height=4 bgcolor='#b9c9fe'><span style="color:#222">Nom</th>
			<th bgcolor='#b9c9fe'><span style="color:#222">Prénom</th>
			<th bgcolor='#b9c9fe'><span style="color:#222">Classement</th>
	</tr>
	<tbody>
	<?php $req="select * from membres where licence=04283 or licence=043069 or licence=7840872 or licence=385083 or licence=99440 order by classement desc;";
	
$resultat=mysql_query($req);

while($ligne=mysql_fetch_array($resultat))
{
		$nom=$ligne['nom'];
		$prenom=$ligne['prenom'];
		$class=$ligne['classement'];
		$licence=$ligne['licence'];
		?>
		<tr>
				<th bgcolor='#d3ddff' width="380"><span style="color:#222"><?php echo $nom;?></th>
				<th bgcolor='#d3ddff' width="380"><span style="color:#222"><a style="color:#092345" href="infoMembre.php?membre=<?php echo $licence;?>"><?php echo $prenom;?></a></th>
				<th bgcolor='#d3ddff'><span style="color:#222"><?php echo $class;?></th>
		</tr>
	</tbody>
<?php } ?>	
	</table>
	<br><br><br>
		<h3><a href="resultatsR.php">La regionale 2 - Equipe 2</a></h3>
	
	<table id="membre" border="1" CELLPADDING="4" CELLSPACING="2" width=80% height=60 style="border-color:#999">
	<thead>
	<tr>
		<th height=4 bgcolor='#b9c9fe'><span style="color:#222">Nom</th>
			<th bgcolor='#b9c9fe'><span style="color:#222">Prénom</th>
			<th bgcolor='#b9c9fe'><span style="color:#222">Classement</th>
	</tr>
	<tbody>
	<?php $req="select * from membres where licence=042613 or licence=042612 or licence=041947 or licence=7827941 order by classement desc;";
	
$resultat=mysql_query($req);

while($ligne=mysql_fetch_array($resultat))
{
		$nom=$ligne['nom'];
		$prenom=$ligne['prenom'];
		$class=$ligne['classement'];
		$licence=$ligne['licence'];
		?>
		<tr>
				<th bgcolor='#d3ddff' width="380"><span style="color:#222"><?php echo $nom;?></th>
				<th bgcolor='#d3ddff' width="380"><span style="color:#222"><a style="color:#092345" href="infoMembre.php?membre=<?php echo $licence;?>"><?php echo $prenom;?></a></th>
				<th bgcolor='#d3ddff'><span style="color:#222"><?php echo $class;?></th>
		</tr>
	</tbody>
	
<?php } ?>	
	</table>
	<br><br><br>


	
	<h3><a href="resultatsD1.php">La Departementale 1</a></h3>

	
	<table id="membre" border="1" CELLPADDING="4" CELLSPACING="2" width=80% height=60 style="border-color:#999">

	<thead>
	<tr>
		<th height=4 bgcolor='#b9c9fe'><span style="color:#222">Nom</th>
			<th bgcolor='#b9c9fe'><span style="color:#222">Prénom</th>
			<th bgcolor='#b9c9fe'><span style="color:#222">Classement</th>
	</tr>
	<tbody>
	<?php $req="select * from membres where licence=042724 or licence=043509 or licence=043221 or licence=043385 or licence=042615 order by classement desc;";
	
$resultat=mysql_query($req);

while($ligne=mysql_fetch_array($resultat))
{
		$nom=$ligne['nom'];
		$prenom=$ligne['prenom'];
		$class=$ligne['classement'];
		$licence=$ligne['licence'];
		?>
		<tr>
				<th bgcolor='#d3ddff' width="380"><span style="color:#222"><?php echo $nom;?></th>
				<th bgcolor='#d3ddff' width="380"><span style="color:#222"><a style="color:#092345" href="infoMembre.php?membre=<?php echo $licence;?>"><?php echo $prenom;?></a></th>
				<th bgcolor='#d3ddff'><span style="color:#222"><?php echo $class;?></th>
		</tr>
	</tbody>
<?php } ?>	
	</table>
	<br><br><br>
	<h3><a href="resultatsD3.php">La Departementale 3</a></h3>

	
	<table id="membre" border="1" CELLPADDING="4" CELLSPACING="2" width=80% height=60 style="border-color:#999">

	<thead>
	<tr>
		<th height=4 bgcolor='#b9c9fe'><span style="color:#222">Nom</th>
			<th bgcolor='#b9c9fe'><span style="color:#222">Prénom</th>
			<th bgcolor='#b9c9fe'><span style="color:#222">Classement</th>
	</tr>
	<tbody>
	<?php $req="select * from membres where licence=042298 or licence=2213131 or licence=043156 or licence=7828480 or licence=043385 order by classement desc;";
	
		$resultat=mysql_query($req);

		while($ligne=mysql_fetch_array($resultat))
		{
		$nom=$ligne['nom'];
		$prenom=$ligne['prenom'];
		$class=$ligne['classement'];
		$licence=$ligne['licence'];
		?>
		<tr>
				<th bgcolor='#d3ddff' width="380"><span style="color:#222"><?php echo $nom;?></th>
				<th bgcolor='#d3ddff' width="380"><span style="color:#222"><a style="color:#092345" href="infoMembre.php?membre=<?php echo $licence;?>"><?php echo $prenom;?></a></th>
				<th bgcolor='#d3ddff'><span style="color:#222"><?php echo $class;?></th>
		</tr>
	</tbody>
	<?php } ?>	
	</table>
	<br><br><br>
	</center>
</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
	</body>
</html>