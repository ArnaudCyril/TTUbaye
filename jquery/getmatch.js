function afficheIframe(adresse)
{
	if($('#iframeMatch').text()=="")
	{
		$('#buttonVoirMatch').val("Cacher les matchs");
		$('#iframeMatch').append('<iframe src="'+adresse+'" width="94%" height="680" border="1""> ');
		$('#iframeMatch').hide().slideToggle();
	}
	else
	{
		$('#iframeMatch').text("");	
		$('#iframeMatch').append('<iframe src="'+adresse+'" width="94%" height="680" border="1""> ');
		$('#iframeMatch').slideToggle();
		if($('#buttonVoirMatch').val()=="Cacher les matchs")
		{
			$('#buttonVoirMatch').val("Voir les matchs");
		}
		else
		{
			$('#buttonVoirMatch').val("Cacher les matchs");
		}
	}
}