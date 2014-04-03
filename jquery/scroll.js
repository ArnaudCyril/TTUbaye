$(document).ready(function(){ // Quand le document est compl�tement charg�
 
	var load = false; // aucun chargement de commentaire n'est en cours
	var lastScrollTop = 0;
	var nbScroll=1;
	/* la fonction offset permet de r�cup�rer la valeur X et Y d'un �l�ment
	dans une page. Ici on r�cup�re la position du dernier div qui 
	a pour classe : ".commentaire" */
	var offset = $('.endComm:last').offset(); 
 
	$(window).scroll(function(){ // On surveille l'�v�nement scroll
 
 
		 var st = $(this).scrollTop();
		nbScroll++;
		/* Si l'on scroll suffisament , si aucun chargement 
		n'est en cours, si le nombre de commentaire affich� est sup�rieur 
		� 5 et si tout les commentaires ne sont pas affich�s, alors on 
		lance la fonction. */

		
		if((st > lastScrollTop) && (nbScroll%4==0)
		&& load==false && ($('.commentaire').size()>=2) && 
		($('.commentaire').size()!=$('.nb_com').text())){
			
			// la valeur passe � vrai, on va charger
			load = true;
			lastScrollTop = st;
			//On r�cup�re l'id du dernier commentaire affich�
			var last_id = $('.commentaire:last').attr('id');
			
 
			//On affiche un loader
			$('.loadmore').show();
 
			//On lance la fonction ajax
			$.ajax({
				url: 'getNews.php',
				type: 'get',
				data: 'last='+last_id,
 
				//Succ�s de la requ�te
				success: function(data) {
 
					//On masque le loader
					$('.loadmore').fadeOut(500);
					/* On affiche le r�sultat apr�s
					le dernier commentaire */
					$('.commentaire:last').after(data);
					/* On actualise la valeur offset
					du dernier commentaire */
					offset = $('.commentaire:last').offset();
					//On remet la valeur � faux car c'est fini
					load = false;
				}
			});
		}
 
 
	});
 
});
 
