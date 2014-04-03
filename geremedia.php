<?php
include "parametres.php";
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
   return "WIDTH=".$dst_w." HEIGHT=".$dst_h;
   
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
$choix=$_POST['choixmedia'];
//$choix="equipes";
$html="";

if($choix=="aucun")
{
	$req="select * from vignette order by id desc";
}
if($choix=="equipes")
{
	$req="select * from vignette where concern='equipes' order by id desc";
}
if($choix=="indiv")
{
	$req="select * from vignette where concern='indiv' order by id desc";
}
if($choix=="autres")
{
	$req="select * from vignette where concern='autre' order by id desc";
}
if($choix=="video")
{
	$req="select * from media where youtube is not null  order by idMess desc";
}

$rep=mysql_query($req);
while($ligne=mysql_fetch_array($rep))
{
	if($choix!="video")
	{
		$chemin=$ligne['urlPhoto'];
		$bigUrl=$ligne['bigUrlPhoto'];
		$titre=$ligne['titrePhoto'];
	
		$html.='<a title="'.$titre.'" href="'.$bigUrl.'" data-lightbox="image-1"><img src="'.$chemin.'" width=225 height=225  ></img></a></span>&nbsp;&nbsp';  

		
		
		//$html.='<a title="'.$titre.'" href="'.$chemin.'" data-lightbox="image-1"><img src="'.$chemin.'"  ></img></a></span>&nbsp;&nbsp';  
	}
	if($choix=="video")
	{
		$source=$ligne['youtube'];
		$html.='<iframe width="420" height="300" src="//www.youtube.com/embed/'.$source.'" frameborder="0" allowfullscreen></iframe>&nbsp;&nbsp';
	}
		
}
echo $html;

?>
