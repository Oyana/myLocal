$(function(){
	var site_w = $(".site").css("width");
	var lineHeight = site_w.split("px");
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

	$(window).on('hashchange', function(e){
		closeMM();
		$("#conffZone").slideToggle(500);
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
		});
	});
	$.ajax({
		url: 	"https://api.github.com/repos/Golgarud/myLocal/commits"}).done(function( data ) {
		// alert(data[0]["sha"]);
		$("html").append(  );
	});
});