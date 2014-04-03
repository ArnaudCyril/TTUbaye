<?php include("menu.php");
function redimage($img_src,$dst_w,$dst_h) {
   // Lit les dimensions de l'image
   $size = GetImageSize($img_src);  
   $src_w = $size[0]; $src_h = $size[1];
   // Teste les dimensions tenant dans la zone
   $test_h = round(($dst_w / $src_w) * $src_h);
   $test_w = round(($dst_h / $src_h) * $src_w);
   // Si Height final non précisé (0)
   if(!$dst_h) $dst_h = $test_h;
   // Sinon si Width final non précisé (0)
   elseif(!$dst_w) $dst_w = $test_w;
   // Sinon teste quel redimensionnement tient dans la zone
   elseif($test_h>$dst_h) $dst_w = $test_w;
   else $dst_h = $test_h;

   // Affiche les dimensions optimales
   echo "WIDTH=".$dst_w." HEIGHT=".$dst_h;
   
}
?>
<html>
<head>
<title>Localisation - Tennis de table Ubaye</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
</head>
	<body>
	<div id="container">
	<center><img src="./images/icones/localisation.png" id="imgDebutPage"/>
	<span id="titre">Localisation</span></center>
		<br><br><br>
		<div id="loca">
		<p> En arrivant de l'autoroute , de Gap ou de Digne par la D900 , entrez dans Barcelonnette , au 1er rond point prenez la 1ére sortie sur la digue, continuez tout droit au 2 stops suivants.</br>Dépassez la salle et tournez a gauche , 50m après le feu.
		</p>
		<img src="./images/loca3.png" <?php redimage("./images/loca3.png",900,800)?>>
		</br></br><hr></br>
		<p> En arrivant de Restefond ou de Briancon , prennez la digue a votre gauche dès l'entrée de Barcelonnette (direction Digne/Gap) et prennez la 2ème sortie a votre droite.</p>
		<img src="./images/loca30.png" <?php redimage("./images/loca3.png",900,800)?>>
		</br></br><hr></br>
		<p>Avancez quelques mètres , vous trouverz un parking pour vous garer devant la salle</p>
		<img src="./images/loca300.png" <?php redimage("./images/loca3.png",900,800)?>>
		<?php 
		/*	
		<h3> Attention , en raison du froid et de travaux d'isolation à la nouvelle salle , les compétitions et certains entraînements se déroulent a<a href="https://maps.google.fr/maps?q=44.385112,6.659879&amp;num=1&amp;hl=fr&amp;ie=UTF8&amp;t=m&amp;ll=44.379821,6.583557&amp;spn=0.471128,0.878906&amp;z=10&amp;source=embed" target="_black"> l'ancienne salle</a> </h3>
		<br><br><hr><br>
		<h2> Pour la nouvelle salle : nous sommes maintenant au 2bis avenue Ernest Pellotier , quartier craplet !</h2><br><br><br><br>
		<h3 id="loca">1) En arrivant de l'autoroute , de Gap ou de Digne par la D900 , entrez dans Barcelonnette , au 1er rond point prenez la 2ème sortie , puis tournez immédiatement à gauche et au stop encore à gauche.<br><h3>
		<?php $plan1="plan1.gif"; ?>
		<img src=plan1.gif <?php redimage($plan1,900,800)?>>
		<br><br><br><h3 id="test">2) Avancez 50 mètres , vous trouverez un portail ouvert à votre droite.</h3><br><br>
		<?php $plan2="plan2.png"; ?>
		<img src=plan2.png <?php redimage($plan2,900,800)?>>
		<br><br>
		<*/ ?>
		</div>
	</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
	</body>
</html>