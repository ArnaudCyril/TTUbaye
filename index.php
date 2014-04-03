<?php include('menu.php');
function redimage($img_src,$dst_w,$dst_h) {
   // Lit les dimensions de l'image
   $size = GetImageSize($img_src);  
   $src_w = $size[0]; $src_h = $size[1];
   // Teste les dimensions tenant dans la zone
   $test_h = round(($dst_w / $src_w) * $src_h);
   $test_w = round(($dst_h / $src_h) * $src_w);
   // Si Height final non pr�cis� (0)
   if(!$dst_h) $dst_h = $test_h;
   // Sinon si Width final non pr�cis� (0)
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
<meta name="viewport" content="width=device-width">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
<META http-equiv="Content-Type" Content="text/html; charset=ISO-8859-15">
<META NAME="description" CONTENT="Club de tennis de table situ� a Barcelonette , dans la vall�e de l'ubaye"> 
<META NAME="keywords" CONTENT="ttu, ttubaye, TTU, TTUBAYE , tennis, de , table , tennis de table , ping , pong , Ubaye , ubaye , Barcelonnette, barcelonnette , barcelo , jausiers , pons , thuiles , meolans , condamine"> 
<title>Accueil - Tennis de table Ubaye</title>
	<script type="text/javascript" src="./jquery/creatediapo.js"></script>
<script type="text/javascript" src="./jquery/scroll.js"></script>
</head>
<BODY>

	<div id="container">

	<center><img src="./images/icones/home.png" id="imgDebutPage" /><span id="titre"> Accueil</span></center></br>
	
	<span id="hide_mobile"></br></br></br></br></span>
	
	<img src="./images/club.jpg" id="imgPresentation" <?php redimage("./images/club.jpg",600,600) ?> >
	<div id="hide_ordi">&nbsp;</div>
	<p id="presentation">
	Le TT Ubaye est le club de tennis de table de Barcelonnette et de toute la vall�e de l'Ubaye 
	<a href="itineraire.php"> situ� </a>au nord du d�partement des Alpes de haute provence (04).</br></br>
	L'esprit du club est simplement de jouer au tennis de table dans la bonne humeur et sans se prendre la t�te , tout en gardant un minimun de s�rieux et d'application.</br>
	</br>Alors que vous soyez jeune o� ag� , d�butant o� joueur confirm� , que vous cherchiez juste un loisir amusant ou que vous ayez une r�elle envie de progresser ,
	n'h�sitez pas � prendre <a href="contact.php">contact </a> avec nous pour nous rejoindre</br></br>
	N'h�sitez pas non plus � passer � la <a href="localisation.php">salle</a> pour des rensiegnements o� des s�ances d'essai</br></br>
	</br>Le club dispose de plusieurs <a href="horaires.php">cr�neaux d'entra�nements </a>adapt�s � votre �ge (pour les plus jeunes) et � votre niveau , et d'un entra�neur qui saura vous faire progresser � votre rythme.</br> 


</p>
	
		
</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
</BODY>
</html>