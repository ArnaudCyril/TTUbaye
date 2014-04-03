<?php include("menu.php"); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Challenge - Tennis de table Ubaye</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
<script type="text/javascript" src="./jquery/misagchall.js"></script>

<link rel="stylesheet" type="text/css" href="./rangeslider/style.css">
</head>
<body>
<div id="container">
<center><img src="./images/icones/progression.png"  id="imgDebutPage"/>
<span id="titre">Le Challenge du Club</span></center>
<br><br>
<center>

	<div id="challenge">
	Le challenge du club est un petit jeu qui consiste à se défier entre joueur du club afin de progresser , mais toujours dans la convivialité</br>
La règle est simple , chaque joueur peut défier en match un joueur mieux classé que lui (jusqu'à 5 rang maximum) , et s'il gagne il prend sa place au classement du challenge.</br>
</br>
Exemple : le joueur classé 14ème défie le 10ème , si il gagne le match il passe 10éme et l'autre 14ème. Si il perd les classement ne bougent pas.
</br></br>Les classements seront mis à jour sur le plus régulièrement possible</br></br>
	<table id="membre" border="1" CELLPADDING="4" CELLSPACING="2" width=80% height=60 style="border-color:#ddd;color:#444">

		<thead>	
			<tr><!-- ligne des titres de colonnes-->
				<th bgcolor='#b9c9fe'>Nom</th>
				<th bgcolor='#b9c9fe'>Prenom</th>
				<th bgcolor='#b9c9fe'>Classement</th>
				<th bgcolor='#b9c9fe'>Rang</th>
				<th bgcolor='#b9c9fe'>Progresssion</th>
			</tr>
		</thead>
		<tbody>
<?php

	$requete="select * from challenge order by rang , progression desc;";

	
// execution de la requette
	$resultat=mysql_query($requete);
	$nbRep=mysql_num_rows($resultat);
//tt que on peut tirer une ligne du résultat
	$class=1;
	while($maLigne=mysql_fetch_array($resultat))
	{
		//maLigne est un tableau associatif correspond a 1 couleur
		$nom=$maLigne['nom'];
		$prenom=$maLigne['prenom'];
		$licence=$maLigne['licence'];
		$pts=$maLigne['points'];
		$rang=$maLigne['rang'];
		$progression=$maLigne['progression'];
		$color="#d3ddff";
		if($class==1)
		{
			$color="#e2b500";
		}
		if($class==2)
		{
			$color="#CECECE";
		}
		if($class==3)
		{
			$color="#D1C78E";
		}
		
		$class++;
		
		if($progression>=0)
		{
			$progression="<span style='color:green'>+".$progression."</span>";
		}
		else
		{
			$progression="<span style='color:red'>".$progression."</span>";	
		}

		
		if(isset($_SESSION['root']))
		{
			?><tr>
				<th bgcolor='#d3ddff'><?php echo $nom ?></th>
				<th bgcolor='#d3ddff'><?php echo $prenom ?></th>
				<th bgcolor='#d3ddff'><?php echo $pts ?></th>
				<th bgcolor='#d3ddff'><input type="hidden" id="id<?php echo $licence?>" value="<?php echo $rang ?>"><input type="text" class="challengeInput" name="rang" id="rang<?php echo $licence ?>" value="<?php echo $rang ?>"> <input type="button" id="submitbuttonSupprimer" value="Modifier" onclick="misahchallenge('<?php echo $licence; ?>',<?php echo $nbRep ?>)"></th>
				<th bgcolor='#d3ddff'><?php echo $progression ?></th>
			</tr>
			<?php
		}
		else
		{
		if($rang==1)  { $rang.="er"; }
		else { $rang.="ème"; }
		//remplir le tableau avec la ligne correspondat a la couleur
	?>
		<tr>		
			<th bgcolor='<?php echo $color ?>'><?php echo $nom ?></th>
			<th bgcolor='<?php echo $color ?>'><?php echo $prenom ?></th>
			<th bgcolor='<?php echo $color ?>'><?php echo $pts ?></th>
			<th bgcolor='<?php echo $color ?>' ><?php echo $rang ?></span></th>
			<th bgcolor='<?php echo $color ?>'><?php echo $progression ?></th>
		</tr>
	<?php
		} 
	}
?>
</tbody>
</table>
</div>
</div>
		<a href="#" class="back-to-top">&#8593; Haut de page &#8593;</a>
<?php include 'footer.php' ?>
</body>
</html>