<?php include "menu.php" ;
require 'recaptchalib.php';
$envoi=0;
if(isset($_POST['action']) and ($_POST['action']=='Envoyer'))
	{
		$mess=$_POST['inputMess'];
		$mailrep=$_POST['inputMailRep'];
		$sujet=$_POST['inputSujet'];
		$headers ='From:'.$mailrep; 
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
	$envoi=1000;
}
else {
		/////////////////////
		if($mess!="" and $mailrep!="" and $sujet!="") 
		{
			for($i=0;$i<strlen($mailrep);$i++)
			{
				if($mailrep[$i]=='@')
				{
					$envoi=10;
				}
				
			}
			if($envoi==10)
			{
				$sujet="TTU - ".$sujet;
				mail('04arnaud@gmail.com',$sujet,$mess,$headers); 
				mail('Sabine.trens@free.fr',$sujet,$mess,$headers); 
				mail('gilles.damien@laposte.net',$sujet,$mess,$headers); 
			}
			else
				{
					$envoi=11;
				}
		}
		
	
else
{
	if($mess=="")
	{
			$envoi=$envoi+4;
	}
	if($mailrep=="")
	{
			$envoi=$envoi+2;
	}
	if($sujet=="")
	{
			$envoi=$envoi+1;
	}
	
}
}
}
?>
<html>
	<head>
	<title>Contact</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
	</head>
	<body>
	
	<div id="container"><center><img src="./images/icones/contact.png"  id="imgDebutPage"/><span id="titre"> Nous Contacter</span></center><br>
<div id="formMess">
<?php
if($envoi==10)
{
		?><center><h4 id="infoMailOk">Message envoyé</h4></center>
	<?php
}
if($envoi==2)
{
		?><center><h4 id="infoMail">Veullez préciser l'adresse de réponse</h4></center>
	<?php
}
if($envoi==1)
{
		?><center><h4 id="infoMail">Veullez préciser le sujet du message</h4></center>
	<?php
}
if($envoi==4)
{
		?><center><h4 id="infoMail">Veullez entrer un contenu dans votre message</h4></center>
	<?php
}
if($envoi==3)
{
		?><center><h4 id="infoMail">Veullez préciser l'adresse de réponse et le sujet de message</h4></center>
	<?php
}
if($envoi==5)
{
		?><center><h4 id="infoMail">Veullez entrer un contenu dans votre message et un sujet</h4></center>
	<?php
}
if($envoi==6)
{
		?><center><h4 id="infoMail">Veullez  entrer un contenu dans votre message et l'adresse de réponse</h4></center>
	<?php
}
if($envoi==7)
{
		?><center><h4 id="infoMail">Veullez préciser les champs demandés</h4></center>
	<?php
}
if($envoi==11)
{
		?><center><h4 id="infoMail">Adresse de réponse invalide</h4></center>
	<?php
}
if($envoi==1000)
{
		?><center><h4 id="infoMail">Mauvais captcha</h4></center>
	<?php
}

?>

<form name="formContact" method="POST" action="contact.php" id="formContact"></br></br>
Adresse de réponse : <br><input type="text" name="inputMailRep" size="30" class="inputCalcul"/><br><br>
Sujet : <br><input type="text" name="inputSujet" size="47" class="inputCalcul"/><br><br>
Message : <br><TEXTAREA  name="inputMess" id="textarea" rows="10" COLS="100" style="resize: none;" style="border-color:blue;"></TEXTAREA><br>
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
?><span style="max-width:100%"><?php echo recaptcha_get_html($cle_publique);?></span><br><br>
<input type="submit" name="action" value="Envoyer" id="submitButton"/>

</form>
	</div>
	</div>
		<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>

</body>
<html>