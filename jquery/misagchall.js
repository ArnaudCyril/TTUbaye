function misahchallenge(lic,nbMax)
{
	var licence=lic;
	var rang=$("#rang"+licence).val();
	var oldrang=$("#id"+licence).val();
	
	if(rang<1 || rang>nbMax)
	{
		$("#rang"+licence).val(oldrang);
		alert("Le rang doit etre un nombre , compris entre 1 et "+nbMax+"...");	
	}
	else
	{
		var diff=oldrang-rang;	
		var req="update challenge set rang="+rang+"  , progression="+diff+" where licence='"+licence+"'";
		$.post( "gerecreneau.php", { requette:req }).done(function( data ) { 
		$("#challenge").text("");
		$("#challenge").append(data).hide().fadeIn(400);
		});
	}
}