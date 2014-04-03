<?php include "menu.php" ;
require 'recaptchalib.php';	
if(isset($_POST['action']))
{
	$cle_publique = "6Lf30OsSAAAAANOzTsszG8vZDrOLvzbUwFA5UwBh";
	$cle_privee   = "6Lf30OsSAAAAABmuUvjo5EMIBvnJIPCNzw5uryct";
 
	// Interrogation du serveur reCaptcha
	// La réponse de reCaptcha est stockée dans la variable $reponse
		$reponse = recaptcha_check_answer(
		$cle_privee,                        // Votre clé privée
		$_SERVER['REMOTE_ADDR'],            // L'adresse IP de l'utilisateur
		$_POST['recaptcha_challenge_field'],// Un identifiant (jeton) permettant à reCaptcha de vérifier la réponse
		$_POST['recaptcha_response_field']  // Ce que l'utlisateur a saisi dans le champ texte du captcha
		);
	$valid=true;
	if( !$reponse->is_valid ){
	$valid=false;
	$error="Mauvais captcha";
	}
	$login=$_POST['inputloginN'];
	$mdp=$_POST['inputNMdp'];
	$mdp2=$_POST['inputNMdp2'];
	$mail=$_POST['inputMail'];
	
	$req="select * from login";
	$rep=mysql_query($req);
	
	while($ligne=mysql_fetch_array($rep))
	{
		if($login==$ligne['login'])
		{
			$valid=false;
			$error="Login indisponible";
		}
	}
	if($mdp!=$mdp2)
	{
		$valid=false;
		$error="Les mots de passe ne correspondent pas";
	}
	if($mdp==""){
		$valid=false;
		$error="Vous n'avez pas rempli de mot de passe";
	}
	if($valid)
	{
		if($mail!="")
		{
		$req2="insert into login values('$login','$mdp',0,'$mail')";
		$rep2=mysql_query($req2);
		}
		else
		{
		$req2="insert into login values('$login','$mdp',0,null)";
		$rep2=mysql_query($req2);
		}
		header("location:connexion.php");
	}

	
}


; ?>
<html>
	<head>
	<title>Créer mon compte - Tennis de Table Ubaye</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="goTop.js"></script>
	</head>
	<body>
	
	<div id="container">
		<center><img src="./images/icones/compte.png"  id="imgDebutPage"/>
	<span id="titre"> Créer mon compte</span></br></br></br></center>
	<?php
	if(isset($_POST['action'])and !$valid){
	?>
	<center><h4 id="infoMail"><?php echo $error ?></h4></center>
	<?php
	}
	?>
			<form name="Log" method="POST" id="compte" action="creercompte.php">
			Login * :<br> <input type="text" name="inputloginN" /><br></br>
			Mot de passe * : <br><input type="password" name="inputNMdp"/></br></br>
			Mot de passe * : <br><input type="password" name="inputNMdp2"/></br></br>
			Mail :<br> <input type="text" name="inputMail" /><br></br
			><br>Antispam :<br>
			<script type="text/javascript">
			var RecaptchaOptions = {
			theme : 'clean'
			};
			</script>
			
			<?php
				$cle_publique = "6Lf30OsSAAAAANOzTsszG8vZDrOLvzbUwFA5UwBh";
				$cle_privee   = "6Lf30OsSAAAAABmuUvjo5EMIBvnJIPCNzw5uryct";
 
				// Affichage du bloc reCaptcha dansle formulaire
			?><span style="max-width:100%"><?php echo recaptcha_get_html($cle_publique);?></span><br>
			<input type="submit" name="action"  id="submitButtonModif" value="Enregistrer"/></br></br>
			</form>
	</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>

</body>
<html>