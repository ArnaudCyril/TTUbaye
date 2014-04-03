<?php
include "parametres.php";
$tdate=getDates("resultatsD1.php");
$t1=getMatch("resultatsR.php");
$t2=getMatch("resultatsR2.php");
$t3=getMatch("resultatsD1.php");
$t4=getMatch("resultatsD3.php");

$dateEcrit=date("20y-m-d");	
$month = date("m",strtotime($tdate[0]));
$coeff=1;
if($month<8)$coeff=8;
$requette="delete from event where type='championnat'";
$reponse=mysql_query($requette);
for($i=0;$i<count($tdate);$i++)
	{
		$contenu=$t1[$i].$t2[$i].$t3[$i].$t4[$i];
		$date=getGoodDate($tdate[$i]);
		$noJ=$i+$coeff;
		$titre="Match de championnat - journée ".$noJ;
		$req="insert into event values(null,'$dateEcrit','$date','$titre','".apo($contenu)."','championnat','cyril')";
		$rep=mysql_query($req);
		echo $req;
		echo "<br>";
	}
	
?>
<script>
document.location.href="evenement.php";
</script>
<?php	
function getGoodDate($date)
{
$jour=$date[0].$date[1];
$mois=$date[3].$date[4];
$annee=$date[6].$date[7];


$madate="20".$annee.'-'.$mois.'-'.$jour;
return $madate;

}
function getDates($url)
{
$file=getUrl($url);
$lines=file($file);
$tab;
$indice=0;
foreach ($lines as $line_num => $line) {
	if($line_num>40 and $line[225]=='B')
	{
		$tab[$indice]=getInfo($lines,$line_num,252," ");
		$indice++;
	}
	if($line_num>40 and $line[451]=='B')
	{
		$tab[$indice]=getInfo($lines,$line_num,478," ");
		$indice++;
	}
  }
  return $tab;
}




function getMatch($url)
{
$file=getUrl($url);
$lines=file($file);
$tab;
$indice=0;
foreach ($lines as $line_num => $line) {
	if($line_num>40 and $line[33]=='P')
	{
		$info1=getInfo($lines,$line_num,35,"/");
		$nb=35+93+strlen($info1);
		$info1=str_replace("<B>","",$info1);
		$info1=str_replace("<","",$info1);
		
		$info2=getInfo($lines,$line_num,$nb,"<");
		
		$info2=str_replace("<B>","",$info2);
		$info2=str_replace("<","",$info2);
		$info2=str_replace(">","",$info2);
		
		if( strstr($info1,"UBAYE")) { 
			//Code à exécuter si la sous-chaine chaine2 est trouvée dans chaine1 
				$tab[$indice]="<span id='eventline'>".$info1."</span> reçoit <span id='eventline2'>".$info2."</span><br>";
				$indice++;
			} 
		if(strstr($info2,"UBAYE")) { 
			//Code à exécuter si la sous-chaine chaine2 est trouvée dans chaine1 
				$tab[$indice]="<span id='eventline'>".$info2."</span> se déplace à  <span id='eventline2'>".$info1."</span><br>";
				$indice++;
			} 
		
		
	
	}
	if($line_num>40 and ($line[549]=='B' or $line[548]=='B'))
	{
		if($line[549]=='P'){$info1=getInfo($lines,$line_num,551,"<");}
		if($line[548]=='P'){$info1=getInfo($lines,$line_num,550,"<");}
		$nb=551+93+strlen($info1);	
	
		$info2=getInfo($lines,$line_num,$nb,"<");
		
		$info2=str_replace("<B>","",$info2);
		$info2=str_replace("<","",$info2);
		$info2=str_replace(">","",$info2);
		
		if( strstr($info1,"UBAYE")) { 
			//Code à exécuter si la sous-chaine chaine2 est trouvée dans chaine1 
				$tab[$indice]="<span id='eventline'>".$info1."</span> reçoit <span id='eventline2'>".$info2."</span><br>";
				$indice++;
			} 
		if(strstr($info2,"UBAYE")) { 
			//Code à exécuter si la sous-chaine chaine2 est trouvée dans chaine1 
				$tab[$indice]="<span id='eventline'>".$info2."</span> se déplace à  <span id='eventline2'>".$info1."</span><br>";
				$indice++;
			} 
		
			
	}
	//echo "<br>".$line[325]." - ".$line_num;

	if($line_num>40 and ($line[325]=='P' or $line[324]=='P'))
	{
		if($line[325]=='P'){$info1=getInfo($lines,$line_num,327,"<");}
		if($line[324]=='P'){$info1=getInfo($lines,$line_num,326,"<");}
		$nb=327+93+strlen($info1);	
		$info2=getInfo($lines,$line_num,$nb,"<");
		
		$info2=str_replace("<B>","",$info2);
		$info2=str_replace("<","",$info2);
		$info2=str_replace(">","",$info2);
		
		if( strstr($info1,"UBAYE")) { 
			//Code à exécuter si la sous-chaine chaine2 est trouvée dans chaine1 
				$tab[$indice]="<span id='eventline'>".$info1."</span> reçoit <span id='eventline2'>".$info2."</span><br>";
				$indice++;
			} 
		if(strstr($info2,"UBAYE")) { 
			//Code à exécuter si la sous-chaine chaine2 est trouvée dans chaine1 
				$tab[$indice]="<span id='eventline'>".$info2."</span> se déplace à  <span id='eventline2'>".$info1."</span><br>";
				$indice++;
			} 
		
			
	}

}

		for($i=0;$i<count($tab);$i++)
		{
			$tab[$i]=str_replace("<P>","",$tab[$i]);
			$tab[$i]=str_replace("<B>","",$tab[$i]);
		}
		return $tab;
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
				//echo $var." ";
				return $var;
				
			}
		}
}
function getUrl($url)
{
	$lines = file($url);
	foreach ($lines as $line_num => $line) {
		if(strlen($line)>100 and $line_num>10 and test)
		{
			return getInfo($lines,$line_num,48,'"');
			 
		}
	}
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
?>
