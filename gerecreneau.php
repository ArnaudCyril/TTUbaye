<?php include "parametres.php";

$req=$_POST['requette'];
$req=mysql_query($req);

$html='<table id="membre" border="1" CELLPADDING="4" CELLSPACING="2" width=80% height=60 style="border-color:#ddd;color:#444"><thead><tr><th bgcolor="#b9c9fe">Nom</th><th bgcolor="#b9c9fe">Prenom</th><th bgcolor="#b9c9fe">Classement</th><th bgcolor="#b9c9fe">Rang</th><th bgcolor="#b9c9fe">Progresssion</th></tr></thead><tbody>';
echo $html;
	$requete="select * from challenge order by rang , progression desc;";
	$resultat=mysql_query($requete);
	$class=1;
	while($maLigne=mysql_fetch_array($resultat))
	{
		//maLigne est un tableau associatif correspond a 1 couleur
		$nom=$maLigne['nom'];
		$prenom=$maLigne['prenom'];
		$licence=$maLigne['licence'];
		$pts=$maLigne['points'];
		$rang=$maLigne['rang'];
		$progression=$maLigne['progression'];
		$color="#d3ddff";
		if($class==1)
		{
			$color="#e2b500";
		}
		if($class==2)
		{
			$color="#CECECE";
		}
		if($class==3)
		{
			$color="#D1C78E";
		}
		
		$class++;
		
		if($progression>=0)
		{
			$progression="<span style='color:green'>+".$progression."</span>";
		}
		else
		{
			$progression="<span style='color:red'>".$progression."</span>";	
		}
		
			?>
				<tr>
				<th bgcolor='#d3ddff'><?php echo $nom ?></th>
				<th bgcolor='#d3ddff'><?php echo $prenom ?></th>
				<th bgcolor='#d3ddff'><?php echo $pts ?></th>
				<th bgcolor='#d3ddff'><input type="hidden" id="id<?php echo $licence?>" value="<?php echo $rang ?>"><input type="text" class="challengeInput" name="rang" id="rang<?php echo $licence ?>" value="<?php echo $rang ?>"> <input type="button" id="submitbuttonSupprimer" value="Modifier" onclick="misahchallenge('<?php echo $licence; ?>')"></th>
				<th bgcolor='#d3ddff'><?php echo $progression ?></th>
			</tr>
			<?php
	}

	
?>
</tbody>
</table>
	