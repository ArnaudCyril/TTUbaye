		$(document).ready(function(){
		var temp=-255; var temp2=-305; var temp3=-355;var temp4=-155;var temp5=-255;
		var tot=temp+temp2+temp3+temp4+temp5;
			$('#btnMenu').click(function(){
				$('#menuMobile').slideToggle(050);
				temp=temp*-1;
				$('#container').animate({marginTop:'+='+temp+'px'},050);
			});
				$('#LienMenuClub').click(function(){
				
				$('#menuMobileClub').slideToggle(050);
				temp2=temp2*-1;
				$('#container').animate({marginTop:'+='+temp2+'px'},050);
				if(temp2>0){
				$('#itemMenuTxtClub').text(' \u25BC Le club');
				}
				else{
				$('#itemMenuTxtClub').text(' \u25B6 Le club');
				}
				

			});
				$('#LienMenuCompet').click(function(){
				$('#menuMobileCompet').slideToggle(050);
				temp3=temp3*-1;
				$('#container').animate({marginTop:'+='+temp3+'px'},050);
				if(temp3>0){
				$('#itemMenuTxtCompet').text(' \u25BC Compétition');
				}
				else{
				$('#itemMenuTxtCompet').text(' \u25B6 Compétition');
				}

			});
				$('#LienMenuLoisir').click(function(){
				$('#menuMobileLoisir').slideToggle(050);
				temp4=temp4*-1;
				$('#container').animate({marginTop:'+='+temp4+'px'},050);
				if(temp4>0){
				$('#itemMenuTxtLoisir').text(' \u25BC Loisir');
				}
				else{
				$('#itemMenuTxtLoisir').text(' \u25B6 Loisir');
				}

			});
				$('#LienMenuAutres').click(function(){
				$('#menuMobileAutres').slideToggle(050);
				temp5=temp5*-1;
				$('#container').animate({marginTop:'+='+temp5+'px'},050);
				if(temp5>0){
				$('#itemMenuTxtAutre').text(' \u25BC Autres');
				}
				else{
				$('#itemMenuTxtAutre').text(' \u25B6 Autres');
				}

			});
					$(window).resize(function() {
					$(window).width();   // returns width of browser viewport
					$(document).width(); // returns width of HTML document

					$(window).height();   // returns heightof browser viewport
					$(document).height(); // returns height of HTML document
					var width = $(window).width(); 
					var height = $(window).height(); 

					if (width >= 960  ) {
					var el=$('#container');
					el.css('margin-top','-0.05%');
					$('#menuMobile').hide();$('#menuMobileClub').hide();$('#menuMobileCompet').hide();$('#menuMobileLoisir').hide();$('#menuMobileAutres').hide();
					$('#LienMenuClub').text('\u25B6 Le club');$('#LienMenuCompet').text('\u25B6 Compétition');$('#LienMenuLoisir').text('\u25B6 Loisir');$('#LienMenuAutres').text('\u25B6 Autres');
					temp=-255;temp2=-255;temp3=-305;temp4=-105;temp5=-155;
					}
					else{
					if(temp+temp2+temp3+temp4+temp5==tot)
					{
						var el=$('#container');
						el.css('margin-top','2%');
					}
					}

			});
		})