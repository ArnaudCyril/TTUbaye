<?php include('menu.php');?>
<html>
<head>
<title>Resultats D3 - Tennis de table Ubaye</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
</head>
	<body>
	<div id="container">
	<center><img src="./images/icones/membre.png"  id="imgDebutPage"/>
	<span id="titre"> La Départementale 3</span>
	<br><br>
                <a href="resultatsR.php" id="optionNav">Regionale 2 - Equipe 1</a>			
				<a href="resultatsR2.php" id="optionNav">Regionale 2 - Equipe 2</a>			
                <a href="resultatsD1.php" id="optionNav">Départementale 1</a>
                <a href="resultatsD3.php" id="optionNav">Départementale 3</a> 
		<br><br><br><br>
		<!-- ne pas toucher , on s'en sert pour les évenement -->
<div id="iframeOrdi"><iframe id="iframe"   src="http://www.fftt.com/sportif/chpt_equipe/chp_div.php?D1=38779&epreuve=1073" width="1000" height="1100"></iframe></div>
<div id="iframeMobile"><iframe width="98%" src="http://www.fftt.com/monclub/spid_consultation/chp_div.php?D1=38779&epreuve=1073"  height="1100"></iframe></div>	
	</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
</body>
</html>