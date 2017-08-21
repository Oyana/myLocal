$(function(){
	var resizeTimer;
	var site_w;
	var lineHeight;
	var loadingIT = 0;
	var url = window.location.href; 
	var tag = window.location.href.split("#")[1];
	var mmenu = $('nav#menu').mmenu({
		navbar: {
				title: "localHost sweet localHost",
			},
		searchfield: true,
	});
	var refreshW = 2000; // reload .site width 2s after window's reload
	var config_dev = $("#ajaxConfig input[name=dev]").val();
	var config_allowUpdate = $("#ajaxConfig input[name=allowUpdate]").val();
	var config_allowGitScan = $("#ajaxConfig input[name=allowGitScan]").val();
	var config_release = $("#ajaxConfig input[name=release]").val();
	var config_path = $("#ajaxConfig input[name=path]").val();
	var site = $("site").each(function (e)
	{
		return $(this).slideToggle();
	});

	if (
			tag != ''
		&&	tag != null
		&&	tag != "null"
		&&	tag != undefined
		&&	tag != "undefined"
	)
	{

		hashchangeFunction( url );
	}
	// hashchange detection (#pseudoElem)
	$(window).on('hashchange', function(e)
	{
		hashchangeFunction( url );
	});

	// on reload done
	$(window).on('resize', function(e) {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout( updateWSize(), refreshW);
	});

	// on site load
	updateWSize();
	$(mmenu).css({"visibility":"visible"});
	if ( config_allowUpdate )
	{
		$.ajax({
			url: "https://api.github.com/repos/Golgarud/myLocal/releases/latest"
		}).done(function( data ) 
		{
			console.log( data);
			console.log( parseFloat(config_release) +"<"+  parseFloat(data.tag_name) );
			// alert(data[0]["sha"]);
			$("html").append( data );
			// ignore fix release (0.0.x) in test for displaying popup
			// but take it in popup link (if pass popup test)
			if ( parseFloat(config_release) <  parseFloat(data.tag_name) )
			{
				$("#main").append( displayPopUpMaj(data) );
			}			
		});
	}

	$(".loadingfade").each(function()
	{
		loadingIT = loadingIT + 5000;
		var bg = $(this).find('.bck-axe');
		$(this).css({"opacity": 1});
		bg.css({"background-image": "url(" + bg.data("img") + ")"});
	});	
	$(".upload-btn").on("click", function(){
		$('.upload-img').css({"opacity": 1, "display": "block"});
		$('.imgUpl').css({"opacity": 1, "display": "block"});
		$(".foot-link").css({"display": "none"});
	});
});