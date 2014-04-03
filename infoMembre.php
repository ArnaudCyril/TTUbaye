<?php 
ob_start();
include("menu.php");

$licence=$_GET['membre'];
$req="select * from membres where licence=$licence;";
$resultat=mysql_query($req);
while($ligne=mysql_fetch_array($resultat))
{
		$nom=$ligne['nom'];
		$prenom=$ligne['prenom'];
		$licence=$ligne['licence'];
		$class=$ligne['classement'];
		$ptsc=$ligne['ptEnCours'];
		$ptsa=$ligne['ptsActuels'];
		$cate=$ligne['categorie'];
		$login=$ligne['loginM'];
}
function EtatDuRepertoire($MonRepertoire,$log){
  $fichierTrouve=0;
  if (is_dir($MonRepertoire))
  {
    if ($dh = opendir($MonRepertoire))
     {
      while (($file = readdir($dh)) !== false && $fichierTrouve==0)
      {
       if ($file!="." && $file!=".." )
		{
			$tof=$MonRepertoire.$file;
			return($tof);
			$fichierTrouve=1;
		}
       }
      closedir($dh);
     }
  }
  else 
  {
	//echo ("Le répertoire n'existe pas");
	$pathnophopto="upload/membres/nophoto.jpg";
	return($pathnophopto);
  }
  if( $fichierTrouve==0)
	{
		//echo ("Le répertoire existe mais il est vide");
		$pathnophopto="upload/membres/nophoto.jpg";
		return($pathnophopto);
	}
  else 
	{
		//echo ("Le répertoire contient des fichiers");
	}
}

///////////////////////////////////////////////
$lien=get1lien($licence);
$lines=file($lien);
$part2="";
foreach ($lines as $line_num => $line) {
		//echo $line_num;
		//echo $lien;
		if($line_num==105)
		{
			//echo "ok";
			$goodlink="http://www.fftt.com/sportif/pclassement/php3/";
			$part2=getInfo($lines,105,632,">");
			if($part2[0]!='F'){$part2=substr($part2,1,strlen($part2)-1);}
			$goodlink.=$part2;
			$goodlink=str_replace("'","",$goodlink);
			$goodlink=str_replace("<","",$goodlink);
		}
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

				if($var[strlen($var)-1]==' ')
				{
					$var=substr($var,0,strlen($var)-1);
				}
				return $var;
				
			}
		}
}
function get1lien($licence)
{
$url="http://www.fftt.com/sportif/pclassement/php3/FFTTlj.php3?session=reqid%3D211%26precision%3D09040015";
$lines = file($url);
$n=0;
$end=getEnd();
$compare="";
 foreach ($lines as $line_num => $line) {
    

			 if($line_num>0 and $line_num<$end and ($line_num%(78+($n*7)))==0)
			{
				
				$n++;
				 $compare=str_replace(" ","",getInfo($lines,$line_num,89,"%"));
				 //echo $compare;
				if($compare==$licence)
				{
					$link="http://www.fftt.com/sportif/pclassement/php3/";
					$link.=getInfo($lines,$line_num,57,"'");
					$link=str_replace(" ","%20",$link);
					return $link;
					
				 }
				// $n++;
			}
		}
}
function getEnd()
{
	$nbLign=-38;
	$url="http://www.fftt.com/sportif/pclassement/php3/FFTTlj.php3?session=reqid%3D211%26precision%3D09040015";
	$lin = file($url);
	foreach ($lin as $line_num => $line) {

		$nbLign++;
		//echo $line_num;
		
		}
		return $nbLign;
}
///////////////////////////////////////

?>
<html>
<head>
<title><?php echo $nom." ".$prenom ?> - Tennis de table Ubaye</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="jquery/goTop.js"></script>

</head>
	<body>
	<div id="container">
	<center>
	  
                <a id="optionNav" href="equipes.php">Retour</a>
   
	<br><br>
	<table id="membre2" border="1" CELLPADDING="4" CELLSPACING="2" width=80% height=60>
		<thead>	
			<tr><!-- ligne des titres de colonnes-->
				<th height=4 bgcolor='#D2E9FF'>Nom</th>
				<th bgcolor='#D2E9FF'>Prenom</th>
				<th bgcolor='#D2E9FF'>N° Licence</th>
				<th bgcolor='#D2E9FF'>Classement</th>
				<th bgcolor='#D2E9FF'>Points licence</th>
				<th bgcolor='#D2E9FF'>Point actuels</th>
				<th bgcolor='#D2E9FF'>Categorie</th>
			</tr>
		</thead>
		<tbody>
		
		</tbody>
		<tr>
			<th height=4 bgcolor='#EBEBEB'><?php echo $nom?></th>
			<th bgcolor='#EBEBEB'><?php echo $prenom?> </th>
			<th bgcolor='#EBEBEB'><?php echo $licence?></th>
			<th bgcolor='#EBEBEB'><?php echo $class?></th>
			<th bgcolor='#EBEBEB'><?php echo $ptsc?></th>
			<th bgcolor='#EBEBEB'><?php echo $ptsa?></th>
			<th bgcolor='#EBEBEB'><?php echo $cate?></th>
		
		</tr>
	</table>
	<br><br>
		<input type="submit" id="buttonVoirMatch" value="Voir les matchs" onclick="afficheIframe('<?php echo $goodlink ?>')" ></br></br>
	<div id="iframeMatch"></div>
<?php

$dossier = "upload/membres/".$login."/";
$photo=EtatDuRepertoire($dossier,$login);

if(isset($_FILES['avatar']) and (isset($_POST['envoyerPhoto'])))
{ 
    $fichierToUpload = basename($_FILES['avatar']['name']);
	echo $_FILES['avatar']['tmp_name'];
	echo $fichierToUpload;
    if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichierToUpload)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Nouvelle image enregistrée  !';
		  $photo=$dossier.$fichierToUpload;
		  $repertoire = opendir($dossier); // On définit le répertoire dans lequel on souhaite travailler.
			while (false !== ($fichier = readdir($repertoire))) // On lit chaque fichier du répertoire dans la boucle.
			{
				$chemin = $dossier."/".$fichier; // On définit le chemin du fichier à effacer.
  
				// Si le fichier n'est pas un répertoire…
				if ($fichier != ".." AND $fichier != "." AND !is_dir($fichier) and $fichier!=$fichierToUpload)
				{
					unlink($chemin); // On efface.
				}
			}
			closedir($repertoire); // Ne pas oublier de fermer le dossier ***EN DEHORS de la boucle*** ! Ce qui évitera à PHP beaucoup de calculs et des problèmes liés à l'ouverture du dossier.
			
	  }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec du telechargement de la photo !';
     }
	
}
if(isset($_POST['SupprPhoto']))
{
	$repertoire = opendir($dossier); 
	while (false !== ($fichier = readdir($repertoire))) // On lit chaque fichier du répertoire dans la boucle.
	{
		$chemin = $dossier."/".$fichier; // On définit le chemin du fichier à effacer.
		if ($fichier != ".." AND $fichier != "." AND !is_dir($fichier))
		{
					unlink($chemin); // On efface.
		}
	}
	$photo="upload/membres/nophoto.jpg";
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

 ?>

 <br><img src=<?php echo $photo;?> <?php redimage($photo,500,500)?>>
<br><br>
<?php 
$log="vide";
$req0="select loginM from membres where licence='$licence';";

$res0=mysql_query($req0);
while($l=mysql_fetch_array($res0))
{
	$log=$l['loginM'];
}

if(empty($_SESSION['loginM']))
{ 

	if(isset($_POST["action"])&& $_POST["action"]=="Connexion")
	{

		header("location:connexion.php");
	}
		?>
		<form method="POST" action="#">
		Changer la photo
		<input type="submit" name="action" value="Connexion" id="submitButton">
		</form>
		<?php 
}
else
{ 
	if($_SESSION['loginM']!=$log)
	{
	?>
		<form method="POST" action="#">
		Changer la photo
		<input type="submit" name="action" value="Connexion" id="submitButton">
		</form>
	<?php
		if(isset($_POST["action"])&& $_POST["action"]=="Connexion")
		{
			header("location:connexion.php");
		}

	}

	if((isset($_SESSION['loginM']))and($_SESSION['loginM']==$log))
	{ 
	?>
		<form method="POST" action="#">
		<input type=submit name="action" value="Deconnexion" id="submitButtonSupprimer">
		</form> <?php 
		if(isset($_POST["action"])&& $_POST["action"]=="Deconnexion")
		{			
			header("location:deconnexion.php");					
		}
		?>
		<form method="POST" action="#" enctype="multipart/form-data">
		Changer votre photo : <input type="file" name="avatar"></br></br>
		<input type="submit" name="envoyerPhoto" value="Envoyer le fichier" id="submitButtonModif">
		</br></br>
		<input type="submit" name="SupprPhoto" value="Supprimer la photo" id="submitButtonSupprimer"></br></br>
		<div id="tipToMembres"></br>Le téléchargement peut prendre du temps en fonction de votre connexion et de la taille du fichier , si l'upload échoue rééssayez ou choisissez une photo plus petite</br></br></div>
		</form>

		<?php
	
?>





<?php }
}
 ?>

	<script src="jquery/getmatch.js"></script>
	</center>
	</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
	</body>
</html>
<?php ob_end_flush(); ?>