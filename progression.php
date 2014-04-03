<?php include("menu.php");

$req="select * from membres";
$resultat=mysql_query($req);
$max1=0;$min1=0;
$max2=0;$min2=0;
$max3=0;$min3=0;
while($ligne=mysql_fetch_array($resultat))
	{
		$diff=$ligne['diff'];
		$nom=$ligne['nom'];
		$prenom=$ligne['prenom'];
		$pts=$ligne['ptsActuels'];
		$licence=$ligne['licence'];
		$class=$ligne['classement'];
		if($diff>=$max1)
		{
		$max1=$diff;
		$nom1=$nom;
		$pts1=$pts;
		$prenom1=$prenom;
		$licence1=$licence;
		$class1=$class;
		}
}
$req2="select * from membres";
$resultat2=mysql_query($req2);
while($ligne2=mysql_fetch_array($resultat2))
	{
		$diff=$ligne2['diff'];
		$nom=$ligne2['nom'];
		$prenom=$ligne2['prenom'];
		$pts=$ligne2['ptsActuels'];
		$licence=$ligne2['licence'];
		$class=$ligne2['classement'];
		
		if($diff>=$max2 and $diff<=$max1 and $licence!=$licence1)
		{
		
		$max2=$diff;
		$nom2=$nom;
		$pts2=$pts;
		$prenom2=$prenom;
		$licence2=$licence;
		$class2=$class;
		}
}
$req3="select * from membres";
$resultat3=mysql_query($req3);
while($ligne3=mysql_fetch_array($resultat3))
	{
		
		$diff=$ligne3['diff'];
		$nom=$ligne3['nom'];
		$prenom=$ligne3['prenom'];
		$pts=$ligne3['ptsActuels'];
		$licence=$ligne3['licence'];
		$class=$ligne3['classement'];
		if($diff>=$max3 and $diff<=$max2 and $licence!=$licence2 and $licence!=$licence1)
		{
		
		$max3=$diff;
		$nom3=$nom;
		$pts3=$pts;
		$prenom3=$prenom;
		$class3=$class;
		}
}
$req4="select * from membres";
$resultat4=mysql_query($req4);
while($ligne4=mysql_fetch_array($resultat4))
	{
		$diff=$ligne4['diff'];
		$nom=$ligne4['nom'];
		$prenom=$ligne4['prenom'];
		$pts=$ligne4['ptsActuels'];
		$licence=$ligne4['licence'];
		$class=$ligne4['classement'];
		if($diff<=$min1)
		{
		$min1=$diff;
		$nom4=$nom;
		$pts4=$pts;
		$prenom4=$prenom;
		$licence4=$licence;
		$class4=$class;
		}
}
$req5="select * from membres";
$resultat5=mysql_query($req5);
while($ligne5=mysql_fetch_array($resultat5))
	{
		$diff=$ligne5['diff'];
		$nom=$ligne5['nom'];
		$prenom=$ligne5['prenom'];
		$pts=$ligne5['ptsActuels'];
		$licence=$ligne5['licence'];
		$class=$ligne5['classement'];
		if($diff<=$min2 and $diff>=$min1 and $licence!=$licence4)
		{
		$min2=$diff;
		$nom5=$nom;
		$pts5=$pts;
		$prenom5=$prenom;
		$licence5=$licence;
		$class5=$class;
		}
}
$req6="select * from membres";
$resultat6=mysql_query($req6);
while($ligne6=mysql_fetch_array($resultat6))
	{
		
		$diff=$ligne6['diff'];
		$nom=$ligne6['nom'];
		$prenom=$ligne6['prenom'];
		$pts=$ligne6['ptsActuels'];
		$licence=$ligne6['licence'];
		$class=$ligne6['classement'];
		if($diff<=$min3 and $diff>=$min2 and $licence!=$licence5 and $licence!=$licence4)
		{
		$min3=$diff;
		$nom6=$nom;
		$pts6=$pts;
		$prenom6=$prenom;
		$class6=$class;
		
		
		}
		
}
?>
<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
<title>Progressions - Tennis de table Ubaye</title>
</head>
	<body>
	<div id="container">
	<center><img src="./images/icones/progression.png"  id="imgDebutPage"/><span id="titre"> Les Progressions</span>
	<br><br><br>
	<h2>Liste des 3 meilleures progressions du mois</h2><br><br>
	<table id="membre" border="1" CELLPADDING="4" CELLSPACING="2" width=80% height=40>
	<thead>
	<tr>
				<th bgcolor='#b9c9fe'>Rang</th>
				<th bgcolor='#b9c9fe'>Nom</th>
				<th bgcolor='#b9c9fe'>Prénom</th>
				<th bgcolor='#b9c9fe'>Anciens points</th>
				<th bgcolor='#b9c9fe'>Nouveaux points</th>
				<th bgcolor='#b9c9fe'>Classement</th>
				<th bgcolor='#b9c9fe'>Progression</th>
		
	</tr>
	</thead>
	<tbody>
	<tr>
				<th bgcolor='#d3ddff' >1er</th>
				<th bgcolor='#d3ddff'><?php echo $nom1?></th>
				<th bgcolor='#d3ddff'><?php echo $prenom1?></th>
				<th bgcolor='#d3ddff'><?php $n=$pts1-$max1; echo $n?></th>
				<th bgcolor='#d3ddff'><?php echo $pts1?></th>
				<th bgcolor='#d3ddff'><?php echo $class1?></th>
				<?php
				if($max1>=0) {
				?>
				<th bgcolor='#d3ddff'><font color="green">+<?php echo $max1?></font></th>
				<?php }
				else { ?> <th bgcolor='#d3ddff'><font color="red"><?php echo $max1?></font></th> <?php } 
					?>
		
	</tr>
	<tr>
				<th bgcolor='#d3ddff'>2eme</th>
				<th bgcolor='#d3ddff'><?php echo $nom2?></th>
				<th bgcolor='#d3ddff'><?php echo $prenom2?></th>
				<th bgcolor='#d3ddff'><?php $n=$pts2-$max2; echo $n?></th>
				<th bgcolor='#d3ddff'><?php echo $pts2?></th>
				<th bgcolor='#d3ddff'><?php echo $class2?></th>
				<?php
				if($max2>=0) {
				?>
				<th bgcolor='#d3ddff'><font color="green">+<?php echo $max2?></font></th>
				<?php }
				else { ?> <th bgcolor='#d3ddff'><font color="red"><?php echo $max2?></font></th> <?php } 
					?>		
	</tr>
	<tr>
				<th bgcolor='#d3ddff'>3eme</th>
				<th bgcolor='#d3ddff'><?php echo $nom3?></th>
				<th bgcolor='#d3ddff'><?php echo $prenom3?></th>
				<th bgcolor='#d3ddff'><?php $n=$pts3-$max3; echo $n?></th>
				<th bgcolor='#d3ddff'><?php echo $pts3?></th>
				<th bgcolor='#d3ddff'><?php echo $class3?></th>
				<?php
				if($max3>=0) {
				?>
				<th bgcolor='#d3ddff'><font color="green">+<?php echo $max3?></font></th>
				<?php }
				else { ?> <th bgcolor='#d3ddff'><font color="red"><?php echo $max3?></font></th> <?php } 
					?>		
	</tr>
	</tbody>
	</table>
	<br><br><br><br>
	<h2>Les 3 plus belles régressions du mois</h2>
	<br><br>
	<table id="membre" border="1" CELLPADDING="4" CELLSPACING="2" width=80% height=40>
	<thead>
	<tr>
				<th bgcolor='#b9c9fe'>Rang</th>
				<th bgcolor='#b9c9fe'>Nom</th>
				<th bgcolor='#b9c9fe'>Prénom</th>
				<th bgcolor='#b9c9fe'>Anciens points</th>
				<th bgcolor='#b9c9fe'>Nouveaux points</th>
				<th bgcolor='#b9c9fe'>Classement</th>
				<th bgcolor='#b9c9fe'>Progression</th>
		
	</tr>
	</thead>
	<tbody>
	<tr>
				<th bgcolor='#d3ddff'>1er</th>
				<th bgcolor='#d3ddff'><?php echo $nom4?></th>
				<th bgcolor='#d3ddff'><?php echo $prenom4?></th>
				<th bgcolor='#d3ddff'><?php $n=$pts4-$min1; echo $n?></th>
				<th bgcolor='#d3ddff'><?php echo $pts4?></th>
				<th bgcolor='#d3ddff'><?php echo $class4?></th>
				<?php
				if($min1>=0) {
				?>
				<th bgcolor='#d3ddff'><font color="green">+<?php echo $min1?></font></th>
				<?php }
				else { ?> <th bgcolor='#d3ddff'><font color="red"><?php echo $min1?></font></th> <?php } 
					?>		
	</tr>
	<tr>
				<th bgcolor='#d3ddff'>2eme</th>
				<th bgcolor='#d3ddff'><?php echo $nom5?></th>
				<th bgcolor='#d3ddff'><?php echo $prenom5?></th>
				<th bgcolor='#d3ddff'><?php $n=$pts5-$min2; echo $n?></th>
				<th bgcolor='#d3ddff'><?php echo $pts5?></th>
				<th bgcolor='#d3ddff'><?php echo $class5?></th>
				<?php
				if($min2>=0) {
				?>
				<th bgcolor='#d3ddff'><font color="green">+<?php echo $min2?></font></th>
				<?php }
				else { ?> <th bgcolor='#d3ddff'><font color="red"><?php echo $min2?></font></th> <?php } 
					?>			
	</tr>
	<tr>
				<th bgcolor='#d3ddff'>3eme</th>
				<th bgcolor='#d3ddff'><?php echo $nom6?></th>
				<th bgcolor='#d3ddff'><?php echo $prenom6?></th>
				<th bgcolor='#d3ddff'><?php $n=$pts6-$min3; echo $n?></th>
				<th bgcolor='#d3ddff'><?php echo $pts6?></th>
				<th bgcolor='#d3ddff'><?php echo $class6?></th>
				<?php
				if($min3>=0) {
				?>
				<th bgcolor='#d3ddff'><font color="green">+<?php echo $min3?></font></th>
				<?php }
				else { ?> <th bgcolor='#d3ddff'><font color="red"><?php echo $min3?></font></th> <?php } 
					?>			
	</tr>
	</body>
	</table>
	<br><br><br>
	<h2>Toutes les progressions</h2>
	<table id="membre" border="1" CELLPADDING="4" CELLSPACING="2" width=80% height=40>
	<thead>
	<tr>
				
				<th bgcolor='#b9c9fe'>Nom</th>
				<th bgcolor='#b9c9fe'>Prénom</th>
				<th bgcolor='#b9c9fe'>Points</th>
				<th bgcolor='#b9c9fe'>Progression</th>
		
	</tr>
	</thead>
	<tbody>
	<?php
	$nb=0;
	$requette="select * from membres order by nom,prenom;";
	$res=mysql_query($requette);
	while($maLigne=mysql_fetch_array($res))
	{
		$nom=$maLigne['nom'];
		$prenom=$maLigne['prenom'];
		$pts=$maLigne['ptsActuels'];
		$prog=$maLigne['diff'];
		if($prog>=0)
		{
			$diff="<font color='green'>+".$prog;
		}
		else
		{
			$diff="<font color='red'>".$prog;
		}
		
	?>
	<tr>
				
				<th <?php if($nb%2==0):?>bgcolor='#d3ddff'<?php else:?>bgcolor='#d3ddff'<?php endif?>><?php echo $nom?></th>
				<th <?php if($nb%2==0):?>bgcolor='#d3ddff'<?php else:?>bgcolor='#d3ddff'<?php endif?>><?php echo $prenom?></th>
				<th <?php if($nb%2==0):?>bgcolor='#d3ddff'<?php else:?>bgcolor='#d3ddff'<?php endif?>><?php echo $pts?></th>
				<th <?php if($nb%2==0):?>bgcolor='#d3ddff'<?php else:?>bgcolor='#d3ddff'<?php endif?>><?php echo $diff ?></th>
				<?php $nb++;?>
	</tr>	
	<?php
	}
	?>
	
	</tbody>
	</table>
	
	<center>
	</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
	</body>
	</html>