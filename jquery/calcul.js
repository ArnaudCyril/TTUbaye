var startingNo = 0;
	var $node = "";
	for(varCount=0;varCount<=startingNo;varCount++){
		var displayCount = varCount+1;
		$node += '<p id="p'+displayCount+'"><label for="var'+displayCount+'">Adversaire n° '+displayCount+': </label><input placeholder="ex:1287" type="text" name="var'+displayCount+'" id="var'+displayCount+'" class="inputCalcul">&nbsp;<span id="submitButtonSupprimer" style="top:-5px;">X</span>';
		$node += '<span id="slideshowMobile"></br></span>	&nbsp;	&nbsp;	<INPUT type="radio" name="'+displayCount+'" value="gagne" class="buttonCalcul" checked >Gagné <INPUT class="buttonCalculL" type="radio" name="'+displayCount+'" value="perdu" >Perdu</p>';
	}
	$('#contentAdv').prepend($node);
	$("#p"+varCount+"").hide();$("#p"+varCount+"").fadeIn(500);
	
	$('#adversaire').on('click', '#submitButtonSupprimer', function(){
	if(varCount>1)
	{
		var parent=$(this).parent();
		var nop=parent.text();
		var start=1000;var nop2="";
		for(var i=0;i<nop.length;i++)
		{
			if(nop[i]==':')
			{
				start=i;
			}
			if(i>=start)
			{
				nop2+=nop[i];
			}
		}
		var toRemove=nop2;
		var toRemove2="Adversaire n° ";
		var nop=nop.replace(toRemove,'');
		var nop=nop.replace(toRemove2,'');
		if(nop<varCount)
		{
			nop++;
			for(var i=nop;i<=varCount;i++)
			{
				var temp=i-1;
				$("label[for='var"+i+"']").text("Adversaire n° "+temp+": ");
				$("label[for='var"+i+"']").attr('for','var'+temp);
				$("input[name='var"+i+"']").attr('id','var'+temp);
				$("input[name='var"+i+"']").attr('name','var'+temp);
				$("input[name="+i+"]").attr('name',temp);
				$("p[id=p"+i+"]").attr('id','p'+temp);
			}
		}
		
		var self = $(this).parent();
		self.fadeOut(700);
		setTimeout(function () { self.remove();}, 300);
		varCount--;
	}	
	});

	$('#submitButton').on('click', function(){
		//new node
		varCount++;
		$node = '<p id="p'+varCount+'"><label for="var'+varCount+'">Adversaire n° '+varCount+': </label><input type="text" name="var'+varCount+'" id="var'+varCount+'" class="inputCalcul">&nbsp;<span id="submitButtonSupprimer">X</span>';
		$node += '<span id="slideshowMobile"></br></span>	&nbsp;	&nbsp;	<INPUT type="radio" name="'+varCount+'" value="gagne" class="buttonCalcul" checked >Gagné <INPUT class="buttonCalculL" type="radio" name="'+varCount+'" value="perdu" >Perdu</p>';
		$('#contentAdv').append($node);
		$("#p"+varCount+"").hide();$("#p"+varCount+"").fadeIn(700);
	});
	
function buildRow(value)
{
	
	if(value==1){end=4;}
	if(value==6){end=5;}
	if(value==5 || value==2 || value==3 || value==4){end=7;}
	var startingNo = end-2;
	end--;
	if(value!=-1)
	{
		if(varCount>end)
		{
			var n=varCount-end;
			var varc=varCount;
			for(var i=0;i<n;i++)
			{
				var soustraire=varc-i;
				var self = $("#p"+soustraire+"");
				self.fadeOut(700);
				setTimeout(function () { self.remove();}, 300);
				varCount--;
			}
		}
		if(varCount<end)
		{
		var n=end-varCount;
			for(var i=0;i<n;i++)
			{
			varCount++;
			$node = '<p id="p'+varCount+'"><label for="var'+varCount+'">Adversaire n° '+varCount+': </label><input type="text" name="var'+varCount+'" id="var'+varCount+'" class="inputCalcul">&nbsp;<span id="submitButtonSupprimer">X</span>';
		$node += '<span id="slideshowMobile"></br></span>	&nbsp;	&nbsp;	<INPUT type="radio" name="'+varCount+'" value="gagne" class="buttonCalcul" checked >Gagné <INPUT class="buttonCalculL" type="radio" name="'+varCount+'" value="perdu" >Perdu</p>';
			$('#contentAdv').append($node);
			$("#p"+varCount+"").hide();$("#p"+varCount+"").fadeIn(700);
			}
		}
	}
}
function calculer()
{
	var error=false;liberror="";
	var mespoints= parseFloat($("#mespoints").val());
	var mespointstemp=mespoints;
	if(!(mespoints>300 && mespoints<4000))
	{
		error=true;
		liberror="Vos points sont mal saisis";
	}
	if(!(error))
	{
	for(var i=0;i<varCount;i++)
		{
	
		var n=i+1;
		var win=$('input[type=radio][name='+n+']:checked').val();
		var autrep=$('input[type=text][name="var'+n+'"]').val();
		if(!(autrep>300 && autrep<4000))
		{
			error=true;
			liberror="Les points sont mal saisis a la ligne "+n;
		}
		else{
		var lastchildid=($("#p"+n+"").children().last().attr('id'));
		var temp=calculerpoints(mespointstemp,autrep,win);
		if(lastchildid=="resul"){$("#p"+n+"").children().last().remove()};
		if(temp>=0){$("#p"+n+"").append("<span id='resul' style='color:green;margin-left:5%' >+ "+temp+" </span>");}
		else{$("#p"+n+"").append("<span id='resul' style='color:red;margin-left:5%'> "+temp+" </span>");}
		mespoints+=temp;
			}
		}
	}
	if(error)
		{
			$('#reponseCalcul').text("");
			$('#reponseCalcul').append(liberror);
		}
	else{
	var diff=mespoints-mespointstemp;
	$('#reponseCalcul').text("");
	if(diff>=0){$('#reponseCalcul').append("Vous avez maintenant : <span>"+mespoints+"</span> points (<label style='color:green;'>+ "+diff+"</label>) ").hide().fadeIn(700);}
	if(diff<0){$('#reponseCalcul').append("Vous avez maintenant : <span>"+mespoints+"</span> points (<label style='color:red;'>"+diff+"</label>) ").hide().fadeIn(700);}
	}

}

function calculerpoints(mespoints,autrespoints,gagne)
{
	if(gagne=="gagne"){var win=true;}
	else{var win=false;}
	var coeff=0;
	var sel=$('select').val();
	//alert(sel);
	if(sel==1 || sel==6 || sel==3 || sel==-1){coeff=1}
	if(sel==2  || sel==4){coeff=1.25}
	if(sel==5){coeff=0.5}
	
	
		dif=mespoints-autrespoints;
		var resultat=0;
		if(mespoints>300 && mespoints<4000 && autrespoints>300 && autrespoints<4000)
		{
			
			if (win)
			{
				
				//debut victoires normales
				if(dif>-25&&dif<25)
				{
					resultat=6;
					finale=resultat+mespoints;
					
				}
				if(dif>24&&dif<50)
				{
					resultat=5.5;
					finale=resultat+mespoints;
					
				}
				if(dif>49&&dif<100)
				{
					resultat=5;
					finale=resultat+mespoints;
				
				}
				if(dif>99&&dif<150)
				{
					resultat=4;
					finale=resultat+mespoints;
					
				}
				if(dif>149&&dif<200)
				{
					resultat=3;
					finale=resultat+mespoints;
					
				}
				if(dif>199&&dif<300)
				{
					resultat=2;
					finale=resultat+mespoints;
				
				}
				if(dif>299&&dif<400)
				{
					resultat=1;
					finale=resultat+mespoints;
					
				}
				if(dif>399&&dif<500)
				{
					resultat=0.5;
					finale=resultat+mespoints;
					
				}
				if(dif>499)
				{
					resultat=0;
					finale=resultat+mespoints;
					
				}
				
				//fin victoire normales
				//debut victoire anormales
				if(dif<-24&&dif>-50)
				{
					resultat=7;
					finale=resultat+mespoints;
					
				}
				if(dif<-49&&dif>-100)
				{
					resultat=8;
					finale=resultat+mespoints;
					
				}
				if(dif<-99&&dif>-150)
				{
					resultat=10;
					finale=resultat+mespoints;
					
				}
				if(dif<-149&&dif>-200)
				{
					resultat=13;
					finale=resultat+mespoints;
					
				}
				if(dif<-199&&dif>-300)
				{
					resultat=17;
					finale=resultat+mespoints;
					
				}
				if(dif<-299&&dif>-400)
				{
					resultat=22;
					finale=resultat+mespoints;
					
				}
				if(dif<-399&&dif>-500)
				{
					resultat=28;
					finale=resultat+mespoints;
					
				}
				if(dif<-499)
				{
					resultat=40;
					finale=resultat+mespoints;
					
				}
				
			}
			else{
						
				//debut defaites normales
				if(dif>-25&&dif<25)
				{
					resultat=5;
					finale=mespoints-resultat;
					
				}
				if(dif>24&&dif<50)
				{
					resultat=6;
					finale=mespoints-resultat;
					
				}
				if(dif>49&&dif<100)
				{
					resultat=7;
					finale=mespoints-resultat;
					
				}
				if(dif>99&&dif<150)
				{
					resultat=8;
					finale=mespoints-resultat;
					
				}
				if(dif>149&&dif<200)
				{
					resultat=10;
					finale=mespoints-resultat;
					
				}
				if(dif>199&&dif<300)
				{
					resultat=12.5;
					finale=mespoints-resultat;
					
				}
				if(dif>299&&dif<400)
				{
					resultat=16;
					finale=mespoints-resultat;
					
				}
				if(dif>399&&dif<500)
				{
					resultat=20;
					finale=mespoints-resultat;
					
				}
				if(dif>499)
				{
					resultat=29;
					finale=mespoints-resultat;
					
				}
				//fin defaites normales
				//debut defaites anormales
				if(dif<-24&&dif>-50)
				{
					resultat=4.5;
					finale=mespoints-resultat;
					
				}
				if(dif<-49&&dif>-100)
				{
					resultat=4;
					finale=mespoints-resultat;
					
				}
				if(dif<-99&&dif>-150)
				{
					resultat=3;
					finale=mespoints-resultat;
					
				}
				if(dif<-149&&dif>-200)
				{
					resultat=2;
					finale=mespoints-resultat;
					
				}
				if(dif<-199&&dif>-300)
				{
					resultat=1;
					finale=mespoints-resultat;
					
				}
				if(dif<-299&&dif>-400)
				{
					resultat=0.5;
					finale=mespoints-resultat;
					
				}
				if(dif<-399)
				{
					resultat=0;
					finale=mespoints-resultat;
					
				}
				resultat=resultat*-1;
			}
			resultat=resultat*coeff;
			return resultat;
		}
}
