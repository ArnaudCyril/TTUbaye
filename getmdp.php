<?php include "menu.php" ;
require 'recaptchalib.php';		
$envoi=0;
if(isset($_POST['action']))
	{
		$adresse=$_POST['inputMail'];

		////////////////////////
		
// Inclusion de l'API recaptcha
 
// Définition des 2 clés
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
 
if( !$reponse->is_valid ){
	$error="Mauvais captcha";
	$trouve=false;
}
else {
		/////////////////////
		$mess="TTU - Récupération des infos : voici les informations trouvées pour l'adresse  ".$adresse."\r\n";
		$req="select * from login where mail='$adresse';";
		$rep=mysql_query($req);
		$trouve=false;
		$nbTest=0;
		while($ligne=mysql_fetch_array($rep))
		{
			if($adresse==$ligne['mail'])
			{
				$nbTest++;
				if($nbTest>1){$mess.= "\r\n et \r\n\r\n";}
				$mess.="Login : ".$ligne['login']."\r\n";
				$mess.="Mot de Passe : ".$ligne['mdp']."\r\n";
				$trouve=true;
			}
		}
		if(!($trouve))
		{
			$error="Pas d'adresse mail correspondante";
		}
		else
		{
			mail($adresse,"TTU - Récupération des infos",$mess); 
		}
		
	
	}
}
?>
<html>
	<head>
	<title>Reporter un bug</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="goTop.js"></script>
	</head>
	<body>
	
	<div id="container">
	<center><img src="./images/icones/connexion.png"  id="imgDebutPage"/><span id="titre">  Login / Mot de passe oublié</span></center>
	</br></br>
	<?php
		if((isset($_POST['action'])) and $trouve){ ?><center><h4 id="infoMailOk">Message envoyé</h4></center><?php }
		if((isset($_POST['action'])) and !($trouve)){ ?><center><h4 id="infoMail"><?php echo $error ?></h4></center><?php }
	?>
	</br></br>
	
<div id="formMess">
<form name="formContact" method="POST" action="getmdp.php">
Votre adresse mail : <br><input type="text" name="inputMail" id="inputMail"/></br></br>
<br>Antispam :<br>
<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'clean'
 };
 </script>

	<?php
// Inclusion de l'API reCaptcha
 
// Définition des 2 clés
$cle_publique = "6Lf30OsSAAAAANOzTsszG8vZDrOLvzbUwFA5UwBh";
$cle_privee   = "6Lf30OsSAAAAABmuUvjo5EMIBvnJIPCNzw5uryct";
 
// Affichage du bloc reCaptcha dansle formulaire
?><span style="max-width:80%"><?php echo recaptcha_get_html($cle_publique);?></span><br></br></br>
</div>
<center><input type="submit" name="action" value="Récupérer mes infos" id="submitButton"/><center></div>

	</br></br>

	
		<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>

</body>
<html>