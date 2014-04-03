<?php include("menu.php"); 
		if(isset($_SESSION['loginM']))
		{
			$log=$_SESSION['loginM'];
		}
function apo($s1)
{
  $s1 = trim($s1); // enleve les espaces autour  
  $s1 = trim($s1, "\xA0" ); // enleve les nbsp autour  
  $s1 = stripslashes($s1); // enleve les slashs avant les apostrophes, etc.  
  $s1 = str_replace("'", "''", $s1); // remplace les guillemets  
  // supprime les caractères non imprimables (null, tab, backspace, ...)  
  $s2 = "";
  for ($i = 0; $i < strlen($s1); $i++) {
     $c = substr($s1, $i, 1);
     if (ord($c) >= 32)
        $s2 .= $c;
  }
  return($s2);
}
function getTitle($type)
{
	if($type=="championnat")
	{
		return "Match(s) de championnat";
	}
	if($type=="individuel")
	{
		return "Compétition individuelle";
	}
	if($type=="stage")
	{
		return "Stage";
	}
	if($type=="autre")
	{
		return "Autre";
	}

}
if(isset($_POST['addev']))
{
	$dateEcrit=date("20y-m-d");	
	$dateEvent=$_POST['adddate'];
	$type=$_POST['addtype'];
	$titre=$_POST['addtitre'];
	$contenu=$_POST['addcontenu'];
	$contenu=nl2br($contenu);
	
	$req="insert into event values(null,'$dateEcrit','$dateEvent','".apo($titre)."','".apo($contenu)."','$type','$login');";
	$rep=mysql_query($req);

}
if(isset($_POST['modif']))
{
	
	$dateEvent=$_POST['dateEv'];
	$type=$_POST['type'];
	$titre=$_POST['titre'];
	$id=$_POST['id'];
	$contenu=$_POST['contenu'];
	$contenu=nl2br($contenu);
	
	$req="update event set dateEv='$dateEvent' , type='$type' , titre='".apo($titre)."' , contenu='".apo($contenu)."' where id=$id";
	$rep=mysql_query($req);

}
if(isset($_POST['supprimer']))
{
	$id=$_POST['id'];
	
	$req="delete from event where id=$id";
	$rep=mysql_query($req);

}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Evénements - Tennis de table Ubaye</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
<link rel="stylesheet" type="text/css" href="./rangeslider/style.css">
</head>
<body>
<div id="container">
<center><img src="./images/icones/event.png"  id="imgDebutPage"/>
<span id="titre">Evénement</span></center></br>
</br>


			
	<?php 
	if(isset($_SESSION['root']) and $_SESSION['root']=="cyril")
	{
		?><center><a id="submitButton" href="getevent.php">Mettre a jour les évenements</a></center></br></br><?php
	}
	
	if(isset($_SESSION['root']))
			{
				$todayDate=date("20y-m-d");
					?>
					<div id="addEvent">
					<center><h3>Ajouter un évenement</h2></center>
					</br>
					<form name="formEvent" method="POST" action="evenement.php">
					Date de l'évenement : <input type="date" name="adddate" value="<?php echo $todayDate ?>"></br></br>
					Type d'évenement : 			
					<select name="addtype">
						<option value="championnat" >Match de Championnat</option>
						<option value="individuel">Compétition Individuelle</option>
						<option value="stage">Stage</option>
						<option value="autre">Autre</option>
					</select></br>
					<p>Titre de l'évenement : <input type="text" name="addtitre"></p>
					<p>Description de l'évenement : </br> <textarea name="addcontenu" rows=6 cols=100 resize="false" id="textareaadd"></textarea>
					<center><input type="submit" name="addev" value="Ajouter l'évenement" id="submitButton" style="color:white">
					</form>
					</div>
					</br></br>
					<?php
			}
	
?><div id="corpevent"><?php
	$dateT=date("20y-m-d");
	$req="select * from event where dateEv>='$dateT' order by dateEv";
	$rep=mysql_query($req);
	while($ligne=mysql_fetch_array($rep))
	{

		if($ligne['login']==$log)
		{
			?>
			<form name="formEvent2" method="POST" action="evenement.php">
			<input type="hidden" name="id" value="<?php echo $ligne['id'] ?>">
			<img src="./images/icones/<?php echo $ligne['type'] ?>.png" width=40 height=40 style="vertical-align:-7px">
			Type d'évenement : <select name="type">
				<option value="championnat" <?php if($ligne['type']=="championnat") { ?> selected <?php } ?>>Match de Championnat</option>
				<option value="individuel" <?php if($ligne['type']=="individuel") { ?> selected <?php } ?>>Compétition Individuelle</option>
				<option value="stage" <?php if($ligne['type']=="stage") { ?> selected <?php } ?>>Stage</option>
				<option value="autre" <?php if($ligne['type']=="autre") { ?> selected <?php } ?>>Autre</option>
			</select></br></br>
			Date de l'évenement : <input type="date" name="dateEv" value="<?php echo $ligne['dateEv'] ?>"></br></br>
			Titre de l'évenement : <input type="text" name="titre" value="<?php echo $ligne['titre'] ?>"></br>
			Description de l'évenement : <textarea name="contenu" id="textareaadd" rows=6 cols=100><?php echo $ligne['contenu'] ?></textarea>
			</br><input type="submit" name="modif" value="Modifier l'évenement" id="submitButtonModif" style="color:white">
			<input type="submit" name="supprimer" value="Supprimer l'évenement" id="submitButtonSupprimer" style="color:white">
			</form>
			<?php
		}
		else
		{
			$varDebut="Le  ";
 
			if($ligne['type']=="championnat") { $varDebut="Week-end du  " ;}
			?>
			
			<p style="font-size:20px"><img src="./images/icones/<?php echo $ligne['type'] ?>.png" id="photoEvent" style="vertical-align:-10px;">&nbsp;&nbsp;&nbsp;
			<?php echo getTitle($ligne['type']) ?> 
			
			<p id="dateEvent" style="font-size:18px;font-weight:bold"><?php echo $ligne['titre'] ?></p>
			<p id="Event">	 <?php echo $varDebut;echo date("d/m/Y", strtotime($ligne['dateEv'])) ?></p>
				</br>
				<p id="Event"><?php echo $ligne['contenu'] ?></p>
				<?php
			
		}
		?></br><hr></br> <?php
	
	}
	
	
	?>
</div>

</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
</body>
</html>