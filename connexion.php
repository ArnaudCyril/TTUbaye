<?php ob_start();
include("menu.php");
function deco()
{
	if(isset($_SESSION['modif']))
	{
		unset($_SESSION['modif']);
	}
	if(isset($_SESSION['loginM']))
	{
		unset($_SESSION['loginM']);
	}
	if(isset($_SESSION['modif2']))
	{
		unset($_SESSION['modif2']);
	}
	if(isset($_SESSION['root']))
	{
		unset($_SESSION['root']);
	}
}
$iserror=false;
if(isset($_POST['link'])) { header("location:creercompte.php");}
if(isset($_POST['linkForget'])) { header("location:getmdp.php");}
if(isset($_POST["action"])&& $_POST["action"]=="Se connecter")
{
	deco();
	$page=$_SESSION['prevent'];
	$login=$_POST["inputlogin"];
	$mdp=$_POST["inputMdp"];
	$req="select * from login;";
	$resultat=mysql_query($req);
	$error="";
	
	
	$nb=0;

	while($maLigne=mysql_fetch_array($resultat))
	{
		$nb++;
		if($login==$maLigne['login']&&$mdp==$maLigne['mdp'])
		{
			$req2="select * from login where login='$login';";
			$res=mysql_query($req2);
			while($ligne=mysql_fetch_array($res))
			{
				$type=$ligne['type'];
			}
			if($type==1)
			{
				$_SESSION['root']=$login;
				//echo $login." ".$_SESSION['root'];
				$_SESSION['loginM']=$login;
				$req3="select * from membres where loginM='$login';";
				$rep2=mysql_query($req3);
				while($ligne=mysql_fetch_array($rep2))
				{
					$licence=$ligne['licence'];
				}
				echo $licence;
				$_SESSION['modif2']=$licence;
				//echo $page;
				header("location:$page");
			
			}
			else
			{
				$reqAnnexe="select * from membres where loginM='$login'";
				$repAnnexe=mysql_query($reqAnnexe);$nbRes=0;
				$nbRes = mysql_num_rows($repAnnexe);
				if($nbRes==0)
				{
					if(isset($_SESSION['modif']))
					{
						unset($_SESSION['modif']);
					}
					if(isset($_SESSION['loginM']))
					{
						unset($_SESSION['loginM']);
					}
					$_SESSION['loginM']=$login;
					header("location:$page");
				}
				else
				{
					if(isset($_SESSION['modif']))
					{
						$licence=$_SESSION['modif'];
						unset($_SESSION['modif']);
			
			
						echo "Connexion r&eacuteussie !";
						echo $licence;
						$_SESSION['loginM']=$login;
						$_SESSION['modif2']=$licence;
						header("location:$page");
					}
					else
					{
						$req2="select * from Membres where loginM='$login';";
						$rep=mysql_query($req2);
						while($ligne=mysql_fetch_array($rep))
						{
							$licence=$ligne['licence'];
						}
						echo $licence;
						$_SESSION['loginM']=$login;
						$_SESSION['modif2']=$licence;
						header("location:$page");
					}
				}
			}
		}
	}
		
	
	if($nb==mysql_num_rows($resultat))
	{ $error="Login ou mot de passe incorect";$iserror=true;}
	
}?>


<html>
	<head>
		<title>
			Login - Tennis de Table Ubaye
		</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
	<div id="container">
	<center><img src="./images/icones/connexion.png"  id="imgDebutPage"/><span id="titre">  Connectez-vous</span></center>
<br><br>
			<?php if($iserror) { ?> <center><h4 id="infoMail"><?php echo $error ?></h4></center> <?php } ?>
			<form name="Log" method="POST" id="connexion">
			Login :<br> <input type="text" name="inputlogin" /><br></br>
			Mot de passe : <br><input type="password" name="inputMdp"/></br></br>
			<input type="submit" name="action" value="Se connecter" id="submitButtonPlein"/></br></br>
			<div id="for1200"><input type="submit" style="border:1px solid green;" name="link"  id="submitButtonModif" value="Cre&eacute;r mon compte"/>
			</br></br><input type="submit" style="border:1px" name="linkForget"  id="submitButtonSupprimer"  value="Mot de passe oublié"/>
			</div>
			<div id="for1600"><input type="submit" style="border:1px solid green;width:27%;" name="link"  id="submitButtonModif" value="Cre&eacute;r mon compte"/>
			<input type="submit" style="border:1px solid red;width:27%;" name="linkForget"  id="submitButtonSupprimer"  value="Mot de passe oublié"/>
			</div>			
			</br></br>
			</form>
			<div id="tipToMembres">
			<p>Pour les licenci&eacutes du club , votre login est : votreNom + 1ere Lettre De Votre Prenom , votre mot de passe est votre num&eacutero de licence.</p>
			<p>Exemple pour Friggi Daniel: login friggid , mot de passe : 04***</p> 
			<p>Exemple pour Jouarie Pierre-Philippe: login jouariepp , mot de passe : 78*****</p> 
			</div>
			</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
	</body>
</html>
<?php ob_end_flush(); ?>