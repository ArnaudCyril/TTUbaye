<?php include("menu.php");?>
<html>
	<head>
		<title>Calcul - Tennis de table Ubaye</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
	
</head>
		
	<head>
	<body>
	<div id="container">
		<center><img src="./images/icones/calcul.png" id="imgDebutPage"/>
		<span id="titre"> Calculez vos points</span><br><br><br><br></center>
		<div id="adversaire">
		 <select name="selectComptet" id="selectCalcul" onchange="buildRow(this.value)" >
		 
		 
		<option value="-1">Selectionnez la comptétition : </option>
		<option value="1">Match de Championnat (3 matchs)</option>
		<option value="6">Match de Championnat (4 matchs)</option>
		<option value="2">Criterium Fédéral Sénior</option>
		<option value="3">Criterium Fédéral Jeune</option>
		<option value="4">Finale Individuelle/Par Classement</option>
		<option value="5">Tournoi / Interclub</option>
		</select>
		</br>
		</br><a href="membres.php" target="_blank" title="Les points de votre situation mensuelle , pour le membres du club cliquez ici pour les connaître">Mes points : </a><input type="text" id="mespoints" class="inputCalcul" placeholder="ex:843"/></br></br>
	
		
		<div id="contentAdv"></div>
				<p> 
		            <span id="submitButton">+ Adversaire</span>
				</p>


			<p class="alignRight">
			</br>
			<center><input type="submit" name="action" value="Calculer" id="submitButtonModif" onclick="calculer()" style="padding:5px 45px;"/></center>
			</p>		
		</div>

		<div id="reponseCalcul"></div>
		<br><hr><br>
		<div id="tipCalcul">
		<h4>Si vous etes membre du club , vous pouvez voir vos point  <a href="membres.php" target="_blank">ici</a></h4>
	<h4>Vous pouvez aussi consulter la grille de calcul des points <a href="http://www.fftt.com/sportif/pclassement/html/grille.htm" target="_blank">ici</a></h4>
		</div>
		</div>
		<script text='text/javascript' src="./jquery/calcul.js"></script>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
		</body>
		</html>