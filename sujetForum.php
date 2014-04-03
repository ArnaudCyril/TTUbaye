<?php
include("menu.php");
$idSujet=$_GET['sujet'];
if(isset($_POST["actionModif"])&& $_POST["actionModif"]=="Modifier")
	{	
		$mess=$_POST["CommForum"];
		$no=$_POST["idModifMsg"];
		if($mess!="")
		{
		$mess=str_replace('"','\"',$mess);
		$mess=str_replace("'","\'",$mess);
		$maRequette="update msgforum set contenu='$mess' where no = '$no'";
		$resultat=mysql_query($maRequette);
		}
	
	}	
if(isset($_POST["actionModif"])&& $_POST["actionModif"]=="Supprimer")
	{	
		$no=$_POST["idModifMsg"];
		$maRequette2="delete from msgforum where no = '$no'";
		$resultat2=mysql_query($maRequette2);

	
	}	
if(isset($_POST["actionCreerMsg"]))
	{	
		$newMess=$_POST["newCommForum"];
		$log=$_SESSION ['loginM'];
		$date=date("20y-m-d");
		$newMess=str_replace('"','\"',$newMess);
		$newMess=str_replace("'","\'",$newMess);

		$maRequette3="insert into msgforum values(null,'$idSujet','$newMess','$log','$date')";
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
 <a id="submitButton" href="forum.php" style="margin-left:8%;"><img src="./images/icones/retour.png" id="imgSubmitBtm" style="vertical-align:-10px;"/> &nbsp;Retour</a></br></br>
<div id="forum">
<?php
$req="select * from msgforum where id=$idSujet;";
$resultat=mysql_query($req);
$nbMess=0;
while($ligne=mysql_fetch_array($resultat))
{
		$nbMess++;
		$no=$ligne['no'];
		$content=$ligne['contenu'];
		$date=$ligne['dateF'];
		$login=$ligne['login'];		
		$identity=$ligne['login'];
		$req2="select * from membres where loginM='$login';";
		$resultat2=mysql_query($req2);
		$ligne2=mysql_fetch_array($resultat2);
		if($ligne2['prenom']!="")$identity=$ligne2['prenom'];
		if(isset($_SESSION['loginM']) and ($_SESSION['loginM']==$login))
		{
		?>
		<form method="POST" name="formForumModifMsg" action="#"/>
		<h4>Par : <?php echo $identity ?> le <?php echo date("d/m/Y", strtotime($ligne['dateF'])); ?> </h4>
		<input type="hidden" name="idModifMsg" value="<?php echo $no ?>"/>
		<textarea  name="CommForum" id="textarea" rows=6 COLS=100 style="resize: none;" placeholder="Laissez votre commentaire..."><?php echo $content ?></textarea>
		</br>
		<input type="submit" name="actionModif" value="Modifier" id="submitButtonModif"/>
		<input type="submit" name="actionModif" value="Supprimer" id="submitButtonSupprimer"/>
		</form>
		<?php
		}
		else
		{
		?>
		<p>Par : <?php echo $identity ?> le <?php echo date("d/m/Y", strtotime($ligne['dateF'])); ?> </p>
		<div id="CommContentForum">
		<h4><?php echo $content ?> </h4></div>
		<?php } ?>
		</br><hr>
		<?php
		
}
if($nbMess==0)
{ ?> <h4 style="font-style='italic'">Pas encore de commentaire , soyez le premier a commenter !</h4> <?php }
if(isset($_SESSION['loginM']))
{
	?>
	<form method="POST" name="formForumNewMsg" action="#"/>
	<textarea  name="newCommForum" id="textarea" rows=6 COLS=100 style="resize: none;" placeholder="Ajouter votre commentaire..."></textarea></br>
	<input type="submit" name="actionCreerMsg" value="Commenter" id="submitButton"/>
	</form>
	<?php
}
else
{ ?>
	<center><a href="connexion.php" id="submitButton">Connectez vous pour ajouter un commentaire</a></center> <?php
}
 ?>
</div>
</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
</body>
</html>