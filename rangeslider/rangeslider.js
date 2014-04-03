		$(function() {

			//Store frequently elements in variables
			var slider  = $('#slider');
			 var value1 = value2 = 0;
			//Hide the Tooltip at first

			//Call the Slider
			slider.slider({
				//Config
				range: true,
				step:5,
				min: 100,
				max:220,
				animate: "fast",
				values: [ 180, 200 ],

				//Slider Event
				slide: function(event, ui) { //When the slider is sliding
				value1 = ui.values[0];
				value2 = ui.values[1];
				$(this).next().val(value1);
				$(this).prev().val(value2);
				var h1=""; var h2="";var temp1=0; var temp2=0;
					if(value1%10!=0)
					{
						value1=value1/10;
						temp1=Math.floor(value1);
						h1=temp1+"h 30";
					}
					else
					{
						value1=value1/10;
						h1=value1+"h";
					}
					$("#h1").text("");
					$("#h1").append(h1);
				
					if(value2%10!=0)
					{
						value2=value2/10;
						temp2=Math.floor(value2);
						h2=temp2+"h 30";
					}
					else
					{
					value2=value2/10;
					h2=value2+"h";
					}	
					$("#h2").text("");
					$("#h2").append(h2);
				
				

				}
			});

		});
		
		///////////////////////////////////////

		$(function() {

			//Store frequently elements in variables
			var slider  = $('#slider2');
			 var value1 = value2 = 0;
			//Hide the Tooltip at first

			//Call the Slider
			slider.slider({
				//Config
				range: true,
				step:5,
				min: 100,
				max:220,
				animate: "fast",
				values: [ 100, 220 ],

				//Slider Event
				slide: function(event, ui) { //When the slider is sliding
				value1 = ui.values[0];
				value2 = ui.values[1];
				$(this).next().val(value1);
				$(this).prev().val(value2);
				var h1=""; var h2="";var temp1=0; var temp2=0;
					if(value1%10!=0)
					{
						value1=value1/10;
						temp1=Math.floor(value1);
						h1=temp1+"h 30";
					}
					else
					{
						value1=value1/10;
						h1=value1+"h";
					}
					$("#ha1").text("");
					$("#ha1").append(h1);
				
					if(value2%10!=0)
					{
						value2=value2/10;
						temp2=Math.floor(value2);
						h2=temp2+"h 30";
					}
					else
					{
					value2=value2/10;
					h2=value2+"h";
					}	
					$("#ha2").text("");
					$("#ha2").append(h2);
				
				

				}
			});

		});
		
function addc()
{
var valuec="";var cate="";var hdebut=0;var hfin=0;
var req="";

	valuec=$("#addDays input[type=radio]:checked").val();
	cate=$("#addCate input[type=radio]:checked").val();
	hdebut=$("#slider2").slider( "values", 0 );
	hfin=$("#slider2").slider( "values", 1 );
	var rang=100; var rangD=100;
	if(cate==".E.L 5-7") { rang=1; };
	if(cate=="C.E.L 8-11") { rang=2; };
	if(cate=="C.E.L 12-17") { rang=3; };
	if(cate=="C.E.L Collège") { rang=4; };
	if(cate=="C.E.L Lycée") { rang=5; };
	if(cate=="Loisirs Jeunes") { rang=6; };
	if(cate=="Loisirs Adultes") { rang=7; };
	if(cate=="Compétition Jeunes") { rang=8; };
	if(cate=="Compétition Adultes") { rang=9 ;};
	
	if(jour=="Lundi") { rangD=1; } if(jour=="Mardi") { rangD=2; } if(jour=="Mercredi") { rangD=3; } if(jour=="Jeudi") { rangD=4; }
	if(jour=="Vendredi") { rangD=5; } if(jour=="Samedi") { rangD=6; } if(jour=="Dimanche") { rangD=7; } 
	
	req="insert into creneau values(null,'"+valuec+"' , '"+cate+"' , "+hdebut+" , "+hfin+" , "+rang+" ,"+rangD+") ;";
	
	
	$.post( "addcreneau.php", { requette:req }).done(function( data ) {  });

					var h1=""; var h2="";var temp1=0; var temp2=0;
					if(hdebut%10!=0)
					{
						hdebut=hdebut/10;
						temp1=Math.floor(hdebut);
						h1=temp1+"h 30";
					}
					else
					{
						hdebut=hdebut/10;
						h1=hdebut+"h";
					}
				
					if(hfin%10!=0)
					{
						hfin=hfin/10;
						temp2=Math.floor(hfin);
						h2=temp2+"h 30";
					}
					else
					{
					hfin=hfin/10;
					h2=hfin+"h";
					}
	
	$("#addrep").text("");
	$("#addrep").append('Nouveau créneau enregistré : '+valuec+' de '+h1+' à '+h2+' pour : '+cate+'').hide().fadeIn(500);


	

}
function search()
{
	hdebut=$("#slider").slider( "values", 0 );
	hfin=$("#slider").slider( "values", 1 );
	nbJour=0;
	nbCate=0;
	 var req="select * from creneau where ("; var test=0;
	$("#days input[type=checkbox]:checked").each(function() {
	 if(test>0) { req+=" or "; }
	 req+="jour='"+$(this).val()+"'";
	 test++;
	 nbJour++;
	});
	req+=" ) and ( ";
	test=0;
	$("#cate input[type=checkbox]:checked").each(function() {
	 if(test>0) { req+=" or "; }
	 req+="categorie='"+$(this).val()+"'";
	 test++;
	 nbCate++;
	});
	
	
	//req+=" ) and ( hdebut>="+hdebut+" or hfin<="+hfin+" )";
	req+=" ) and ((hdebut<="+hdebut+" and hfin>="+hfin+") or (hdebut<="+hdebut+" and hfin>"+hdebut+") or (hdebut>"+hdebut+" and hdebut<"+hfin+"))";
	
	
	$.post( "seekcreneau.php", { requette:req , debut:hdebut , fin:hfin , jour:nbJour , cate:nbCate }).done(function( data ) { 
	
	//if ($("#navMobileCren").is(":visible")){
	// $('#days').css("float","none");$('#days').css("width","90%");
	// $('#cate').css("float","none");$('#cate').css("width","90%");
	// $('#horaire').css("float","none");$('#horaire').css("width","90%");
	//}
	$("#repcreneauC").text("");

	$("#repcreneauC").append(data).hide().fadeIn(400);
	$('html, body').animate({
        scrollTop: $("#goSearch").offset().top
    }, 1000);
	//$("#test").text(req);

	});
	
}
function addappear(){
$("#addcreneau").slideToggle(500);
if($(".buttonaddcreneau").text()!="Cacher")
	{
		$(".buttonaddcreneau").text("Cacher");
	}
else{
		$(".buttonaddcreneau").text("+ Ajouter un créneau + ");
		$("#addrep").hide();

}
}
function modifappear()
{
$("#modifcreneau").slideToggle(500);
if($(".buttonmodifcreneau").text()!="Cacher")
	{
		$(".buttonmodifcreneau").text("Cacher");
	}
else{
		$(".buttonmodifcreneau").text("* Modifier un créneau * ");

}
}

function lessCren()
{
	hdebut=$("#slider").slider( "values", 0 );
	hfin=$("#slider").slider( "values", 1 );
	
	if(hdebut>=105)
	{
	var nh1=hdebut-5;
	$( "#slider" ).slider( "option", "values", [ nh1, hfin ] );
	
	var value1=nh1; var h1=""; var h2="";var temp1=0; var temp2=0;
					if(nh1%10!=0)
					{
						value1=value1/10;
						temp1=Math.floor(value1);
						h1=temp1+"h 30";
						//alert(h1);
					}
					else
					{
						value1=value1/10;
						h1=value1+"h";
						//alert(h1);
					}
					$("#h1").text("");
					$("#h1").append(h1);
	}
} 
function moreCren()
{
	hdebut=$("#slider").slider( "values", 0 );
	hfin=$("#slider").slider( "values", 1 );
	
	if(hdebut<=215 && hdebut+5<hfin)
	{
	var nh2=hdebut+5;
	$( "#slider" ).slider( "option", "values", [ nh2, hfin ] );
	
	var value1=nh2; var h1=""; var h2="";var temp1=0; var temp2=0;
					if(nh2%10!=0)
					{
						value1=value1/10;
						temp1=Math.floor(value1);
						h1=temp1+"h 30";
						//alert(h1);
					}
					else
					{
						value1=value1/10;
						h1=value1+"h";
						//alert(h1);
					}
					$("#h1").text("");
					$("#h1").append(h1);
	}
} 
//////
function lessCren2()
{
	hdebut=$("#slider").slider( "values", 0 );
	hfin=$("#slider").slider( "values", 1 );
	
	if(hfin>=105 && hfin>hdebut+5)
	{
	var nh1=hfin-5;
	$( "#slider" ).slider( "option", "values", [ hdebut, nh1 ] );
	
	var value1=nh1; var h1=""; var h2="";var temp1=0; var temp2=0;
					if(nh1%10!=0)
					{
						value1=value1/10;
						temp1=Math.floor(value1);
						h1=temp1+"h 30";
						//alert(h1);
					}
					else
					{
						value1=value1/10;
						h1=value1+"h";
						//alert(h1);
					}
					$("#h2").text("");
					$("#h2").append(h1);
	}
	
} 
function moreCren2()
{
	hdebut=$("#slider").slider( "values", 0 );
	hfin=$("#slider").slider( "values", 1 );
	
	if(hfin<=215)
	{
	var nh2=hfin+5;
	$( "#slider" ).slider( "option", "values", [ hdebut, nh2 ] );
	
	var value1=nh2; var h1=""; var h2="";var temp1=0; var temp2=0;
					if(nh2%10!=0)
					{
						value1=value1/10;
						temp1=Math.floor(value1);
						h1=temp1+"h 30";
						//alert(h1);
					}
					else
					{
						value1=value1/10;
						h1=value1+"h";
						//alert(h1);
					}
					$("#h2").text("");
					$("#h2").append(h1);
	}
	
}