<?php include('menu.php');

if(isset($_POST["actionModif"])&& $_POST["actionModif"]=="Modifier")
	{	
		$sujet=$_POST["nomSujet"];
		$idS=$_POST["idSujet"];
		if($sujet!="")
		{
		$maRequette="update forum set nom='$sujet' where id = '$idS'";
		$resultat=mysql_query($maRequette);
		}
	
	}	
if(isset($_POST["actionModif"])&& $_POST["actionModif"]=="Supprimer")
	{	
		$id=$_POST["idSujet"];
		$maRequette2="delete from msgforum where id = '$id'";
		$resultat2=mysql_query($maRequette2);
		$maRequette4="delete from forum where id = '$id'";
		$resultat4=mysql_query($maRequette4);

	
	}	
if(isset($_POST["actionCreer"]))
	{	
		$newSujet=$_POST["nomNewSujet"];
		$log=$_SESSION ['loginM'];
		$maRequette3="insert into forum values(null,'$newSujet','$log')";
		$resultat3=mysql_query($maRequette3);

	
	}	
 ?>
<html>
<head>
<meta name="viewport" content="width=device-width">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>

<META NAME="description" CONTENT="Club de tennis de table situé a Barcelonette , dans la vallée de l'ubaye"> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Forum - Tennis de table Ubaye</title>
<script type="text/javascript" src="./jquery/scroll.js"></script>

</head>
<BODY>

<div id="container">
<center><img src="./images/icones/forum.png"  id="imgDebutPage"/><span id="titre"> Le Forum</span></center></br>
<div id="forum">
<center></br><h2> Liste des sujets</h2></br></br></center>
<?php
	$req="select * from forum";
	$rep=mysql_query($req);
	while($ligne=mysql_fetch_array($rep))
	{
		$sujet=$ligne['nom'];
		$id=$ligne['id'];
		$author=$ligne['login'];	
		?>
		
		<h3><a href="sujetForum.php?sujet=<?php echo $id;?>">&#149; <?php echo $sujet ?></a></h3>
		<?php
		if(isset($_SESSION['loginM']) and ($author==$_SESSION['loginM']))
		{
			?>
			
			</br>
			<form method="POST" name="formForum" action="forum.php"/>
			Nom du sujet : 
			<input type="hidden" name="idSujet" value="<?php echo $id?>"/>
			<input type="text" name="nomSujet" value="<?php echo $sujet?>"/>
			<input type="submit" name="actionModif" value="Modifier" id="submitButtonModif"/>
			<input type="submit" name="actionModif" value="Supprimer" id="submitButtonSupprimer"/>
			</form>
			
		<!-- <h4>Ouvert par : <?php echo $author ?> </h4>	-->
		<?php
		}
					echo "<hr>";

	}
?>
</br>
<?php
if(isset($_SESSION['loginM']))
{ ?>
<form method="POST" name="formForumNewTopic" action="forum.php"/>
<p>Nouveau sujet : <input type="text" name="nomNewSujet" /></p>
<input type="submit" name="actionCreer" value="Créer le sujet" id="submitButton"/>
</form>
<?php
}
else{
		?>
		<center><a href="connexion.php" id="submitButton">Connectez vous pour créer un sujet </a></center>
		<?php
}
?>
</div>
</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
</body>
</html>