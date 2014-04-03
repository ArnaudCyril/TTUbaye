$(document).ready(function(){
		var tit="";
		$('.photoStyle').hover(function(){
		var tit=$(this).attr("title");
		$('<div style="z-index:10" id="afterTof">'+$(this).attr("title")+'</div>').insertBefore($(this).parent()).hide().fadeIn(1000);
		$('#afterTof').width($(this).width()-20);
		var temp=($('#container').width()/100*5);
		var decal=($('#container').width()-680)/2;
		$('#afterTof').css("margin-left",decal+1-temp);
		//$(this).attr("title","");
		},function(){	
		$('#afterTof').remove();
		//$(this).attr("title",tit);

	});
	
		$('.photoStyle2').hover(function(){
		var tit=$(this).attr("title");
		$('<div style="z-index:10" id="afterTof">'+$(this).attr("title")+'</div>').insertBefore($(this).parent()).hide().fadeIn(1000);
		$('#afterTof').width($(this).width()-20);
		var temp=($('#container').width()/100*5);
		var decal=($('#container').width()-780)/2;
		$('#afterTof').css("margin-left",decal+1-temp+60);
		//$(this).attr("title","");
		},function(){	
		$('#afterTof').remove();
		//$(this).attr("title",tit);

	});

	

	
});