<?php include('parametres.php'); $nbRep=-1;?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript" src="/jquery/creatediapo.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
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
function redimage2($img_src,$dst_w,$dst_h) 
{
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
   return("WIDTH=".$dst_w." HEIGHT=".$dst_h);
   
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
function getTypeP($photo)
{
	$stop=0;
	for($i=0;$i<strlen($photo);$i++)
	{
		if($photo[$i]=='.' and $i>10)
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
	if(!(file_exists($dossierTemp)))
	{
		mkdir($dossierTemp, 0755);			
		chmod($dossierTemp, 0755);
	}
	$dossier2="./upload/vignette".$dossier."/".$end;
	return $dossier2;
}
function createDiapo($tabPhoto,$tabTitle,$idPost)
{
	
	$html="";
	$tabEffect[0]="blindX";
	$tabEffect[1]="blindY";
	$tabEffect[2]="blindZ";
	$tabEffect[3]="cover";
	$tabEffect[4]="curtainX";
	$tabEffect[5]="curtainY";
	$tabEffect[6]="fade";
	$tabEffect[7]="fadeZoom";
	$tabEffect[8]="growX";
	$tabEffect[9]="growY";
	$tabEffect[10]="scrollUp";
	$tabEffect[11]="scrollDown";
	$tabEffect[12]="scrollLeft";
	$tabEffect[13]="scrollRight";
	$tabEffect[14]="scrollHorz";
	$tabEffect[15]="scrollVert";
	$tabEffect[16]="shuffle";
	$tabEffect[17]="slideX";
	$tabEffect[18]="slideY";
	$tabEffect[19]="toss";
	$tabEffect[20]="turnUp";
	$tabEffect[21]="turnDown";
	$tabEffect[22]="turnLeft";
	$tabEffect[23]="turnRight";
	$tabEffect[24]="uncover";
	$tabEffect[25]="wipe";
	$tabEffect[26]="zoom";
	$effet=$tabEffect[rand(0,26)];
	//$effet=$tabEffect[6];
	$tabSize="";
	foreach ($tabPhoto as $i => $value) {
	$tabSize[$i]=redimage2($value,700,700);
	}
	//$html.='<link type="text/css" rel="stylesheet" media="screen" href="styleTTU.css"/><link type="text/css" rel="stylesheet" media="screen and (min-width: 1200px) and (max-width:1560px)" href="styleTTU2.css"/><link type="text/css" rel="stylesheet" media="screen and (max-width:1200px)" href="styleMobileTTU.css"/>';

	
	 $html.='<script>$(function() {  var $bc = $("#buttonContainer'.$idPost.'"); var $container = $("#diapo'.$idPost.'").cycle({fx:"'.$effet.'",speed:600,timeout:10000,pause: 1,after:onAfter });$container.children().each(function(i) { $(\'<input type="button" class="'.$idPost.'buttonGoToDiapo\'+(i+1)+\'" id="buttonGoToDiapo" value="\'+(i+1)+\'" />\').appendTo($bc).click(function() { $container.cycle(i,"'.$effet.'"); return false; }); });}); </script>';
	
	 $html.='<script>function onAfter(curr,next,opts) { 
	 var temp=$(this).parent().attr("id");var id="";
	  for(var i=5;i<temp.length;i++)
	 {
		id+=temp.charAt(i);
		 }	
	 $("#buttonContainer"+id).children().css("color","#700"); var noSlide=opts.currSlide+1;$("."+id+"buttonGoToDiapo"+noSlide).css("color","#FF0000"); }</script>';
	
	 $html.='<script>function gereDiapo(no,etat){if(etat=="pausediapo"){$("#diapo"+no).cycle("pause");$(".gereButton"+no).attr("id","playdiapo");$(".gereButton"+no).text("");$(".gereButton"+no).append(\'<img src="./images/icones/play.png" width="30" height="30">\')}else{$("#diapo"+no).cycle("resume");$(".gereButton"+no).attr("id","pausediapo");$(".gereButton"+no).text("");$(".gereButton"+no).append(\'<img src="./images/icones/pause.png" width="30" height="30">\')}}</script>';
	
	 $html.='<div id="diapo'.$idPost.'" class="cdiapo">';
	$i=0;
	foreach ($tabPhoto as $i2 => $value2) {
	 $n=$i2+1;
	$html.='<img src="'.$value2.'" id="'.$n.'"  class="photoStyle" '.$tabSize[$i2].' title="'.$tabTitle[$i2].'">';
 }
	$html.='</div></br><center><span id="buttonContainer'.$idPost.'"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label onclick="gereDiapo('.$idPost.',this.id)" class="gereButton'.$idPost.'" id="pausediapo" ><img src="./images/icones/pause.png" width="30" height="30"></label></center>';
	echo $html;
	
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
function is_empty_dir($src) 
{ 
	$h = opendir($src); 
	while (($o = readdir($h)) !== FALSE) 
	{ 
		if (($o != '.') and ($o != '..')) 
		{ 
			$c++; 
		} 
	} 
	closedir($h); 
	if($c==0) 
	return true; 
	else 
	return false; 
}
if(isset($_POST["action"]))
{
			
		$mess=$_POST["inputMess"];		
		$date=date("20y-m-d");	
		$titre=$_POST["inputTitre"];		
		$login=$_SESSION['loginM'];		
		$album=$_POST["legende"];
		$concerne=$_POST["concern"];

		$mess=nl2br($mess);
		
		if(strlen($mess)>4 and strlen($titre)>4)
		{
			$maRequette="insert into messages values(null,'".apo($mess)."','$titre','$date',0,'$login',null,null);";
			$resultat=mysql_query($maRequette);
			$lastId = mysql_result(mysql_query("SELECT MAX(id) FROM messages"),0);
			if(isset($_FILES['uploads']["name"][0]) and ($_FILES['uploads']["name"][0]!=""))
			{ 
			
				$count=1;$i=0;
				$dossier="./upload/photo/";
			 
				mkdir($dossier."Mess_".$lastId."_".$date, 0755);			
				$dossier=$dossier."Mess_".$lastId."_".$date."/";
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
		else
		{
				$e=false;
				$error="Titre et / ou message trop court !";
		}

		
	
}
if(isset($_POST["deleteall"]))
{
		$id=$_POST["id"];
		$req="delete from messages where id='$id'";
		$rep=mysql_query($req);
		
		$req2="select * from media where idMess='$id'";
		$rep2=mysql_query($req2);
		while($ligne=mysql_fetch_array($rep2))
		{	
			$fichier=$ligne['urlPhoto'];
			unlink($fichier);
			$stop=0;
			$taille=strlen($fichier);

			for($i=0;$i<$taille;$i++)
			{

				 if($fichier[$i]=='/')
				{
					 $stop=$i;
				 }
				
			}
			$fichier=substr($fichier,0,$stop);
			
		}	
		if(file_exists($fichier))rmdir($fichier);		
		 $req3="delete from media where idMess='$id'";
		 $rep3=mysql_query($req3);
		 //////////////////////////////////////////
		$req5="select * from vignette where id=$id";
		$rep5=mysql_query($req5);
		while($ligne=mysql_fetch_array($rep5))
		{
			$fichier=$ligne['urlPhoto'];
			unlink($fichier);
			$stop=0;
			$taille=strlen($fichier);

			for($i=0;$i<$taille;$i++)
			{

				 if($fichier[$i]=='/')
				{
					 $stop=$i;
				 }
				
			}
			$fichier=substr($fichier,0,$stop);		
		}
		if(file_exists($fichier))rmdir($fichier);		
		 $req4="delete from vignette where id='$id'";
		 $rep4=mysql_query($req4);
		 
}
if(isset($_POST["actionAddPhoto"]))
{
		$madate=$_POST["oldDate"];
		$lastId=$_POST["id"];
		$album=$_POST["album"];
		$concerne=$_POST["concern"];
		if(strlen($concerne<2))
		{
			$r="select * from media where idMess=$lastId";
			$re=mysql_query($r);
			$lin=mysql_fetch_array($re);
			$concerne=$lin['concern'];
		}
		
		if(isset($_FILES['newupload']["name"][0]) and ($_FILES['newupload']["name"][0]!=""))
		{ 
			$count=1;$i=0;
			$dossier="./upload/photo/";
			$dossier=$dossier."Mess_".$lastId."_".$madate."/";

			$Vdossier=getDossier($dossier);
			
			if(!(file_exists($dossier)))
			{
				mkdir($dossier, 0755);
				chmod($dossier, 0755);			
			}			
			
			foreach ($_FILES['newupload']['tmp_name'] as $file) 
			{

				
				$name=$dossier.$_FILES['newupload']['name'][$i];
				
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
if(isset($_POST["actionmodif"]))
{
		//j'enregistre
		//recup du login et du mdp
		
		$mess2=$_POST["inputMess2"];

		$id2=$_POST["id"];
	
		$titre2=$_POST["inputTitre2"];
		
		$mess2=nl2br($mess2);
		$maRequette4="update messages set message='".apo($mess2)."' ,title='".apo($titre2)."' where id=$id2;";
		
	
		$resultat44=mysql_query($maRequette4); 
		
	
}
if(isset($_POST["modiftypephoto"]))
{
	$type=$_POST['concern'];
	$id2=$_POST["id"];
	$req="update media set concern='$type' where idMess='$id2'";
	$rep=mysql_query($req);
}
if(isset($_POST["actionmodif2"]))
{
		//j'enregistre
		//recup du login et du mdp
		$dosssier="";
		$id2=$_POST["id"];
		$album=$_POST["album"];
		if(isset($_POST['photo']))
		{ //sera vrai si au moins un moins un checkbox a Ã©tÃ© cochÃ©
 
				foreach($_POST['photo'] as $chkbx){
 
					unlink($chkbx);
					$req="delete from media where idMess=$id2 and urlPhoto='$chkbx'";
					$rep=mysql_query($req);
					
					$r="select * from vignette where id=$id2 and bigUrlPhoto='$chkbx'";
					$r2=mysql_query($r);
					while($l=mysql_fetch_array($r2))
					{
						$dtemp=$l['urlPhoto'];
						$term2=getTypeP($dtemp);
						$dossier2=str_replace('.'.$term2,"",$dtemp);
						
						unlink($l['urlPhoto']);					
					}
					$stop2=0;
					for($i=0;$i<strlen($dossier2);$i++)
					{
						if($dossier2[$i]=='/'){$stop2=$i;}
					}
					$dossier2=substr($dossier2,0,$stop2);
					if(is_empty_dir($dossier2)) { 
						rmdir($dossier2);
					} 
					
					$req2="delete from vignette where id=$id2 and bigUrlPhoto='$chkbx'";
					$rep2=mysql_query($req2);
					$term=getTypeP($chkbx);
					
					$dossier=str_replace('.'.$term,"",$chkbx);
					$stop=0;
					for($i=0;$i<strlen($dossier);$i++)
					{
						if($dossier[$i]=='/'){$stop=$i;}
					}
					$dossier=substr($dossier,0,$stop);
					if(is_empty_dir($dossier)) { 
						rmdir($dossier);
					} 
					
 
			}
		}
		
		
		$maRequette4="update media set titrePhoto='".apo($album)."' where idMess=$id2;";
		$resultat4=mysql_query($maRequette4); 
		
	
}
if(isset($_POST["actionmodif3"]))
{
		//j'enregistre
		//recup du login et du mdp
	
		$id2=$_POST["id"];
		if(isset($_POST['video']))
		{ //sera vrai si au moins un moins un checkbox a Ã©tÃ© cochÃ©
 
				foreach($_POST['video'] as $chkbx){
 
					$req="delete from media where idMess=$id2 and youtube='$chkbx'";
					$rep=mysql_query($req);
 
			}
		}
		

		
	
}
	
			$req="select * from messages where statut=0 and id < ".mysql_real_escape_string($_GET['last'])." ORDER BY id DESC LIMIT 2";
			$rep=mysql_query($req);
			while($ligne=mysql_fetch_array($rep))
			{
				
				$img="";
				$titrePhoto="";
				$id=$ligne['id'];
				$mess=$ligne['message'];
				$mess=utf8_encode($mess);			
				$tit=$ligne['title'];
				$tit=utf8_encode($tit);
				if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false)
				{
					$mess=$ligne['message'];
					$tit=$ligne['title'];
				}
				if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false)
				{
					$mess=$ligne['message'];
					$tit=$ligne['title'];
				}
				$date=$ligne['dateN'];
				$log=$ligne['login'];
			
							$req2="select * from media where idMess=$id and youtube is null";
							$rep2=mysql_query($req2);
							$nbRep=mysql_num_rows($rep2);
							if($nbRep>0)
							{
								if($nbRep==1)
								{
									$line=mysql_fetch_array($rep2);
									$img=$line['urlPhoto'];
									$tabP[0]=$img;
									$titrePhoto=$line['titrePhoto'];
								}
								else
								{
									$tabP="";$tabT="";$noPhoto=0;
									while($line=mysql_fetch_array($rep2))
									{
										$tabP[$noPhoto]=$line['urlPhoto'];
										$tabT[$noPhoto]=$line['titrePhoto'];
										$titrePhoto=$line['titrePhoto'];
										$noPhoto++;
										$tabT[$noPhoto-1].=" Photo ".$noPhoto;
										
									}
								}
							}
							
				
				
	
				?>
				
									

				<?php 
				if(isset($_SESSION['loginM']))
				{
					$login=$_SESSION['loginM'];
				}
				if((empty($login))or (($log!=$login) and $login!="president"))
				{
					?>
					<div class="commentaire" id="<?php echo $ligne['id']?>">		
					<p id="newsDate">Le <?php echo date("d/m/Y", strtotime($date)) ?> </p></br> 
					<h3 id="news"><a href="news.php?news=<?php echo $id ?>"><?php echo $tit ?></a></h3>
					<h4 id="news"> <?php echo $mess ?> </h4> 
					<?php 
					if(isset($img) and $img!="")
					{
						?>  <a href="news.php?news=<?php echo $id ?>"><img id="center" src=<?php echo $img?> <?php redimage($img,700,700)?> ></a> </br></br><?php
					}
					if($nbRep>1)
					{
							
							createDiapo($tabP,$tabT,$id);
					}
					$mare="select * from media where idMess='$id' and youtube is not null;";
					$marep=mysql_query($mare);
					$affiche=true;
					while($ligneRep=mysql_fetch_array($marep))
					{
						if($affiche)
						{
						?><center></br></br><a href="news.php?news=<?php echo $id ?>">Cliquez pour voir la vidéo</a></center><?php
						$affiche=false;
						}
					}
					
					?>
	
					</br><hr style="color:#555;background-color:#555;height: 1px;border: 0;margin-left:20px;margin-right:20px">
					</div>
					<div class="endComm"></div>
					<?php
				}
				
				if((isset($login)) and (($log==$login) or $login=="president"))
				{
				
				?> 
				
					<div class="commentaire" id="<?php echo $ligne['id']?>">
					<form name="New2" method="POST" action="index.php" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $id ?>"/>
					<input type="hidden" name="oldDate" value="<?php echo $date ?>"/>
					Titre du post : <input type="text" name="inputTitre2" value=" <?php echo $tit ?>"/></br>
					Contenu : </br><TEXTAREA  name="inputMess2" rows="10" COLS="100" id="test"> <?php echo $mess ?></TEXTAREA>
					</br><input type="submit" id="submitButtonSupprimer" name="actionmodif" value="Modifier le titre et/ou le contenu du post"/></br>
				 <?php
							if($nbRep>0)
							{
									?></br></br></br>Titre de l'album : <input type="text" name="album" value="<?php echo $titrePhoto ?>" /></br></br>  <?php
									for($i=0;$i<count($tabP);$i++)
									{
									
										?>
										<label style="display:inline-block"><img src="<?php echo $tabP[$i] ?>" <?php redimage($tabP[$i],180,180) ?> style="text-a"></br>
										<span>Supprimer :<input type="checkbox" name="photo[]" value="<?php echo $tabP[$i] ?>"/></span>
										</label>
										&nbsp;&nbsp; <?php
									}
									?></br></br><input id="submitButtonSupprimer" type="submit" name="actionmodif2" value="Supprimer les photos / modifier le titre de l'album"/></br>
									<?php
								
							}
						
							?>
								</br>Ajouter photo(s) : <input type="file" name="newupload[]" multiple onchange="gereRadio(<?php echo $nbRep ?> ,<?php echo $id ?> )"></br><input type="submit" class="radio" name="actionAddPhoto" value="Ajouter" id="submitButton">
								<div id="radio<?php echo $id ?>"></div>
								
								<?php if($nbRep>0) { ?>
										</br> Compétition : 
						<input type="radio" name="concern" value="equipes" <?php if($about=="equipes"){?> checked <?php  }?>>Championnat (par equipes)
						<input type="radio" name="concern" value="indiv"  <?php if($about=="indiv"){?> checked <?php  }?>> Individuelle
						<input type="radio" name="concern" value="autre"  <?php if($about=="autre"){?> checked <?php  }?>> Ne concerne pas une compétition 
						<input type="submit" name="modiftypephoto" value="Modifier le type de photo" id="submitButtonSupprimer">
						  </br>
								<?php } ?>
								
						<?php $maRequett="select * from media where idMess=$id and youtube is not null;";						
							  $maRep=mysql_query($maRequett);
							  $nbVideo=mysql_num_rows($maRep);
							  while($maLigne=mysql_fetch_array($maRep))
							  {
										?>
										<label style="display:inline-block"></br>
										<iframe width="250" height="200" src="//www.youtube.com/embed/<?php echo $maLigne['youtube'] ?>" frameborder="0" allowfullscreen></iframe>
										<span>Supprimer :<input type="checkbox" name="video[]" value="<?php echo $maLigne['youtube'] ?>"/></span>
										</label>
										<?php
							  }
							  
							  if($nbVideo>0){?></br><input id="submitButtonSupprimer" type="submit" name="actionmodif3" value="Supprimer les vidéos"/></br> <?php } ?>

						
									</br></br><center><input type="submit" name="deleteall" value="SUPPRIMER LE POST" id="submitButtonSupprimer"></center>
										
					</br></br><hr></br>
					</form>
					</div>
					<div class="endComm"></div>
					</br>
		<?php }
		?>
				
				
					
			<?php
			}
	?>