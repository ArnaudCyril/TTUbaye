<?php include ("parametres.php");
$hour=date("m");


$temp=$_SERVER['PHP_SELF'];// a changer sur le vrai site
$page="";$taille=strlen($_SERVER['PHP_SELF']);
for($i=1;$i<$taille;$i++)
{
	$page.=$temp[$i];
}
$id1="";$id2="";$id3="";$id4="";$id5="";
if($page=="index.php" or $page=="news.php")$id1="id='menuActive'";
if($page=="itineraire.php" or $page=="actualites.php"  or $page=="localisation.php" or $page=="membres.php" or $page=="organisation.php" or $page=="about.php")$id2="id='menuActive'";
if($page=="horairesL.php" or $page=="challenge.php" or $page=="tarifL.php")$id4="id='menuActive'";
if($page=="upload.php" or $page=="getmdp.php" or $page=="contact.php" or $page=="moncompte.php" or $page=="connexion.php" or $page=="deconnexion.php" or $page=="bug.php" or $page=="forum.php" or $page=="creercompte.php" or $page=="sujetForum.php")$id5="id='menuActive'";
if($id1=="" and $id2=="" and $id4=="" and $id5=="")$id3="id='menuActive'";

?>        
<html>
	<head>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-41903339-1', 'ttubaye.com');
  ga('send', 'pageview');

</script>

		<link type="text/css" rel="stylesheet" media="screen" href="styleTTU.css"/>
		<link type="text/css" rel="stylesheet" media="screen and (min-width: 1200px) and (max-width:1560px)" href="styleTTU2.css"/>
		<link type="text/css" rel="stylesheet" media="screen and (max-width:1200px)" href="styleMobileTTU.css"/>

		
	<!--[if IE]>
  Ici votre code HTML réservé à IE.
<![endif]-->

		<meta name="viewport" content="width=device-width">
	
		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js'/></script>
		<script text='text/javascript' src="./jquery/menu.js"></script>
		<link href="./css/style.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="./jquery/titrediapo.js"></script>
		<link href="./css/component.css" rel="stylesheet" type="text/css" />
		<link href="./jquery/lightbox.css" rel="stylesheet" type="text/css" />
        <script src="./jquery/modernizr.custom.js"></script>
        <script src="./jquery/jquery-1.10.2.min.js"></script>
		<script src="./jquery/lightbox-2.6.min.js"></script>
		
		<link rel="SHORTCUT ICON" href="./favicon2.ico" />
		<script type="text/javascript" src="menu.js"></script>
	</head>
	<body>

		<div id="headerMobile">
		
		<span id="btnMenu"><img src="menu.png" width="40px" height="40px"> Menu -<span style="color:#fff"> TT</span><span style="color:#aaa">Ubaye</span></span> 
		
		
		<div id="menuMobile">
		  <div id="itemMenu"><a href="index.php" ><img src="./images/icones/home.png" id="imgSubmitBtm" /> Accueil</a></div>
         <div id="itemMenu"><a href="#" id="LienMenuClub"><img src="./images/icones/club.png" id="imgSubmitBtm" /><span id="itemMenuTxtClub"> &#9654; Le club</span></a></div>
		 <div id="menuMobileClub">
						<div id="itemSSMenu"><a href="actualites.php"><img src="./images/icones/news.png" id="imgSubmitBtm" /> Actualités</a></div>
						<div id="itemSSMenu"><a href="membres.php"><img src="./images/icones/membre.png" id="imgSubmitBtm" /> Membres</a></div>
						<div id="itemSSMenu"><a href="itineraire.php"><img src="./images/icones/intineraire.png" id="imgSubmitBtm" /> Itineraire</a></div>
                        <div id="itemSSMenu"><a href="localisation.php"><img src="./images/icones/localisation.png" id="imgSubmitBtm" />Localisation</a></div>
						<div id="itemSSMenu"><a href="about.php"><img src="./images/icones/histoire.png" id="imgSubmitBtm" /> A propos</a></div>
                        <div id="itemSSMenu"><a href="organisation.php"><img src="./images/icones/organisation.png" id="imgSubmitBtm" /> Organisation</a></div>
		  </div>
		  
          <div id="itemMenu"><a href="#" id="LienMenuCompet"><img src="./images/icones/compet.png" id="imgSubmitBtm" /><span id="itemMenuTxtCompet"> &#9654; Compétition</span></a></div>
		  <div id="menuMobileCompet">
                          <div id="itemSSMenu"> <a href="equipes.php"><img src="./images/icones/equipe.png" id="imgSubmitBtm" /> Les Equipes</a></div>
                           <div id="itemSSMenu"><a href="resultatsR.php"><img src="./images/icones/calendrier.png" id="imgSubmitBtm" />  Calendrier / Résultats</a></div>
						   <div id="itemSSMenu"><a href="tarifC.php"><img src="./images/icones/tarif.png" id="imgSubmitBtm" />  Tarifs</a></div>
	
						   <div id="itemSSMenu"><a href="horaires.php"><img src="./images/icones/horaire.png" id="imgSubmitBtm" /> Entrainement</a></div>
						    <div id="itemSSMenu"> <a href="evenement.php"><img src="./images/icones/event.png" id="imgSubmitBtm" /> Evénements</a></div>
						   <div id="itemSSMenu"><a href="progression.php"><img src="./images/icones/progression.png" id="imgSubmitBtm" />  Progression</a></div>
						   <div id="itemSSMenu"><a href="calcul.php"><img src="./images/icones/calcul.png" id="imgSubmitBtm" />  Calculez vos points</a></div>
			</div>			   
		<div id="itemMenu"><a href="#" id="LienMenuLoisir"><img src="./images/icones/loisir.png" id="imgSubmitBtm" /><span id="itemMenuTxtLoisir"> &#9654; Loisir</span></a></div>
		  <div id="menuMobileLoisir">
						   <div id="itemSSMenu"><a href="tarifL.php"><img src="./images/icones/tarif.png" id="imgSubmitBtm" /> Tarifs</a></div>
						   <div id="itemSSMenu"><a href="horaires.php"><img src="./images/icones/horaire.png" id="imgSubmitBtm" /> Entrainement</a></div>
						  <div id="itemSSMenu"><a href="challenge.php"><img src="./images/icones/progression.png" id="imgSubmitBtm" /> Challenge du club</a></div>

			</div>			   
		  <div id="itemMenu"><a href="#" id="LienMenuAutres"><img src="./images/icones/autres.png" id="imgSubmitBtm" /><span id="itemMenuTxtAutre"> &#9654; Autres</span></a></div>
		  <div id="menuMobileAutres">
                     <div id="itemSSMenu"><a href="contact.php"><img src="./images/icones/contact.png" id="imgSubmitBtm" /> Contact</a></div>
					 <div id="itemSSMenu"><a href="forum.php"><img src="./images/icones/forum.png" id="imgSubmitBtm" /> Forum</a></div>

                       <div id="itemSSMenu"><a href="upload.php"><img src="./images/icones/photo.png" id="imgSubmitBtm" /> Photos</a></div>
					   	<?php if(empty($_SESSION['modif2']) and (empty($_SESSION['modif'])) and (empty($_SESSION['loginM'])) and (empty($_SESSION['root'])))
						{
							?><div id="itemSSMenu"><a href="connexion.php"><img src="./images/icones/connexion.png" id="imgSubmitBtm" /> Connexion</a></div><?php
	
						}
						else
						{
						 ?>
						  <div id="itemSSMenu"><a href="moncompte.php"><img src="./images/icones/compte.png" id="imgSubmitBtm" /> Mon Compte</a></div>
						<div id="itemSSMenu"><a href="deconnexion.php"><img src="./images/icones/deconnexion.png" id="imgSubmitBtm" /> Deconnexion</a></div>
						<?php
						} ?>

			</div>	
        </div>
		</div>
		
		<?php /* fin menu Mobile */ ?>
		<?php /**/?>
		<?php /* debut menu Ordi */ ?>
		<div id="headerMenu" >
		<a href="/"><span id="MenuName">TT<span style="color:#5996F7">Ubaye</span></span></a>
		<ul id="menu">
 
        <li >
                <a href="index.php"  <?php if($id2!=""){echo 'style="border:none;"';}if($id1!="") echo 'style="color:black;border:none;};"'; echo $id1 ; ?>><img src="./images/icones/home.png" width="20px" height="20px" /> Accueil</a>
        </li>
        <li >
                <a href="#"  <?php echo $id2  ;if($id3!=""){echo 'style="border:none;"';} if($id2!="")  echo 'style="color:black;border:none;width:152px;height:55px;"'?>><img src="./images/icones/club.png" width="26px" height="26px" style="vertical-align:middle;"/> Le Club</a>
                <ul <?php if($id2!=""){echo 'id="ulActive"';} else{echo 'id="ulNonActive"';} ?>>
						<li id="headerMenuTop"><a href="actualites.php"><img src="./images/icones/news.png" width="26px" height="26px" style="vertical-align:-5px;"/>&nbsp; Actualités</a></li>
						<li ><a href="membres.php"><img src="./images/icones/membre.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Membres</a></li>
						<li><a href="itineraire.php"><img src="./images/icones/intineraire.png" width="26px" height="26px" style="vertical-align:-5px;"/>&nbsp; Itineraire</a></li>
                        <li ><a href="localisation.php"><img src="./images/icones/localisation.png" width="26px" height="26px" style="vertical-align:-5px;"/>&nbsp;Localisation</a></li>
						<li><a href="about.php"><img src="./images/icones/histoire.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; A propos</a></li>
						<li id="headerMenuDown"><a href="organisation.php"><img src="./images/icones/organisation.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Organisation</a></li>

                </ul>
        </li>
         
        <li >
                <a href="#"  <?php echo $id3  ;if($id4!=""){echo 'style="border:none;"';} if($id3!="") echo 'style=";height:55px;color:black;border:none"'?>><img src="./images/icones/compet.png" width="26px" height="26px" style="vertical-align:middle;"/> Compétition</a>
                <ul <?php if($id3!=""){echo 'id="ulActive"';} else{echo 'id="ulNonActive"';} ?>>
                        <li id="headerMenuTop">
                                <a href="equipes.php"><img src="./images/icones/equipe.png" width="26px" height="26px" style="vertical-align:-5px;"/>&nbsp; Les Equipes</a>
									
                        </li>
                        <li>
                                <a href="resultatsR.php"><img src="./images/icones/calendrier.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Calendrier / Résultats</a>
						</li>		
								<li><a href="tarifC.php"><img src="./images/icones/tarif.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Tarifs</a></li>
								<li><a href="horaires.php"><img src="./images/icones/horaire.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Horaires d'entrainement</a></li>
								<li><a href="evenement.php"><img src="./images/icones/event.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Evénements</a></li>
								
								<li><a href="progression.php"><img src="./images/icones/progression.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Progression</a></li>
								<li><a href="calcul.php"><img src="./images/icones/calcul.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Calculez vos points</a></li>
                        
                </ul>
        </li >
         
        <li>
                <a href="#"  <?php echo $id4  ;if($id5!=""){echo 'style="border:none;"';} if($id4!="") echo 'style=";height:55px;color:black;border:none"'?>><img src="./images/icones/loisir.png" width="26px" height="26px" style="vertical-align:middle;"/> Loisirs</a>
                <ul <?php if($id4!=""){echo 'id="ulActive"';} else{echo 'id="ulNonActive"';} ?>>
                        <li id="headerMenuTop"><a href="tarifL.php"><img src="./images/icones/tarif.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Tarifs</a></li>
                        <li ><a href="horairesL.php"><img src="./images/icones/horaire.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Horaires d'entrainement</a></li>
					    <li id="headerMenuDown"><a href="challenge.php"><img src="./images/icones/progression.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Challenge du club</a></li>

			   </ul>
        </li>
         
        <li>
                <a href="#"  <?php echo $id5  ; if($id5!="") echo 'style=";height:55px;color:black;border:none"'?>><img src="./images/icones/autres.png" width="26px" height="26px" style="vertical-align:-5px;"/> Autres</a>
                <ul <?php if($id5!=""){echo 'id="ulActive"';} else{echo 'id="ulNonActive"';} ?>>
						
                        <li id="headerMenuTop"><a href="contact.php"><img src="./images/icones/contact.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Contact</a></li>
              			<li><a href="forum.php"><img src="./images/icones/forum.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Forum</a></li>
						<li ><a href="upload.php"><img src="./images/icones/photo.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Photos</a></li>
						
						
                        <li id="headerMenuDown">
						<?php if(empty($_SESSION['modif2']) and (empty($_SESSION['modif'])) and (empty($_SESSION['loginM'])) and (empty($_SESSION['root'])))
						{
							?><a href="connexion.php"><img src="./images/icones/connexion.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Connexion</a><?php
	
						}
						else
						{
						 ?>
						<a href="moncompte.php"><img src="./images/icones/compte.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Mon Compte</a>
						<a href="deconnexion.php"><img src="./images/icones/deconnexion.png" width="22px" height="22px" style="vertical-align:-5px;"/>&nbsp; Deconnexion</a>
						<?php
						} ?></li>
                </ul>
        </li>
         
		</ul>
		<a href="http://www.ubaye.com/" target="_blanck"><img id="logoUbaye" src="./images/ubaye.png"/></a>

		
		
		<?php
		
		if(isset($_SESSION['loginM']))
		{
			$login=$_SESSION['loginM'];
			if($login=="trenss")
			{
				?><p id="lien"><font color="000">TRENS Sabine</font><p> <?php
			}
			else
			{
			
				$res=mysql_query("select * from membres where loginM='$login';");
				$nbResult=mysql_num_rows($res);
				if($nbResult!=0)
				{
					while($maLigne=mysql_fetch_array($res))
					{
						$nom=$maLigne['nom'];
						$prenom=$maLigne['prenom'];
						$licence=$maLigne['licence'];
					}
		
					?>
					<a id="lien" href="infoMembre.php?membre=<?php echo $licence;?>" class="head"><?php echo "   ".$nom."  ".$prenom;?></a>
					<?php
				}
				else
				{
					?>
					
					<span id="lien"><?php echo $_SESSION['loginM']?></span>
					<?php
				}
			}
		}
		if(isset($_SERVER["HTTP_REFERER"]) and ($_SERVER["HTTP_REFERER"]!="http://ttubaye.com/connexion.php") and ($_SERVER["HTTP_REFERER"]!="http://www.ttubaye.com/connexion.php") )
		{
			$_SESSION['prevent']=$_SERVER["HTTP_REFERER"] ;
		}
		?>
		</div>
		</div>
	</body>
</html>