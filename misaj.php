<?php
include ("parametres.php");
$maLingne=78;
$n=0;
do{
	getFiles($n,getUrl(78+$n*7));
	createMembre("/home/ttubayec/public_html/infoMembres/fichier".$n.".txt");
	$n++;
	}
while(!(78+$n*7>getEnd()));

?>
<SCRIPT LANGUAGE="JavaScript"> 
document.location.href="membres.php" ;
</SCRIPT> 
<?php
//fin des instructions
//debut des fonctions
function getFiles($no,$url)
{
	$nom_file = "/home/ttubayec/public_html/infoMembres/fichier".$no.".txt";
	$texte ="";
	$texte = file_get_contents($url);
	// création du fichier
	$f = fopen($nom_file, "w+");
	// écriture
	fputs($f, $texte );
	// fermeture
	fclose($f);
}
function getUrl($start)
{
	getFiles("Club","http://www.fftt.com/sportif/pclassement/php3/FFTTlj.php3?session=reqid%3D211%26precision%3D09040015");
	$li = file('/home/ttubayec//public_html/infoMembres/fichierClub.txt');
	$url="http://www.fftt.com/sportif/pclassement/php3/".getInfo($li,$start,57,"'");
	$url=str_replace(' ','',$url);
	return $url;
}
function getInfo($lines,$noLigne,$depart,$fin)
{
		foreach ($lines as $line_num => $line) {
			  
			  if($line_num==$noLigne)
			  {			
				 $ind=$depart;
				$var="";	
				  do{
					 $var.=$line[$ind];
					 $ind++;
				    }
				while(!($line[$ind]==$fin));
				 return $var;
				
			  }
		}
}
function createMembre($url)
{
	
	$lines = file($url);
	// Affiche toutes les lignes du tableau comme code HTML, avec les numéros de ligne
	$nom=getInfo($lines,56,72," ");
	echo $nom;
	$prenom=getInfo($lines,56,93,"<");
	$licence=getInfo($lines,66,59,"<");
	$classement=getInfo($lines,82,50,"<");
	$ptsEnCours=getInfo($lines,98,53,"<");
	$valeurDebutSaison=getInfo($lines,84,47,"<");
	if($valeurDebutSaison[strlen($valeurDebutSaison)-1]=='.'){$valeurDebutSaison=substr($valeurDebutSaison,0,strlen($valeurDebutSaison)-1);}
	//echo $valeurDebutSaison." ";
	$categorie=getInfo($lines,76,47,"<");
	$progression=getInfo($lines,100,47,"<");if($progression[0]=='+'){$progression=substr($progression,1,strlen($progression));}	
	if($progression[0]=='<'){$progression=substr($progression,22,strlen($progression));}
	$login=creaLogin($nom,$prenom);
	
	$reqAnnexe="select * from membres where licence='$licence'";
	$repAnnexxe=mysql_query($reqAnnexe);
	$ligne=mysql_fetch_array($repAnnexxe);
	$oldLog=$ligne['loginM'];
	if(isset($oldLog) and $oldLog!="") { $login=$oldLog ;}
	
	$reqSuppr="delete from membres where licence='$licence'";
	$repSuppr=mysql_query($reqSuppr);
	 $requette="insert into membres values('$nom','$prenom','$licence',$classement,$valeurDebutSaison,$ptsEnCours,'$categorie',$progression,'$login')";
	 // echo "</br>".$requette;
	$reponse=mysql_query($requette);
	
	$reqLog="select * from login where login='$login'";
	$repLog=mysql_query($reqLog);
	if(mysql_num_rows($repLog)==0)
	{
		$reqLog2="insert into login values('$login','$licence',0,null)";
		$repLog2=mysql_query($reqLog2);
	}
	$dir_nom = "/home/ttubayec/public_html/upload/membres/";
	$dir_nom.=$login;
		if (!(file_exists($dir_nom))) 
		{
			mkdir($dir_nom, 0755);
		}
	
	
}

function creaLogin($nom,$prenom)
{
	$log=strtolower($nom).strtolower($prenom[0]);
	for($i=0;$i<strlen($nom);$i++)
	{
		if($nom[$i]=='-')
		{
			$log.=strtolower($nom[$i+1]);
		}	
	}
	for($i=0;$i<strlen($prenom);$i++)
	{
		if($prenom[$i]=='-')
		{
			$log.=strtolower($prenom[$i+1]);
		}	
	}
	return $log;
}
function getEnd()
{
	$nbLign=-38;
	$lin = file('/home/ttubayec/public_html/infoMembres/fichierClub.txt');
	foreach ($lin as $line_num => $line) {

		$nbLign++;
		
		}
		return $nbLign;
}


?>

 