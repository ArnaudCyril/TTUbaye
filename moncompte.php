<?php
 include "menu.php" ;
if(empty($_SESSION['loginM']))
{
	?><SCRIPT LANGUAGE="JavaScript"> 
document.location.href="connexion.php" 
</SCRIPT> <?php
}
if(isset($_POST['action']))
{
	$oldLogin=$_SESSION['loginM'];
	$login=$_POST['inputloginN'];
	$oldm=$_POST['inputOldMdp'];
	$Oldmdp=$_POST['oldMd'];
	$mdp=$_POST['inputNMdp'];
	$mdp2=$_POST['inputNMdp2'];
	$mail=$_POST['inputMail'];
	$req="select * from login";
	$rep=mysql_query($req);
	$valid=true;
	while($ligne=mysql_fetch_array($rep))
	{
		if($login==$ligne['login'] and $login!=$oldLogin)
		{
			$valid=false;
			$error="Login indisponible";
		}
	}
	if($mdp!="" and $Oldmdp!=$oldm)
	{
		$valid=false;
		$error="L'acien mot de passe est incorrect";
	}
	if($mdp!=$mdp2)
	{
		$valid=false;
		$error="Les mots de passe ne correspondent pas";
	}
	if($valid and $_POST['action']=="Enregistrer")
	{
		
		$reqAnnexe="select * from membres where loginM='$oldLogin'";
		$repAnnexe=mysql_query($reqAnnexe);
		$nbR=mysql_num_rows($repAnnexe);
			if($nbR!=0)
			{
				$reqAnnexe2="update membres set loginM='$login' where loginM='$oldLogin'";
				$repAnnexe2=mysql_query($reqAnnexe2);
				rename("/new/upload/membres/$oldLogin", "/new/upload/membres/$login");
			}
			if($mdp!="")
			{
				$req3="update login set mdp='$mdp' where login='$oldLogin';";
				$rep3=mysql_query($req3);		
			}
			if($mail!="")
			{
				$req4="update login set mail='$mail' where login='$oldLogin';";
				$rep4=mysql_query($req4);		
			}
			if($login!="")
			{
			
				$req2="update login set login='$login' where login='$oldLogin';";
				$rep2=mysql_query($req2);
				$req20="update forum set login='$login' where login='$oldLogin';";
				$rep20=mysql_query($req20);
				$req200="update msgforum set login='$login' where login='$oldLogin';";
				$rep200=mysql_query($req200);	
				$req2000="update messages set login='$login' where login='$oldLogin';";
				$rep2000=mysql_query($req2000);		
				
				$_SESSION['loginM']=$login;
			}
		
		//header("location:connexion.php");
	}
	if($valid and $_POST['action']=="Supprimer ce compte")
	{
			$req2="delete from login where login='$oldLogin'";
			$rep2=mysql_query($req2);
			header("location:connexion.php");
	}

	
}


; ?>
<html>
	<head>
	<title>Mon compte - Tennis de Table Ubaye</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="goTop.js"></script>
	</head>
	<body>
	
	<div id="container">
		<center><img src="./images/icones/compte.png"  id="imgDebutPage"/>
	<span id="titre"> Mon compte</span></br></br></br></center>
	<?php
	if(isset($_POST['action'])and !$valid){
	?>
	<center><h4 id="infoMail"><?php echo $error ?></h4></center>
	<?php
	}
	if(isset($_SESSION['loginM']))
	{
		$l=$_SESSION['loginM'];
		$req5="select * from login where login='$l'";
		$rep5=mysql_query($req5);
		$ligne5=mysql_fetch_array($rep5);
		$log=$ligne5['login'];
		$mdp=$ligne5['mdp'];
		$mail=$ligne5['mail'];
	?>
			<form name="Log" method="POST" id="compte" action="moncompte.php">
			Login * :<br> <input type="text" name="inputloginN" value="<?php echo $log?>"/><br></br>
			<input type="hidden" name="oldMd" value="<?php echo $mdp?>"/>
			Ancien Mot de passe * : </br><input type="password" name="inputOldMdp"></br></br>
			Mot de passe * : </br><input type="password" name="inputNMdp"/></br></br>
			Mot de passe * : </br><input type="password" name="inputNMdp2"/></br></br>
			Mail :</br> <input type="text" name="inputMail" value="<?php echo $mail?>"/><br></br>
			<input type="submit" name="action"  id="submitButtonModif" value="Enregistrer"/></br></br>
			<input type="submit" name="action"  id="submitButtonSupprimer" value="Supprimer ce compte"/>
			</br></br>
			</form>
	<?php }
	else{
		//header("location:connexion.php");
	}	
	?>		
	
	</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>

</body>
<html>