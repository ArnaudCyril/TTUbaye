<?php include ("menu.php");
$compteur=1;

//////////////////////////////
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_YouTube');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');

/**
 * Obtenir le droit d'upload vers un compte YouTube
 * L'objet créer sera utilisé pour l'instanciation d'un nouveau objet Youtube 
 */
$authenticationURL = 'https://www.google.com/accounts/ClientLogin';
$httpClient = Zend_Gdata_ClientLogin::getHttpClient('adressemail','mot de passe','youtube',null,null,null,null,$authenticationURL);


/**
 * Créer un objet Youtube (Zend_Gdata_YouTube)
 * Créer un objet vidéo (classe Zend_Gdata_YouTube_VideoEntry)
 * Récupérer un "Token" qui est une clé d'autorisation temporaire retournée par Youtube (clé + url)
 * Construire le formulaire d'upload avec les informations du Token
 */
 
	 $developerKey = 'AI39si5dBU5a1aAqQrncrFMhqOA0hUzKEpZuNzRouAWIKUXXKOuO8HYZLyKIwUtbJBevxX_iLfaUsTgqKy8B7UO91vWe08pWUg';
	  //$developerKey = 'AI39si4nxAtUaBDGWlFM-0tIt_v2UAh_k3VU4pWvBa1U8CUEiztgMRlJk0HXDg-ayYrfrAOYM79q3G19FY0D_ejx1S4555vdSw';
	  $yt = new Zend_Gdata_YouTube($httpClient,null,null,$developerKey);
$titreV='TTUbaye ';
if(isset($_POST['getInfosVideo']))
{
	if(strlen($_POST['getInfosVideo'])>1)
	{
		$titreV.="- ";
		$titreV.=$_POST['videoName'];
	}
}
$myVideoEntry = new Zend_Gdata_YouTube_VideoEntry();
$myVideoEntry->setVideoTitle($titreV);
$myVideoEntry->setVideoDescription('Vidéo du site ...');
$myVideoEntry->setVideoCategory('Sports'); // catégorie valide voir doc Youtube 
$myVideoEntry->SetVideoTags('test, php upload'); // mots clés

$tokenHandlerUrl = 'http://gdata.youtube.com/action/GetUploadToken';
$tokenArray = $yt->getFormUploadToken($myVideoEntry, $tokenHandlerUrl);
$tokenValue = $tokenArray['token'];
$postUrl = $tokenArray['url'];

	$id=$_SERVER["REQUEST_URI"];
	$stop=0;
	for($i=0;$i<strlen($id);$i++)
	{
		if($id[$i]=="=")
		{
			$stop=$i;
		}
	}
	if(strlen($id)>12)
	{
		$id=substr($id,$stop+1,strlen($id));
		$req2="select * from tempvideo;";
		$rep2=mysql_query($req2);
		while($l2=mysql_fetch_array($rep2))
		{
			$idPost=$l2['id'];
			$titreVideo2=$l2['titre'];
		}
		$description='Video Youtube - '.$id;
		//if(strlen($id)>7)
		//{
			$req3="insert into media values($idPost,'$description','$titreVideo2','$id',null)";

			$rep3=mysql_query($req3);
		//}
		$req4=mysql_query("delete from tempvideo");
		
	}
	


// URL où rediriger après traitement de la vidéo par Youtube (= réponse Youtube) :
$nextUrl = 'http://ttubaye.com/upload.php'; 
if(isset($_POST["action"]))
{
			
		
		$login=$_SESSION['loginM'];		
		$album=$_POST["legende"];
		$concerne=$_POST["concern"];
		$lastId=$_POST["ranger3"];
		$date=date("20y-m-d");	
			if(isset($_FILES['uploads']["name"][0]) and ($_FILES['uploads']["name"][0]!=""))
			{ 
			
				$count=1;$i=0;
				$dossier="./upload/photo/";			 
				mkdir($dossier."PhotoUpload_".$lastId."_".$date, 0755);			
				$dossier=$dossier."PhotoUpload_".$lastId."_".$date."/";
				chmod($dossier, 0755);
				foreach ($_FILES['uploads']['tmp_name'] as $file) 
				{

					$name=$dossier.$_FILES['uploads']['name'][$i];
					
					$name=str_replace('é','e',$name); 
					$name=str_replace('è','e',$name); 
					$name=str_replace('à','a',$name); 
					$name=str_replace('@','a',$name); 
					$name=str_replace('ê','e',$name); 
					$name=str_replace('ë','e',$name); 
					$name=str_replace('ù','u',$name); 
					$name=str_replace('&','+',$name); 
					$name=str_replace('ç','c',$name); 
					if(copy($file,$name))
					{
						$type=getTypeP($name);
						if($type=="jpg" or $type=="jpeg" or $type=="JPG"){	$source = imagecreatefromjpeg($name); }// La photo est la source
						if($type=="png" or $type=="PNG"){	$source = imagecreatefrompng($name); }// La photo est la source
						
						if(imagesx($source)>1000 or imagesy($source)>1000)
						{
							$destination = imagecreatetruecolor(redimage3($name,1000,1000) , redimage4($name,1000,1000)); // On crée la miniature vide

							// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
							$largeur_source = imagesx($source);
							$hauteur_source = imagesy($source);
							$largeur_destination = imagesx($destination);
							$hauteur_destination = imagesy($destination);

							imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

							if($type=="jpg" or $type=="jpeg" or $type=="JPG")imagejpeg($destination, $name);
							if($type=="png" or $type=="PNG")imagepng($destination, $name);
						}
						$req="insert into media values ($lastId,'$name','".apo($album)."',null,'$concerne')";
						$rep=mysql_query($req);
						$Ndossier=getDossier($name);
						creaMini($name,$Ndossier);
						$req2="insert into vignette values ('$Ndossier','".apo($album)."','$name','$concerne',$lastId)";
						$rep2=mysql_query($req2);
						$i++;
						$count++;
					}
					else
					{
					echo "Erreur de l'insertion de la photo ".$count;
					}
				}
			}


		
	
}
?>
<html>
<head>
<title>Album - Tennis de table Ubaye</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
<script src="./jquery/geremedia.js"></script>
<script type="text/javascript" src="./jquery/affichety.js"></script>
</head>
<body>
<div id="container">
<center><img src="./images/icones/photo.png"  id="imgDebutPage"/><span id="titre"> Album photo</span><br><br><br><br></center>
<?php if(isset($_SESSION['loginM']))
{


///////////////////// 
?>

	<span id="divError"></span>
				<span onclick="afficheForm()" id="addVideo">Ajouter une Vidéo <img src="./images/icones/yt.png" width="50" height="50" style="vertical-align:-13px"></span>
				<span onclick="afficheForm2()" id="addPhotos">Ajouter une Photo <img src="./images/icones/addphoto.png" width="50" height="50" style="vertical-align:-13px"></span>
				</br></br></br></br></br>
				<div id="formYt" >
					<form action="upload.php" method="POST">
			
					<?php if(isset($_POST['getInfosVideo']))
					{
						?><p>Titre de la vidéo : <?php echo $_POST['videoName'] ?></p>
						<input type="hidden" id="videoNa" value="<?php echo $_POST['videoName'] ?>">
						<p>Article concerné : <?php
							$post="";
							$myId=$_POST['ranger2'];
							if($myId!=-1)
							{
								$rep=mysql_query("select * from messages where id=$myId");
								$lign=mysql_fetch_array($rep);
								echo $lign['title']." - ".date("d/m/Y", strtotime($lign['dateN']));
								$post=$lign['title']." - ".date("d/m/Y", strtotime($lign['dateN']));
							}
							else{
								echo "Aucun";
								$post="Aucun";
								}
							?></p>

							<input type="hidden" id="related" value="<?php echo $_POST['ranger2']; ?> ">
							<?php
							}
							else{ ?>
								<p>Titre de la vidéo : <input type="text" name="videoName" id="videoName"> (en cas d'upload)</p>
								Article concerné : 
								<select name="ranger2" id="dropdown">
								<option value="-1">Aucun</option>
								<?php
								$rep=mysql_query("select * from messages where statut=0 order by id desc");
								while($ligne=mysql_fetch_array($rep))
								{
									?><option value="<?php echo $ligne["id"]?>"><?php echo $ligne['title']." - ".date("d/m/Y", strtotime($ligne['dateN'])) ?></option><?php
								}
								?>
								</select>
								
								<input value="Continuer" name="getInfosVideo"  type="submit" id="submitButton" />
								
						<?php } ?>
						</form>
						<?php if(isset($_POST['getInfosVideo']))
						{ ?>
						<form id="ytform" action="<?php echo $postUrl; ?>?nexturl=<?php echo $nextUrl; ?>" method="post"  enctype="multipart/form-data"> 
						<input name="file" type="file" id="inputFile" /> 
						<input name="token" type="hidden" value="<?php echo $tokenValue; ?>"/>
						</br><h4>OU</h4></br>
							Donnez le lien de la vidéo youtube : <input type="text" name="linkgiven" id="linkgiven"></br>
						<input value="Envoyer la vidéo" name="action"  type="button" class="buttonSent" id="submitButton" onclick="getRelatedPost()" /></br>
						</form>

						<?php } ?>
						<span id="load"></br>Upload en cours... <img src="/images/loading.gif" width="150" height="150" style="vertical-align:-65px"></br><p>Cela peut prendre quelques minutes..</p></span>
						
						<script>$("#load").hide();  </script>
						<?php if(empty($_POST['getInfosVideo']))
						{ ?>
						<script>$("#formYt").hide();  </script>
						<?php } ?>
						<script src="./jquery/progressbar.js"></script>
						</br>
			</div>
		<!-- //////////////////////////////////// -->
			<div id="addPhoto">
			<form id="addtof" name="New" action="upload.php" method="POST" enctype="multipart/form-data" >
			Photo(s) : <input type="file" name="uploads[]" multiple id="addtof"></br>
			Titre de la photo / de l'album : <input type="text" name="legende" id="addalbum"/></br>	
			Article concerné : 
			<select name="ranger3" id="dropdown">
					<option value="-1">Aucun</option>
			<?php
					$rep=mysql_query("select * from messages where statut=0 order by id desc");
					while($ligne=mysql_fetch_array($rep))
					{
						?><option value="<?php echo $ligne["id"]?>"><?php echo $ligne['title']." - ".date("d/m/Y", strtotime($ligne['dateN'])) ?></option><?php
					}
					
			?>
			</select></br> Compétition : 
						<input type="radio" name="concern" value="equipes" checked>Championnat (par equipes)
						<input type="radio" name="concern" value="indiv"> Individuelle
						<input type="radio" name="concern" value="autre"> Ne concerne pas une compétition : 
						  </br>
			<input type="submit" name="action" value="Envoyer" id="submitButton"></br>
			</form>
			
			<div class="progress">
			<div class="bar"></div >
			<div class="percent">0%</div >
			</div>
			<script src="http://malsup.github.com/jquery.form.js"></script>
			<script src="./jquery/progressbar.js"></script>
			</br>
			</div>
			<script>$("#addPhoto").hide();  </script>
			<script src="./jquery/progressbar2.js"></script>
									</br></br>
			
<?php

}

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
function redimage3($img_src,$dst_w,$dst_h) {
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
   return($dst_w);
  
}
function redimage4($img_src,$dst_w,$dst_h) {
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
   return($dst_h);
  
}
function apo($s1)
{
  $s1 = trim($s1); // enleve les espaces autour  
  $s1 = trim($s1, "\xA0" ); // enleve les nbsp autour  
  $s1 = stripslashes($s1); // enleve les slashs avant les apostrophes, etc.  
  $s1 = str_replace("'", "''", $s1); // remplace les guillemets  
  // supprime les caractères non imprimables (null, tab, backspace, ...)  
  $s2 = "";
  for ($i = 0; $i < strlen($s1); $i++) {
     $c = substr($s1, $i, 1);
     if (ord($c) >= 32)
        $s2 .= $c;
  }
  return($s2);
}
function getTypeP($photo)
{
	$stop=0;
	for($i=0;$i<strlen($photo);$i++)
	{
		if($photo[$i]=='.')
		{
			$stop=$i;
		}
	}
	$ext=substr($photo,$stop+1,strlen($photo));
	return $ext;
}

function creaMini($url,$dossier)
{
// Création des instances d'image
$src = imagecreatefromjpeg($url);
$diff=imagesx($src)-imagesy($src);
$largeur=imagesx($src);
$hauteur=imagesy($src);

if($diff<0)
{
	$dest = imagecreatetruecolor($largeur,$largeur);
	$startY=($hauteur-$largeur)/2;
	imagecopy($dest, $src, 0, 0, 0,$startY, $largeur, $largeur);

}
else
{
	$dest = imagecreatetruecolor($hauteur,$hauteur);
	$startX=($largeur-$hauteur)/2;
	imagecopy($dest, $src, 0, 0, $startX,0, $hauteur, $hauteur);

}

// Affichage et libération de la mémoire

//imagejpeg($dest);
$size=imagesx($dest);
$NouvelleImage = imagecreatetruecolor(230 , 230) or die ("Erreur");
imagecopyresampled($NouvelleImage , $dest, 0, 0, 0, 0, 230, 230, $size,$size);
 imagejpeg($NouvelleImage,$dossier); 

imagedestroy($NouvelleImage);
imagedestroy($dest);
imagedestroy($src);
}
function getDossier($url)
{
	$lastSlash=200;
	$dossier="";
	$end="";
	for($i=0;$i<strlen($url);$i++)
	{
		if($url[$i]=="/" and $i>20)
		{
			$lastSlash=$i;
		}
		if($lastSlash<$i)
		{
			$end.=$url[$i];
		}
	}
	
	$dossier=substr($url,0,$lastSlash);
	
	for($i=0;$i<strlen($dossier);$i++)
	{
		if($url[$i]=="/")
		{
			$lastSlash=$i;
		}
	}
	$dossier=substr($dossier,$lastSlash,strlen($dossier));
	$dossierTemp="./upload/vignette".$dossier;
	//echo $dossierTemp;
	mkdir($dossierTemp, 0755);			
	chmod($dossierTemp, 0755);
	
	$dossier2="./upload/vignette".$dossier."/".$end;
	return $dossier2;
}
//ici
			?>




	</br></br>
	<div  id="contentMedia">
	<label class="choixMedia" id="choixMediaAll" onclick="getMedia(this.id)">Toutes les photos</label>
	<label class="choixMedia" id="choixMediaTeam" onclick="getMedia(this.id)">Championnat</label>
	<label class="choixMedia" id="choixMediaIndiv"   onclick="getMedia(this.id)">Individuel</label>
	<label class="choixMedia" id="choixMediaOther"  onclick="getMedia(this.id)">Autres</label>
	<label class="choixMedia" id="choixMediaVideos"  onclick="getMedia(this.id)">Vidéos</label>
	</div>
	<div  id="contentMediaMo">
	<center>
	<div class="choixMedia" id="choixMediaAll" onclick="getMedia(this.id)">Toutes les photos</div>
	<div class="choixMedia" id="choixMediaTeam" onclick="getMedia(this.id)">Championnat</div>
	<div class="choixMedia" id="choixMediaIndiv"   onclick="getMedia(this.id)">Individuel</div>
	<div class="choixMedia" id="choixMediaOther"  onclick="getMedia(this.id)">Autres</div>
	<div class="choixMedia" id="choixMediaVideos"  onclick="getMedia(this.id)">Vidéos</div>
	</div>
	</br>

		
			<div id="afficheMedia">
				</br></br></br></br>
			<?php
			$requette="select * from vignette order by id desc;";
			$result=mysql_query($requette);
			while($ligne=mysql_fetch_array($result))
			{
				$chemin=$ligne['urlPhoto'];
				$bigUrl=$ligne['bigUrlPhoto'];
				$titre=$ligne['titrePhoto'];
				if(strlen($chemin)>3)
				{
					//echo $chemin."<br>";
					?>
					<a id="Photoordi" title="<?php echo $titre?>" href="<?php echo $bigUrl?>" data-lightbox="image-1"><img src="<?php echo $chemin?>"  ></img></a>&nbsp;&nbsp;
					
					<?php

				}			
			}
				
				
			
				
			

?>
	<div  id="contentMediaMo">
	</center>
	</div>
			</div>
		


</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
</body>
</html>