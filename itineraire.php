<?php include("menu.php");?>
<html>
<head>
<title>Itinéraire - Tennis de table Ubaye</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
 <link rel="stylesheet" href="./iti/jquery-ui-1.8.12.custom.css" type="text/css" /> 

  <style type="text/css">

    #container h1{margin:0px 0px 10px 20px;}
    #container #map{width:96%;height:580px;margin:auto;padding-top:10px;}
    #container #panel{margin-left:10%;margin-right:10%;}
    #container #destinationForm{margin:0px 0px 00px 0px;background:#f5f5f5;padding:30px 20px 6px 20px;}
    #container #destinationForm input[type=text]{border:solid 1px #C0C0C0;}
  </style>
  <style type="text/css">
@media print {
  #headerMenu *{
    display:none;
  }
   #headerMobile *{
    display:none;
  }
   #footer *{
    display:none;
  }

 #hideprint *{
    display:none;
  }
}
</style>
</head>
<body>
<div id="container">

<center><img src="./images/icones/intineraire.png" id="imgDebutPage" /><span id="titre">&nbsp; Itinéraire</span></center>
</br></br></br>
		<div id="contentIti">
		<span id="hideprint">
        <div id="destinationForm">
		
            <form action="" method="get" name="direction" id="direction">
			
				<label id="goHere">Point de départ :</label><input type="text" name="origin" id="origin" class="inputIti">&nbsp;&nbsp;<label>Destination :</label><input type="text" name="destination" id="destination" value=" Salle du TTU" class="inputIti" disabled="true">&nbsp;&nbsp;<span id="for1200"></br></span><input type="button" value="Calculer l'itinéraire" id="submitButtonModif" onclick="javascript:calculate()"></span>
				</br></br>
				<span ><!--Compétition : Championnat<INPUT type="radio" onchange="initialize()" id="destinationHidden" name="choix" value="44.384805,6.659784" class="buttonCalcul" checked ><!--44.38788,6.640369 -->
				<!--&nbsp;&nbsp;&nbsp;Criterium Fédéral , Finales ...<INPUT type="radio" onchange="initialize()" id="destinationHidden" name="choix" value="44.384805,6.659784" class="buttonCalcul">
				--><a id="submitButton" href="localisation.php" style="float:right">La fin du trajet en photos </a></br></span>
				<?php /*<span id="for1200"><!--Compétition : Championnat<INPUT type="radio" onchange="initialize()" id="destinationHidden" name="choix" value="44.384805,6.659784" class="buttonCalcul" checked ><!--44.38788,6.640369 -->
				<!--&nbsp;&nbsp;&nbsp;Criterium Fédéral , Finales ...<INPUT type="radio" onchange="initialize()" id="destinationHidden" name="choix" value="44.384805,6.659784" class="buttonCalcul">
				</br>--></br><a id="submitButton" href="localisation.php" style="float:left">La fin du trajet en photos </a></br></span>
				*/ ?>
				
            </form>
        </div>
		<div id="map">
		   <p>Veuillez patienter pendant le chargement de la carte...</p>
        </br>
		</div>
		</br>
		<a href="javascript:window.print()" title="Imprimer l'Itinéraire" style="display:none;margin-left:10px;" id="printIti"><img width="40px" height="40px" src="./images/icones/print.png"/></a>
		</span>
        <div id="panel"></div>
		</div>

</div>
    <script type="text/javascript" src="./iti/jquery.min.js"></script>
    <script type="text/javascript" src="./iti/jquery-ui-1.8.12.custom.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=fr"></script>
    <script type="text/javascript" src="./iti/functions.js"></script>

<a href="#" class="back-to-top" >&#9650;</a>
<?php include 'footer.php' ?>
</span>
</body>
</html>
