function afficheForm()
{

			
			if ($("#formYt").is(":visible")){
				$("#addVideo").css("border","4px solid rgba(255, 0, 0,0)");
				$("#addPhotos").css("border","4px solid rgba(255, 0, 0,0)");
			}
			else
			{
				$("#addVideo").css("border-top","4px solid #0003B3");
				$("#addPhotos").css("border-top","4px solid rgba(255, 0, 0,0)");
			}

			$("#addPhoto").hide();
			$("#formYt").slideToggle();

}


function afficheForm2()
{
	

		if ($("#addPhoto").is(":visible")){
			$("#addVideo").css("border","4px solid rgba(255, 0, 0,0)");
			$("#addPhotos").css("border","4px solid rgba(255, 0, 0,0)");
		}
		else
		{
			$("#addPhotos").css("border-top","4px solid #0003B3");
			$("#addVideo").css("border","4px solid rgba(255, 0, 0,0)");
		}

		$("#formYt").hide();
		$("#addPhoto").slideToggle();
}
