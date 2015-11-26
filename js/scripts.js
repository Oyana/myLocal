$(function(){
	var site_w = $(".site").css("width");
	var lineHeight = site_w.split("px");
	var url = window.location.href; 
	lineHeight = lineHeight[0]*0.5+"px";
	$('.site').each(function(index, el) {
		$(this).css({
			"height": site_w
		});
	});
	$('.site-content .local-link').each(function(index, el) {
		$(this).css({
			"line-height": lineHeight
		});
	});
	
	var mmenu = $('nav#menu').mmenu();

	function displayConff()
	{
		$('html, body').animate({
			scrollTop: $(document).height()
		}, 1500);
		$.ajax({
			method: "POST",
			data: { "method": "getConfForm" },
			dataType: "html",
			url: 	"./myLocal/index.php"
			}).done(function( data ) {
				$("#conffZone").append( data );
				$("#conffZone").slideToggle(500);
		});
	}

	function cleanTag()
	{
		window.history.pushState("","", url.split("#")[0]);
	}

	function closeMM()
	{
		$(".mm-opened").each(function(index, el)
		{
			$(this).removeClass('mm-opened');
		});
		$(".mm-opening").each(function(index, el)
		{
			$(this).removeClass('mm-opening');
		});
		$(".mm-background").each(function(index, el)
		{
			$(this).removeClass('mm-background');
		});
		$(".mm-current").each(function(index, el)
		{
			$(this).removeClass('mm-current');
		});
		$(".mm-opened").each(function(index, el)
		{
			$(this).removeClass('mm-opened');
		});
		$(".mm-slideOut").each(function(index, el)
		{
			$(this).removeClass('mm-slideOut');
		});
	}

	if ( url.split("#")[1] == "conff" )
	{
		$(window).trigger('hashchange');
		console.log(url.split("#"));
		displayConff();
	}

	$(window).on('hashchange', function(e){
		url = window.location.href; 
		if ( url.split("#")[1] == "conff" )
		{
			closeMM();
			displayConff();
		}
		else if( url.split("#")[1] == "closeConff" )
		{
			$("#conffZone").slideToggle(500);
		}
	});
	$.ajax({
		url: "https://api.github.com/repos/Golgarud/myLocal/commits"
	}).done(function( data ) 
	{
		// alert(data[0]["sha"]);
		$("html").append(  );
	});
});