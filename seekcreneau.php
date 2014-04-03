<?php 
header('Content-Type: text/html; charset=utf-8'); 

$html="<div id='repCreneau'>";
$req=utf8_decode($_POST['requette']);
$deb=$_POST['debut'];
$fi=$_POST['fin'];
$nbJour=$_POST['jour'];
$nbCate=$_POST['cate'];
$nbRep=0;

// $req="select * from creneau where (jour='Vendredi' ) and ( categorie='Compétition Adultes' ) and ((hdebut<=185 and hfin>=200) or (hdebut<=185 and hfin>185) or (hdebut>185 and hdebut<200))";
// $deb=175;
// $fi=200;
if($nbCate>0 and $nbJour>0)
{
	$rep=mysql_query($req);
	while($ligne=mysql_fetch_array($rep))
	{
		$nbRep++;
		$hdebut=$ligne['hdebut']; $hfin=$ligne['hfin'];
		$debut=$hdebut;
		$fin=$hfin;
					$h1=""; $h2="";$temp1=0; $temp2=0;
					if($hdebut%10!=0)
					{
						$hdebut=$hdebut/10;
						$temp1=floor($hdebut);
						$h1=$temp1."h 30";
					}
					else
					{
						$hdebut=$hdebut/10;
						$h1=$hdebut."h";
						
					}
				
					if($hfin%10!=0)
					{
						$hfin=$hfin/10;
						$temp2=floor($hfin);
						$h2=$temp2."h 30";
					}
					else
					{
						$hfin=$hfin/10;
						$h2=$hfin."h";
					}	
	
	
		
		$html.="Entrainement <label id='infoCreneauOk'>".$ligne['jour']." </label> pour les <label id='infoCreneauOk'>".$ligne['categorie']."</label> de : ";

	
	
		if($debut==$deb)
		{
			$h1="<label id='infoCreneauOk'>".$h1."</label>";
		}
		else
		{
			$h1="<label id='infoCreneauPOk'>".$h1."</label>";
		}
		if($fin==$fi)
		{
			$h2="<label id='infoCreneauOk'>".$h2."</label>";
		}
		else
		{
		$h2="<label id='infoCreneauPOk'>".$h2."</label>";
		}
		$html.=$h1." à ".$h2."</br></br>";
		$html.="<hr>";

}
	if($nbRep==0)
	{
		$html.="Aucun résultat trouvé !";
	}
}
elseif($nbCate==0 and $nbJour==0)
{
	$html.="<label id='infoCreneauPOk' >Veillez cocher au moins une catégorie et un jour !</label> ";
}
elseif($nbCate==0)
{
	$html.="<label id='infoCreneauPOk' >Veillez cocher au moins une catégorie !</label> ";
}
elseif($nbJour==0)
{
	$html.="<label id='infoCreneauPOk' >Veillez cocher au moins un jour !</label> ";
}
$html.="</div>";
echo utf8_encode($html);
?>
