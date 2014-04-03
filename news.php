<?php include('menu.php');
$news=$_GET['news'];
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
	$effet=$tabEffect[6];
	$tabSize="";
	foreach ($tabPhoto as $i => $value) {
	$tabSize[$i]=redimage2($value,800,800);
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
	$html.='<img src="'.$value2.'" id="'.$n.'"  class="photoStyle2" '.$tabSize[$i2].' title="'.$tabTitle[$i2].'">';
	}
	$html.='</div></br><center><span id="buttonContainer'.$idPost.'"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label onclick="gereDiapo('.$idPost.',this.id)" class="gereButton'.$idPost.'" id="pausediapo" ><img src="./images/icones/pause.png" width="30" height="30"></label></center>';
	echo $html;
	
}
if(isset($_POST["action"])&& $_POST["action"]=="Envoyer")
	{
		//j'enregistre
		//recup du login et du mdp
		
		
		$mess=$_POST["inputComm"];
		$login=$_SESSION['loginM'];
		$date=date("20y-m-d");
		if($mess!="")
		{
		$mess=str_replace('"','\"',$mess);
		$mess=str_replace("'","\'",$mess);
		$maRequette2="insert into messages values(null,'$mess',null,'$date',2,'$login',null,'$news');";
		$resultat2=mysql_query($maRequette2);
		
			$req10="select * from messages where id='$news'";
			$rep10=mysql_query($req10);
			$ligne10=mysql_fetch_array($rep10);
			
			$tit=$ligne10['title'];
			//echo $tit;
			 mail('04arnaudbis@gmail.com',$tit,"Alerte , ca marche pour moi !");
		}
	
	}
if(isset($_POST["actionModif"])&& $_POST["actionModif"]=="Modifier")
	{	
		$mess=$_POST["inputAModif"];
		$id=$_POST["idInputHidden"];
		if($mess!="")
		{
		$mess=str_replace('"','\"',$mess);
		$mess=str_replace("'","\'",$mess);
		$maRequette3="update messages set message='$mess' where id = '$id'";
		$resultat3=mysql_query($maRequette3);
		}
	
	}	
if(isset($_POST["actionModif"])&& $_POST["actionModif"]=="Supprimer")
	{	
		$id=$_POST["idInputHidden"];
		$maRequette4="delete from messages where id = '$id'";
		$resultat4=mysql_query($maRequette4);

	
	}	

		$req="select * from messages where id='$news'";
			$rep=mysql_query($req);
			while($ligne=mysql_fetch_array($rep))
			{
				$id=$ligne['id'];
				$mess=$ligne['message'];
				$tit=$ligne['title'];
				$date=$ligne['dateN'];
				$log=$ligne['login'];
			}
		$req2="select * from media where idMess=$id and youtube is null ";
		$rep2=mysql_query($req2);
		$nbRep=mysql_num_rows($rep2);
		$img="";
		if($nbRep>0)
		{
			if($nbRep==1)
			{
				$line=mysql_fetch_array($rep2);
				$img=$line['urlPhoto'];
				$titrePhoto=$line['titrePhoto'];
				$about=$line['concern'];
				$tabP[0]=$line['urlPhoto'];

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
					$about=$line['concern'];
					$tabT[$noPhoto-1].=" Photo ".$noPhoto;
										
				}
			}
		}		
			

				?>
<html>
<head>
<title><?php echo $tit ?> - Tennis de table Ubaye</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="./jquery/creatediapo.js"></script>
<script type="text/javascript" src="./jquery/goTop.js"></script>

</head>
<body>

<div id="container">
<center>
 <a id="submitButton" href="actualites.php"><img src="./images/icones/retour.png" id="imgSubmitBtm" style="vertical-align:-10px;"/> &nbsp;Retour</a>
 </center>  
	<br><br>

				<p id="news">Le <?php echo date("d/m/Y", strtotime($date)) ?> </p><br> 
				<h3 id="news"><?php echo $tit ?></h3><br> 
				<h4 id="news"> <?php echo $mess ?> </h4> <br>
				<?php if(isset($img) and $img!="")
					{
						?>  <img id="center"  class="photoStyle2" src=<?php echo $img?> <?php redimage($img,700,700)?> ></br></br><?php
					}
					if($nbRep>1)
					{
							
							createDiapo($tabP,$tabT,$id);
					}
					$mare="select * from media where idMess='$id' and youtube is not null;";
					$marep=mysql_query($mare);
					while($ligneRep=mysql_fetch_array($marep))
					{
						?><center></br></br></br><iframe width="760" height="515" src="//www.youtube.com/embed/<?php echo $ligneRep['youtube'] ?>" frameborder="0" allowfullscreen></iframe></center><?php
					}
					?>
				<div id="commentaire">
				<br><br><hr id="news2">
		<center> 
		<?php
		if(empty($_SESSION["loginM"]))
		{?>
				<a href="connexion.php" id="submitButton">Connectez vous pour commenter </a>
	<?php
		} ?>
		
		<span id="hide_ordi"></br></br></span>
		<span id="hide_mobile">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
		Partager sur facebook : 	
		<a name="fb_share" type="button_count" expr:share_url='data:post.url' href="http://www.facebook.com/sharer.php">Partager</a>
		</center>

		<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script></br>
		
		<?php 
		if(isset($_SESSION['loginM']))
		{ ?>
		<form name="formComm" method="POST" action="news.php?news=<?php echo $news;?>#commentaire" style="margin-left:8%">
		Commentaire : </br><textarea  name="inputComm" id="textarea" rows=6 COLS=100 style="resize: none;" placeholder="Laissez votre commentaire..."></textarea></br>
		<input type="submit" name="action" value="Envoyer" id="submitButton"/>

		</form> 
		
		<?php 
		}

	
		?>
		
		</br>
		<?php 
			$req="select * from messages where statut=2 and refer=$news order by id desc";
			$rep=mysql_query($req);
			$nbCom=0;
			while($ligne=mysql_fetch_array($rep))
			{
				$nbCom++;
				$mess=$ligne['message'];
				$login=$ligne['login'];
				$identite=$ligne['login'];
				$date=$ligne['dateN'];
				$id=$ligne['id'];
				$req2="select * from membres where loginM='$login'";
				$rep2=mysql_query($req2);
				$ligne2=mysql_fetch_array($rep2);
				if($ligne2['prenom']!="")$identite=$ligne2['prenom'];
			
		
					if(isset($_SESSION['loginM']) and ($_SESSION['loginM']==$login))
					{ 	?>
						<form name="formModifComm" method="POST" action="news.php?news=<?php echo $news;?>#commentaire">
						<p>Par : <?php echo $identite ?></p>
						<input type="hidden" name="idInputHidden" value="<?php echo $id ?>"/> 
						<p>Le :<?php echo date("d/m/Y", strtotime($date))?></p>
						<textarea name="inputAModif" id="textarea" rows=6 COLS=100 style="resize: none;" placeholder="Laissez votre commentaire..."><?php echo $mess ?></textarea></br>
						<input type="submit" name="actionModif" value="Modifier" id="submitButtonModif"/>
						<input type="submit" name="actionModif" value="Supprimer" id="submitButtonSupprimer"/>
						</br><hr id="news2"></br>
						</form>
						<?php
					}
					
					else
					{ ?>
						
						<p>Par : <?php echo $identite ?></p>
						<p>Le :<?php echo date("d/m/Y", strtotime($date))?></p>
						<div id="CommContent">
						<h4><?php echo $mess ?></h4></div>
						</br></br></br><hr id="news2">
						<?php 
					} 
		
		}
		if($nbCom==0)
		{?>
		<center><h4 style="font-style:italic">Pas encore de commentaire , soyez le premier a commenter !</h4></center>
	<?php }
		
		?>
		</div>

</div>
<a href="#" class="back-to-top">&#9650;</a>
<?php include 'footer.php' ?>
</body>
</html>