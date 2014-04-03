function getMedia(media)
{

	var choix="aucun";
	
	if(media=="choixMediaAll") { choix="aucun";$(".choixMedia").css("background","#e1e1e1");$(".choixMedia").css("border-bottom","1px solid #bbb");$("#choixMediaAll").css("border-bottom","1px solid white");$("#choixMediaAll").css("background","white") }
	if(media=="choixMediaTeam") { choix="equipes";$(".choixMedia").css("background","#e1e1e1");$(".choixMedia").css("border-bottom","1px solid #bbb");$("#choixMediaTeam").css("border-bottom","1px solid white");$("#choixMediaTeam").css("background","white") }
	if(media=="choixMediaIndiv") { choix="indiv"; $(".choixMedia").css("background","#e1e1e1");$(".choixMedia").css("border-bottom","1px solid #bbb");$("#choixMediaIndiv").css("border-bottom","1px solid white");$("#choixMediaIndiv").css("background","white")}
	if(media=="choixMediaOther") { choix="autres"; $(".choixMedia").css("background","#e1e1e1");$(".choixMedia").css("border-bottom","1px solid #bbb");$("#choixMediaOther").css("border-bottom","1px solid white");$("#choixMediaOther").css("background","white")}
	if(media=="choixMediaVideos") { choix="video"; $(".choixMedia").css("background","#e1e1e1");$(".choixMedia").css("border-bottom","1px solid #bbb");$("#choixMediaVideos").css("border-bottom","1px solid white");$("#choixMediaVideos").css("background","white")}
	
	$.post( "geremedia.php", { choixmedia:choix })  .done(function( data ) {
	$("#afficheMedia").text("");
	$("#afficheMedia").append("</br></br></br></br>"+data+"</br></br>"); 
	
	
	});
}
