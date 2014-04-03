<?php include("menu.php");
if(isset($_POST['supmodif']))
{
		$idM=$_POST['idmodif'];
		$req="delete from creneau where id=$idM";
		$rep=mysql_query($req);
}
if(isset($_POST['modmodif']))
{
		$idM=$_POST['idmodif'];
		$day=$_POST['slctday'];
		$cate=$_POST['slctcate'];
		$h1=$_POST['heurem1'];
		$h10=$_POST['heurem10'];
		$h2=$_POST['heurem2'];
		$h20=$_POST['heurem20'];
		$liberror="";
		$error=false;
		

		if($h10!=0 and $h10!=30)
		{
			$error=true;
			$liberror.="L'heure de début doit être pile (ex 17h00) ou a la demi (ex 17h30).<br>";
		}
		if($h20!=0 and $h20!=30)
		{
			$error=true;
			$liberror.="L'heure de fin doit être pile (ex 17h00) ou a la demi (ex 17h30).<br>";
		}
		if($h10==30)
		{
			$h1=$h1*10+5;
		}
		else
		{
			$h1=$h1*10;
		}
		if($h20==30)
		{
			$h2=$h2*10+5;
		}
		else
		{
			$h2=$h2*10;
		}
		if($h1>=$h2)
		{
			$error=true;
			$liberror.="L'heure de début doit être inferieure a l'heure de fin<br>";
		}
		if($h1<100 or $h1>220)
		{
			$error=true;
			$liberror.="L'heure de début doit être entre 10h et 22h.<br>";
		}
		if($h2<100 or $h2>220)
		{
			$error=true;
			$liberror.="L'heure de fin doit être entre 10h et 22h.<br>";
		}
		if(!$error)
		{

			$req="update creneau set jour='$day' , categorie='$cate' , hdebut=$h1 , hfin=$h2 where id=$idM";
			$rep=mysql_query($req);
			$liberror="Créneau modifié";
		}

}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Horaires - Tennis de table Ubaye</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
<link rel="stylesheet" type="text/css" href="./rangeslider/style.css">
</head>
<body>
<div id="container">
<center><img src="./images/icones/horaire.png"  id="imgDebutPage"/>
<span id="titre">Les Horaires d'entrainement</span></center>

		</br>
		<?php if(isset($_SESSION['root']))
		{ ?>
		</br></br>
		<?php } ?>
	<div style="color:#F72840;margin-left:5%;margin-right:5%">Attention , jusqu'à nouvel ordre les entraînements et les compétitions se déroulent a
	la <a href="localisation.php">salle omnisport</a> de Barcelonnette.<br>
	Les entraînements sont de 18h à 20h , le lundi , mercredi et vendredi.</br>
	Les créneaux ci-dessous ne seront valides que très prochainement!</div>
	<script src="./rangeslider/rangeslider.js"></script>
	<script src="./rangeslider/js/jquery-1.7.2.min.js"></script>
	<script src="./rangeslider/js/jquery-ui-1.8.21.custom.min.js"></script>
	</br><span id="test"></span></br>
	
				<div id="creneau">
				<form method="POST" action="horaires.php#addcreneau" name="formCreneau">
				<div id="days">
				<p style="font-size:20px">Quel(s) jour(s) ?</p>
				<?php 
				$req="select distinct jour from creneau order by rangD";
				$nbRep=0;
				$rep=mysql_query($req);
				while($ligne=mysql_fetch_array($rep))
				{
					

					?>	
					
					<input type="checkbox" class="ckcboxcreneau" id="day" value="<?php echo $ligne['jour'] ?>"<?php if($nbRep==0 or $nbRep==2 or $nbRep==4)	{ ?> checked <?php } ?>> <?php echo $ligne['jour'] ?>
					</br>
					<?php $nbRep++;
				}
				
				
				?>
				</div>
				<div id="cate" >
				<p style="font-size:20px">Quelle(s) catégorie(s) ? </p>
				<?php 
				$req2="select distinct categorie from creneau order by rang";
				$nbRep=0;
				$rep2=mysql_query($req2);
				while($ligne=mysql_fetch_array($rep2))
				{
						$cat=$ligne['categorie'];
						$nbRep++; 
						if($nbRe==5) echo "</br>";
					?>	<input type="checkbox" class="ckcboxcreneau" id="categ" value="<?php echo $ligne['categorie'] ?>" <?php if($cat[1]!='.') { ?>checked <?php } ?>> <?php echo $ligne['categorie'] ?></br><?php 
				}
				
				
				?>
				</div>
				<div id="horaire">
				<p style="font-size:20px">Quelle(s) Horaires(s) ? </p>
				<span style="margin-left:20%;font-size:24px;margin-bottom:3px;"><span id="h1">18h</span> &nbsp;&nbsp;-&nbsp;&nbsp; <span id="h2">20h</span></br></span>
				<div id="slider"></div>
				</div>
				<div id="navMobileCren"></br>
				<span id="contentButtonMoCren1"><center>Heure de début</br>
				<input type="button" class="buttonMobileCreneau" id="moinsCre" value="-"  onclick="lessCren()"><input type="button" id="moinsCre" value="+" class="buttonMobileCreneau" onclick="moreCren()">
				</center></span>
				<span id="contentButtonMoCren1"><center>Heure de fin</br>
				<input type="button" class="buttonMobileCreneau" id="moinsCre" value="-"  onclick="lessCren2()"><input type="button" id="moinsCre" value="+" class="buttonMobileCreneau" onclick="moreCren2()">
				</center></span>

				</div>
				
				<div id="seekCren"><input type="button" name="ajouter" value="Rechercher les créneaux" id="submitButton" onclick="search()"></div>
				</form>
				<div id="goSearch"></div>
				</div>
				</br></br>
				<div id="repcreneauC"></div>
				</br></br></br></br>
	<?php if(isset($_SESSION['root']))
			{
			?>		

				
				
				<div id="addCButton">
				</br></br>
				<label id="submitButton" onclick="addappear()" class="buttonaddcreneau">+ Ajouter un créneau + </label>
				</br></br>
				</div>
				<div id="addcreneau">
				<form method="POST" action="horaires.php#addcreneau" name="formAjoutCreneau">
				<center><h4 style="font-style:italic">Nouveau Créneau</h4></center>
				<div id="addDays">
				<p>Quel(s) jour(s) ?</p>
				<input type="radio" name="addday" id="addday" value="Lundi" checked> Lundi</br>
				<input type="radio" name="addday" id="addday" value="Mardi"> Mardi</br>
				<input type="radio" name="addday" id="addday" value="Mercredi"> Mercredi</br>
				<input type="radio" name="addday" id="addday" value="Jeudi"> Jeudi</br>
				<input type="radio" name="addday"id="addday" value="Vendredi"> Vendredi</br>
				<input type="radio" name="addday" id="addday" value="Samedi"> Samedi</br>
				<input type="radio" name="addday" id="addday" value="Dimanche"> Dimanche</br>			
				</div>
				<div id="addCate" >
				<p>Quelle Catégorie ? </p>
				<input type="radio" name="addcateg" id="addcateg" value="C.E.L 5-7"> C.E.L 5-7</br>
				<input type="radio" name="addcateg" id="addcateg" value=" C.E.L 8-11"> C.E.L 8-11</br>
				<input type="radio" name="addcateg" id="addcateg" value="C.E.L 12-17"> C.E.L 12-17</br>
				<input type="radio" name="addcateg" id="addcateg" value="C.E.L Collège"> C.E.L Collège</br>
				<input type="radio" name="addcateg" id="addcateg" value="C.E.L Lycée"> C.E.L Lycée</br>
				<input type="radio" name="addcateg" id="addcateg" value="Loisirs Jeunes"> Loisirs Jeunes</br>
				<input type="radio" name="addcateg" id="addcateg" value="Loisirs Adultes"> Loisirs Adultes</br>	
				<input type="radio" name="addcateg" id="addcateg" value="Compétition Jeunes"> Compétition Jeunes</br>
				<input type="radio" name="addcateg" id="addcateg" value="Compétition Adultes" checked> Compétition Adultes</br>	
				</div>
				<div id="addHoraire">
				<p>Quelle(s) Horaires(s) ? </p>
				<span id="ha1">10h</span> - <span id="ha2">22h</span></br>
				<div id="slider2"></div></br></br></br>
				</div>
				<center><input type="button" name="ajouter" value="Ajouter un créneau" id="submitButton" onclick="addc()"></center>
				</form>
				</br></br>
				</div>
				</br></br>
				
				<div id="addrep"></div></br></br>
				<div id="addCButton">
				</br></br>
				<label id="submitButton" onclick="modifappear()" class="buttonmodifcreneau">* Modifier un créneau *</label>
				</br></br>
				</div>
				<div id="modifcreneau">
				<?php
				$nbRep=0;
				$req="select * from creneau order by rangD,rang";
				$rep=mysql_query($req);
				while($line=mysql_fetch_array($rep))
				{
								$nbRep++;
								$categ=$line['categorie'];
								$h1=floor(($line['hdebut'])/10);
								$h2=floor(($line['hfin'])/10);
								$h10=0;
								$h20=0;
								if($line['hdebut']%10!=0)
								{
									$h10=30;
								}
								if($line['hfin']%10!=0)
								{
									$h20=30;
								}
								?>
								<center>
								<form name="formModif" method="post" class="modifcreneauform" id="modifcreneauform<?php echo $nbRep?>" action="horaires.php#modifcreneauform<?php echo $nbRep?>">
								<input type="hidden" name="idmodif" value="<?php echo $line['id'] ?>">
								<?php if(isset($_POST['modmodif']) and $idM==$line['id'])
								{
									if($error)
									{
										?><h4 id="infoMail"><?php echo $liberror ?></h4><?php
									}
									else
									{
										?><h4 id="infoMailOk"><?php echo $liberror ?></h4><?php
									}
								}
								?>
					Entrainement le <select name="slctday">
									<option value="Lundi" <?php if($line['jour']=="Lundi") { ?> selected <?php } ?>> Lundi</option>
									<option value="Mardi" <?php if($line['jour']=="Mardi") { ?> selected <?php } ?>> Mardi</option>
									<option value="Mercredi" <?php if($line['jour']=="Mercredi") { ?> selected <?php } ?>> Mercredi</option>
									<option value="Jeudi" <?php if($line['jour']=="Jeudi") { ?> selected <?php } ?>> Jeudi</option>
									<option value="Vendredi" <?php if($line['jour']=="Vendredi") { ?> selected <?php } ?>> Vendredi</option>
									<option value="Samedi" <?php if($line['jour']=="Samedi") { ?> selected <?php } ?>> Samedi</option>
									<option value="Dimanche" <?php if($line['jour']=="Dimanche") { ?> selected <?php } ?>> Dimanche</option>
									</select >
									
									
					pour les <select name="slctcate"><?php $r2="select distinct categorie from creneau order by rang";
									$rp2=mysql_query($r2);
									while($ligne=mysql_fetch_array($rp2))
									{
										$cat=$ligne['categorie'];
									?><option value="<?php echo $cat ?>" <?php if($cat==$categ) { ?> selected <?php } ?>><?php echo $cat ?></option>
<?php 
									}
									?></select>
									 de <input type="text" value="<?php echo $h1 ?>" size=2 name="heurem1" >h<input type="text" size=2 value="<?php echo $h10 ?>" id="heurem1" name="heurem10" >
									à <input type="text" value="<?php echo $h2 ?>" size=2 name="heurem2" >h<input type="text" size=2 value="<?php echo $h20 ?>" id="heurem1" name="heurem20" >								 
									</br></br></br><input type="submit" id="submitButtonModif" name="modmodif" value="Modifier">
									<input type="submit" id="submitButtonSupprimer" name="supmodif" value="Supprimer">	


									
									</form>
									</br><hr></br>
									<center>
									<?php
					
				}
				
				?>
				</div>


				
				
				
				
			
			<?php
			}
			if(!(isset($_POST['modmodif']) or isset($_POST['supmodif'])))
			{
				?><script> $("#modifcreneau").hide(); </script><?php
			}
			if(isset($_POST['modmodif']))
			{
				?><script> $(".buttonmodifcreneau").text("Cacher"); </script><?php			}

	?>
	


</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
</body>
</html>

