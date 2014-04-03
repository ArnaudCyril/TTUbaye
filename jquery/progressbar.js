(function() {

var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');

$('#addnews').ajaxForm({
		beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    complete: function(xhr) {
     bar.width("100%");
    percent.html("100%");
    status.html(xhr.responseText);
	
	document.location.href="http://ttubaye.com/index.php"
    }
}); 

})();

function getRelatedPost() {
	var files=$('#inputFile').val();
	var lien=$('#linkgiven').val();
	if(files.length<2 && lien.length<1) // si pas de vidéo sélectionnéé OU pas de lien donné
	{	
			$("#divError").text("");
			$("#divError").append('<center><h4 id="infoMail">Vous n\'avez pas sélectionné de vidéo et pas donné de lien !</h4></center>');				
		
	}
	else
	{
			if(lien.length<1) // et qu il n y a pas de vidéo sélectionnéé
			{
				var article=$('#related').val();
				var videoname=$('#videoNa').val();
			
				//alert(videoname);
				//alert(article);
				$.post("traitervideo.php", { id:article , name:videoname });
				setTimeout("$('#ytform').submit()", 1000);
				$("#load").hide().fadeIn(700);
			}
			else{
					var article=$('#related').val();
					var videoname=$('#videoNa').val();
					var video_id = lien.split('v=')[1];
					var ampersandPosition = video_id.indexOf('&');
					if(ampersandPosition != -1) {
					video_id = video_id.substring(0, ampersandPosition);
					}
					$.post("traitervideo2.php", { id:article , name:videoname , lien:video_id });
					setTimeout(function() {   document.location.href="http://ttubaye.com/upload.php"    }, 1000);		
				}
		
	}
		//alert("ok");
}  
function gereButtonSend() {

var files=$('#inputFile').val();
var lien=$('#linkgiven').val();

	if(files.length>2)
	{
		$(".buttonSent").removeAttr('disabled'); 
		$(".buttonSent").attr('id',"submitButton"); 
		
	}
	else
	{	
		if(lien.length>0)
		{
				$(".buttonSent").removeAttr('disabled'); 
				$(".buttonSent").attr('id',"submitButton"); 
		}
		else
		{
			$(".buttonSent").attr('disabled',true);
			$(".buttonSent").attr('id',"submitButtonD"); 
		}
	}

}
function gereRadio(val,id) {

var files=$('.radio').val();
	if(files.length>2 && val==0 && $('#radio'+id).text()=="")
	{

		$('#radio'+id).append('Compétition : <input type="radio" name="concern" value="equipes" checked>Championnat (par equipes)<input type="radio" name="concern" value="indiv"> Individuelle	<input type="radio" name="concern" value="autre"> Ne concerne pas une compétition : </br>');
	}
	else
	{		
		//alert('2');

	}

}
